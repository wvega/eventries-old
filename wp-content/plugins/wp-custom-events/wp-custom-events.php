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


if (!function_exists('debug')) {
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
}


define('WPCE_DIR_NAME', str_replace(basename(__FILE__), '', plugin_basename(__FILE__)));
define('WPCE_URL', WP_PLUGIN_URL. '/' . WPCE_DIR_NAME);
define('WPCE_DIR', WP_PLUGIN_DIR. '/' . WPCE_DIR_NAME);


class CustomEventsPlugin {
    public function CustomEventsPlugin() {
        add_action('init', array($this, 'init'));
        add_action('save_post', array($this, 'save'));
    }
    
    function init() {
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
            'register_meta_box_cb' => array($this, 'setup_metabox'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'events'),
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
        wp_register_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', array(), '3', true);
        
        wp_register_script('jquery-ui-datepicker', WPCE_URL.'js/jquery-ui-1.8.5/jquery-ui-1.8.5.custom.min.js', array('jquery'), '1.8.5', true);
        wp_register_style('jquery-ui-smoothness', WPCE_URL.'js/jquery-ui-1.8.5/smoothness/jquery-ui-1.8.5.custom.css', array(), '1.8.5', 'all');
    
        wp_register_script('jquery-timepicker', WPCE_URL.'js/jquery-timepicker/jquery.timepicker.js', array('jquery'), '1.0.1', true);
        wp_register_style('jquery-timepicker', WPCE_URL.'js/jquery-timepicker/jquery.timepicker.css', array(), '1.0.1', 'all');
        
        wp_register_script('jquery-location-picker', WPCE_URL.'js/jquery-location-picker/jquery.location-picker.js', array('jquery', 'google-maps'), '1.0', true);
    
        wp_register_script('wp-custom-events', WPCE_URL.'js/wp-custom-events.js', array('jquery-ui-datepicker', 'jquery-timepicker', 'jquery-location-picker'), '1.0', true);
        wp_register_style('wp-custom-events', WPCE_URL.'css/wp-custom-events.css', array('jquery-ui-smoothness', 'jquery-timepicker'), '1.0', 'all');
        
        wp_enqueue_script('wp-custom-events');
    }
    
    public function save($id) {
        if (!isset($_POST['wpce_nonce']) || !wp_verify_nonce($_POST['wpce_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }
    
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $id;
        }
    
        if ('event' == $_POST['post_type']) {
            if (!current_user_can('edit_post', $id)) {
                return $id;
            }
        } else {
            return $id;
        }
    
        // validate input
        $data = filter_input_array(INPUT_POST, array(
            'wpce_start_date' => FILTER_SANITIZE_STRING,
            'wpce_start_time' => FILTER_SANITIZE_STRING,
            'wpce_end_date' => FILTER_SANITIZE_STRING,
            'wpce_end_time' => FILTER_SANITIZE_STRING,
            'wpce_address' => FILTER_SANITIZE_STRING,
            'wpce_location' => FILTER_SANITIZE_STRING,
            'wpce_url' => FILTER_VALIDATE_URL));
    
        // get validated values
        $start_date = $data['wpce_start_date'];
        $start_time = $data['wpce_start_time'];
        $end_date = $data['wpce_end_date'];
        $end_time = $data['wpce_end_time'];
        $address = $data['wpce_address'];
        $location = $data['wpce_location'];
        $url = $data['wpce_url'];
        
        // generate timestamps
        
        if (strlen($start_date) > 0 && strlen($start_time) > 0) {
            $s = strptime("$start_date $start_time", '%m/%d/%Y %I:%M %p');
        } else if (strlen($start_time) > 0) {
            $start_date = strftime('%m/%d/%Y');
            $s = strptime("$start_date $start_time", '%m/%d/%Y %I:%M %p');
        } else if (strlen($start_date) > 0) {
            $s = strptime($start_date . ' 12:00 AM', '%m/%d/%Y %I:%M %p');
        } else {
            $s = null;
        }
    
        if ($s) {
            $start_timestamp = mktime($s['tm_hour'], $s['tm_min'], $s['tm_sec'], $s['tm_mon'] + 1, $s['tm_mday'], $s['tm_year'] + 1900);
        } else {
            $start_timestamp = null;
        }
    
        if (strlen($end_date) > 0 && strlen($end_time) > 0) {
            $e = strptime("$end_date $end_time", '%m/%d/%Y %I:%M %p');
        } else if (strlen($end_time) > 0) {
            $end_date = strftime('%m/%d/%Y');
            $e = strptime("$end_date $end_time", '%m/%d/%Y %I:%M %p');
        } else if (strlen($end_date) > 0) {
            $e = strptime($end_date . ' 11:59 PM', '%m/%d/%Y %I:%M %p');
        } else {
            $e = false;
        }
    
        if ($e) {
            $end_timestamp = mktime($e['tm_hour'], $e['tm_min'], $e['tm_sec'], $e['tm_mon'] + 1, $e['tm_mday'], $e['tm_year'] + 1900);
        } else {
            $end_timestamp = null;
        }
    
        // save custom fields
        update_post_meta($id, 'start-date', $start_date);
        update_post_meta($id, 'start-time', $start_time);
        update_post_meta($id, 'start-timestamp', $start_timestamp);
        update_post_meta($id, 'end-date', $end_date);
        update_post_meta($id, 'end-time', $end_time);
        update_post_meta($id, 'end-timestamp', $end_timestamp);
        update_post_meta($id, 'address', $address);
        update_post_meta($id, 'location', $location);
        update_post_meta($id, 'url', $url);
        
        //debug($start_date); debug($start_time); debug($start_timestamp); debug(date('Y-m-d H:00')); exit();
    
        return $id;
    }
    
    public function setup_metabox() {
        wp_enqueue_script('wp-custom-events'); wp_enqueue_style('wp-custom-events');
        add_meta_box('wp-custom-events-info', __('Event Information', 'wp-custom-events'), array($this, 'metabox'), 'event', 'normal', 'high');
    }

    public function metabox($post) {
        wp_nonce_field(plugin_basename(__FILE__), 'wpce_nonce');
    
        $start_timestamp = get_post_meta($post->ID, 'start-timestamp', true);
        $end_timestamp = get_post_meta($post->ID, 'end-timestamp', true);
        $address = get_post_meta($post->ID, 'address', true);
        $location = get_post_meta($post->ID, 'location', true);
        $url = get_post_meta($post->ID, 'url', true);
    
    //    $start_date = strlen($start_timestamp) > 0 ? date('m/d/Y', $start_timestamp) : '';
    //    $start_time = strlen($start_timestamp) > 0 ? date('h:i A', $start_timestamp) : '';
    //    $end_date = strlen($start_timestamp) > 0 ? date('m/d/Y', $end_timestamp) : '';
    //    $end_time = strlen($start_timestamp) > 0 ? date('h:i A', $end_timestamp) : '';
        $start_date = get_post_meta($post->ID, 'start-date', true);
        $start_time = get_post_meta($post->ID, 'start-time', true);
        $end_date = get_post_meta($post->ID, 'end-date', true);
        $end_time = get_post_meta($post->ID, 'end-time', true);
    
        echo '<div class="clearfix">';
    
        echo '<div class="wpce-column">';
        echo '<label class="wpce-centered">'. __('Start Date/Time', 'wp-events') .'</label>';
        echo '<ul class="wp-events-form-fields"><li>';
        echo '<label for="wp-events-start-time">'. __('Time', 'wp-events') .' </label>';
        echo '<input id="wp-events-start-time" tabindex="1000" name="wpce_start_time" type="text" value="' . $start_time .'" />';
        echo '</li><li>';
        echo '<label for="wp-events-start-date">'. __('Date', 'wp-events') .' </label>';
        echo '<input id="wp-events-start-date" name="wpce_start_date" type="text" value="' . $start_date .'" />';
        echo '</li></ul>';
        echo '</div>';
    
        echo '<div class="wpce-column">';
        echo '<label class="wpce-centered">'. __('End Date/Time', 'wp-events') .'</label>';
        echo '<ul class="wp-events-form-fields"><li>';
        echo '<label for="wp-events-end-time">'. __('Time', 'wp-events') .' </label>';
        echo '<input id="wp-events-end-time" tabindex="1001" name="wpce_end_time" type="text" value="' . $end_time .'" />';
        echo '</li><li>';
        echo '<label for="wp-events-end-date">'. __('Date', 'wp-events') .' </label>';
        echo '<input id="wp-events-end-date" name="wpce_end_date" type="text" value="' . $end_date .'" />';
        echo '</li></ul>';
        echo '</div>';
        
        echo '<div class="wpce-column wpce-double-column">';
        echo '<label class="wpce-centered" for="wp-events-map">'. __('Map', 'wp-events') .' </label>';
        echo '<input id="wp-events-location" tabindex="1002" id="wp-events-location" name="wpce_location" type="text" value="'. $location . '" />';
        echo '</div>';
    
        echo '<div class="wpce-column wpce-double-column">';
        echo '<label class="wpce-centered" for="wp-events-address">'. __('Address', 'wp-events') .' </label>';
        echo '<textarea class="wpce-textarea" tabindex="1003" id="wp-events-address" name="wpce_address"/>' . $address . '</textarea>';
        echo '</div>';
    
        echo '<div class="wpce-column wpce-double-column">';
        echo '<label class="wpce-centered" for="wp-events-url">'. __('URL', 'wp-events') .' </label>';
        echo '<input class="wpce-urlfield" tabindex="1004" id="wp-events-url" name="wpce_url" type="text" value="'. $url .'" />';
        echo '</div>';
    
        echo '</div>';
    }
}

$plugin = new CustomEventsPlugin();

include WPCE_DIR . 'event.php';