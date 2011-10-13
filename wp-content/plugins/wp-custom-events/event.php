<?php

class Event {
    public function Event($id) {
        $this->start_timestamp = get_post_meta($id, 'start-timestamp', true);
        $this->start_date = get_post_meta($id, 'start-date', true);
        if (strlen($this->start_date)) {
            $this->start_date = $this->date($this->start_timestamp);
        }
        $this->start_time = get_post_meta($id, 'start-time', true);
        if (strlen($this->start_time)) {
            $this->start_time = $this->time($this->start_timestamp);
        }
        
        $this->end_timestamp = get_post_meta($id, 'end-timestamp', true);
        $this->end_date = get_post_meta($id, 'end-date', true);
        if (strlen($this->end_date)) {
            $this->end_date = $this->date($this->end_timestamp);
        }
        $this->end_time = get_post_meta($id, 'end-time', true);
        if (strlen($this->end_time)) {
            $this->end_time = $this->time($this->end_timestamp);
        }
        
        $this->address = nl2br(get_post_meta($id, 'address', true));
        $this->url = get_post_meta($id, 'url', true);
        
        $this->location = get_post_meta($id, 'location', true);
    }
    
    private function date($timestamp) {
        return strftime('%Y-%m-%d', $timestamp);
    }
    
    private function time($timestamp) {
        return strftime('%H:%M %p', $timestamp);
    }
    
    function is_one_day_event() {
        return $this->date($this->start_timestamp) == $this->date($this->end_timestamp);
    }
}