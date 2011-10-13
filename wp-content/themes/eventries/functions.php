<?php 

function __init__() {
    register_nav_menu('primary', __('Menu Principal', 'eventries'));
}
add_action('init', '__init__');

/**
 * Find up to five (by default) closest events that are going to happen in the 
 * near future. All events happening today
 */
function upcoming_events($count=5) {
    $timestamp = strtotime(date('Y-m-d H:00', current_time('timestamp')));
    $query = new WP_Query(array(
        'post_type' => 'event',
        'post_per_page' => $count,
        'order' => 'ASC',
        'orderby' => 'meta_value_num',
        'meta_key' => 'start-timestamp',
        'meta_value' => $timestamp,
        'meta_compare' => '>='
    ));
    
    return $query;
}

/**
 * Find events that start before the end of the day and end after the start of 
 * the current day. Events happening today.
 */
function todays_events($count=5) {
    $timestamp = current_time('timestamp');
    $query = new WP_Query(array(
        'post_type' => 'event',
        'post_per_page' => $count,
        'order' => 'ASC',
        'orderby' => 'meta_value_num',
        'meta_key' => 'start-timestamp',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'start-timestamp',
                'value' => strtotime(date('Y-m-d 23:59:59', $timestamp)),
                'compare' => '<='
            ),
            array(
                'key' => 'end-timestamp',
                'value' => strtotime(date('Y-m-d 00:00:00', $timestamp)),
                'compare' => '>='
            )
        )
    ));
    return $query;
}
