<?php

function wpce_format_date($timestamp) {
    return strftime('%Y-%m-%d', $timestamp);
}

function wpce_format_time($timestamp) {
    return strftime('%H:%M %p', $timestamp);
}