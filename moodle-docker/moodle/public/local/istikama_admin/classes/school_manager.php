<?php
namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

use core_course_category;
use stdClass;
use context_coursecat;

class school_manager {

    const MAX_DEPTH = 3;

    /**
     * Get the depth of a category (1=school, 2=level, 3=class).
     */
    public static function get_category_depth(int $categoryid): int {
        $category = core_course_category::get($categoryid, MUST_EXIST, true);
        return $category->depth;
    }

    /**
     * Get the hierarchy label for a given depth.
     */
    public static function get_depth_label(int $depth): string {
        switch ($depth) {
            case 1: return get_string('hierarchy_school', 'local_istikama_admin');
            case 2: return get_string('hierarchy_level', 'local_istikama_admin');
            case 3: return get_string('hierarchy_class', 'local_istikama_admin');
            default: return get_string('hierarchy_school', 'local_istikama_admin');
        }
    }

    /**
     * Check if a child can be created under this category.
     */
    public static function can_create_child(int $categoryid): bool {
        $depth = self::get_category_depth($categoryid);
        return $depth < self::MAX_DEPTH;
    }

    /**
     * Get the label for adding a child under this category.
     */
    public static function get_add_child_label(int $parentdepth): string {
        $childdepth = $parentdepth + 1;
        return self::get_depth_label($childdepth);
    }

    /**
     * Create a school (top-level category + extended info).
     */
    public static function create_school(object $data): int {
        global $DB;

        // Create the Moodle category.
        $catdata = new stdClass();
        $catdata->name = $data->name;
        $catdata->parent = 0;
        $catdata->description = $data->description ?? '';
        $catdata->descriptionformat = FORMAT_HTML;
        $catdata->visible = 1;
        $category = core_course_category::create($catdata);

        // Create the extended school info record.
        $record = new stdClass();
        $record->categoryid = $category->id;
        $record->institution_code = $data->institution_code ?? '';
        $record->wilaya_code = $data->wilaya_code ?? '';
        $record->wilaya_name = $data->wilaya_name ?? '';
        $record->commune_code = $data->commune_code ?? '';
        $record->commune_name = $data->commune_name ?? '';
        $record->address = $data->address ?? '';
        $record->phone = $data->phone ?? '';
        $record->email = $data->email ?? '';
        $record->admin_userid = $data->admin_userid ?? null;
        $record->logo_itemid = $data->logo_itemid ?? null;
        $record->timecreated = time();
        $record->timemodified = time();

        $DB->insert_record('istikama_school_info', $record);

        // Handle logo file if uploaded.
        if (!empty($data->logo_itemid)) {
            self::save_school_logo($category->id, $data->logo_itemid);
        }

        return $category->id;
    }

    /**
     * Update school info.
     */
    public static function update_school(int $categoryid, object $data): void {
        global $DB;

        // Update the Moodle category name.
        $category = core_course_category::get($categoryid);
        $catdata = new stdClass();
        $catdata->name = $data->name;
        $catdata->description = $data->description ?? $category->description;
        $category->update($catdata);

        // Update the extended info.
        $record = $DB->get_record('istikama_school_info', ['categoryid' => $categoryid]);
        if (!$record) {
            $record = new stdClass();
            $record->categoryid = $categoryid;
            $record->timecreated = time();
        }

        $record->institution_code = $data->institution_code ?? $record->institution_code ?? '';
        $record->wilaya_code = $data->wilaya_code ?? $record->wilaya_code ?? '';
        $record->wilaya_name = $data->wilaya_name ?? $record->wilaya_name ?? '';
        $record->commune_code = $data->commune_code ?? $record->commune_code ?? '';
        $record->commune_name = $data->commune_name ?? $record->commune_name ?? '';
        $record->address = $data->address ?? $record->address ?? '';
        $record->phone = $data->phone ?? $record->phone ?? '';
        $record->email = $data->email ?? $record->email ?? '';
        $record->admin_userid = $data->admin_userid ?? $record->admin_userid ?? null;
        $record->logo_itemid = $data->logo_itemid ?? $record->logo_itemid ?? null;
        $record->timemodified = time();

        if (!empty($record->id)) {
            $DB->update_record('istikama_school_info', $record);
        } else {
            $DB->insert_record('istikama_school_info', $record);
        }

        if (!empty($data->logo_itemid)) {
            self::save_school_logo($categoryid, $data->logo_itemid);
        }
    }

    /**
     * Create a level (depth-2 sub-category under a school) linked to a global level.
     */
    public static function create_level(int $schoolid, int $global_level_id): int {
        global $DB;
        $global = $DB->get_record('istikama_global_level', ['id' => $global_level_id], '*', MUST_EXIST);
        $catdata = new stdClass();
        $catdata->name = $global->name;
        $catdata->parent = $schoolid;
        $catdata->visible = 1;
        $category = core_course_category::create($catdata);
        
        $info = new stdClass();
        $info->categoryid = $category->id;
        $info->global_level_id = $global->id;
        $DB->insert_record('istikama_level_info', $info);
        
        return $category->id;
    }

    /**
     * Create a class (depth-3 sub-category under a level).
     */
    public static function create_class(int $levelid, string $name): int {
        // Enforce max depth.
        if (self::get_category_depth($levelid) >= self::MAX_DEPTH - 1 + 1) {
            throw new \moodle_exception('max_depth_reached', 'local_istikama_admin');
        }
        $catdata = new stdClass();
        $catdata->name = $name;
        $catdata->parent = $levelid;
        $catdata->visible = 1;
        $category = core_course_category::create($catdata);
        return $category->id;
    }

    /**
     * Get extended school info for a category.
     */
    public static function get_school_info(int $categoryid): ?object {
        global $DB;
        return $DB->get_record('istikama_school_info', ['categoryid' => $categoryid]) ?: null;
    }

    /**
     * Get full hierarchy tree: schools → levels → classes.
     */
    public static function get_hierarchy(): array {
        $topchildren = core_course_category::top()->get_children();
        $tree = [];
        foreach ($topchildren as $school) {
            $schooldata = self::build_tree_node($school, 1);
            $tree[] = $schooldata;
        }
        return $tree;
    }

    /**
     * Build a tree node recursively (up to max depth).
     */
    private static function build_tree_node($category, int $depth): array {
        global $DB;
        $node = [
            'id' => $category->id,
            'name' => $category->name,
            'depth' => $depth,
            'label' => self::get_depth_label($depth),
            'coursecount' => $category->coursecount,
            'can_create_child' => $depth < self::MAX_DEPTH,
            'children' => [],
        ];

        if ($depth === 1) {
            $info = $DB->get_record('istikama_school_info', ['categoryid' => $category->id]);
            if ($info) {
                $node['info'] = $info;
            }
        } else if ($depth === 2) {
            $levelinfo = $DB->get_record_sql("
                SELECT gli.global_level_id, gl.order_index 
                FROM {istikama_level_info} gli
                JOIN {istikama_global_level} gl ON gl.id = gli.global_level_id
                WHERE gli.categoryid = ?
            ", [$category->id]);
            if ($levelinfo) {
                $node['global_level_id'] = $levelinfo->global_level_id;
                $node['order_index'] = $levelinfo->order_index;
            } else {
                $node['global_level_id'] = 0;
                $node['order_index'] = 999;
            }
        }

        if ($depth < self::MAX_DEPTH) {
            $children = $category->get_children();
            foreach ($children as $child) {
                $node['children'][] = self::build_tree_node($child, $depth + 1);
            }
            if ($depth === 1 && !empty($node['children'])) {
                usort($node['children'], function($a, $b) {
                    return ($a['order_index'] ?? 999) <=> ($b['order_index'] ?? 999);
                });
            }
        } else {
            // At max depth (Class), get subjects (courses) inside it.
            $courses = $category->get_courses();
            $subjects = [];
            foreach ($courses as $c) {
                $subjects[] = [
                    'id' => $c->id,
                    'name' => $c->fullname
                ];
            }
            $node['subjects'] = $subjects;
        }

        return $node;
    }

    /**
     * Create a subject (Moodle course) inside a class category.
     */
    public static function create_subject(int $classid, string $name): int {
        global $DB, $CFG;
        require_once($CFG->dirroot . '/course/lib.php');
        
        $category = core_course_category::get($classid, MUST_EXIST, true);
        
        // Prevent duplicate names in the same class.
        if ($DB->record_exists('course', ['category' => $classid, 'fullname' => $name])) {
            throw new \moodle_exception('error_duplicate_subject', 'local_istikama_admin');
        }
        
        $courseRecord = new stdClass();
        $courseRecord->category = $classid;
        $courseRecord->fullname = $name;
        $courseRecord->shortname = clean_param($name, PARAM_ALPHANUMEXT) . '_' . $classid . '_' . time();
        $courseRecord->visible = 1;
        
        $course = create_course($courseRecord);
        return $course->id;
    }

    /**
     * Save school logo from draft area.
     */
    private static function save_school_logo(int $categoryid, int $draftitemid): void {
        $context = \context_system::instance();
        file_save_draft_area_files(
            $draftitemid,
            $context->id,
            'local_istikama_admin',
            'schoollogo',
            $categoryid,
            ['maxfiles' => 1, 'accepted_types' => ['image']]
        );
    }

    /**
     * Get school logo URL.
     */
    public static function get_school_logo_url(int $categoryid): ?string {
        $context = \context_system::instance();
        $fs = get_file_storage();
        $files = $fs->get_area_files($context->id, 'local_istikama_admin', 'schoollogo', $categoryid, 'id', false);
        $file = reset($files);
        if (!$file) {
            return null;
        }
        return \moodle_url::make_pluginfile_url(
            $context->id,
            'local_istikama_admin',
            'schoollogo',
            $categoryid,
            $file->get_filepath(),
            $file->get_filename()
        )->out(false);
    }

    /**
     * Delete a school and all its children.
     */
    public static function delete_school(int $categoryid): void {
        global $DB;
        $category = core_course_category::get($categoryid);
        $category->delete_full(true);
        $DB->delete_records('istikama_school_info', ['categoryid' => $categoryid]);
    }

    /**
     * Get potential school administrators.
     */
    public static function get_potential_admins(): array {
        global $DB, $CFG;

        $adminids = explode(',', $CFG->siteadmins ?? '');
        $adminids = array_filter(array_map('intval', $adminids));

        $sql = "SELECT DISTINCT u.id, u.firstname, u.lastname, u.email
                  FROM {user} u
                  JOIN {role_assignments} ra ON ra.userid = u.id
                  JOIN {role} r ON r.id = ra.roleid
                 WHERE u.deleted = 0
                   AND u.suspended = 0
                   AND r.shortname IN ('manager', 'coursecreator')";
        
        $roled_users = $DB->get_records_sql($sql) ?: [];
        $site_admins = [];

        if (!empty($adminids)) {
            list($insql, $params) = $DB->get_in_or_equal($adminids);
            $site_admins = $DB->get_records_select('user', "deleted = 0 AND suspended = 0 AND id $insql", $params, '', 'id, firstname, lastname, email') ?: [];
        }

        $all_admins = [];
        foreach ($site_admins as $user) {
            $all_admins[$user->id] = $user;
        }
        foreach ($roled_users as $user) {
            if (!isset($all_admins[$user->id])) {
                $all_admins[$user->id] = $user;
            }
        }

        usort($all_admins, function($a, $b) {
            $cmp = strcasecmp($a->lastname, $b->lastname);
            if ($cmp === 0) {
                return strcasecmp($a->firstname, $b->firstname);
            }
            return $cmp;
        });

        return $all_admins;
    }
}
