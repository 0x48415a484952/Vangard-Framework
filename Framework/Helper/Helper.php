<?php

declare(strict_types=1);

if (!function_exists('d')) {
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}

if (!function_exists('removeTrailingSlash')) {
    function removeTrailingSlash(string $url): string
    {
        return rtrim($url, '/');
    }
}
