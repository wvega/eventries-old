<?php

global $wpce_event;

function get_event_meta($key) {
    global $wpce_event; $id = get_the_ID();

    if ($wpce_event == null || $wpce_event['id'] != $id) {
        $wpce_event = array(
            'id' => $id,
            'start-date' => get_post_meta($id, 'start-date', true),
            'start-time' => get_post_meta($id, 'start-time', true),
            'start-timestamp' => get_post_meta($id, 'start-timestamp', true),
            'end-date' => get_post_meta($id, 'end-date', true),
            'end-time' => get_post_meta($id, 'end-time', true),
            'end-timestamp' => get_post_meta($id, 'end-timestamp', true),
            'address' => get_post_meta($id, 'address', true),
            'url' => get_post_meta($id, 'url', true)
        );
    }

    if (!empty($key) && isset($wpce_event[$key])) {
        return $wpce_event[$key];
    } else {
        return $wpce_event;
    }
}

function the_start_date() {
    if (strlen(get_event_meta('start-date'))) {
        echo wpce_format_date(get_event_meta('start-timestamp'));
    } else {
        echo '';
    }
}

function the_end_date() {
    if (strlen(get_event_meta('end-date'))) {
        echo wpce_format_date(get_event_meta('end-timestamp'));
    } else {
        echo '';
    }
}

function the_start_time() {
    if (strlen(get_event_meta('start-time'))) {
        echo wpce_format_time(get_event_meta('start-timestamp'));
    } else {
        echo '';
    }
}

function the_end_time() {
    if (strlen(get_event_meta('end-time'))) {
        echo wpce_format_time(get_event_meta('end-timestamp'));
    } else {
        echo '';
    }
}

function the_address() {
    echo nl2br(get_event_meta('address'));
}

function the_url() {
    echo get_event_meta('url');
}

function is_one_day_event() {
    return wpce_format_date(get_event_meta('start-timestamp')) == wpce_format_date(get_event_meta('end-timestamp'));
}