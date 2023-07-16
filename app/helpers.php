<?php

if (!function_exists('getYoutubeId')) {
    function getYoutubeId($url)
    {
        $result = preg_split('/(vi\\/|v=|\\/v\\/|youtu\\.be\\/|\\/embed\\/)/', $url);

        return null !== $result[1] ? preg_split('/[^0-9a-z_-]/i', $result[1])[0] : $result[0];
    }
}
