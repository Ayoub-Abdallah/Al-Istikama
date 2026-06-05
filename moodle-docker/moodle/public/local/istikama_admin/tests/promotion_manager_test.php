<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * PHPUnit tests for promotion_manager.
 *
 * Covers:
 *   - single-student promote / retain / graduate
 *   - bulk + per-class promote
 *   - source season != target season requirement
 *   - target season write-blocking (archived/closed)
 *   - audit log row written for every action
 *
 * @covers \local_istikama_admin\promotion_manager
 */
final class promotion_manager_test extends \advanced_testcase {

    private int $fromseason;
    private int $toseason;
    private int $studentid;
    private int $fromclassid;
    private int $toclassid;
    private int $schoolid;

    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
        $this->setAdminUser();

        $gen = $this->getDataGenerator();
        $now = time();

        // Two seasons.
        $this->fromseason = season_manager::create((object)[
            'name' => 'Y1', 'start_date' => $now,            'end_date' => $now + 30 * DAYSECS,
            'status' => season_manager::STATUS_ACTIVE,
        ]);
        $this->toseason = season_manager::create((object)[
            'name' => 'Y2', 'start_date' => $now + 60*DAYSECS, 'end_date' => $now + 120*DAYSECS,
            'status' => season_manager::STATUS_UPCOMING,
        ]);

        // School + class categories.
        $schoolcat = $gen->create_category(['name' => 'School A']);
        $levelcat  = $gen->create_category(['name' => 'Primary', 'parent' => $schoolcat->id]);
        $fromcat   = $gen->create_category(['name' => 'P1',      'parent' => $levelcat->id]);
        $tocat     = $gen->create_category(['name' => 'P2',      'parent' => $levelcat->id]);
        $this->schoolid    = (int)$schoolcat->id;
        $this->fromclassid = (int)$fromcat->id;
        $this->toclassid   = (int)$tocat->id;

        // A student enrolled in the from-class for the from-season.
        $stu = $gen->create_user();
        $this->studentid = (int)$stu->id;
        global $DB;
        $DB->insert_record('istikama_user_school', (object)[
            'userid'       => $this->studentid,
            'schoolid'     => $this->schoolid,
            'levelid'      => (int)$levelcat->id,
            'classid'      => $this->fromclassid,
            'role'         => 'student',
            'seasonid'     => $this->fromseason,
            'timecreated'  => $now,
            'timemodified' => $now,
        ]);
    }

    public function test_promote_creates_new_enrollment_and_audit_row(): void {
        global $DB;
        $logid = promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->toseason, $this->toclassid,
            promotion_manager::ACTION_PROMOTE, 'unit test'
        );
        $this->assertGreaterThan(0, $logid);

        // New enrollment row.
        $newrow = $DB->get_record('istikama_user_school', [
            'userid' => $this->studentid, 'seasonid' => $this->toseason, 'role' => 'student',
        ]);
        $this->assertNotFalse($newrow);
        $this->assertEquals($this->toclassid, (int)$newrow->classid);

        // Source row is untouched.
        $src = $DB->get_record('istikama_user_school', [
            'userid' => $this->studentid, 'seasonid' => $this->fromseason, 'role' => 'student',
        ]);
        $this->assertNotFalse($src);

        // Audit row.
        $log = $DB->get_record('istikama_season_promotion', ['id' => $logid]);
        $this->assertEquals(promotion_manager::ACTION_PROMOTE, $log->action);
        $this->assertEquals($this->fromseason, (int)$log->from_seasonid);
        $this->assertEquals($this->toseason,   (int)$log->to_seasonid);
    }

    public function test_retain_keeps_same_class(): void {
        global $DB;
        promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->toseason, null,
            promotion_manager::ACTION_RETAIN
        );
        $newrow = $DB->get_record('istikama_user_school', [
            'userid' => $this->studentid, 'seasonid' => $this->toseason, 'role' => 'student',
        ]);
        $this->assertEquals($this->fromclassid, (int)$newrow->classid);
    }

    public function test_graduate_writes_no_new_enrollment(): void {
        global $DB;
        promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->toseason, null,
            promotion_manager::ACTION_GRADUATE
        );
        $newrow = $DB->get_record('istikama_user_school', [
            'userid' => $this->studentid, 'seasonid' => $this->toseason, 'role' => 'student',
        ]);
        $this->assertFalse($newrow); // No new enrollment.

        // But the audit log row IS written.
        $log = $DB->record_exists('istikama_season_promotion', [
            'studentid' => $this->studentid, 'action' => promotion_manager::ACTION_GRADUATE,
        ]);
        $this->assertTrue($log);
    }

    public function test_same_season_promotion_throws(): void {
        $this->expectException(\moodle_exception::class);
        promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->fromseason, $this->toclassid
        );
    }

    public function test_promotion_to_archived_season_throws(): void {
        season_manager::change_status($this->toseason, season_manager::STATUS_ARCHIVED);
        $this->expectException(\moodle_exception::class);
        promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->toseason, $this->toclassid
        );
    }

    public function test_promote_bulk_reports_ok_and_failed_counts(): void {
        $bad = 0; // nonexistent student id = 0 -> filtered as invalid.
        $result = promotion_manager::promote_bulk(
            [$this->studentid, $bad], $this->fromseason, $this->toseason, $this->toclassid
        );
        $this->assertEquals(1, $result['ok']);
        $this->assertEquals(0, $result['failed']);
    }

    public function test_promote_class_picks_up_all_students_in_source(): void {
        global $DB;
        // Add a second student to from-class/from-season.
        $stu2 = $this->getDataGenerator()->create_user();
        $DB->insert_record('istikama_user_school', (object)[
            'userid' => $stu2->id, 'schoolid' => $this->schoolid,
            'classid' => $this->fromclassid, 'role' => 'student',
            'seasonid' => $this->fromseason,
            'timecreated' => time(), 'timemodified' => time(),
        ]);

        $result = promotion_manager::promote_class(
            $this->fromclassid, $this->fromseason, $this->toseason, $this->toclassid
        );
        $this->assertEquals(2, $result['ok']);
    }

    public function test_promotion_audit_includes_performer(): void {
        global $DB, $USER;
        $logid = promotion_manager::promote_student(
            $this->studentid, $this->fromseason, $this->toseason, $this->toclassid
        );
        $log = $DB->get_record('istikama_season_promotion', ['id' => $logid]);
        $this->assertEquals((int)$USER->id, (int)$log->performed_by);
    }
}
