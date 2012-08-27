<?php 
/**
 * Utility functions for Eventrie's theme
 */

 add_theme_support('post-thumbnails');

class EventriesTheme {
    private static $instance = null;

    private function __construct() {
        self::showEventsInMainLoop();
        self::registerSidebars();
    }

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new EventriesTheme();
        }
        return self::$instance;
    }

    private function showEventsInMainLoop() {
        if (!function_exists('tribe_update_option')) return;
        if (!class_exists('TribeEventsTemplates')) return;
        tribe_update_option('showInLoops', true);
        add_action('pre_get_posts', array('TribeEventsTemplates', 'showInLoops'));
    }

    private function registerSidebars() {
        register_sidebar(array(
            'id' => 'main-right-sidebar',
            'name' => 'Main Right Sidebar'
        ));
    }
}

EventriesTheme::instance();