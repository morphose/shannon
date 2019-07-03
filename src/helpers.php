<?php

use Morphose\Shannon\Factory as Shannon;

if (!function_exists('humanize')) {
    /**
     * @param int $bytes
     * @param bool $abbreviate
     * @return string
     */
    function humanize($bytes, $abbreviate = true)
    {
        return shannon($bytes)->humanize($abbreviate);
    }
}

if (!function_exists('shannon')) {
    /**
     * @param int $bytes
     * @return Shannon
     */
    function shannon($bytes)
    {
        return new Shannon($bytes);
    }
}
