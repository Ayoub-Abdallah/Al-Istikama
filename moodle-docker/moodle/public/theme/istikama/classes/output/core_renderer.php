<?php

namespace theme_istikama\output;

defined('MOODLE_INTERNAL') || die;

class core_renderer extends \theme_boost\output\core_renderer {

    public function render_from_template($templatename, $context) {
        $logourl = $this->get_logo_url() ? $this->get_logo_url()->out() : null;
        $compactlogourl = $this->get_compact_logo_url() ? $this->get_compact_logo_url()->out() : null;

        if (is_array($context)) {
            $context['istikama_logourl'] = $logourl;
            $context['istikama_compactlogourl'] = $compactlogourl;
        } else if (is_object($context)) {
            $context->istikama_logourl = $logourl;
            $context->istikama_compactlogourl = $compactlogourl;
        }
        
        return parent::render_from_template($templatename, $context);
    }

}
