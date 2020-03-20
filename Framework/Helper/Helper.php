<?php

declare(strict_types=1);

namespace Septillion\Framework\Helper;

class Helper
{
    // public static function endsWith($haystack, $needle)
    // {
    //     $length = strlen($needle);
    //     if ($length == 0) {
    //         return true;
    //     }
    //     return (substr($haystack, -$length) === $needle);
    // }

    public static function removeTrailingSlash(string $url) : string
    {
        return rtrim($url, '/');
    }
}