<?php
namespace local_istikama_admin\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

use moodleform;
use local_istikama_admin\geodata;
use local_istikama_admin\school_manager;

class school_form extends moodleform {

    protected function definition() {
        $mform = $this->_form;
        $schoolinfo = $this->_customdata['schoolinfo'] ?? null;
        $categoryid = $this->_customdata['categoryid'] ?? 0;

        // Hidden fields.
        $mform->addElement('hidden', 'categoryid', $categoryid);
        $mform->setType('categoryid', PARAM_INT);

        $mform->addElement('hidden', 'action', $categoryid ? 'editschool' : 'addschool');
        $mform->setType('action', PARAM_ALPHA);

        // School Name.
        $mform->addElement('text', 'name', get_string('school_name', 'local_istikama_admin'), ['size' => 60]);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Institution Code.
        $mform->addElement('text', 'institution_code', get_string('institution_code', 'local_istikama_admin'), ['size' => 30]);
        $mform->setType('institution_code', PARAM_ALPHANUMEXT);

        // Wilaya dropdown.
        $wilayas = geodata::get_wilayas_menu();
        $mform->addElement('select', 'wilaya_code', get_string('wilaya', 'local_istikama_admin'), $wilayas,
            ['id' => 'id_wilaya_code']);
        $mform->setType('wilaya_code', PARAM_RAW);

        // Commune dropdown (dynamically populated by JS, validated by server via optional_param)
        $communes = ['' => get_string('choosedots')];
        $current_wilaya = optional_param('wilaya_code', $schoolinfo->wilaya_code ?? '', PARAM_RAW);
        if (!empty($current_wilaya)) {
            $communes = geodata::get_communes_menu($current_wilaya);
        }
        $mform->addElement('select', 'commune_code', get_string('commune', 'local_istikama_admin'), $communes,
            ['id' => 'id_commune_code']);
        $mform->setType('commune_code', PARAM_RAW);

        // Address.
        $mform->addElement('textarea', 'address', get_string('address', 'local_istikama_admin'),
            ['rows' => 3, 'cols' => 60]);
        $mform->setType('address', PARAM_TEXT);

        // Phone.
        $mform->addElement('text', 'phone', get_string('phone', 'local_istikama_admin'), ['size' => 20]);
        $mform->setType('phone', PARAM_TEXT);

        // Email.
        $mform->addElement('text', 'email', get_string('school_email', 'local_istikama_admin'), ['size' => 40]);
        $mform->setType('email', PARAM_EMAIL);

        // School Administrator.
        $admins = school_manager::get_potential_admins();
        $adminoptions = ['' => get_string('choosedots')];
        foreach ($admins as $admin) {
            $adminoptions[$admin->id] = fullname($admin) . ' (' . $admin->email . ')';
        }
        $mform->addElement('select', 'admin_userid', get_string('school_admin', 'local_istikama_admin'), $adminoptions);
        $mform->setType('admin_userid', PARAM_INT);

        // School Logo.
        $mform->addElement('filepicker', 'logo_itemid', get_string('school_logo', 'local_istikama_admin'),
            null, ['maxbytes' => 2097152, 'accepted_types' => ['image']]);

        // Description.
        $mform->addElement('textarea', 'description', get_string('description'), ['rows' => 4, 'cols' => 60]);
        $mform->setType('description', PARAM_TEXT);

        // Set defaults from existing data.
        if ($schoolinfo) {
            $mform->setDefault('institution_code', $schoolinfo->institution_code ?? '');
            $mform->setDefault('wilaya_code', $schoolinfo->wilaya_code ?? '');
            $mform->setDefault('commune_code', $schoolinfo->commune_code ?? '');
            $mform->setDefault('address', $schoolinfo->address ?? '');
            $mform->setDefault('phone', $schoolinfo->phone ?? '');
            $mform->setDefault('email', $schoolinfo->email ?? '');
            $mform->setDefault('admin_userid', $schoolinfo->admin_userid ?? '');
        }

        if ($categoryid) {
            $category = \core_course_category::get($categoryid);
            $mform->setDefault('name', $category->name);
        }

        $this->add_action_buttons(true, $categoryid ?
            get_string('edit_school', 'local_istikama_admin') :
            get_string('add_school', 'local_istikama_admin'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        if (empty($data['name'])) {
            $errors['name'] = get_string('required');
        }
        return $errors;
    }
}
