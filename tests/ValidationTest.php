<?php

namespace FormHelper\tests;

use FormHelper\ValidationTrait;

/**
 * Class ValidationTest
 *
 * @package FormHelper\tests
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{
    use ValidationTrait;

    public function testIsCyrillic()
    {
        $this->assertFalse($this->isCyrillic('Hello'));
        $this->assertTrue($this->isCyrillic('Привет'));
    }

    public function testIsLatin()
    {
        $this->assertTrue($this->isLatin('Hello'));
        $this->assertFalse($this->isLatin('Привет'));
    }

    public function testIsText()
    {
        $this->assertTrue($this->isText('HelloПривет'));
        $this->assertFalse($this->isText('Привет1'));
    }

    public function testIsInteger()
    {
        $this->assertTrue($this->isInteger('98761'));
        $this->assertFalse($this->isInteger('987)3'));
    }

}