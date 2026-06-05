<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * PHPUnit tests for season_manager.
 *
 * Covers:
 *   - create / update / delete lifecycle
 *   - status transition matrix (allowed + forbidden moves)
 *   - atomic active-season switching
 *   - validation rules (name unique, dates ordered, etc.)
 *   - write-blocked detection for archived/closed seasons
 *
 * @covers \local_istikama_admin\season_manager
 */
final class season_manager_test extends \advanced_testcase {

    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
        $this->setAdminUser();
    }

    public function test_create_season_with_valid_data_persists(): void {
        global $DB;
        $now = time();
        $id = season_manager::create((object)[
            'name'        => '2025/2026',
            'description' => 'First season',
            'start_date'  => $now,
            'end_date'    => $now + 365 * DAYSECS,
        ]);
        $this->assertGreaterThan(0, $id);

        $rec = $DB->get_record('istikama_season', ['id' => $id], '*', MUST_EXIST);
        $this->assertEquals('2025/2026', $rec->name);
        $this->assertEquals(season_manager::STATUS_DRAFT, $rec->status);
    }

    public function test_create_with_empty_name_throws(): void {
        $this->expectException(\moodle_exception::class);
        season_manager::create((object)[
            'name'       => '',
            'start_date' => time(),
            'end_date'   => time() + 30 * DAYSECS,
        ]);
    }

    public function test_create_with_end_before_start_throws(): void {
        $this->expectException(\moodle_exception::class);
        season_manager::create((object)[
            'name'       => 'Bad',
            'start_date' => time() + 30 * DAYSECS,
            'end_date'   => time(),
        ]);
    }

    public function test_duplicate_name_throws(): void {
        $now = time();
        season_manager::create((object)[
            'name' => 'Dup', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
        $this->expectException(\moodle_exception::class);
        season_manager::create((object)[
            'name' => 'Dup', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
    }

    public function test_activate_atomically_archives_previous_active(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        $b = season_manager::create((object)[
            'name' => 'B', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
        season_manager::change_status($b, season_manager::STATUS_ACTIVE);

        $this->assertEquals(season_manager::STATUS_ARCHIVED, season_manager::get($a)->status);
        $this->assertEquals(season_manager::STATUS_ACTIVE,   season_manager::get($b)->status);
        $this->assertEquals($b, season_manager::get_active_id());
    }

    public function test_active_to_active_is_noop(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        season_manager::change_status($a, season_manager::STATUS_ACTIVE);
        $this->assertEquals(season_manager::STATUS_ACTIVE, season_manager::get($a)->status);
    }

    public function test_closed_is_terminal(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ARCHIVED,
        ]);
        season_manager::change_status($a, season_manager::STATUS_CLOSED);

        $this->expectException(\moodle_exception::class);
        season_manager::change_status($a, season_manager::STATUS_ACTIVE);
    }

    public function test_forbidden_active_to_draft_throws(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        $this->expectException(\moodle_exception::class);
        season_manager::change_status($a, season_manager::STATUS_DRAFT);
    }

    public function test_update_blocked_on_archived(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ARCHIVED,
        ]);
        $this->expectException(\moodle_exception::class);
        season_manager::update($a, (object)[
            'name' => 'A!', 'start_date' => $now, 'end_date' => $now + 2 * DAYSECS,
        ]);
    }

    public function test_delete_only_allowed_on_draft(): void {
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'D', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
        season_manager::change_status($a, season_manager::STATUS_UPCOMING);
        $this->expectException(\moodle_exception::class);
        season_manager::delete($a);
    }

    public function test_delete_draft_removes_record(): void {
        global $DB;
        $now = time();
        $a = season_manager::create((object)[
            'name' => 'D', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
        season_manager::delete($a);
        $this->assertFalse($DB->record_exists('istikama_season', ['id' => $a]));
    }

    public function test_is_write_blocked_for_each_status(): void {
        $now = time();
        $draft = season_manager::create((object)[
            'name' => 'Dr', 'start_date' => $now, 'end_date' => $now + DAYSECS,
        ]);
        $active = season_manager::create((object)[
            'name' => 'Ac', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        $arch = season_manager::create((object)[
            'name' => 'Ar', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ARCHIVED,
        ]);
        $closed = season_manager::create((object)[
            'name' => 'Cl', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ARCHIVED,
        ]);
        season_manager::change_status($closed, season_manager::STATUS_CLOSED);

        $this->assertFalse(season_manager::is_write_blocked($draft));
        $this->assertFalse(season_manager::is_write_blocked($active));
        $this->assertTrue(season_manager::is_write_blocked($arch));
        $this->assertTrue(season_manager::is_write_blocked($closed));
    }

    public function test_get_active_returns_null_when_no_active(): void {
        $this->assertNull(season_manager::get_active());
        $this->assertEquals(0, season_manager::get_active_id());
        $this->assertFalse(season_manager::has_active());
    }

    public function test_only_one_active_at_a_time(): void {
        global $DB;
        $now = time();
        season_manager::create((object)[
            'name' => 'A', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        season_manager::create((object)[
            'name' => 'B', 'start_date' => $now, 'end_date' => $now + DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        $activeids = $DB->get_records('istikama_season', ['status' => season_manager::STATUS_ACTIVE]);
        $this->assertCount(1, $activeids);
    }
}
