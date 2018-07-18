<?php

use Morphose\Factory as Morphose;

if (!function_exists('humanize')) {
    /**
     * @param int $bytes
     * @param bool $abbreviate
     * @return string
     */
    function humanize($bytes, $abbreviate = true)
    {
        return (new Morphose($bytes))->humanize($abbreviate);
    }
}
