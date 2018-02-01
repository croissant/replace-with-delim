<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Croissant\StringTemplate;

class StringTemplateTest extends TestCase
{
    public function testOutput()
    {
        $this->assertEquals('a1234567890c', StringTemplate::output('a{{b}}c', ['b' => '1234567890']));
        $this->assertEquals('a1234567890c', StringTemplate::output('a{{  b }}c', ['b' => '1234567890']));
        $this->assertEquals('axxxxxxxa', StringTemplate::output('a%%abcdefg%%a', ['abcdefg' => 'xxxxxxx'], '%%'));
    }
}