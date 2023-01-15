<?php

class Time
{
    public static function get(string $time = null, string $timeFormat = 'Y-m-d H:i:s'): string {
        $time = $time ?? date('Y-m-d H:i:s');
        return date($timeFormat, strtotime($time));
    }
}