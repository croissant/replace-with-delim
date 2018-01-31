<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Module\StringTemplate;

class TempTest extends TestCase
{
    public function testOutput()
    {
        $result = StringTemplate::output('a{{b}}c', ['b' => '1234567890']);

        $this->assertEquals('a1234567890c', $result);

        $this->assertEquals('axxxxxxxa', StringTemplate::output('a%%abcdefg%%a', ['abcdefg' => 'xxxxxxx'], '%%'));
    }
}