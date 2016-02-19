<?php
namespace Captions\Helper;

class Helper
{
    public static function make_time($hours, $minutes, $seconds, $milliseconds)
    {
        $time = (float)$seconds;

        $time += (float)$milliseconds / 1000;

        $time += 60 * (int)$minutes;

        $time += 60 * 60 * (int)$hours;

        $time || $time = (float)0;

        return $time;
    }
}