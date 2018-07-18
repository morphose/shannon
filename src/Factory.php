<?php

namespace Morphose;

/**
 * Class Factory
 * @package Morphose
 */
class Factory
{
    /**
     * @const int
     */
    const SCALE_BINARY = 1024;
    /**
     * @const int
     */
    const SCALE_DECIMAL = 1000;

    /**
     * @var int
     */
    protected $bytes = 0;

    /**
     * @var int
     */
    protected $scale;

    /**
     * @var array
     */
    protected static $prefixes = [
        self::SCALE_BINARY => [
            'Kibi',
            'Mebi',
            'Gibi',
            'Tebi',
            'Pebi',
            'Exbi',
        ],
        self::SCALE_DECIMAL => [
            'Kilo',
            'Mega',
            'Giga',
            'Tera',
            'Peta',
            'Exa',
            'Zetta',
            'Yotta',
        ]
    ];

    /**
     * @var string
     */
    protected static $sulfix = 'Byte';

    /**
     * @param int $bytes
     * @param int $scale
     */
    public function __construct($bytes, $scale = self::SCALE_DECIMAL)
    {
        $this->bytes($bytes);
        $this->scale($scale);
    }

    /**
     * @param string $unit
     * @return string
     */
    protected function abbreviate($unit)
    {
        $pattern = '/^(.)?.*' . static::$sulfix . '/i';
        $replacement = '$1';

        if ($this->scale === static::SCALE_BINARY) {
            $replacement .= 'i';
        }

        return preg_replace($pattern, $replacement . static::$sulfix[0], $unit);
    }

    /**
     * @param int $bytes
     * @return int
     */
    public function bytes($bytes = null)
    {
        if ($bytes) {
            $this->bytes = $bytes;
        }

        return $this->bytes;
    }

    /**
     * @param bool $abbreviate
     * @return string
     */
    public function humanize($abbreviate = true)
    {
        $prefix = '';
        $prefixes = static::$prefixes[$this->scale];
        $size = $this->bytes;

        while ($size >= $this->scale && $prefix = current($prefixes)) {
            $size /= $this->scale;

            next($prefixes);
        }

        $size = round($size, 2);
        $unit = $this->standardize($prefix);

        if ($abbreviate) {
            $unit = $this->abbreviate($unit);
        } else {
            $unit = $this->plural($unit, $size);
        }

        return join(' ', [$size, $unit]);
    }

    /**
     * @param string $unit
     * @param int $size
     * @return string
     */
    protected function plural($unit, $size)
    {
        if ($size > 1) {
            $unit .= 's';
        }

        return $unit;
    }

    /**
     * @param int $scale = null
     * @return int
     */
    public function scale($scale = null)
    {
        if ($scale) {
            $this->scale = array_key_exists($scale, static::$prefixes) ? $scale : self::SCALE_DECIMAL;
        }

        return $this->scale;
    }

    /**
     * @param string $prefix
     * @return string
     */
    protected function standardize($prefix)
    {
        return ucfirst($prefix . strtolower(static::$sulfix));
    }
}
