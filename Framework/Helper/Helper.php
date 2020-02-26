<?php

namespace Septillion\Framework\Helper;

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