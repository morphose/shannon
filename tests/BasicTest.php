<?php

namespace Tests;

/**
 * Class BasicTest
 * @package Tests
 */
class BasicTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanHumanizeAbbreviatedUnits()
    {
        /**
         * Singular
         */
        $this->assertSame('1 B', humanize(1e0));
        $this->assertSame('1 KB', humanize(1e3));
        $this->assertSame('1 MB', humanize(1e6));
        $this->assertSame('1 GB', humanize(1e9));
        $this->assertSame('1 TB', humanize(1e12));
        $this->assertSame('1 PB', humanize(1e15));
        $this->assertSame('1 EB', humanize(1e18));
        $this->assertSame('1 ZB', humanize(1e21));
        $this->assertSame('1 YB', humanize(1e24));

        /**
         * Plural
         */
        $this->assertSame('2 B', humanize(2e0));
        $this->assertSame('2 KB', humanize(2e3));
        $this->assertSame('2 MB', humanize(2e6));
        $this->assertSame('2 GB', humanize(2e9));
        $this->assertSame('2 TB', humanize(2e12));
        $this->assertSame('2 PB', humanize(2e15));
        $this->assertSame('2 EB', humanize(2e18));
        $this->assertSame('2 ZB', humanize(2e21));
        $this->assertSame('2 YB', humanize(2e24));
    }

    /**
     * @return void
     */
    public function testCanHumanizeFullUnits()
    {
        /**
         * Singular
         */
        $this->assertSame('1 Byte', humanize(1e0, false));
        $this->assertSame('1 Kilobyte', humanize(1e3, false));
        $this->assertSame('1 Megabyte', humanize(1e6, false));
        $this->assertSame('1 Gigabyte', humanize(1e9, false));
        $this->assertSame('1 Terabyte', humanize(1e12, false));
        $this->assertSame('1 Petabyte', humanize(1e15, false));
        $this->assertSame('1 Exabyte', humanize(1e18, false));
        $this->assertSame('1 Zettabyte', humanize(1e21, false));
        $this->assertSame('1 Yottabyte', humanize(1e24, false));

        /**
         * Plural
         */
        $this->assertSame('2 Bytes', humanize(2e0, false));
        $this->assertSame('2 Kilobytes', humanize(2e3, false));
        $this->assertSame('2 Megabytes', humanize(2e6, false));
        $this->assertSame('2 Gigabytes', humanize(2e9, false));
        $this->assertSame('2 Terabytes', humanize(2e12, false));
        $this->assertSame('2 Petabytes', humanize(2e15, false));
        $this->assertSame('2 Exabytes', humanize(2e18, false));
        $this->assertSame('2 Zettabytes', humanize(2e21, false));
        $this->assertSame('2 Yottabytes', humanize(2e24, false));
    }

    /**
     * @return void
     */
    public function testCanHumanizeFloats()
    {
        /**
         * Bytes
         */
        $this->assertStringStartsWith('0.1', humanize(.1));
        $this->assertStringStartsWith('1.1', humanize(1.1));
        $this->assertStringStartsWith('11.1', humanize(11.1));
        $this->assertStringStartsWith('111.1', humanize(111.1));

        /**
         * Kilobytes
         */
        $this->assertStringStartsWith('1.11', humanize(1111.1));
        $this->assertStringStartsWith('11.11', humanize(11111.1));
        $this->assertStringStartsWith('111.11', humanize(111111.1));

        /**
         * Megabytes
         */
        $this->assertStringStartsWith('1.11', humanize(1111111.1));
        $this->assertStringStartsWith('11.11', humanize(11111111.1));
        $this->assertStringStartsWith('111.11', humanize(111111111.1));
    }

    /**
     * @return void
     */
    public function testCanHumanizeAndRound()
    {
        /**
         * Floats
         */
        $this->assertStringStartsWith('0.33', humanize(0.333));
        $this->assertStringStartsWith('0.78', humanize(0.777));

        /**
         * Integers
         */
        $this->assertStringStartsWith('3.33', humanize(3333));
        $this->assertStringStartsWith('7.78', humanize(7777));
    }
}
