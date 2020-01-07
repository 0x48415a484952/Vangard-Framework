<?php

namespace Septillion\Classes;



class Helper
{
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }

    public static function removeTrailingSlash($url)
    {
     return rtrim($url, '/');
    }
}