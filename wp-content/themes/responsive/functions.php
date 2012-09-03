<?php 
/**
 * Utility functions for Eventrie's theme
 */

 add_theme_support('post-thumbnails');

class EventriesTheme {
    private static $instance = null;

    private function __construct() {
        $this->registerSidebars();
        $this->registerMenus();
        $this->showEventsInMainLoop();

        add_action('init', array($this, 'init'));
    }

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new EventriesTheme();
        }
        return self::$instance;
    }

    public function init() {
        $this->registerScripts();
        add_filter('wp_nav_menu_objects', array($this, 'fixActiveMenuClass'), 10, 2);
    }

    private function showEventsInMainLoop() {
        if (!function_exists('tribe_update_option')) return;
        if (!class_exists('TribeEventsTemplates')) return;
        tribe_update_option('showInLoops', true);
        add_action('pre_get_posts', array('TribeEventsTemplates', 'showInLoops'));
    }

    public function registerScripts() {
        $js = get_stylesheet_directory_uri() . '/js';
        wp_register_script('jquery-wookmark', "$js/jquery.wookmark.js", array('jquery'), '0.5', true);
        wp_register_script('eventries', "$js/eventries.js", array('jquery', 'jquery-wookmark'), '0.1', true);
        add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    public function enqueueScripts() {
        wp_enqueue_script('eventries');
    }

    private function registerSidebars() {
        register_sidebar(array(
            'id' => 'main-right-sidebar',
            'name' => 'Main Right Sidebar',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2><div class="widget-content">',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></li>'
        ));
    }

    private function registerMenus() {
        register_nav_menu('primary', 'Primary Menu');
    }

    public function fixActiveMenuClass($items, $args) {
        if (is_admin()) return;

        foreach ($items as $item) {
            if (in_array('current-menu-item', $item->classes)) {
                $item->classes[] = 'active';
            }
        }

        return $items;
    }

    public function getRandomFlickrImage() {
        static $index = -1;
        static $images = array(
            'http://farm6.staticflickr.com/5276/5862226909_829eee65b5_z.jpg',
            'http://farm9.staticflickr.com/8295/7874883666_31996ac404_b.jpg',
            'http://farm9.staticflickr.com/8312/7904586034_1f6a848aaf_b.jpg',
            'http://farm9.staticflickr.com/8444/7897023082_f65d38d910_b.jpg',
            'http://farm9.staticflickr.com/8037/7901481296_701189916f_b.jpg',
            'http://farm8.staticflickr.com/7248/7879398406_f2f54c86b3_b.jpg'
        );

        if ($index === -1) shuffle($images);

        return $images[++$index % count($images)];
    }
}

EventriesTheme::instance();


class Cycle {
    private static $queues = array();
    private static $size = 0;

    private static function create($items) {
        $queue = new StdClass();
        $queue->items = $items;
        $queue->index = 0;
        $queue->length = count($items);

        self::$size = self::$size + 1;

        array_push(self::$queues, $queue);
    }

    public static function start($items) {
        self::create((array) $items);
        return self::next();
    }

    public static function next() {
        $queue = self::$queues[self::$size - 1];
        $queue->index = ($queue->index + 1) % $queue->length;
        return $queue->items[$queue->index];
    }

    public static function end() {
        array_shift(self::$queues);
    }
}