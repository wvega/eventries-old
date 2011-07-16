<?php

function wpce_admin_init() {
    add_action('save_post', 'wpce_save_post');
}
add_action('admin_init', 'wpce_admin_init');


function wpce_save_post($id) {

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
        'wpce_url' => FILTER_VALIDATE_URL));

    // get validated values
    $start_date = $data['wpce_start_date'];
    $start_time = $data['wpce_start_time'];
    $end_date = $data['wpce_end_date'];
    $end_time = $data['wpce_end_time'];
    $location = $data['wpce_address'];
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
    update_post_meta($id, 'address', $location);
    update_post_meta($id, 'url', $url);

    return $id;
}


function wpce_meta_box_cb() {
    wp_enqueue_script('wp-custom-events'); wp_enqueue_style('wp-custom-events');
    add_meta_box('wp-custom-events-info', __('Event Information', 'wp-custom-events'), 'wpce_meta_box_event_info', 'event', 'normal', 'high');
}


function wpce_meta_box_event_info($post) {
    wp_nonce_field(plugin_basename(__FILE__), 'wpce_nonce');

    $start_timestamp = get_post_meta($post->ID, 'start-timestamp', true);
    $end_timestamp = get_post_meta($post->ID, 'end-timestamp', true);
    $address = get_post_meta($post->ID, 'address', true);
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
    echo '<input id="wp-events-location" tabindex="1002" id="wp-events-location" name="wpce_location" type="text" value="'. '$location' .'" />';
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