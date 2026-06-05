<?php
// AJAX endpoint for geodata lookups and user assignment management.
define('AJAX_SCRIPT', true);

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');
require_login();
require_sesskey();

use local_istikama_admin\geodata;
use local_istikama_admin\school_manager;

$action = required_param('action', PARAM_ALPHANUMEXT);

header('Content-Type: application/json; charset=utf-8');

switch ($action) {

    // ─── Question moderation (Technical Professor) ─────────────────
    case 'approve_question':
    case 'reject_question':
    case 'report_question':
    case 'unreport_question': {
        local_istikama_admin_require_target_user();
        $tier = local_istikama_admin_get_user_tier();
        if (!in_array($tier, ['technical_professor', 'full_admin'], true)) {
            echo json_encode(['success' => false, 'error' => 'Not authorized']);
            break;
        }
        global $DB, $USER;
        $qbeid = required_param('qbe_id', PARAM_INT);
        if (!$DB->record_exists('question_bank_entries', ['id' => $qbeid])) {
            echo json_encode(['success' => false, 'error' => 'Question not found']);
            break;
        }

        $now = time();
        $existing = $DB->get_record('istikama_question_meta', ['qbe_id' => $qbeid]);
        if (!$existing) {
            $existing = (object)[
                'qbe_id'        => $qbeid,
                'levelid'       => 0,
                'subjectid'     => 0,
                'createdby'     => (int)$USER->id,
                'review_status' => 'approved',
                'reported'      => 0,
                'reportedby'    => null,
                'reportreason'  => null,
                'timecreated'   => $now,
                'timemodified'  => $now,
            ];
            $existing->id = $DB->insert_record('istikama_question_meta', $existing);
        }

        if ($action === 'approve_question') {
            $existing->review_status = 'approved';
            $existing->reported = 0;
            $existing->reportedby = null;
            $existing->reportreason = null;
        } else if ($action === 'reject_question') {
            $existing->review_status = 'rejected';
        } else if ($action === 'report_question') {
            $existing->reported = 1;
            $existing->reportedby = (int)$USER->id;
            $existing->reportreason = optional_param('reason', '', PARAM_TEXT);
        } else if ($action === 'unreport_question') {
            $existing->reported = 0;
            $existing->reportedby = null;
            $existing->reportreason = null;
        }
        $existing->timemodified = $now;
        $DB->update_record('istikama_question_meta', $existing);
        echo json_encode(['success' => true]);
        break;
    }

    // ─── Quiz slot operations (remove, reorder, set max mark) ──────
    case 'quiz_slot_remove':
    case 'quiz_slot_move':
    case 'quiz_slot_setmark': {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/mod/quiz/locallib.php');

        $cmid = required_param('cmid', PARAM_INT);
        $slot = required_param('slot', PARAM_INT);

        try {
            $cm = get_coursemodule_from_id('quiz', $cmid, 0, false, MUST_EXIST);
            $ctx = context_module::instance($cm->id);
            require_capability('mod/quiz:manage', $ctx);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => 'Quiz not found or access denied.']);
            break;
        }

        $quizobj = \mod_quiz\quiz_settings::create($cm->instance);
        $structure = \mod_quiz\structure::create_for_quiz($quizobj);

        try {
            if ($action === 'quiz_slot_remove') {
                $structure->remove_slot($slot);
                echo json_encode(['success' => true]);
                break;
            }
            if ($action === 'quiz_slot_move') {
                $direction = required_param('direction', PARAM_ALPHA);
                $rec = $DB->get_record('quiz_slots', ['quizid' => $cm->instance, 'slot' => $slot], '*', MUST_EXIST);
                $maxslot = (int)$DB->get_field_sql('SELECT MAX(slot) FROM {quiz_slots} WHERE quizid = ?', [$cm->instance]);

                if ($direction === 'up' && $slot > 1) {
                    $beforeslot = $slot - 1;
                    $afterid = ($beforeslot > 1) ? (int)$DB->get_field('quiz_slots', 'id',
                        ['quizid' => $cm->instance, 'slot' => $beforeslot - 1]) : 0;
                    $structure->move_slot($rec->id, $afterid, $rec->page);
                } else if ($direction === 'down' && $slot < $maxslot) {
                    $afterid = (int)$DB->get_field('quiz_slots', 'id',
                        ['quizid' => $cm->instance, 'slot' => $slot + 1]);
                    $structure->move_slot($rec->id, $afterid, $rec->page);
                }
                echo json_encode(['success' => true]);
                break;
            }
            if ($action === 'quiz_slot_setmark') {
                $maxmark = required_param('maxmark', PARAM_FLOAT);
                if ($maxmark < 0) { $maxmark = 0; }
                $rec = $DB->get_record('quiz_slots', ['quizid' => $cm->instance, 'slot' => $slot], '*', MUST_EXIST);
                $DB->set_field('quiz_slots', 'maxmark', $maxmark, ['id' => $rec->id]);
                // Recompute quiz sumgrades.
                \mod_quiz\quiz_settings::create($cm->instance)->get_grade_calculator()->recompute_quiz_sumgrades();
                echo json_encode(['success' => true]);
                break;
            }
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            break;
        }
        echo json_encode(['success' => false, 'error' => 'Unknown slot action.']);
        break;
    }

    case 'communes':
        $wilaya = required_param('wilaya', PARAM_RAW);
        $communes = geodata::get_communes($wilaya);
        echo json_encode($communes);
        break;

    case 'wilayas':
        $wilayas = geodata::get_wilayas();
        echo json_encode($wilayas);
        break;

    // ── Schools hierarchy endpoints ──

    case 'getschools':
        local_istikama_admin_require_full_admin();
        $schools = core_course_category::top()->get_children();
        $result = [];
        foreach ($schools as $school) {
            $result[] = ['id' => (int)$school->id, 'name' => format_string($school->name)];
        }
        echo json_encode($result);
        break;

    case 'getlevels':
        local_istikama_admin_require_full_admin();
        $schoolid = required_param('schoolid', PARAM_INT);
        $school = core_course_category::get($schoolid);
        $levels = $school->get_children();
        $result = [];
        foreach ($levels as $level) {
            $result[] = ['id' => (int)$level->id, 'name' => format_string($level->name)];
        }
        echo json_encode($result);
        break;

    case 'getclasses':
        local_istikama_admin_require_full_admin();
        $levelid = required_param('levelid', PARAM_INT);
        $level = core_course_category::get($levelid);
        $classes = $level->get_children();
        $result = [];
        foreach ($classes as $class) {
            $result[] = ['id' => (int)$class->id, 'name' => format_string($class->name)];
        }
        echo json_encode($result);
        break;

    case 'getsubjects':
        local_istikama_admin_require_full_admin();
        $classid = required_param('classid', PARAM_INT);
        $class = core_course_category::get($classid);
        $courses = $class->get_courses();
        $result = [];
        foreach ($courses as $course) {
            $result[] = ['id' => (int)$course->id, 'name' => format_string($course->fullname)];
        }
        echo json_encode($result);
        break;

    case 'bulkassignsubjects':
        local_istikama_admin_require_full_admin();
        $datajson = required_param('data', PARAM_RAW);
        $data = json_decode($datajson, true);
        if (!$data || !is_array($data) || empty($data['classids']) || empty($data['subjects'])) {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
            break;
        }

        try {
            // Find all unique classids
            $classids = array_unique($data['classids']);
            $subjectkeys = array_unique($data['subjects']);
            
            require_once(__DIR__ . '/classes/school_manager.php');

            $createdcount = 0;
            foreach ($classids as $classid) {
                $classid = (int)$classid;
                $classcat = core_course_category::get($classid);
                $existingcourses = $classcat->get_courses();
                $existingnames = [];
                foreach ($existingcourses as $c) {
                    $existingnames[$c->fullname] = $c->id;
                }

                foreach ($subjectkeys as $gid) {
                    $gsub = $DB->get_record('istikama_subject_names', ['id' => $gid]);
                    if (!$gsub) continue;
                    $subjectname = $gsub->name;
                    
                    // Check if mapping exists
                    $mapping = $DB->get_record('istikama_class_subjects', ['classid' => $classid, 'subject_name_id' => $gid]);
                    
                    if (!$mapping) {
                        // Create it
                        require_once($CFG->dirroot . '/course/lib.php');
                        $courseRecord = new stdClass();
                        $courseRecord->category = $classid;
                        $courseRecord->fullname = $subjectname;
                        $courseRecord->shortname = clean_param($subjectname, PARAM_ALPHANUMEXT) . '_' . $classid . '_' . time();
                        $courseRecord->visible = 1;
                        $course = create_course($courseRecord);
                        $courseid = $course->id;

                        // Save strictly to class_subject mapping
                        $new_map = new stdClass();
                        $new_map->classid = $classid;
                        $new_map->subject_name_id = $gid;
                        $new_map->courseid = $courseid;
                        $DB->insert_record('istikama_class_subjects', $new_map);

                        $createdcount++;
                    } else {
                        $courseid = $mapping->courseid;
                    }
                    
                    // Auto-enroll all students in this class into this subject implicitly
                    local_istikama_admin_enroll_class_students_in_subject($classid, $courseid);
                }
            }

            echo json_encode([
                'success' => true, 
                'createdcount' => $createdcount
            ]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'getglobaltags':
        local_istikama_admin_require_full_admin();
        $targetcatid = required_param('targetcatid', PARAM_INT);
        $context = required_param('context', PARAM_ALPHANUM);

        $levelid = 0;
        if ($context === 'class') {
            $cat = core_course_category::get($targetcatid);
            $levelid = $cat->parent;
        } else if ($context === 'level') {
            $levelid = $targetcatid;
        }

        if (!$levelid) {
            echo json_encode([]);
            break;
        }

        $levelinfo = $DB->get_record('istikama_level_info', ['categoryid' => $levelid]);
        if (!$levelinfo) {
            $cat = core_course_category::get($levelid, IGNORE_MISSING);
            if ($cat) {
                $globals = $DB->get_records('istikama_global_level');
                $matched_global_id = 0;
                foreach ($globals as $g) {
                    if (stripos($cat->name, $g->name) !== false || stripos($g->name, $cat->name) !== false) {
                        $matched_global_id = $g->id;
                        break;
                    }
                }
                if (!$matched_global_id) {
                    $newgl = new stdClass();
                    $newgl->name = $cat->name;
                    $newgl->timecreated = time();
                    $newgl->timemodified = time();
                    $newgl->order_index = 99;
                    $matched_global_id = $DB->insert_record('istikama_global_level', $newgl);
                }
                if ($matched_global_id) {
                    $levelinfo = new stdClass();
                    $levelinfo->categoryid = $levelid;
                    $levelinfo->global_level_id = $matched_global_id;
                    $levelinfo->id = $DB->insert_record('istikama_level_info', $levelinfo);
                }
            }
        }
        
        if (!$levelinfo) {
            echo json_encode([]);
            break;
        }

        $gs = $DB->get_records('istikama_subject_names', ['level_id' => $levelinfo->global_level_id], 'name ASC');
        $tags = [];
        foreach ($gs as $g) {
            $tags[] = [
                'id' => $g->id,
                'name' => format_string($g->name)
            ];
        }
        echo json_encode($tags);
        break;

    case 'createsubject':
        local_istikama_admin_require_full_admin();
        $name = required_param('name', PARAM_TEXT);
        $targetcatid = required_param('targetcatid', PARAM_INT);
        $context = required_param('context', PARAM_ALPHANUM);

        $levelid = 0;
        if ($context === 'class') {
            $cat = core_course_category::get($targetcatid);
            $levelid = $cat->parent;
        } else if ($context === 'level') {
            $levelid = $targetcatid;
        }
        if (!$levelid) {
            echo json_encode(['success' => false, 'error' => 'Invalid context for subject creation']);
            break;
        }

        $levelinfo = $DB->get_record('istikama_level_info', ['categoryid' => $levelid]);
        if (!$levelinfo) {
            $cat = core_course_category::get($levelid, IGNORE_MISSING);
            if ($cat) {
                $globals = $DB->get_records('istikama_global_level');
                $matched_global_id = 0;
                foreach ($globals as $g) {
                    if (stripos($cat->name, $g->name) !== false || stripos($g->name, $cat->name) !== false) {
                        $matched_global_id = $g->id;
                        break;
                    }
                }
                if (!$matched_global_id) {
                    $newgl = new stdClass();
                    $newgl->name = $cat->name;
                    $newgl->timecreated = time();
                    $newgl->timemodified = time();
                    $newgl->order_index = 99;
                    $matched_global_id = $DB->insert_record('istikama_global_level', $newgl);
                }
                if ($matched_global_id) {
                    $levelinfo = new stdClass();
                    $levelinfo->categoryid = $levelid;
                    $levelinfo->global_level_id = $matched_global_id;
                    $levelinfo->id = $DB->insert_record('istikama_level_info', $levelinfo);
                }
            }
        }
        
        if (!$levelinfo) {
            echo json_encode(['success' => false, 'error' => 'No global level linked']);
            break;
        }

        $global_level_id = $levelinfo->global_level_id;
        $name = trim($name);
        
        $exists = $DB->get_record('istikama_subject_names', ['name' => $name, 'level_id' => $global_level_id]);
        if ($exists) {
            // Instead of erroring out, we gracefully accept it and reuse the existing Subject Name
            echo json_encode(['success' => true, 'id' => $exists->id, 'name' => $exists->name, 'is_new' => false]);
            break;
        }

        $gs = new stdClass();
        $gs->level_id = $global_level_id;
        $gs->name = $name;
        $gs->timecreated = time();
        $id = $DB->insert_record('istikama_subject_names', $gs);
        
        echo json_encode(['success' => true, 'id' => $id, 'name' => $name, 'is_new' => true]);
        break;

    // ── Simplified Quiz Creation ──

    case 'create_simple_quiz':
        require_login();
        $courseid = required_param('courseid', PARAM_INT);
        $course = get_course($courseid);
        $context = context_course::instance($courseid);
        require_capability('moodle/course:manageactivities', $context);

        $name = required_param('name', PARAM_TEXT);
        $description = optional_param('description', '', PARAM_RAW);
        $timelimit = optional_param('timelimit', 30, PARAM_INT);
        $attempts = optional_param('attempts', 1, PARAM_INT);
        $gradepass = optional_param('gradepass', 50, PARAM_INT);
        $shufflequestions = optional_param('shufflequestions', 1, PARAM_INT);
        $sectionid = optional_param('sectionid', 0, PARAM_INT);
        $sectionnum_param = optional_param('sectionnum', -1, PARAM_INT);

        // Resolve section number.
        if ($sectionnum_param >= 0) {
            $sectionnum = $sectionnum_param;
        } else if ($sectionid && $DB->record_exists('course_sections', ['id' => $sectionid])) {
            $sectionnum = (int)$DB->get_field('course_sections', 'section', ['id' => $sectionid]);
        } else {
            $sectionnum = 0;
        }

        try {
            require_once($CFG->dirroot . '/course/lib.php');
            require_once($CFG->dirroot . '/course/modlib.php');
            require_once($CFG->dirroot . '/mod/quiz/lib.php');

            // Create the course module record.
            $module = $DB->get_record('modules', ['name' => 'quiz'], '*', MUST_EXIST);
            $cm = new stdClass();
            $cm->course = $courseid;
            $cm->module = $module->id;
            $cm->section = 0;
            $cm->idnumber = '';
            $cm->added = time();
            $cm->visible = 1;
            $cm->visibleoncoursepage = 1;
            $cmid = add_course_module($cm);

            // Create the quiz instance.
            $quiz = new stdClass();
            $quiz->course = $courseid;
            $quiz->name = $name;
            $quiz->intro = $description;
            $quiz->introformat = FORMAT_HTML;
            $quiz->timeopen = 0;
            $quiz->timeclose = 0;
            $quiz->timelimit = $timelimit * 60; // Convert minutes to seconds.
            $quiz->overduehandling = 'autosubmit';
            $quiz->graceperiod = 0;
            $quiz->preferredbehaviour = 'deferredfeedback';
            $quiz->canredoquestions = 0;
            $quiz->attempts = $attempts;
            $quiz->attemptonlast = 0;
            $quiz->grademethod = 1; // Highest grade.
            $quiz->decimalpoints = 2;
            $quiz->questiondecimalpoints = -1;
            $quiz->reviewattempt = 69904;
            $quiz->reviewcorrectness = 69904;
            $quiz->reviewmaxmarks = 69904;
            $quiz->reviewmarks = 69904;
            $quiz->reviewspecificfeedback = 69904;
            $quiz->reviewgeneralfeedback = 69904;
            $quiz->reviewrightanswer = 69904;
            $quiz->reviewoverallfeedback = 69904;
            $quiz->questionsperpage = 1;
            $quiz->navmethod = 'free';
            $quiz->shuffleanswers = $shufflequestions;
            $quiz->sumgrades = 0;
            $quiz->grade = 100;
            $quiz->timecreated = time();
            $quiz->timemodified = time();
            $quiz->quizpassword = '';
            $quiz->subnet = '';
            $quiz->browsersecurity = '-';
            $quiz->delay1 = 0;
            $quiz->delay2 = 0;
            $quiz->showuserpicture = 0;
            $quiz->showblocks = 0;
            $quiz->completionattemptsexhausted = 0;
            $quiz->completionminattempts = 0;
            $quiz->allowofflineattempts = 0;

            $quizid = $DB->insert_record('quiz', $quiz);

            // Link course module to quiz instance.
            $DB->set_field('course_modules', 'instance', $quizid, ['id' => $cmid]);
            course_add_cm_to_section($courseid, $cmid, $sectionnum);

            // Set grade to pass.
            if ($gradepass > 0) {
                require_once($CFG->libdir . '/gradelib.php');
                $gi = grade_item::fetch([
                    'itemtype' => 'mod',
                    'itemmodule' => 'quiz',
                    'iteminstance' => $quizid,
                    'courseid' => $courseid,
                ]);
                if ($gi) {
                    $gi->gradepass = ($gradepass / 100) * 100; // Percentage of max grade.
                    $gi->update();
                }
            }

            course_modinfo::clear_instance_cache($courseid);
            rebuild_course_cache($courseid, true);

            // Redirect to native quiz view page.
            $editurl = (new moodle_url('/mod/quiz/view.php', ['id' => $cmid]))->out(false);

            echo json_encode([
                'success' => true,
                'cmid' => $cmid,
                'quizid' => $quizid,
                'editurl' => $editurl,
            ]);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to create quiz: ' . $e->getMessage()]);
        }
        break;

    case 'add_simple_question':
        require_login();
        require_sesskey();
        global $CFG;
        $CFG->debug = 32767;
        $CFG->debugdisplay = 1;
        try {
            $quizid = required_param('quizid', PARAM_INT);
            $type = required_param('type', PARAM_ALPHA);
            $questiontext = required_param('questiontext', PARAM_RAW);
            
            $quiz = $DB->get_record('quiz', ['id' => $quizid], '*', MUST_EXIST);
            $cm = get_coursemodule_from_instance('quiz', $quiz->id);
            $context = context_module::instance($cm->id);
            require_capability('mod/quiz:manage', $context);
            
            require_once($CFG->dirroot . '/mod/quiz/locallib.php');
            require_once($CFG->libdir . '/questionlib.php');
            require_once($CFG->dirroot . '/question/type/questiontypebase.php');
            
            // Get or create category
            $category = $DB->get_record('question_categories', ['contextid' => $context->id], '*', IGNORE_MULTIPLE);
            if (!$category) {
                $category = new stdClass();
                $category->contextid = $context->id;
                $category->name = 'Default for ' . $quiz->name;
                $category->info = '';
                $category->parent = 0;
                $category->sortorder = 999;
                $category->stamp = make_unique_id_code();
                $category->id = $DB->insert_record('question_categories', $category);
            }
            
            $q = new stdClass();
            $q->category = $category->id . ',' . $category->contextid;
            $q->qtype = $type;
            $q->name = core_text::substr(strip_tags($questiontext), 0, 40) . '...';
            $q->questiontext = ['text' => $questiontext, 'format' => FORMAT_HTML];
            $q->generalfeedback = ['text' => '', 'format' => FORMAT_HTML];
            $q->defaultmark = 1;
            $q->penalty = 0.3333333;
            $q->length = 1;
            $q->stamp = make_unique_id_code();
            $q->version = make_unique_id_code();
            $q->hidden = 0;
            
            if ($type === 'multichoice') {
                require_once($CFG->dirroot . '/question/type/multichoice/questiontype.php');
                $qtypeobj = new \qtype_multichoice();
                
                $parsedchoices = json_decode(required_param('choices', PARAM_RAW));
                $correct_index = required_param('correct_index', PARAM_INT);
                
                $q->single = 1;
                $q->shuffleanswers = 1;
                $q->answernumbering = 'abc';
                $q->showstandardinstruction = 0;
                $q->correctfeedback = ['text' => '', 'format' => FORMAT_HTML];
                $q->partiallycorrectfeedback = ['text' => '', 'format' => FORMAT_HTML];
                $q->incorrectfeedback = ['text' => '', 'format' => FORMAT_HTML];
                $q->shownumcorrect = 0;
                
                $q->answer = [];
                $q->answerformat = [];
                $q->fraction = [];
                $q->feedback = [];
                $q->feedbackformat = [];
                
                foreach ($parsedchoices as $index => $text) {
                    if (empty($text)) continue;
                    $q->answer[] = ['text' => $text, 'format' => FORMAT_HTML]; // MC answers are usually nested in some versions, but let's safely pass both formats
                    $q->fraction[] = ($index == $correct_index) ? 1.0 : 0.0;
                    $q->feedback[] = ['text' => '', 'format' => FORMAT_HTML];
                    $q->feedbackformat[] = FORMAT_HTML;
                }
            } else if ($type === 'truefalse') {
                require_once($CFG->dirroot . '/question/type/truefalse/questiontype.php');
                $qtypeobj = new \qtype_truefalse();
                $correct = required_param('correct', PARAM_INT);
                
                $q->answer = ['True', 'False'];
                $q->fraction = [
                    0 => ($correct == 1) ? 1.0 : 0.0,
                    1 => ($correct == 0) ? 1.0 : 0.0
                ];
                $q->feedback = ['', ''];
                $q->feedbackformat = [FORMAT_HTML, FORMAT_HTML];
                $q->correctanswer = ($correct == 1);  // some moodle versions need this
            } else {
                echo json_encode(['error' => 'Invalid question type.']);
                break;
            }
            
            $savedq = $qtypeobj->save_question($q, $q);
            if (!empty($savedq->id)) {
                quiz_add_quiz_question($savedq->id, $quiz);
                
                // Fetch the slot ID for UI removal later via the proper Moodle API
                $quizobj = \mod_quiz\quiz_settings::create($quizid, $USER->id);
                $structure = \mod_quiz\structure::create_for_quiz($quizobj);
                $slots = $structure->get_slots();
                $last_slot = end($slots);
                $slotid = $last_slot->id;
                
                $icon = ($type === 'multichoice') ? '🔘' : '👍';
                
                echo json_encode([
                    'success' => true,
                    'question' => [
                        'id' => $savedq->id,
                        'slotid' => $slotid,
                        'name' => format_string($savedq->name),
                        'text' => format_text($savedq->questiontext),
                        'type' => $type,
                        'icon' => $icon,
                        'mark' => 1
                    ]
                ]);
            } else {
                echo json_encode(['error' => 'Database error while saving the question.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage() . "\n" . $e->getTraceAsString()]);
        }
        break;

    case 'delete_simple_question':
        require_login();
        require_sesskey();
        try {
            $quizid = required_param('quizid', PARAM_INT);
            $slotid = required_param('slotid', PARAM_INT);
            
            $quiz = $DB->get_record('quiz', ['id' => $quizid], '*', MUST_EXIST);
            $cm = get_coursemodule_from_instance('quiz', $quiz->id);
            $context = context_module::instance($cm->id);
            require_capability('mod/quiz:manage', $context);
            
            require_once($CFG->dirroot . '/mod/quiz/locallib.php');
            
            $quizobj = \mod_quiz\quiz_settings::create($quizid, $USER->id);
            $structure = \mod_quiz\structure::create_for_quiz($quizobj);
            $slot = $DB->get_record('quiz_slots', ['id' => $slotid], 'slot', MUST_EXIST);
            $structure->remove_slot($slot->slot);

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to remove question: ' . $e->getMessage()]);
        }
        break;

    // ── Content Bank Endpoints ──

    case 'get_chooser_content':
        // Admins, technical professors, and teachers can all access course content.
        require_login();
        $courseid = required_param('courseid', PARAM_INT);
        
        // Find subject/level matching this course
        // In this system, courses ARE subjects. The level is its parent's parent (Level > Class > Course).
        $course = $DB->get_record('course', ['id' => $courseid]);
        if (!$course) {
            echo json_encode(['error' => 'Invalid course']);
            break;
        }

        // Validate user has access to manage activities in this course.
        $context = context_course::instance($courseid);
        if (!has_capability('moodle/course:manageactivities', $context)) {
            echo json_encode(['error' => 'Access denied']);
            break;
        }

        // Derive current class/level from course category tree: School > Level > Class > Course.
        $courseclassid = (int)$course->category;
        $courselevelid = 0;
        try {
            $classcat = core_course_category::get($courseclassid);
            $courselevelid = (int)$classcat->parent;
        } catch (\Exception $e) {
            echo json_encode(['error' => 'Invalid class/level mapping']);
            break;
        }

        if (!$courseclassid || !$courselevelid) {
            echo json_encode([]);
            break;
        }

        // Subject can be stored as direct course id and/or as global subject_name_id mapping.
        $subjectkeys = [(string)$courseid];
        $subjectmap = $DB->get_record('istikama_class_subjects', ['courseid' => $courseid]);
        if ($subjectmap && !empty($subjectmap->subject_name_id)) {
            $subjectkeys[] = (string)$subjectmap->subject_name_id;
        }
        $subjectkeys = array_values(array_unique(array_filter($subjectkeys)));

        // Content level can be stored as category level id and/or global level id.
        $levelkeys = [(string)$courselevelid];
        $levelinfo = $DB->get_record('istikama_level_info', ['categoryid' => $courselevelid]);
        if ($levelinfo && !empty($levelinfo->global_level_id)) {
            $levelkeys[] = (string)$levelinfo->global_level_id;
        }
        // Also match other level categories sharing the same global_level_id.
        if ($levelinfo && !empty($levelinfo->global_level_id)) {
            $sibling_levels = $DB->get_records('istikama_level_info', ['global_level_id' => $levelinfo->global_level_id]);
            foreach ($sibling_levels as $sl) {
                $levelkeys[] = (string)$sl->categoryid;
            }
        }
        $levelkeys = array_values(array_unique(array_filter($levelkeys)));

        if (empty($subjectkeys) || empty($levelkeys)) {
            echo json_encode([]);
            break;
        }

        // Teacher assignment check: only enforced for regular teachers, NOT admins/professors.
        $tier = local_istikama_admin_get_user_tier((int)$USER->id);
        $is_privileged = in_array($tier, ['full_admin', 'teacher_creator', 'school_manager']);

        if (!$is_privileged) {
            // Regular teacher — must be assigned to this class+level+subject.
            list($teachersubsql, $teachersubparams) = $DB->get_in_or_equal($subjectkeys, SQL_PARAMS_NAMED, 'tsub');
            $teacherparams = [
                'userid' => (int)$USER->id,
                'classid' => $courseclassid,
                'levelid' => $courselevelid,
            ];
            $teacherparams = array_merge($teacherparams, $teachersubparams);
            $teachersql = "SELECT 1
                             FROM {istikama_user_school} us
                             JOIN {istikama_teacher_subject} ts ON ts.assignmentid = us.id
                            WHERE us.userid = :userid
                              AND us.role = 'teacher'
                              AND us.classid = :classid
                              AND us.levelid = :levelid
                              AND ts.subject {$teachersubsql}";

            if (!$DB->record_exists_sql($teachersql, $teacherparams)) {
                echo json_encode([]);
                break;
            }
        }

        list($subjectsql, $subjectparams) = $DB->get_in_or_equal($subjectkeys, SQL_PARAMS_NAMED, 'csub');
        list($levelsql, $levelparams) = $DB->get_in_or_equal($levelkeys, SQL_PARAMS_NAMED, 'clvl');

        $params = ['status' => 'approved'];
        $params = array_merge($params, $subjectparams, $levelparams);

        $sql = "SELECT id, name, content_type, description, timecreated
                  FROM {istikama_content_bank}
                 WHERE status = :status
                   AND subject {$subjectsql}
                   AND level {$levelsql}
              ORDER BY timecreated DESC";
        $records = $DB->get_records_sql($sql, $params);

        $result = [];
        foreach ($records as $rec) {
            $icon = '📄';
            if ($rec->content_type === 'video') $icon = '🎥';
            if ($rec->content_type === 'h5p') $icon = '📦';
            if ($rec->content_type === 'book') $icon = '📖';
            if ($rec->content_type === 'link') $icon = '🔗';
            if ($rec->content_type === 'quiz') $icon = '❓';

            $result[] = [
                'id' => $rec->id,
                'name' => format_string($rec->name),
                'content_type' => $rec->content_type,
                'icon' => $icon,
                'description' => format_text($rec->description ?? '', FORMAT_PLAIN),
                'date' => userdate((int)$rec->timecreated, get_string('strftimedatetimeshort', 'langconfig'))
            ];
        }

        echo json_encode($result);
        break;

    // ── User assignment endpoints ──

    case 'getuserassignment':
        local_istikama_admin_require_full_admin();
        $userid = required_param('userid', PARAM_INT);

        // Determine the user's role type.
        $roletype = istikama_detect_user_role_type($userid);

        // Get assignments.
        $assignments = $DB->get_records('istikama_user_school', ['userid' => $userid]);

        $result = [
            'userid' => $userid,
            'roletype' => $roletype,
            'assignments' => [],
        ];

        foreach ($assignments as $a) {
            $entry = [
                'id' => (int)$a->id,
                'schoolid' => (int)$a->schoolid,
                'schoolname' => '',
                'levelid' => $a->levelid ? (int)$a->levelid : null,
                'levelname' => '',
                'classid' => $a->classid ? (int)$a->classid : null,
                'classname' => '',
                'role' => $a->role,
                'subjects' => [],
            ];

            // Resolve names.
            try {
                $cat = core_course_category::get($a->schoolid);
                $entry['schoolname'] = format_string($cat->name);
            } catch (Exception $e) {}

            if ($a->levelid) {
                try {
                    $cat = core_course_category::get($a->levelid);
                    $entry['levelname'] = format_string($cat->name);
                } catch (Exception $e) {}
            }

            if ($a->classid) {
                try {
                    $cat = core_course_category::get($a->classid);
                    $entry['classname'] = format_string($cat->name);
                } catch (Exception $e) {}
            }

            // Get teacher subjects.
            if ($a->role === 'teacher') {
                $subjects = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $a->id]);
                foreach ($subjects as $s) {
                    $entry['subjects'][] = $s->subject;
                }
            }

            $result['assignments'][] = $entry;
        }

        // Also check istikama_school_info for manager admin_userid (sync).
        if ($roletype === 'manager') {
            $managed = $DB->get_records('istikama_school_info', ['admin_userid' => $userid]);
            foreach ($managed as $m) {
                // Check if already in assignments.
                $found = false;
                foreach ($result['assignments'] as $a) {
                    if ((int)$a['schoolid'] === (int)$m->categoryid && $a['role'] === 'manager') {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $entry = [
                        'id' => 0,
                        'schoolid' => (int)$m->categoryid,
                        'schoolname' => '',
                        'levelid' => null,
                        'levelname' => '',
                        'classid' => null,
                        'classname' => '',
                        'role' => 'manager',
                        'subjects' => [],
                        'from_school_info' => true,
                    ];
                    try {
                        $cat = core_course_category::get($m->categoryid);
                        $entry['schoolname'] = format_string($cat->name);
                    } catch (Exception $e) {}
                    $result['assignments'][] = $entry;
                }
            }
        }

        // Parent: return children and all students for assignment UI.
        if ($roletype === 'parent') {
            // Get this parent's current children.
            $children = $DB->get_records('istikama_parent_child', ['parentid' => $userid]);
            $childIds = array_map(function($c) { return (int)$c->childid; }, $children);
            $result['childIds'] = array_values($childIds);

            // Get ALL students in system for the checkbox list.
            $systemcontext = context_system::instance();
            $studentrole = $DB->get_record('role', ['shortname' => 'student']);
            $students = [];
            if ($studentrole) {
                $sql = "SELECT DISTINCT u.id, u.firstname, u.lastname, u.email
                          FROM {user} u
                          JOIN {role_assignments} ra ON ra.userid = u.id
                          JOIN {context} cx ON cx.id = ra.contextid
                         WHERE ra.roleid = :roleid
                           AND cx.contextlevel = :contextlevel
                           AND u.deleted = 0
                           AND u.confirmed = 1
                      ORDER BY u.lastname, u.firstname";
                $studentusers = $DB->get_records_sql($sql, [
                    'roleid' => $studentrole->id,
                    'contextlevel' => CONTEXT_SYSTEM,
                ]);

                // Get ALL parent-child links to show cross-parent badges.
                $allLinks = $DB->get_records('istikama_parent_child');
                $parentsByChild = [];
                foreach ($allLinks as $link) {
                    $parentsByChild[(int)$link->childid][] = (int)$link->parentid;
                }

                foreach ($studentusers as $su) {
                    $sid = (int)$su->id;
                    $linkedParents = $parentsByChild[$sid] ?? [];
                    // Other parents = parents linked to this child, excluding the current parent.
                    $otherParents = array_filter($linkedParents, function($pid) use ($userid) {
                        return $pid !== (int)$userid;
                    });
                    $students[] = [
                        'id' => $sid,
                        'name' => fullname($su),
                        'email' => $su->email,
                        'assigned' => in_array($sid, $childIds),
                        'linked_to_others' => !empty($otherParents),
                    ];
                }
            }
            $result['students'] = $students;
        }

        // Return immediately for technical professor
        if ($roletype === 'technical_professor') {
            echo json_encode($result);
            break;
        }

        echo json_encode($result);
        break;

    case 'saveuserassignment':
        local_istikama_admin_require_full_admin();

        $userid = required_param('userid', PARAM_INT);
        $roletype = required_param('roletype', PARAM_ALPHA);
        $datajson = required_param('data', PARAM_RAW);
        $data = json_decode($datajson, true);

        if (!$data || !is_array($data)) {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
            break;
        }

        try {
            $transaction = $DB->start_delegated_transaction();

            // ── Cross-role cleanup (runs for EVERY role switch) ───────────────
            // Ensures that data from a PREVIOUS role never leaks into tier
            // detection after the role changes (e.g. teacher → parent).
            // Each role handler below still does its own same-role cleanup
            // (idempotent — harmless if records are already gone).
            if ($roletype !== 'teacher') {
                $prev_teacher = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher']);
                foreach ($prev_teacher as $o) {
                    $oldsubs = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                    foreach ($oldsubs as $sub) {
                        local_istikama_admin_unenroll_user_from_subject($userid, (int)$sub->subject);
                    }
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher']);
            }
            if ($roletype !== 'student') {
                $prev_student = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'student']);
                foreach ($prev_student as $o) {
                    if (!empty($o->classid)) {
                        local_istikama_admin_unenroll_user_from_class($userid, (int)$o->classid);
                    }
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'student']);
            }
            if ($roletype !== 'manager') {
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'manager']);
                $DB->execute("UPDATE {istikama_school_info} SET admin_userid = NULL WHERE admin_userid = ?", [$userid]);
            }
            if ($roletype !== 'parent') {
                $DB->delete_records('istikama_parent_child', ['parentid' => $userid]);
            }
            // ── end cross-role cleanup ────────────────────────────────────────

            if ($roletype === 'technical_professor') {
                // Technical professors don't need school assignments.
                // Just clear any old assignments if they exist.
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid]);
                foreach ($old as $o) {
                    if ($o->role === 'teacher') {
                        $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                    }
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid]);
                $DB->execute("UPDATE {istikama_school_info} SET admin_userid = NULL WHERE admin_userid = ?", [$userid]);
                $DB->delete_records('istikama_parent_child', ['parentid' => $userid]);
            } else if ($roletype === 'student') {
                // Remove old student assignments and unenroll from previous class courses.
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'student']);
                foreach ($old as $o) {
                    if ($o->classid) {
                        local_istikama_admin_unenroll_user_from_class($userid, (int)$o->classid);
                    }
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'student']);

                if (!empty($data['schoolid']) && !empty($data['levelid']) && !empty($data['classid'])) {
                    $record = new stdClass();
                    $record->userid   = $userid;
                    $record->schoolid = (int)$data['schoolid'];
                    $record->levelid  = (int)$data['levelid'];
                    $record->classid  = (int)$data['classid'];
                    $record->role     = 'student';
                    $record->seasonid = local_istikama_admin_resolve_write_seasonid() ?: null;
                    $record->timecreated  = time();
                    $record->timemodified = time();
                    $DB->insert_record('istikama_user_school', $record);
                    // Enrollment happens AFTER allow_commit() to avoid the
                    // "Message was not sent" exception from the welcome-email hook.
                }

            } else if ($roletype === 'teacher') {
                // Teacher: multiple assignments (school + level + class + subjects each).
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher']);
                foreach ($old as $o) {
                    $oldsubs = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                    foreach ($oldsubs as $sub) {
                        local_istikama_admin_unenroll_user_from_subject($userid, (int)$sub->subject);
                    }
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher']);

                if (!empty($data['assignments']) && is_array($data['assignments'])) {
                    foreach ($data['assignments'] as $assignment) {
                        if (empty($assignment['schoolid']) || empty($assignment['levelid']) || empty($assignment['classid'])) {
                            continue;
                        }
                        $seasonidcur = local_istikama_admin_resolve_write_seasonid() ?: null;
                        $record = new stdClass();
                        $record->userid = $userid;
                        $record->schoolid = (int)$assignment['schoolid'];
                        $record->levelid = (int)$assignment['levelid'];
                        $record->classid = (int)$assignment['classid'];
                        $record->role = 'teacher';
                        $record->seasonid = $seasonidcur;
                        $record->timecreated = time();
                        $record->timemodified = time();
                        $aid = $DB->insert_record('istikama_user_school', $record);

                        if (!empty($assignment['subjects']) && is_array($assignment['subjects'])) {
                            foreach ($assignment['subjects'] as $subj) {
                                $courseid = (int)$subj;
                                if ($courseid > 0) {
                                    $srec = new stdClass();
                                    $srec->assignmentid = $aid;
                                    $srec->subject = (string)$courseid;
                                    $srec->seasonid = $seasonidcur;
                                    $srec->timecreated = time();
                                    $DB->insert_record('istikama_teacher_subject', $srec);

                                    local_istikama_admin_enroll_user_in_subject($userid, $courseid, 'editingteacher');
                                }
                            }
                        }
                    }
                }

            } else if ($roletype === 'manager') {
                // Manager: multiple schools.
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'manager']);
                foreach ($old as $o) {
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'manager']);

                // Also clear admin_userid from school_info for this user.
                $DB->execute("UPDATE {istikama_school_info} SET admin_userid = NULL WHERE admin_userid = ?", [$userid]);

                if (!empty($data['schoolids']) && is_array($data['schoolids'])) {
                    foreach ($data['schoolids'] as $sid) {
                        $sid = (int)$sid;
                        if ($sid <= 0) continue;

                        $record = new stdClass();
                        $record->userid = $userid;
                        $record->schoolid = $sid;
                        $record->levelid = null;
                        $record->classid = null;
                        $record->role = 'manager';
                        $record->seasonid = local_istikama_admin_resolve_write_seasonid() ?: null;
                        $record->timecreated = time();
                        $record->timemodified = time();
                        $DB->insert_record('istikama_user_school', $record);

                        // Sync to istikama_school_info.admin_userid.
                        $schoolinfo = $DB->get_record('istikama_school_info', ['categoryid' => $sid]);
                        if ($schoolinfo) {
                            $schoolinfo->admin_userid = $userid;
                            $schoolinfo->timemodified = time();
                            $DB->update_record('istikama_school_info', $schoolinfo);
                        }
                    }
                }

            } else if ($roletype === 'parent') {
                // Parent: sync children via istikama_parent_child join table.
                // Delete all existing links for this parent.
                $DB->delete_records('istikama_parent_child', ['parentid' => $userid]);

                // Insert new links (only valid student IDs, avoid duplicates).
                $studentIds = !empty($data['studentIds']) && is_array($data['studentIds'])
                    ? $data['studentIds'] : [];

                $inserted = [];
                foreach ($studentIds as $childid) {
                    $childid = (int)$childid;
                    if ($childid <= 0 || in_array($childid, $inserted)) {
                        continue;
                    }
                    // Validate the child user exists and is a student.
                    $childuser = $DB->get_record('user', ['id' => $childid, 'deleted' => 0, 'confirmed' => 1]);
                    if (!$childuser) {
                        continue;
                    }
                    $DB->insert_record('istikama_parent_child', (object)[
                        'parentid' => $userid,
                        'childid' => $childid,
                        'timecreated' => time(),
                    ]);
                    $inserted[] = $childid;
                }
            }

            $transaction->allow_commit();

            // Enroll student in all class courses AFTER the transaction is closed.
            // Must be outside the transaction: enrol_user() fires message hooks that
            // call message_send(), which fails inside open transactions.
            if ($roletype === 'student' && !empty($data['classid'])) {
                local_istikama_admin_enroll_user_in_class($userid, (int)$data['classid'], 'student');
            }

            echo json_encode(['success' => true]);

        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'getusersbytab':
        local_istikama_admin_require_full_admin();
        $tab = required_param('tab', PARAM_ALPHA);
        $search = optional_param('search', '', PARAM_TEXT);
        $school = optional_param('school', 0, PARAM_INT);
        $page = optional_param('page', 0, PARAM_INT);
        $perpage = optional_param('perpage', 25, PARAM_INT);
        $perpage = max(10, min($perpage, 100));

        $systemcontext = context_system::instance();

        $where = ['u.deleted = 0', 'u.confirmed = 1'];
        $params = [];

        if ($search !== '') {
            $like = $DB->sql_like($DB->sql_concat('u.firstname', "' '", 'u.lastname'), ':searchname', false, false) .
                ' OR ' . $DB->sql_like('u.email', ':searchemail', false, false);
            $where[] = "({$like})";
            $params['searchname'] = "%{$search}%";
            $params['searchemail'] = "%{$search}%";
        }

        // Filter by role tab.
        $role_shortnames = [];
        if ($tab === 'students') {
            $role_shortnames = ['student'];
        } else if ($tab === 'teachers') {
            $role_shortnames = ['teacher', 'editingteacher', 'technicalprofessor', 'technical_professor', 'technicalprof', 'technical_teacher'];
        } else if ($tab === 'managers') {
            $role_shortnames = ['manager', 'coursecreator', 'schoolmanager'];
        } else if ($tab === 'parents') {
            $role_shortnames = ['parent'];
        }

        if (!empty($role_shortnames)) {
            [$rinsql, $rinparams] = $DB->get_in_or_equal($role_shortnames, SQL_PARAMS_NAMED, 'rsn');
            $where[] = "EXISTS (
                SELECT 1
                  FROM {role_assignments} ra
                  JOIN {context} cx ON cx.id = ra.contextid
                  JOIN {role} r ON r.id = ra.roleid
                 WHERE ra.userid = u.id
                   AND cx.contextlevel = :rcontextlevel
                   AND r.shortname {$rinsql}
            )";
            $params['rcontextlevel'] = CONTEXT_SYSTEM;
            $params = array_merge($params, $rinparams);
        }

        if ($school > 0) {
            $where[] = "EXISTS (
                SELECT 1
                  FROM {istikama_user_school} us
                 WHERE us.userid = u.id
                   AND us.schoolid = :schoolfilter
            )";
            $params['schoolfilter'] = $school;
        }

        $wheresql = implode(' AND ', $where);
        $countsql = "SELECT COUNT(1) FROM {user} u WHERE {$wheresql}";
        $totalusers = (int)$DB->count_records_sql($countsql, $params);

        $selectsql = "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess
                        FROM {user} u
                       WHERE {$wheresql}
                    ORDER BY u.lastname ASC, u.firstname ASC";
        $users = $DB->get_records_sql($selectsql, $params, $page * $perpage, $perpage);

        $userids = array_map(function($u) { return (int)$u->id; }, $users);

        // Get roles.
        $rolesbyuser = [];
        $roleshortbyuser = [];
        if (!empty($userids)) {
            [$insql, $inparams] = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
            $rparams = array_merge($inparams, ['contextlevel2' => CONTEXT_SYSTEM]);
            $rsql = "SELECT ra.userid, r.shortname, r.name
                       FROM {role_assignments} ra
                       JOIN {role} r ON r.id = ra.roleid
                       JOIN {context} cx ON cx.id = ra.contextid
                      WHERE cx.contextlevel = :contextlevel2
                        AND ra.userid {$insql}";
            $roleassignments = $DB->get_records_sql($rsql, $rparams);
            foreach ($roleassignments as $ra) {
                $uid = (int)$ra->userid;
                $rolesbyuser[$uid][] = !empty($ra->name) ? $ra->name : $ra->shortname;
                $roleshortbyuser[$uid][] = $ra->shortname;
            }
        }

        // Get assignment info.
        $assignmentbyuser = [];
        if (!empty($userids)) {
            [$ainsql, $ainparams] = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED, 'auid');
            $asql = "SELECT us.*, cc.name as schoolname
                       FROM {istikama_user_school} us
                       LEFT JOIN {course_categories} cc ON cc.id = us.schoolid
                      WHERE us.userid {$ainsql}";
            $uassignments = $DB->get_records_sql($asql, $ainparams);
            foreach ($uassignments as $ua) {
                $assignmentbyuser[(int)$ua->userid][] = format_string($ua->schoolname ?? '');
            }
        }

        $rows = [];
        foreach ($users as $user) {
            $uid = (int)$user->id;
            $userroletype = istikama_detect_user_role_type_from_shortnames($roleshortbyuser[$uid] ?? []);
            $assigninfo = '';
            if (!empty($assignmentbyuser[$uid])) {
                $assigninfo = implode(', ', array_unique($assignmentbyuser[$uid]));
            }
            $rows[] = [
                'id' => $uid,
                'name' => fullname($user),
                'email' => $user->email,
                'role' => implode(', ', $rolesbyuser[$uid] ?? []),
                'role_type' => $userroletype,
                'assignment' => $assigninfo,
                'lastlogin' => !empty($user->lastaccess) ? userdate($user->lastaccess) : '-',
                'editurl' => (new moodle_url('/user/editadvanced.php', ['id' => $uid]))->out(false),
                'viewurl' => (new moodle_url('/user/profile.php', ['id' => $uid]))->out(false),
                'deleteurl' => (new moodle_url('/admin/user.php', [
                    'delete' => $uid,
                    'sesskey' => sesskey(),
                ]))->out(false),
            ];
        }

        echo json_encode([
            'users' => $rows,
            'total' => $totalusers,
            'page' => $page,
            'perpage' => $perpage,
            'pages' => ceil($totalusers / $perpage),
        ]);
        break;

    // ═══════════════════════════════════════════
    // ═══ SCHOOL MANAGER SCOPED ENDPOINTS ═══
    // ═══════════════════════════════════════════

    case 'smgetlevels':
        local_istikama_admin_require_school_manager();
        $schoolid = local_istikama_admin_get_manager_school();
        if (!$schoolid) {
            echo json_encode([]);
            break;
        }
        $school = core_course_category::get($schoolid);
        $levels = $school->get_children();
        $result = [];
        foreach ($levels as $level) {
            $result[] = ['id' => (int)$level->id, 'name' => format_string($level->name)];
        }
        echo json_encode($result);
        break;

    case 'smgetclasses':
        local_istikama_admin_require_school_manager();
        $schoolid = local_istikama_admin_get_manager_school();
        $levelid = required_param('levelid', PARAM_INT);
        // Validate that this level belongs to the manager's school.
        if (!$schoolid || !local_istikama_admin_category_belongs_to_school($levelid, $schoolid)) {
            echo json_encode(['error' => 'Access denied']);
            break;
        }
        $level = core_course_category::get($levelid);
        $classes = $level->get_children();
        $result = [];
        foreach ($classes as $class) {
            $result[] = ['id' => (int)$class->id, 'name' => format_string($class->name)];
        }
        echo json_encode($result);
        break;

    case 'smgetuserassignment':
        local_istikama_admin_require_school_manager();
        $schoolid = local_istikama_admin_get_manager_school();
        $userid = required_param('userid', PARAM_INT);

        // Validate user belongs to this school.
        if (!$schoolid || !local_istikama_admin_user_belongs_to_school($userid, $schoolid)) {
            echo json_encode(['error' => 'Access denied: user not in your school']);
            break;
        }

        $roletype = istikama_detect_user_role_type($userid);
        // For school manager scope, remap manager to none (they can't manage managers).
        if ($roletype === 'manager') {
            $roletype = 'none';
        }

        $assignments = $DB->get_records('istikama_user_school', ['userid' => $userid, 'schoolid' => $schoolid]);

        $result = [
            'userid' => $userid,
            'roletype' => $roletype,
            'assignments' => [],
        ];

        foreach ($assignments as $a) {
            $entry = [
                'id' => (int)$a->id,
                'schoolid' => (int)$a->schoolid,
                'schoolname' => '',
                'levelid' => $a->levelid ? (int)$a->levelid : null,
                'levelname' => '',
                'classid' => $a->classid ? (int)$a->classid : null,
                'classname' => '',
                'role' => $a->role,
                'subjects' => [],
            ];

            try {
                $cat = core_course_category::get($a->schoolid);
                $entry['schoolname'] = format_string($cat->name);
            } catch (Exception $e) {}

            if ($a->levelid) {
                try {
                    $cat = core_course_category::get($a->levelid);
                    $entry['levelname'] = format_string($cat->name);
                } catch (Exception $e) {}
            }

            if ($a->classid) {
                try {
                    $cat = core_course_category::get($a->classid);
                    $entry['classname'] = format_string($cat->name);
                } catch (Exception $e) {}
            }

            if ($a->role === 'teacher') {
                $subjects = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $a->id]);
                foreach ($subjects as $s) {
                    $entry['subjects'][] = $s->subject;
                }
            }

            $result['assignments'][] = $entry;
        }

        echo json_encode($result);
        break;

    case 'smsaveuserassignment':
        local_istikama_admin_require_school_manager();
        $schoolid = local_istikama_admin_get_manager_school();

        $userid = required_param('userid', PARAM_INT);
        $roletype = required_param('roletype', PARAM_ALPHA);
        $datajson = required_param('data', PARAM_RAW);
        $data = json_decode($datajson, true);

        if (!$data || !is_array($data) || !$schoolid) {
            echo json_encode(['success' => false, 'error' => 'Invalid data']);
            break;
        }

        // School managers can't manage manager roles.
        if ($roletype === 'manager') {
            echo json_encode(['success' => false, 'error' => 'Access denied']);
            break;
        }

        // Validate user belongs to school.
        if (!local_istikama_admin_user_belongs_to_school($userid, $schoolid)) {
            // If user is new to this school, that's OK for assignment creation.
        }

        try {
            $transaction = $DB->start_delegated_transaction();

            if ($roletype === 'student') {
                // Remove old assignment and unenroll from previous class courses.
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'student', 'schoolid' => $schoolid]);
                foreach ($old as $o) {
                    if ($o->classid) {
                        local_istikama_admin_unenroll_user_from_class($userid, (int)$o->classid);
                    }
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'student', 'schoolid' => $schoolid]);

                $levelid = !empty($data['levelid']) ? (int)$data['levelid'] : 0;
                $classid = !empty($data['classid']) ? (int)$data['classid'] : 0;

                if ($levelid && $classid) {
                    if (!local_istikama_admin_category_belongs_to_school($levelid, $schoolid) ||
                        !local_istikama_admin_category_belongs_to_school($classid, $schoolid)) {
                        throw new \Exception('Invalid level/class for this school');
                    }
                    $record = new stdClass();
                    $record->userid    = $userid;
                    $record->schoolid  = $schoolid;
                    $record->levelid   = $levelid;
                    $record->classid   = $classid;
                    $record->role      = 'student';
                    $record->seasonid  = local_istikama_admin_resolve_write_seasonid() ?: null;
                    $record->timecreated  = time();
                    $record->timemodified = time();
                    $DB->insert_record('istikama_user_school', $record);
                }

            } else if ($roletype === 'teacher') {
                $old = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher', 'schoolid' => $schoolid]);
                foreach ($old as $o) {
                    $oldsubs = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                    foreach ($oldsubs as $sub) {
                        local_istikama_admin_unenroll_user_from_subject($userid, (int)$sub->subject);
                    }
                    $DB->delete_records('istikama_teacher_subject', ['assignmentid' => $o->id]);
                }
                $DB->delete_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher', 'schoolid' => $schoolid]);

                if (!empty($data['assignments']) && is_array($data['assignments'])) {
                    foreach ($data['assignments'] as $assignment) {
                        $levelid = !empty($assignment['levelid']) ? (int)$assignment['levelid'] : 0;
                        $classid = !empty($assignment['classid']) ? (int)$assignment['classid'] : 0;
                        if (!$levelid || !$classid) {
                            continue;
                        }
                        if (!local_istikama_admin_category_belongs_to_school($levelid, $schoolid) ||
                            !local_istikama_admin_category_belongs_to_school($classid, $schoolid)) {
                            continue;
                        }
                        $seasonidcur2 = local_istikama_admin_resolve_write_seasonid() ?: null;
                        $record = new stdClass();
                        $record->userid    = $userid;
                        $record->schoolid  = $schoolid;
                        $record->levelid   = $levelid;
                        $record->classid   = $classid;
                        $record->role      = 'teacher';
                        $record->seasonid  = $seasonidcur2;
                        $record->timecreated  = time();
                        $record->timemodified = time();
                        $aid = $DB->insert_record('istikama_user_school', $record);

                        if (!empty($assignment['subjects']) && is_array($assignment['subjects'])) {
                            foreach ($assignment['subjects'] as $subj) {
                                $courseid = (int)$subj;
                                if ($courseid > 0) {
                                    $srec = new stdClass();
                                    $srec->assignmentid = $aid;
                                    $srec->subject      = (string)$courseid;
                                    $srec->seasonid     = $seasonidcur2;
                                    $srec->timecreated  = time();
                                    $DB->insert_record('istikama_teacher_subject', $srec);
                                    local_istikama_admin_enroll_user_in_subject($userid, $courseid, 'editingteacher');
                                }
                            }
                        }
                    }
                    // Give teacher access to the central Question Bank
                    local_istikama_admin_ensure_qbank_access($userid);
                }
            }

            $transaction->allow_commit();

            // Enroll student AFTER commit so the transaction is already closed
            // (enrol_user fires hooks that may send messages — must be outside a transaction).
            if ($roletype === 'student') {
                $classid = !empty($data['classid']) ? (int)$data['classid'] : 0;
                if ($classid) {
                    local_istikama_admin_enroll_user_in_class($userid, $classid, 'student');
                }
            }

            echo json_encode(['success' => true]);

        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'smgetusersbytab':
        local_istikama_admin_require_school_manager();
        $schoolid = local_istikama_admin_get_manager_school();
        if (!$schoolid) {
            echo json_encode(['users' => [], 'total' => 0, 'page' => 0, 'perpage' => 25, 'pages' => 0]);
            break;
        }

        $tab = required_param('tab', PARAM_ALPHA);
        $search = optional_param('search', '', PARAM_TEXT);
        $page = optional_param('page', 0, PARAM_INT);
        $perpage = optional_param('perpage', 25, PARAM_INT);
        $perpage = max(10, min($perpage, 100));

        $systemcontext = context_system::instance();

        $where = ['u.deleted = 0', 'u.confirmed = 1'];
        $params = [];

        // Always filter to manager's school.
        $where[] = "EXISTS (
            SELECT 1
              FROM {istikama_user_school} us
             WHERE us.userid = u.id
               AND us.schoolid = :schoolfilter
        )";
        $params['schoolfilter'] = $schoolid;

        // Exclude technical professors and school managers.
        $excluded_roles = ['technicalprofessor', 'technical_professor', 'technicalprof', 'technical_teacher', 'schoolmanager'];
        [$exinsql, $exparams] = $DB->get_in_or_equal($excluded_roles, SQL_PARAMS_NAMED, 'xr');
        $where[] = "NOT EXISTS (
            SELECT 1
              FROM {role_assignments} raex
              JOIN {context} cxex ON cxex.id = raex.contextid
              JOIN {role} rex ON rex.id = raex.roleid
             WHERE raex.userid = u.id
               AND cxex.contextlevel = :excontextlevel
               AND rex.shortname {$exinsql}
        )";
        $params['excontextlevel'] = CONTEXT_SYSTEM;
        $params = array_merge($params, $exparams);

        if ($search !== '') {
            $like = $DB->sql_like($DB->sql_concat('u.firstname', "' '", 'u.lastname'), ':searchname', false, false) .
                ' OR ' . $DB->sql_like('u.email', ':searchemail', false, false);
            $where[] = "({$like})";
            $params['searchname'] = "%{$search}%";
            $params['searchemail'] = "%{$search}%";
        }

        // Filter by role tab (no managers tab for school manager).
        $role_shortnames = [];
        if ($tab === 'students') {
            $role_shortnames = ['student'];
        } else if ($tab === 'teachers') {
            $role_shortnames = ['teacher', 'editingteacher'];
        }
        // 'all' tab = no additional filter.

        if (!empty($role_shortnames)) {
            [$rinsql, $rinparams] = $DB->get_in_or_equal($role_shortnames, SQL_PARAMS_NAMED, 'rsn');
            $where[] = "EXISTS (
                SELECT 1
                  FROM {role_assignments} ra
                  JOIN {context} cx ON cx.id = ra.contextid
                  JOIN {role} r ON r.id = ra.roleid
                 WHERE ra.userid = u.id
                   AND cx.contextlevel = :rcontextlevel
                   AND r.shortname {$rinsql}
            )";
            $params['rcontextlevel'] = CONTEXT_SYSTEM;
            $params = array_merge($params, $rinparams);
        }

        $wheresql = implode(' AND ', $where);
        $countsql = "SELECT COUNT(1) FROM {user} u WHERE {$wheresql}";
        $totalusers = (int)$DB->count_records_sql($countsql, $params);

        $selectsql = "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess
                        FROM {user} u
                       WHERE {$wheresql}
                    ORDER BY u.lastname ASC, u.firstname ASC";
        $users = $DB->get_records_sql($selectsql, $params, $page * $perpage, $perpage);

        $userids = array_map(function($u) { return (int)$u->id; }, $users);

        // Get roles.
        $rolesbyuser = [];
        $roleshortbyuser = [];
        if (!empty($userids)) {
            [$insql, $inparams] = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
            $rparams = array_merge($inparams, ['contextlevel2' => CONTEXT_SYSTEM]);
            $rsql = "SELECT ra.userid, r.shortname, r.name
                       FROM {role_assignments} ra
                       JOIN {role} r ON r.id = ra.roleid
                       JOIN {context} cx ON cx.id = ra.contextid
                      WHERE cx.contextlevel = :contextlevel2
                        AND ra.userid {$insql}";
            $roleassignments = $DB->get_records_sql($rsql, $rparams);
            foreach ($roleassignments as $ra) {
                $uid = (int)$ra->userid;
                $rolesbyuser[$uid][] = !empty($ra->name) ? $ra->name : $ra->shortname;
                $roleshortbyuser[$uid][] = $ra->shortname;
            }
        }

        // For school manager, role type detection is student/teacher only.
        $sm_detect = function(array $shortnames): string {
            $teacher_roles = ['teacher', 'editingteacher'];
            $student_roles = ['student'];
            $parent_roles = ['parent'];
            foreach ($shortnames as $sn) {
                if (in_array($sn, $teacher_roles)) return 'teacher';
            }
            foreach ($shortnames as $sn) {
                if (in_array($sn, $student_roles)) return 'student';
            }
            foreach ($shortnames as $sn) {
                if (in_array($sn, $parent_roles)) return 'parent';
            }
            return 'none';
        };

        $rows = [];
        foreach ($users as $user) {
            $uid = (int)$user->id;
            $userroletype = $sm_detect($roleshortbyuser[$uid] ?? []);
            $rows[] = [
                'id' => $uid,
                'name' => fullname($user),
                'email' => $user->email,
                'role' => implode(', ', $rolesbyuser[$uid] ?? []),
                'role_type' => $userroletype,
                'assignment' => '',
                'lastlogin' => !empty($user->lastaccess) ? userdate($user->lastaccess) : '-',
                'editurl' => (new moodle_url('/user/editadvanced.php', ['id' => $uid]))->out(false),
                'viewurl' => (new moodle_url('/user/profile.php', ['id' => $uid]))->out(false),
                'deleteurl' => '',
            ];
        }

        echo json_encode([
            'users' => $rows,
            'total' => $totalusers,
            'page' => $page,
            'perpage' => $perpage,
            'pages' => ceil($totalusers / $perpage),
        ]);
        break;

    // ═══════════════════════════════════════════
    // ═══ TEACHER SCOPED ENDPOINTS ═══
    // ═══════════════════════════════════════════

    case 'tgetclasses':
        local_istikama_admin_require_teacher();
        $assignments = local_istikama_admin_get_teacher_assignments();
        $result = [];
        foreach ($assignments as $a) {
            $student_count = $a->classid ? $DB->count_records_sql("SELECT COUNT(1) FROM {istikama_user_school} WHERE classid = :cid AND role = 'student'", ['cid' => $a->classid]) : 0;
            $result[] = [
                'classid' => (int)$a->classid,
                'classname' => $a->classname ?? '',
                'levelname' => $a->levelname ?? '',
                'schoolname' => $a->schoolname ?? '',
                'subjects' => $a->subjects ?? [],
                'student_count' => $student_count,
            ];
        }
        echo json_encode($result);
        break;

    case 'tgetclassstudents':
        local_istikama_admin_require_teacher();
        $cid = required_param('classid', PARAM_INT);
        if (!local_istikama_admin_teacher_has_class($cid)) {
            echo json_encode(['error' => 'Access denied']);
            break;
        }
        $students = local_istikama_admin_get_class_students($cid);
        $result = [];
        foreach ($students as $s) {
            $result[] = [
                'id' => (int)$s->id,
                'name' => fullname($s),
                'email' => $s->email,
                'lastaccess' => !empty($s->lastaccess) ? userdate($s->lastaccess) : '—',
            ];
        }
        echo json_encode($result);
        break;

    case 'tgetattendance':
        local_istikama_admin_require_teacher();
        $cid = required_param('classid', PARAM_INT);
        $date = required_param('attend_date', PARAM_TEXT);
        if (!local_istikama_admin_teacher_has_class($cid)) {
            echo json_encode(['error' => 'Access denied']);
            break;
        }
        $records = $DB->get_records('istikama_attendance', ['classid' => $cid, 'attend_date' => $date]);
        $result = [];
        foreach ($records as $r) {
            $result[] = [
                'studentid' => (int)$r->studentid,
                'status' => $r->status,
                'behavior_note' => $r->behavior_note,
            ];
        }
        echo json_encode($result);
        break;

    case 'tgetassessments':
        local_istikama_admin_require_teacher();
        $cid = required_param('classid', PARAM_INT);
        if (!local_istikama_admin_teacher_has_class($cid)) {
            echo json_encode(['error' => 'Access denied']);
            break;
        }
        $records = $DB->get_records('istikama_assessments', ['classid' => $cid], 'timecreated DESC');
        $result = [];
        foreach ($records as $r) {
            $sname = '';
            try { $su = $DB->get_record('user', ['id' => $r->studentid], 'firstname,lastname'); $sname = fullname($su); } catch (Exception $e) {}
            $result[] = [
                'id' => (int)$r->id,
                'studentid' => (int)$r->studentid,
                'student_name' => $sname,
                'title' => $r->title,
                'subject' => $r->subject,
                'score' => $r->score,
                'max_score' => $r->max_score,
                'notes' => $r->notes,
                'date' => userdate($r->timecreated),
            ];
        }
        echo json_encode($result);
        break;

    case 'tmycontent':
        local_istikama_admin_require_teacher();
        $status = optional_param('status', '', PARAM_ALPHA);
        $where = ['uploaded_by' => $USER->id];
        if ($status) $where['status'] = $status;
        $records = $DB->get_records('istikama_content_bank', $where, 'timecreated DESC');
        $result = [];
        foreach ($records as $r) {
            $result[] = [
                'id' => (int)$r->id,
                'name' => $r->name,
                'content_type' => $r->content_type,
                'subject' => $r->subject ?? '',
                'status' => $r->status,
                'date' => userdate($r->timecreated),
            ];
        }
        echo json_encode($result);
        break;

    case 'tmyactivities':
        local_istikama_admin_require_teacher();
        $records = [];
        try { $records = $DB->get_records('istikama_teacher_activities', ['created_by' => $USER->id], 'timecreated DESC'); } catch (Exception $e) {}
        $result = [];
        foreach ($records as $r) {
            $result[] = [
                'id' => (int)$r->id,
                'name' => $r->name,
                'type' => $r->type,
                'subject' => $r->subject ?? '',
                'status' => $r->status,
                'date' => userdate($r->timecreated),
            ];
        }
        echo json_encode($result);
        break;

    // ═══════════════════════════════════════════
    // ═══ PARENT-CHILD LINKING (Admin/Manager) ═══
    // ═══════════════════════════════════════════

    case 'linkparent':
        local_istikama_admin_require_full_admin();
        $parentid = required_param('parentid', PARAM_INT);
        $childid = required_param('childid', PARAM_INT);
        if ($DB->record_exists('istikama_parent_child', ['parentid' => $parentid, 'childid' => $childid])) {
            echo json_encode(['success' => true, 'message' => 'Already linked']);
        } else {
            $DB->insert_record('istikama_parent_child', (object)[
                'parentid' => $parentid,
                'childid' => $childid,
                'timecreated' => time(),
            ]);
            echo json_encode(['success' => true, 'message' => 'Parent linked to child']);
        }
        break;

    case 'unlinkparent':
        local_istikama_admin_require_full_admin();
        $parentid = required_param('parentid', PARAM_INT);
        $childid = required_param('childid', PARAM_INT);
        $DB->delete_records('istikama_parent_child', ['parentid' => $parentid, 'childid' => $childid]);
        echo json_encode(['success' => true, 'message' => 'Link removed']);
        break;

    case 'getparentchildren':
        local_istikama_admin_require_parent();
        $children = local_istikama_admin_get_parent_children();
        $result = [];
        foreach ($children as $c) {
            $result[] = [
                'id' => (int)$c->id,
                'fullname' => fullname($c),
                'email' => $c->email,
                'schoolname' => $c->schoolname,
                'levelname' => $c->levelname,
                'classname' => $c->classname,
                'lastaccess' => $c->lastaccess ? userdate($c->lastaccess) : null,
            ];
        }
        echo json_encode($result);
        break;

    // ═══════════════════════════════════════════════════════════════════
    // Content Bank — Moderation AJAX Actions
    // ═══════════════════════════════════════════════════════════════════

    case 'cb_change_status':
        require_sesskey();
        $contentid = required_param('contentid', PARAM_INT);
        $newstatus = required_param('new_status', PARAM_ALPHANUMEXT);
        $notes     = optional_param('notes', '', PARAM_TEXT);
        try {
            local_istikama_admin_change_content_status($contentid, $newstatus, $notes);
            $statuses = local_istikama_admin_get_content_statuses();
            $st = $statuses[$newstatus] ?? [];
            echo json_encode([
                'success'  => true,
                'label'    => $st['label'] ?? ucfirst($newstatus),
                'badge_bg' => $st['badge_bg'] ?? '#f1f5f9',
                'badge_fg' => $st['badge_fg'] ?? '#475569',
                'icon'     => $st['icon'] ?? 'fa-circle',
            ]);
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'cb_bulk_change_status':
        require_sesskey();
        $ids_raw   = required_param('contentids', PARAM_TEXT);
        $newstatus = required_param('new_status', PARAM_ALPHANUMEXT);
        $notes     = optional_param('notes', '', PARAM_TEXT);
        $ids = array_filter(array_map('intval', explode(',', $ids_raw)));
        $count = 0;
        foreach ($ids as $cid) {
            try {
                local_istikama_admin_change_content_status($cid, $newstatus, $notes);
                $count++;
            } catch (\Throwable $e) {
                // Skip items that fail (e.g., already deleted).
            }
        }
        echo json_encode(['success' => true, 'count' => $count]);
        break;

    case 'cb_add_tag':
        require_sesskey();
        $contentid = required_param('contentid', PARAM_INT);
        $tag       = trim(required_param('tag', PARAM_TEXT));
        $tag_type  = optional_param('tag_type', 'custom', PARAM_ALPHANUMEXT);
        if ($tag === '') {
            echo json_encode(['success' => false, 'error' => 'Empty tag']);
            break;
        }
        // Check for duplicate.
        $exists = $DB->record_exists('istikama_content_tags', ['content_id' => $contentid, 'tag' => $tag]);
        if ($exists) {
            echo json_encode(['success' => false, 'error' => 'Tag already exists']);
            break;
        }
        $tagid = $DB->insert_record('istikama_content_tags', (object)[
            'content_id'  => $contentid,
            'tag'         => $tag,
            'tag_type'    => $tag_type,
            'added_by'    => $USER->id,
            'timecreated' => time(),
        ]);
        echo json_encode(['success' => true, 'id' => $tagid, 'tag' => $tag, 'tag_type' => $tag_type]);
        break;

    case 'cb_remove_tag':
        require_sesskey();
        $tagid = required_param('tagid', PARAM_INT);
        $DB->delete_records('istikama_content_tags', ['id' => $tagid]);
        echo json_encode(['success' => true]);
        break;

    case 'cb_get_tags':
        $contentid = required_param('contentid', PARAM_INT);
        $tags = $DB->get_records('istikama_content_tags', ['content_id' => $contentid], 'timecreated ASC');
        $out = [];
        foreach ($tags as $t) {
            $out[] = ['id' => (int)$t->id, 'tag' => $t->tag, 'tag_type' => $t->tag_type];
        }
        echo json_encode($out);
        break;

    case 'cb_get_history':
        $contentid = required_param('contentid', PARAM_INT);
        $rows = $DB->get_records('istikama_content_status_history', ['content_id' => $contentid], 'timecreated DESC');
        $statuses = local_istikama_admin_get_content_statuses();
        $out = [];
        foreach ($rows as $r) {
            $user = $DB->get_record('user', ['id' => $r->changed_by], 'firstname, lastname');
            $out[] = [
                'user'       => $user ? fullname($user) : '—',
                'old_status' => $statuses[$r->old_status]['label'] ?? ucfirst($r->old_status),
                'new_status' => $statuses[$r->new_status]['label'] ?? ucfirst($r->new_status),
                'old_key'    => $r->old_status,
                'new_key'    => $r->new_status,
                'notes'      => $r->notes ?? '',
                'time'       => userdate($r->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
            ];
        }
        echo json_encode($out);
        break;

    default:
        echo json_encode(['error' => 'Unknown action']);
        break;
}

/**
 * Detect user's primary role type from their system-level role assignments.
 */
function istikama_detect_user_role_type(int $userid): string {
    global $DB;

    $sql = "SELECT r.shortname
              FROM {role_assignments} ra
              JOIN {role} r ON r.id = ra.roleid
              JOIN {context} cx ON cx.id = ra.contextid
             WHERE ra.userid = :userid
               AND cx.contextlevel = :contextlevel";
    $roles = $DB->get_records_sql($sql, ['userid' => $userid, 'contextlevel' => CONTEXT_SYSTEM]);
    $shortnames = array_map(function($r) { return $r->shortname; }, $roles);
    return istikama_detect_user_role_type_from_shortnames($shortnames);
}

/**
 * Detect role type from an array of shortnames.
 */
function istikama_detect_user_role_type_from_shortnames(array $shortnames): string {
    $manager_roles = ['manager', 'coursecreator', 'schoolmanager'];
    $parent_roles = ['parent'];
    $tech_prof_roles = ['technicalprofessor', 'technical_professor', 'technicalprof', 'technical_teacher'];
    $teacher_roles = ['teacher', 'editingteacher'];
    $student_roles = ['student'];

    foreach ($shortnames as $sn) {
        if (in_array($sn, $manager_roles)) return 'manager';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $parent_roles)) return 'parent';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $tech_prof_roles)) return 'technical_professor';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $teacher_roles)) return 'teacher';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $student_roles)) return 'student';
    }
    return 'none';
}
