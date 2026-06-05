<?php
namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

class geodata {
    private static $datafile = '/local/istikama_admin/geodata/algeria_wilayas.json';
    private static $data = null;

    private static function load(): array {
        global $CFG;
        if (self::$data !== null) {
            return self::$data;
        }
        $filepath = $CFG->dirroot . self::$datafile;
        if (!file_exists($filepath)) {
            self::$data = [];
            return self::$data;
        }
        $json = file_get_contents($filepath);
        $decoded = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            self::$data = [];
            return self::$data;
        }
        self::$data = $decoded;
        return self::$data;
    }

    public static function get_wilayas(): array {
        $data = self::load();
        $wilayas = [];
        foreach ($data as $w) {
            $wilayas[] = [
                'code' => $w['code'],
                'name' => $w['name'],
                'name_ar' => $w['name_ar'],
            ];
        }
        return $wilayas;
    }

    public static function get_communes(string $wilayacode): array {
        $data = self::load();
        foreach ($data as $w) {
            if ($w['code'] === $wilayacode) {
                return $w['communes'] ?? [];
            }
        }
        return [];
    }

    public static function get_wilaya_name(string $code, string $lang = 'name'): string {
        $data = self::load();
        foreach ($data as $w) {
            if ($w['code'] === $code) {
                return $w[$lang] ?? $w['name'] ?? '';
            }
        }
        return '';
    }

    public static function get_commune_name(string $wcode, string $ccode, string $lang = 'name'): string {
        $communes = self::get_communes($wcode);
        foreach ($communes as $c) {
            if ($c['code'] === $ccode) {
                return $c[$lang] ?? $c['name'] ?? '';
            }
        }
        return '';
    }

    public static function get_wilayas_menu(): array {
        $wilayas = self::get_wilayas();
        $menu = ['' => get_string('choosedots')];
        foreach ($wilayas as $w) {
            $menu[$w['code']] = $w['code'] . ' - ' . $w['name'] . ' (' . $w['name_ar'] . ')';
        }
        return $menu;
    }

    public static function get_communes_menu(string $wilayacode): array {
        $communes = self::get_communes($wilayacode);
        $menu = ['' => get_string('choosedots')];
        foreach ($communes as $c) {
            $menu[$c['code']] = $c['name'] . ' (' . $c['name_ar'] . ')';
        }
        return $menu;
    }

    public static function get_all_communes_menu(): array {
        $data = self::load();
        $menu = ['' => get_string('choosedots')];
        foreach ($data as $w) {
            $communes = $w['communes'] ?? [];
            foreach ($communes as $c) {
                // Prepend wilaya code to name to avoid duplicate names and clarify.
                $menu[$c['code']] = $c['name'] . ' (' . $c['name_ar'] . ') - Wilaya: ' . $w['code'];
            }
        }
        return $menu;
    }
}
