<?php
namespace local_istikama_admin\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class upload_content_form extends \moodleform {
    public function definition() {
        $mform = $this->_form;

        // Custom File Manager (Supports Drag & Drop)
        $mform->addElement('header', 'uploadheader', 'Upload New Content');
        
        $mform->addElement('text', 'name', 'Content Name');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        $options = [
            'subdirs' => 0,
            'maxbytes' => $this->_customdata['maxbytes'] ?? 0,
            'maxfiles' => 1,
            'accepted_types' => ['web_image', '.pdf', '.h5p'] // Can add more
        ];
        
        $mform->addElement('filemanager', 'contentfile', 'File', null, $options);
        $mform->addRule('contentfile', null, 'required', null, 'client');
        
        $mform->addElement('text', 'external_url', 'External Link (YouTube, etc.)');
        $mform->setType('external_url', PARAM_URL);
        
        // Metadata
        $mform->addElement('select', 'category', 'Category', ['main' => 'Main', 'illustrative' => 'Illustrative', 'enrichment' => 'Enrichment']);
        $mform->addElement('select', 'level', 'Level', ['1' => 'Level 1', '2' => 'Level 2']);
        
        $this->add_action_buttons(false, 'Upload Content');
    }
}
