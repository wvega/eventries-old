<?php
/*
Plugin Name: WordPress Custom Events
Plugin URI: http://wvega.github.com/wp-events
Description: Use WP custom types to easily allow event creation and publication.
Version: 0.1
Author: Willington Vega
Author URI: http://wvega.com
License: BSD, MIT, GPL
*/



function debug($var = false, $showHtml = false, $showFrom = true) {
    if ($showFrom) {
        $calledFrom = debug_backtrace();
        echo '<strong>';
        echo substr(str_replace(ROOT, '', $calledFrom[0]['file']), 1);
        echo '</strong>';
        echo ' (line <strong>' . $calledFrom[0]['line'] . '</strong>)';
    }
    echo "\n<pre class=\"cake-debug\">\n";

    $var = print_r($var, true);
    if ($showHtml) {
        $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
    }
    echo $var . "\n</pre>\n";
}


define('WPCE_DIR_NAME', str_replace(basename(__FILE__), '', plugin_basename(__FILE__)));
define('WPCE_URL', WP_PLUGIN_URL. '/' . WPCE_DIR_NAME);
define('WPCE_DIR', WP_PLUGIN_DIR. '/' . WPCE_DIR_NAME);


/**
 * 
 */
function wpce_activate() {}
register_activation_hook(__FILE__, 'wpce_activate');


/**
 * 
 */
function wpce_init() {
    register_post_type('event', array(
        'label' => _x('Events', 'event'),
        'labels' => array(
            'name' => _x('Events', 'event'),
            'singular_name' => _x('Event', 'event'),
            'add_new' => _x('Add Event', 'event'),
            'add_new_item' => _x('Add New Event', 'event'),
            'edit_item' => _x('Edit Event', 'event'),
            'new_item' => _x('New Event', 'event'),
            'view_item' => _x('View Event', 'event'),
            'search_items' => _x('Search Events', 'event'),
            'not_found' => _x('No events found', 'event'),
            'not_found_in_trash' => _x('No events found in trash', 'event')),
        'description' => _x('An Event', 'event'),
        'public' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
        'taxonomies' => array('category', 'post_tag', 'location'),
        'register_meta_box_cb' => 'wpce_meta_box_cb', // see admin.php
        'menu_position' => 5,
    ));

    register_taxonomy('location', 'event', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Locations', 'taxonomy general name'),
            'singular_name' => _x('Location', 'taxonomy singular name'),
            'search_items' =>  __('Search Locations'),
            'all_items' => __('All Locations'),
            'parent_item' => __('Parent Location'),
            'parent_item_colon' => __('Parent Location:'),
            'edit_item' => __('Edit Location'),
            'update_item' => __('Update Location'),
            'add_new_item' => __('Add New Location'),
            'new_item_name' => __('New Location Name'),
          ),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'location')
    ));
        
    flush_rewrite_rules();

    // rename Post Tags taxonmy to Tags, which is more general
    $tags = get_object_vars(get_taxonomy('post_tag'));
    $tags['labels'] = get_object_vars($tags['labels']);
    $tags['cap'] = get_object_vars($tags['cap']);

    $tags['labels']['name'] = _x('Tags', 'taxnomy general name');
    $tags['labels']['singular_name'] = _x('Tag', 'taxnomy singular name');
    $tags['label'] = _x('Tags', 'taxnomy general nlabel');

    register_taxonomy('post_tag', 'post', $tags);
    register_taxonomy_for_object_type('post_tag', 'event');

    // register needed scripts and their css stylesheets
    wp_register_script('jquery-ui-datepicker', WPCE_URL.'js/jquery-ui-1.8.5/jquery-ui-1.8.5.custom.min.js', array('jquery'), '1.8.5', true);
    wp_register_style('jquery-ui-smoothness', WPCE_URL.'js/jquery-ui-1.8.5/smoothness/jquery-ui-1.8.5.custom.css', array(), '1.8.5', 'all');

    wp_register_script('jquery-timepicker', WPCE_URL.'js/jquery-timepicker/jquery.timepicker.js', array('jquery'), '1.0.1', true);
    wp_register_style('jquery-timepicker', WPCE_URL.'js/jquery-timepicker/jquery.timepicker.css', array(), '1.0.1', 'all');

    wp_register_script('wp-custom-events', WPCE_URL.'js/wp-custom-events.js', array('jquery-ui-datepicker', 'jquery-timepicker'), '1.0', true);
    wp_register_style('wp-custom-events', WPCE_URL.'css/wp-custom-events.css', array('jquery-ui-smoothness', 'jquery-timepicker'), '1.0', 'all');
}
add_action('init', 'wpce_init');

include WPCE_DIR . 'functions.php';
include WPCE_DIR . 'admin.php';
include WPCE_DIR . 'template.php';