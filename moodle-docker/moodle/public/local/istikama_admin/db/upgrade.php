<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

function xmldb_local_istikama_admin_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2026040101) {

        // ---- Rebuild istikama_content_bank with full schema ----
        $table = new xmldb_table('istikama_content_bank');

        // Add new fields if they don't exist.
        $newfields = [
            'name'           => new xmldb_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'id'),
            'content_type'   => new xmldb_field('content_type', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'document', 'name'),
            'subject'        => new xmldb_field('subject', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'category'),
            'level'          => new xmldb_field('level', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'subject'),
            'lesson'         => new xmldb_field('lesson', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'level'),
            'description'    => new xmldb_field('description', XMLDB_TYPE_TEXT, null, null, null, null, null, 'lesson'),
            'keywords'       => new xmldb_field('keywords', XMLDB_TYPE_CHAR, '1024', null, null, null, null, 'description'),
            'external_url'   => new xmldb_field('external_url', XMLDB_TYPE_CHAR, '1024', null, null, null, null, 'keywords'),
            'file_itemid'    => new xmldb_field('file_itemid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'filename'),
            'contentbank_id' => new xmldb_field('contentbank_id', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'file_itemid'),
            'reject_reason'  => new xmldb_field('reject_reason', XMLDB_TYPE_TEXT, null, null, null, null, null, 'status'),
        ];

        foreach ($newfields as $fname => $field) {
            if (!$dbman->field_exists($table, $fname)) {
                $dbman->add_field($table, $field);
            }
        }

        // ---- Create istikama_content_ratings ----
        $table2 = new xmldb_table('istikama_content_ratings');
        if (!$dbman->table_exists($table2)) {
            $table2->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table2->add_field('content_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table2->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table2->add_field('rating', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL);
            $table2->add_field('rating_type', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'usefulness');
            $table2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table2->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table2->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $table2->add_index('content_user_type_uix', XMLDB_INDEX_UNIQUE, ['content_id', 'userid', 'rating_type']);
            $dbman->create_table($table2);
        }

        // ---- Create istikama_content_comments ----
        $table3 = new xmldb_table('istikama_content_comments');
        if (!$dbman->table_exists($table3)) {
            $table3->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table3->add_field('content_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table3->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table3->add_field('comment_text', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL);
            $table3->add_field('parent_id', XMLDB_TYPE_INTEGER, '10');
            $table3->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table3->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table3->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $table3->add_index('content_time_ix', XMLDB_INDEX_NOTUNIQUE, ['content_id', 'timecreated']);
            $dbman->create_table($table3);
        }

        upgrade_plugin_savepoint(true, 2026040101, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040301) {
        // Create istikama_school_info table.
        $table = new xmldb_table('istikama_school_info');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('categoryid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('institution_code', XMLDB_TYPE_CHAR, '50');
            $table->add_field('wilaya_code', XMLDB_TYPE_CHAR, '10');
            $table->add_field('wilaya_name', XMLDB_TYPE_CHAR, '255');
            $table->add_field('commune_code', XMLDB_TYPE_CHAR, '10');
            $table->add_field('commune_name', XMLDB_TYPE_CHAR, '255');
            $table->add_field('address', XMLDB_TYPE_TEXT);
            $table->add_field('phone', XMLDB_TYPE_CHAR, '30');
            $table->add_field('email', XMLDB_TYPE_CHAR, '255');
            $table->add_field('admin_userid', XMLDB_TYPE_INTEGER, '10');
            $table->add_field('logo_itemid', XMLDB_TYPE_INTEGER, '10');
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);

            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table->add_key('categoryid_fk', XMLDB_KEY_FOREIGN_UNIQUE, ['categoryid'], 'course_categories', ['id']);

            $table->add_index('institution_code_ix', XMLDB_INDEX_NOTUNIQUE, ['institution_code']);
            $table->add_index('wilaya_code_ix', XMLDB_INDEX_NOTUNIQUE, ['wilaya_code']);
            $table->add_index('admin_userid_ix', XMLDB_INDEX_NOTUNIQUE, ['admin_userid']);

            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026040301, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040302) {
        // Create istikama_user_school table.
        $table = new xmldb_table('istikama_user_school');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('schoolid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('levelid', XMLDB_TYPE_INTEGER, '10');
            $table->add_field('classid', XMLDB_TYPE_INTEGER, '10');
            $table->add_field('role', XMLDB_TYPE_CHAR, '20', null, XMLDB_NOTNULL);
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);

            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

            $table->add_index('userid_role_ix', XMLDB_INDEX_NOTUNIQUE, ['userid', 'role']);
            $table->add_index('schoolid_ix', XMLDB_INDEX_NOTUNIQUE, ['schoolid']);
            $table->add_index('userid_schoolid_role_uix', XMLDB_INDEX_UNIQUE, ['userid', 'schoolid', 'levelid', 'classid', 'role']);

            $dbman->create_table($table);
        }

        // Create istikama_teacher_subject table.
        $table2 = new xmldb_table('istikama_teacher_subject');
        if (!$dbman->table_exists($table2)) {
            $table2->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table2->add_field('assignmentid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table2->add_field('subject', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL);
            $table2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);

            $table2->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table2->add_key('assignmentid_fk', XMLDB_KEY_FOREIGN, ['assignmentid'], 'istikama_user_school', ['id']);

            $table2->add_index('assignmentid_subject_uix', XMLDB_INDEX_UNIQUE, ['assignmentid', 'subject']);

            $dbman->create_table($table2);
        }

        upgrade_plugin_savepoint(true, 2026040302, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040304) {
        // Create istikama_teacher_activities table.
        $t1 = new xmldb_table('istikama_teacher_activities');
        if (!$dbman->table_exists($t1)) {
            $t1->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t1->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL);
            $t1->add_field('type', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'quiz');
            $t1->add_field('description', XMLDB_TYPE_TEXT);
            $t1->add_field('questions_json', XMLDB_TYPE_TEXT);
            $t1->add_field('created_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('schoolid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('classid', XMLDB_TYPE_INTEGER, '10');
            $t1->add_field('subject', XMLDB_TYPE_CHAR, '100');
            $t1->add_field('status', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'active');
            $t1->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t1->add_index('created_by_ix', XMLDB_INDEX_NOTUNIQUE, ['created_by']);
            $t1->add_index('schoolid_ix', XMLDB_INDEX_NOTUNIQUE, ['schoolid']);
            $t1->add_index('classid_ix', XMLDB_INDEX_NOTUNIQUE, ['classid']);
            $dbman->create_table($t1);
        }

        // Create istikama_content_lesson_link table.
        $t2 = new xmldb_table('istikama_content_lesson_link');
        if (!$dbman->table_exists($t2)) {
            $t2->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t2->add_field('content_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('linked_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t2->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $t2->add_index('content_course_uix', XMLDB_INDEX_UNIQUE, ['content_id', 'courseid', 'classid']);
            $t2->add_index('courseid_ix', XMLDB_INDEX_NOTUNIQUE, ['courseid']);
            $dbman->create_table($t2);
        }

        // Create istikama_activity_lesson_link table.
        $t3 = new xmldb_table('istikama_activity_lesson_link');
        if (!$dbman->table_exists($t3)) {
            $t3->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t3->add_field('activity_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_field('linked_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t3->add_key('activity_fk', XMLDB_KEY_FOREIGN, ['activity_id'], 'istikama_teacher_activities', ['id']);
            $t3->add_index('activity_course_uix', XMLDB_INDEX_UNIQUE, ['activity_id', 'courseid', 'classid']);
            $t3->add_index('courseid_ix', XMLDB_INDEX_NOTUNIQUE, ['courseid']);
            $dbman->create_table($t3);
        }

        // Create istikama_attendance table.
        $t4 = new xmldb_table('istikama_attendance');
        if (!$dbman->table_exists($t4)) {
            $t4->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t4->add_field('studentid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('attend_date', XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL);
            $t4->add_field('status', XMLDB_TYPE_CHAR, '16', null, XMLDB_NOTNULL, null, 'present');
            $t4->add_field('behavior_note', XMLDB_TYPE_TEXT);
            $t4->add_field('recorded_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t4->add_index('student_class_date_uix', XMLDB_INDEX_UNIQUE, ['studentid', 'classid', 'attend_date']);
            $t4->add_index('classid_date_ix', XMLDB_INDEX_NOTUNIQUE, ['classid', 'attend_date']);
            $dbman->create_table($t4);
        }

        // Create istikama_assessments table.
        $t5 = new xmldb_table('istikama_assessments');
        if (!$dbman->table_exists($t5)) {
            $t5->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t5->add_field('studentid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t5->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t5->add_field('subject', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL);
            $t5->add_field('title', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL);
            $t5->add_field('score', XMLDB_TYPE_NUMBER, '10', null, null, null, null);
            $t5->add_field('max_score', XMLDB_TYPE_NUMBER, '10', null, null, null, null);
            $t5->add_field('notes', XMLDB_TYPE_TEXT);
            $t5->add_field('assessed_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t5->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t5->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t5->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t5->add_index('studentid_classid_ix', XMLDB_INDEX_NOTUNIQUE, ['studentid', 'classid']);
            $t5->add_index('classid_subject_ix', XMLDB_INDEX_NOTUNIQUE, ['classid', 'subject']);
            $t5->add_index('assessed_by_ix', XMLDB_INDEX_NOTUNIQUE, ['assessed_by']);
            $dbman->create_table($t5);
        }

        upgrade_plugin_savepoint(true, 2026040304, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040401) {
        $t1 = new xmldb_table('istikama_global_level');
        if (!$dbman->table_exists($t1)) {
            $t1->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t1->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL);
            $t1->add_field('order_index', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
            $t1->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t1->add_index('order_ix', XMLDB_INDEX_NOTUNIQUE, ['order_index']);
            $dbman->create_table($t1);

            // Seed global levels logically.
            $levels = [
                'Primary 1' => 1, 'Primary 2' => 2, 'Primary 3' => 3, 'Primary 4' => 4, 'Primary 5' => 5,
                'Middle 1' => 6, 'Middle 2' => 7, 'Middle 3' => 8, 'Middle 4' => 9,
                'Secondary 1' => 10, 'Secondary 2' => 11, 'Secondary 3' => 12
            ];

            foreach ($levels as $lname => $order) {
                $gl = new stdClass();
                $gl->name = $lname;
                $gl->order_index = $order;
                $gl->timecreated = time();
                $gl->timemodified = time();
                $DB->insert_record('istikama_global_level', $gl);
            }
        }

        $t2 = new xmldb_table('istikama_subject_names');
        if (!$dbman->table_exists($t2)) {
            $t2->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t2->add_field('level_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL);
            $t2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t2->add_key('level_fk', XMLDB_KEY_FOREIGN, ['level_id'], 'istikama_global_level', ['id']);
            $dbman->create_table($t2);
            
            // Seed base subjects based on standard Algerian curriculum roughly.
            $seeded_levels = $DB->get_records('istikama_global_level');
            $primary_subjects = ['Mathematics', 'Arabic Language', 'French Language', 'Islamic Studies', 'Science', 'History & Geography'];
            $mixed_subjects = array_merge($primary_subjects, ['Physics', 'English Language', 'Informatics']);
            $secondary_subjects = array_merge($mixed_subjects, ['Chemistry', 'Biology', 'Philosophy']);
            
            foreach ($seeded_levels as $l) {
                $subs = [];
                if ($l->order_index <= 5) $subs = $primary_subjects;
                else if ($l->order_index <= 9) $subs = $mixed_subjects;
                else $subs = $secondary_subjects;
                
                foreach ($subs as $sname) {
                    $gs = new stdClass();
                    $gs->level_id = $l->id;
                    $gs->name = $sname;
                    $gs->timecreated = time();
                    $DB->insert_record('istikama_subject_names', $gs);
                }
            }
        }

        $t3 = new xmldb_table('istikama_level_info');
        if (!$dbman->table_exists($t3)) {
            $t3->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t3->add_field('categoryid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_field('global_level_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t3->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t3->add_key('category_fk', XMLDB_KEY_FOREIGN_UNIQUE, ['categoryid'], 'course_categories', ['id']);
            $t3->add_key('global_level_fk', XMLDB_KEY_FOREIGN, ['global_level_id'], 'istikama_global_level', ['id']);
            $dbman->create_table($t3);
        }

        upgrade_plugin_savepoint(true, 2026040401, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040402) {
        $t4 = new xmldb_table('istikama_class_subjects');
        if (!$dbman->table_exists($t4)) {
            $t4->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t4->add_field('classid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('subject_name_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t4->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t4->add_key('class_fk', XMLDB_KEY_FOREIGN, ['classid'], 'course_categories', ['id']);
            $t4->add_key('subject_fk', XMLDB_KEY_FOREIGN, ['subject_name_id'], 'istikama_subject_names', ['id']);
            $t4->add_key('course_fk', XMLDB_KEY_FOREIGN_UNIQUE, ['courseid'], 'course', ['id']);
            $t4->add_index('class_subject_uix', XMLDB_INDEX_UNIQUE, ['classid', 'subject_name_id']);
            $dbman->create_table($t4);
        }

        upgrade_plugin_savepoint(true, 2026040402, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040403) {
        $table1 = new xmldb_table('istikama_global_subject');
        if ($dbman->table_exists($table1)) {
            $dbman->rename_table($table1, 'istikama_subject_names');
        }

        $table2 = new xmldb_table('istikama_class_subject');
        if ($dbman->table_exists($table2)) {
            $field = new xmldb_field('global_subject_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            if ($dbman->field_exists($table2, $field)) {
                $dbman->rename_field($table2, $field, 'subject_name_id');
            }
            $dbman->rename_table($table2, 'istikama_class_subjects');
        }

        upgrade_plugin_savepoint(true, 2026040403, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026040600) {
        $table = new xmldb_table('istikama_support_tickets');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('subject', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL);
            $table->add_field('message', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL);
            $table->add_field('severity', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'normal');
            $table->add_field('status', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'open');
            $table->add_field('admin_notes', XMLDB_TYPE_TEXT, null, null, null);
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table->add_index('userid_ix', XMLDB_INDEX_NOTUNIQUE, ['userid']);
            $table->add_index('status_ix', XMLDB_INDEX_NOTUNIQUE, ['status']);
            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026040600, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026042201) {
        // Create istikama_parent_child table.
        $table = new xmldb_table('istikama_parent_child');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('parentid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('childid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table->add_index('parentid_childid_uix', XMLDB_INDEX_UNIQUE, ['parentid', 'childid']);
            $table->add_index('parentid_ix', XMLDB_INDEX_NOTUNIQUE, ['parentid']);
            $table->add_index('childid_ix', XMLDB_INDEX_NOTUNIQUE, ['childid']);
            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026042201, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026051201) {
        // Question metadata + moderation table — durable mapping of a question
        // to its Level + Subject (independent of category renames), plus review flags.
        $table = new xmldb_table('istikama_question_meta');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id',                XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('qbe_id',            XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');
            $table->add_field('levelid',           XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'qbe_id');
            $table->add_field('subjectid',         XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'levelid');
            $table->add_field('createdby',         XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'subjectid');
            $table->add_field('review_status',     XMLDB_TYPE_CHAR,    '16', null, XMLDB_NOTNULL, null, 'approved', 'createdby');
            $table->add_field('reported',          XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '0', 'review_status');
            $table->add_field('reportedby',        XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'reported');
            $table->add_field('reportreason',      XMLDB_TYPE_TEXT,    null, null, null, null, null, 'reportedby');
            $table->add_field('timecreated',       XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'reportreason');
            $table->add_field('timemodified',      XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'timecreated');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table->add_index('qbe_uix',       XMLDB_INDEX_UNIQUE,    ['qbe_id']);
            $table->add_index('levelid_ix',    XMLDB_INDEX_NOTUNIQUE, ['levelid']);
            $table->add_index('subjectid_ix',  XMLDB_INDEX_NOTUNIQUE, ['subjectid']);
            $table->add_index('reported_ix',   XMLDB_INDEX_NOTUNIQUE, ['reported']);
            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026051201, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026051203) {
        // Reusable quiz metadata — durable Level + Subject mapping for a quiz
        // owned by the central QB course, plus review/moderation flags.
        $table = new xmldb_table('istikama_quiz_meta');
        if (!$dbman->table_exists($table)) {
            $table->add_field('id',            XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field('quizid',        XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');
            $table->add_field('cmid',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'quizid');
            $table->add_field('levelid',       XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'cmid');
            $table->add_field('subjectid',     XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'levelid');
            $table->add_field('createdby',     XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'subjectid');
            $table->add_field('reusable',      XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '1', 'createdby');
            $table->add_field('review_status', XMLDB_TYPE_CHAR,    '16', null, XMLDB_NOTNULL, null, 'approved', 'reusable');
            $table->add_field('reported',      XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '0', 'review_status');
            $table->add_field('reportedby',    XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'reported');
            $table->add_field('reportreason',  XMLDB_TYPE_TEXT,    null, null, null, null, null, 'reportedby');
            $table->add_field('timecreated',   XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'reportreason');
            $table->add_field('timemodified',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'timecreated');
            $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $table->add_index('quizid_uix',    XMLDB_INDEX_UNIQUE,    ['quizid']);
            $table->add_index('levelid_ix',    XMLDB_INDEX_NOTUNIQUE, ['levelid']);
            $table->add_index('subjectid_ix',  XMLDB_INDEX_NOTUNIQUE, ['subjectid']);
            $table->add_index('reusable_ix',   XMLDB_INDEX_NOTUNIQUE, ['reusable']);
            $dbman->create_table($table);
        }

        upgrade_plugin_savepoint(true, 2026051203, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026051902) {

        // ---- Create istikama_content_status_history (audit trail) ----
        $t1 = new xmldb_table('istikama_content_status_history');
        if (!$dbman->table_exists($t1)) {
            $t1->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t1->add_field('content_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('old_status', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL);
            $t1->add_field('new_status', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL);
            $t1->add_field('changed_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_field('notes', XMLDB_TYPE_TEXT, null, null, null);
            $t1->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t1->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t1->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $t1->add_index('content_time_ix', XMLDB_INDEX_NOTUNIQUE, ['content_id', 'timecreated']);
            $dbman->create_table($t1);
        }

        // ---- Create istikama_content_tags (structured tagging) ----
        $t2 = new xmldb_table('istikama_content_tags');
        if (!$dbman->table_exists($t2)) {
            $t2->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $t2->add_field('content_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('tag', XMLDB_TYPE_CHAR, '128', null, XMLDB_NOTNULL);
            $t2->add_field('tag_type', XMLDB_TYPE_CHAR, '32', null, XMLDB_NOTNULL, null, 'custom');
            $t2->add_field('added_by', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $t2->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $t2->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $t2->add_index('content_tag_uix', XMLDB_INDEX_UNIQUE, ['content_id', 'tag']);
            $t2->add_index('tag_ix', XMLDB_INDEX_NOTUNIQUE, ['tag']);
            $dbman->create_table($t2);
        }

        upgrade_plugin_savepoint(true, 2026051902, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026052301) {
        // -----------------------------------------------------------------
        // Phase 1 — Academic Seasons foundation
        // -----------------------------------------------------------------

        // 1) Add `tier` column to istikama_global_level (primary|middle|high).
        $lvltable = new xmldb_table('istikama_global_level');
        $tierfield = new xmldb_field('tier', XMLDB_TYPE_CHAR, '16', null, XMLDB_NOTNULL, null, 'primary', 'name');
        if ($dbman->table_exists($lvltable) && !$dbman->field_exists($lvltable, $tierfield)) {
            $dbman->add_field($lvltable, $tierfield);

            // Backfill tier from existing order_index heuristic (Algerian curriculum default).
            $existing = $DB->get_records('istikama_global_level');
            foreach ($existing as $lvl) {
                if ($lvl->order_index <= 5) {
                    $tier = 'primary';
                } else if ($lvl->order_index <= 9) {
                    $tier = 'middle';
                } else {
                    $tier = 'high';
                }
                $DB->set_field('istikama_global_level', 'tier', $tier, ['id' => $lvl->id]);
            }

            $tieridx = new xmldb_index('tier_ix', XMLDB_INDEX_NOTUNIQUE, ['tier']);
            if (!$dbman->index_exists($lvltable, $tieridx)) {
                $dbman->add_index($lvltable, $tieridx);
            }
        }

        // 2) Create istikama_season (the core academic year entity).
        $season = new xmldb_table('istikama_season');
        if (!$dbman->table_exists($season)) {
            $season->add_field('id',           XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $season->add_field('name',         XMLDB_TYPE_CHAR,    '100', null, XMLDB_NOTNULL);
            $season->add_field('description',  XMLDB_TYPE_TEXT,    null,  null, null);
            $season->add_field('start_date',   XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL);
            $season->add_field('end_date',     XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL);
            $season->add_field('status',       XMLDB_TYPE_CHAR,    '16',  null, XMLDB_NOTNULL, null, 'draft');
            $season->add_field('created_by',   XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL);
            $season->add_field('timecreated',  XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL);
            $season->add_field('timemodified', XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL);

            $season->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

            $season->add_index('name_uix',      XMLDB_INDEX_UNIQUE,    ['name']);
            $season->add_index('status_ix',     XMLDB_INDEX_NOTUNIQUE, ['status']);
            $season->add_index('start_date_ix', XMLDB_INDEX_NOTUNIQUE, ['start_date']);

            $dbman->create_table($season);
        }

        // 3) Create istikama_school_level (school↔level mapping).
        $schoollvl = new xmldb_table('istikama_school_level');
        if (!$dbman->table_exists($schoollvl)) {
            $schoollvl->add_field('id',              XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $schoollvl->add_field('schoolid',        XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $schoollvl->add_field('global_level_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $schoollvl->add_field('enabled',         XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '1');
            $schoollvl->add_field('timecreated',     XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $schoollvl->add_field('timemodified',    XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $schoollvl->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $schoollvl->add_key('global_level_fk', XMLDB_KEY_FOREIGN, ['global_level_id'], 'istikama_global_level', ['id']);
            $schoollvl->add_index('school_level_uix', XMLDB_INDEX_UNIQUE,    ['schoolid', 'global_level_id']);
            $schoollvl->add_index('schoolid_ix',      XMLDB_INDEX_NOTUNIQUE, ['schoolid']);
            $dbman->create_table($schoollvl);
        }

        // 4) Create istikama_season_promotion (promotion/retention audit log).
        $promo = new xmldb_table('istikama_season_promotion');
        if (!$dbman->table_exists($promo)) {
            $promo->add_field('id',            XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $promo->add_field('studentid',     XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $promo->add_field('from_seasonid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $promo->add_field('to_seasonid',   XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $promo->add_field('from_classid',  XMLDB_TYPE_INTEGER, '10');
            $promo->add_field('to_classid',    XMLDB_TYPE_INTEGER, '10');
            $promo->add_field('action',        XMLDB_TYPE_CHAR,    '16', null, XMLDB_NOTNULL, null, 'promote');
            $promo->add_field('notes',         XMLDB_TYPE_TEXT,    null, null, null);
            $promo->add_field('performed_by',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $promo->add_field('timecreated',   XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);

            $promo->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $promo->add_key('from_season_fk', XMLDB_KEY_FOREIGN, ['from_seasonid'], 'istikama_season', ['id']);
            $promo->add_key('to_season_fk',   XMLDB_KEY_FOREIGN, ['to_seasonid'],   'istikama_season', ['id']);

            $promo->add_index('studentid_to_season_ix', XMLDB_INDEX_NOTUNIQUE, ['studentid', 'to_seasonid']);

            $dbman->create_table($promo);
        }

        // 5) Sync tables that existed in upgrade.php but were missing from install.xml.
        // (No-op for existing installs; only relevant if install was somehow partial.)
        $sht = new xmldb_table('istikama_content_status_history');
        if (!$dbman->table_exists($sht)) {
            $sht->add_field('id',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $sht->add_field('content_id',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $sht->add_field('old_status',  XMLDB_TYPE_CHAR,    '32', null, XMLDB_NOTNULL);
            $sht->add_field('new_status',  XMLDB_TYPE_CHAR,    '32', null, XMLDB_NOTNULL);
            $sht->add_field('changed_by',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $sht->add_field('notes',       XMLDB_TYPE_TEXT,    null, null, null);
            $sht->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL);
            $sht->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $sht->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $sht->add_index('content_time_ix', XMLDB_INDEX_NOTUNIQUE, ['content_id', 'timecreated']);
            $dbman->create_table($sht);
        }

        upgrade_plugin_savepoint(true, 2026052301, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026052302) {
        // -----------------------------------------------------------------
        // Phase 2 — Season-stamp existing tables (additive, NULL by default).
        // Existing rows are NOT backfilled; admin must set the active season
        // first and then re-run promotion / migration tooling to associate
        // historical rows with seasons.
        // -----------------------------------------------------------------

        // istikama_user_school: add seasonid + index. Drop the old strict
        // unique index because (userid, schoolid, levelid, classid, role) is
        // no longer globally unique across seasons.
        $t = new xmldb_table('istikama_user_school');
        $f = new xmldb_field('seasonid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'role');
        if (!$dbman->field_exists($t, $f)) {
            $dbman->add_field($t, $f);
        }
        $oldidx = new xmldb_index('userid_schoolid_role_uix', XMLDB_INDEX_UNIQUE,
            ['userid', 'schoolid', 'levelid', 'classid', 'role']);
        if ($dbman->index_exists($t, $oldidx)) {
            $dbman->drop_index($t, $oldidx);
        }
        $newix1 = new xmldb_index('seasonid_ix', XMLDB_INDEX_NOTUNIQUE, ['seasonid']);
        if (!$dbman->index_exists($t, $newix1)) {
            $dbman->add_index($t, $newix1);
        }
        $newix2 = new xmldb_index('userid_season_role_ix', XMLDB_INDEX_NOTUNIQUE, ['userid', 'seasonid', 'role']);
        if (!$dbman->index_exists($t, $newix2)) {
            $dbman->add_index($t, $newix2);
        }

        // istikama_teacher_subject: add seasonid (denormalized for fast filtering).
        $t2 = new xmldb_table('istikama_teacher_subject');
        $f2 = new xmldb_field('seasonid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'subject');
        if (!$dbman->field_exists($t2, $f2)) {
            $dbman->add_field($t2, $f2);
        }
        $ix2 = new xmldb_index('seasonid_ix', XMLDB_INDEX_NOTUNIQUE, ['seasonid']);
        if (!$dbman->index_exists($t2, $ix2)) {
            $dbman->add_index($t2, $ix2);
        }

        // istikama_teacher_activities: add seasonid.
        $t3 = new xmldb_table('istikama_teacher_activities');
        $f3 = new xmldb_field('seasonid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'status');
        if (!$dbman->field_exists($t3, $f3)) {
            $dbman->add_field($t3, $f3);
        }
        $ix3 = new xmldb_index('seasonid_ix', XMLDB_INDEX_NOTUNIQUE, ['seasonid']);
        if (!$dbman->index_exists($t3, $ix3)) {
            $dbman->add_index($t3, $ix3);
        }

        // istikama_attendance: add seasonid.
        $t4 = new xmldb_table('istikama_attendance');
        $f4 = new xmldb_field('seasonid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'recorded_by');
        if (!$dbman->field_exists($t4, $f4)) {
            $dbman->add_field($t4, $f4);
        }
        $ix4 = new xmldb_index('seasonid_ix', XMLDB_INDEX_NOTUNIQUE, ['seasonid']);
        if (!$dbman->index_exists($t4, $ix4)) {
            $dbman->add_index($t4, $ix4);
        }

        // istikama_assessments: add seasonid.
        $t5 = new xmldb_table('istikama_assessments');
        $f5 = new xmldb_field('seasonid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'assessed_by');
        if (!$dbman->field_exists($t5, $f5)) {
            $dbman->add_field($t5, $f5);
        }
        $ix5 = new xmldb_index('seasonid_ix', XMLDB_INDEX_NOTUNIQUE, ['seasonid']);
        if (!$dbman->index_exists($t5, $ix5)) {
            $dbman->add_index($t5, $ix5);
        }

        upgrade_plugin_savepoint(true, 2026052302, 'local', 'istikama_admin');
    }

    // ─────────────────────────────────────────────────────────────────────
    // 2026052502 — Add `status` column to istikama_user_school
    // ─────────────────────────────────────────────────────────────────────
    if ($oldversion < 2026052502) {
        $t = new xmldb_table('istikama_user_school');
        $f = new xmldb_field('status', XMLDB_TYPE_CHAR, '20', null,
            XMLDB_NOTNULL, null, 'enrolled', 'seasonid');
        if (!$dbman->field_exists($t, $f)) {
            $dbman->add_field($t, $f);
        }
        $ix = new xmldb_index('status_ix', XMLDB_INDEX_NOTUNIQUE, ['status']);
        if (!$dbman->index_exists($t, $ix)) {
            $dbman->add_index($t, $ix);
        }
        // Backfill existing rows: any row without a status gets 'enrolled'.
        $DB->execute("UPDATE {istikama_user_school} SET status = 'enrolled'
                       WHERE status IS NULL OR status = ''");

        upgrade_plugin_savepoint(true, 2026052502, 'local', 'istikama_admin');
    }

    // ─────────────────────────────────────────────────────────────────────
    // 2026052601 — Multi-level + multi-subject content (M:N relations)
    // ─────────────────────────────────────────────────────────────────────
    if ($oldversion < 2026052601) {
        // istikama_content_levels
        $t = new xmldb_table('istikama_content_levels');
        if (!$dbman->table_exists($t)) {
            $t->add_field('id',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $t->add_field('content_id',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $t->add_field('level_key',   XMLDB_TYPE_CHAR,   '100', null, XMLDB_NOTNULL, null, null);
            $t->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $t->add_key('primary',    XMLDB_KEY_PRIMARY, ['id']);
            $t->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $t->add_index('content_level_uix', XMLDB_INDEX_UNIQUE,    ['content_id', 'level_key']);
            $t->add_index('level_key_ix',      XMLDB_INDEX_NOTUNIQUE, ['level_key']);
            $dbman->create_table($t);
        }

        // istikama_content_subjects
        $t2 = new xmldb_table('istikama_content_subjects');
        if (!$dbman->table_exists($t2)) {
            $t2->add_field('id',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $t2->add_field('content_id',  XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $t2->add_field('subject_key', XMLDB_TYPE_CHAR,   '100', null, XMLDB_NOTNULL, null, null);
            $t2->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $t2->add_key('primary',    XMLDB_KEY_PRIMARY, ['id']);
            $t2->add_key('content_fk', XMLDB_KEY_FOREIGN, ['content_id'], 'istikama_content_bank', ['id']);
            $t2->add_index('content_subject_uix', XMLDB_INDEX_UNIQUE,    ['content_id', 'subject_key']);
            $t2->add_index('subject_key_ix',      XMLDB_INDEX_NOTUNIQUE, ['subject_key']);
            $dbman->create_table($t2);
        }

        // Backfill: copy the single denormalized level/subject from istikama_content_bank
        // into the M:N tables so every existing content row appears under its primary
        // level + subject. Idempotent — uses unique indexes to skip dupes on rerun.
        $now = time();
        $rows = $DB->get_records_select('istikama_content_bank',
            "(level IS NOT NULL AND level <> '') OR (subject IS NOT NULL AND subject <> '')",
            null, '', 'id, level, subject');
        foreach ($rows as $r) {
            if (!empty($r->level)) {
                $exists = $DB->record_exists('istikama_content_levels',
                    ['content_id' => $r->id, 'level_key' => $r->level]);
                if (!$exists) {
                    $DB->insert_record('istikama_content_levels', (object)[
                        'content_id'  => (int)$r->id,
                        'level_key'   => $r->level,
                        'timecreated' => $now,
                    ]);
                }
            }
            if (!empty($r->subject)) {
                $exists = $DB->record_exists('istikama_content_subjects',
                    ['content_id' => $r->id, 'subject_key' => $r->subject]);
                if (!$exists) {
                    $DB->insert_record('istikama_content_subjects', (object)[
                        'content_id'  => (int)$r->id,
                        'subject_key' => $r->subject,
                        'timecreated' => $now,
                    ]);
                }
            }
        }

        upgrade_plugin_savepoint(true, 2026052601, 'local', 'istikama_admin');
    }

    // ── 0.20: Full Technical Support / Ticketing System ────────────────────
    // Extend istikama_support_tickets with lifecycle + ownership fields and
    // create istikama_support_messages for the conversation thread.
    if ($oldversion < 2026052801) {
        $dbman = $DB->get_manager();
        $table = new xmldb_table('istikama_support_tickets');

        // Add new columns one by one (idempotent — field_exists guards).
        $newfields = [
            ['role',          XMLDB_TYPE_CHAR,   '32',  null, null,             null, null, 'userid'],
            ['schoolid',      XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'role'],
            ['seasonid',      XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'schoolid'],
            ['category',      XMLDB_TYPE_CHAR,   '64',  null, XMLDB_NOTNULL,    null, 'other',  'seasonid'],
            ['priority',      XMLDB_TYPE_CHAR,   '32',  null, XMLDB_NOTNULL,    null, 'normal', 'category'],
            ['assigned_to',   XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'status'],
            ['lastreplytime', XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'admin_notes'],
            ['lastreplyby',   XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'lastreplytime'],
            ['resolvedtime',  XMLDB_TYPE_INTEGER,'10',  null, null,             null, null, 'lastreplyby'],
        ];
        foreach ($newfields as $spec) {
            [$name, $type, $length, $unsigned, $notnull, $sequence, $default, $previous] = $spec;
            $field = new xmldb_field($name, $type, $length, $unsigned, $notnull, $sequence, $default, $previous);
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }

        // Helpful indexes.
        foreach ([
            ['schoolid_ix',  ['schoolid']],
            ['assigned_ix',  ['assigned_to']],
            ['lastreply_ix', ['lastreplytime']],
        ] as [$idxname, $fields]) {
            $idx = new xmldb_index($idxname, XMLDB_INDEX_NOTUNIQUE, $fields);
            if (!$dbman->index_exists($table, $idx)) {
                $dbman->add_index($table, $idx);
            }
        }

        // New messages table.
        // Build via xmldb_table::add_field positional API (Moodle convention),
        // not by passing pre-built xmldb_field instances.
        $msgs = new xmldb_table('istikama_support_messages');
        if (!$dbman->table_exists($msgs)) {
            $msgs->add_field('id',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $msgs->add_field('ticketid',    XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $msgs->add_field('userid',      XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $msgs->add_field('message',     XMLDB_TYPE_TEXT,    null, null, XMLDB_NOTNULL, null, null);
            $msgs->add_field('is_internal', XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '0');
            $msgs->add_field('is_system',   XMLDB_TYPE_INTEGER, '1',  null, XMLDB_NOTNULL, null, '0');
            $msgs->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $msgs->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $msgs->add_index('ticketid_ix', XMLDB_INDEX_NOTUNIQUE, ['ticketid']);
            $msgs->add_index('userid_ix',   XMLDB_INDEX_NOTUNIQUE, ['userid']);
            $dbman->create_table($msgs);
        }

        upgrade_plugin_savepoint(true, 2026052801, 'local', 'istikama_admin');
    }

    // ── 0.21: School notifications system ──────────────────────────────────
    if ($oldversion < 2026053101) {
        $dbman = $DB->get_manager();

        $tbl = new xmldb_table('istikama_school_notification');
        if (!$dbman->table_exists($tbl)) {
            $tbl->add_field('id',             XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $tbl->add_field('schoolid',       XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, null, null);
            $tbl->add_field('createdby',      XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, null, null);
            $tbl->add_field('title',          XMLDB_TYPE_CHAR,    '255', null, XMLDB_NOTNULL, null, null);
            $tbl->add_field('body',           XMLDB_TYPE_TEXT,    null,  null, XMLDB_NOTNULL, null, null);
            $tbl->add_field('audience_role',  XMLDB_TYPE_CHAR,    '32',  null, null,          null, null);
            $tbl->add_field('audience_classid', XMLDB_TYPE_INTEGER, '10', null, null,         null, null);
            $tbl->add_field('audience_levelid', XMLDB_TYPE_INTEGER, '10', null, null,         null, null);
            $tbl->add_field('status',         XMLDB_TYPE_CHAR,    '32',  null, XMLDB_NOTNULL, null, 'draft');
            $tbl->add_field('scheduledfor',   XMLDB_TYPE_INTEGER, '10',  null, null,          null, null);
            $tbl->add_field('sentat',         XMLDB_TYPE_INTEGER, '10',  null, null,          null, null);
            $tbl->add_field('sentby',         XMLDB_TYPE_INTEGER, '10',  null, null,          null, null);
            $tbl->add_field('recipients_count', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
            $tbl->add_field('read_count',     XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, null, '0');
            $tbl->add_field('timecreated',    XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, null, null);
            $tbl->add_field('timemodified',   XMLDB_TYPE_INTEGER, '10',  null, XMLDB_NOTNULL, null, null);
            $tbl->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $tbl->add_index('schoolid_ix', XMLDB_INDEX_NOTUNIQUE, ['schoolid']);
            $tbl->add_index('status_ix',   XMLDB_INDEX_NOTUNIQUE, ['status']);
            $tbl->add_index('sentat_ix',   XMLDB_INDEX_NOTUNIQUE, ['sentat']);
            $dbman->create_table($tbl);
        }

        upgrade_plugin_savepoint(true, 2026053101, 'local', 'istikama_admin');
    }

    // ── 0.22: Advertisements & Announcements system ────────────────────────
    if ($oldversion < 2026060101) {
        $dbman = $DB->get_manager();

        // Main advertisements table.
        $ad = new xmldb_table('istikama_advertisement');
        if (!$dbman->table_exists($ad)) {
            $ad->add_field('id',           XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $ad->add_field('title',        XMLDB_TYPE_CHAR,    '255',  null, XMLDB_NOTNULL, null, null);
            $ad->add_field('content',      XMLDB_TYPE_TEXT,    null,   null, null,          null, null);
            $ad->add_field('linkurl',      XMLDB_TYPE_CHAR,    '1024', null, null,          null, null);
            $ad->add_field('linktext',     XMLDB_TYPE_CHAR,    '255',  null, null,          null, null);
            $ad->add_field('placement',    XMLDB_TYPE_CHAR,    '64',   null, XMLDB_NOTNULL, null, 'popup');
            $ad->add_field('trigger_rule', XMLDB_TYPE_CHAR,    '32',   null, XMLDB_NOTNULL, null, 'everyvisit');
            $ad->add_field('audience',     XMLDB_TYPE_CHAR,    '32',   null, XMLDB_NOTNULL, null, 'student');
            $ad->add_field('schoolid',     XMLDB_TYPE_INTEGER, '10',   null, null,          null, null);
            $ad->add_field('dismissible',  XMLDB_TYPE_INTEGER, '1',    null, XMLDB_NOTNULL, null, '1');
            $ad->add_field('priority',     XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, '0');
            $ad->add_field('bgcolor',      XMLDB_TYPE_CHAR,    '16',   null, null,          null, null);
            $ad->add_field('status',       XMLDB_TYPE_CHAR,    '16',   null, XMLDB_NOTNULL, null, 'active');
            $ad->add_field('starttime',    XMLDB_TYPE_INTEGER, '10',   null, null,          null, null);
            $ad->add_field('endtime',      XMLDB_TYPE_INTEGER, '10',   null, null,          null, null);
            $ad->add_field('viewcount',    XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, '0');
            $ad->add_field('clickcount',   XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, '0');
            $ad->add_field('createdby',    XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, null);
            $ad->add_field('timecreated',  XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, null);
            $ad->add_field('timemodified', XMLDB_TYPE_INTEGER, '10',   null, XMLDB_NOTNULL, null, null);
            $ad->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $ad->add_index('status_ix',   XMLDB_INDEX_NOTUNIQUE, ['status']);
            $ad->add_index('schoolid_ix', XMLDB_INDEX_NOTUNIQUE, ['schoolid']);
            $ad->add_index('window_ix',   XMLDB_INDEX_NOTUNIQUE, ['starttime', 'endtime']);
            $dbman->create_table($ad);
        }

        // Per-user dismissal / seen tracking.
        $dis = new xmldb_table('istikama_ad_dismissal');
        if (!$dbman->table_exists($dis)) {
            $dis->add_field('id',          XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $dis->add_field('adid',        XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $dis->add_field('userid',      XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $dis->add_field('reason',      XMLDB_TYPE_CHAR,    '16', null, XMLDB_NOTNULL, null, 'dismissed');
            $dis->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
            $dis->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            $dis->add_index('ad_user_reason_uix', XMLDB_INDEX_UNIQUE, ['adid', 'userid', 'reason']);
            $dis->add_index('userid_ix', XMLDB_INDEX_NOTUNIQUE, ['userid']);
            $dbman->create_table($dis);
        }

        upgrade_plugin_savepoint(true, 2026060101, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026060301) {
        // Create the Istikama student custom profile fields (father/grandfather
        // name, gender, date of birth, student ID).
        require_once(__DIR__ . '/../locallib.php');
        local_istikama_admin_ensure_student_profile_fields();

        upgrade_plugin_savepoint(true, 2026060301, 'local', 'istikama_admin');
    }

    if ($oldversion < 2026060302) {
        // Attendance: track late-excuse / absence-justification.
        $table = new xmldb_table('istikama_attendance');
        $excused = new xmldb_field('excused', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0', 'behavior_note');
        if (!$dbman->field_exists($table, $excused)) {
            $dbman->add_field($table, $excused);
        }
        $justify = new xmldb_field('justify_note', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'excused');
        if (!$dbman->field_exists($table, $justify)) {
            $dbman->add_field($table, $justify);
        }

        upgrade_plugin_savepoint(true, 2026060302, 'local', 'istikama_admin');
    }

    return true;
}
