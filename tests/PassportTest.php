<?php

namespace FormHelper\tests;

use FormHelper\PassportHelper;


/**
 * Class FullNameTest
 *
 * @package FormHelper\tests
 */
class PassportTest extends \PHPUnit_Framework_TestCase
{
    public $helper;

    public function __construct($name = NULL, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->helper = new PassportHelper();
    }

    public function testRuPassport()
    {
        $passport = '1234198689';

        $this->assertEquals(
            1234, $this->helper->set($passport)
            ->setLanguage('ru')
            ->explodePassport()
            ->getPassSrc()
        );

        $this->assertEquals(
            198689, $this->helper->set($passport)
            ->setLanguage('ru')
            ->explodePassport()
            ->getPassNum()
        );

        $this->assertEquals(
            ['pass_src' => 1234, 'pass_num' => 198689],
            $this->helper->set($passport)
            ->setLanguage('ru')
            ->explodePassport()
            ->get()
        );
    }

    public function testRuPassportError()
    {
        $passport = '123419869';

        $this->assertFalse(
            $this->helper->set($passport)
            ->setLanguage('ru')
            ->explodePassport()
            ->getPassSrc()
        );
    }

    public function testUaPassport()
    {
        $passport = 'АК654321';

        $this->assertEquals(
            'АК', $this->helper->set($passport)
            ->setLanguage('ua')
            ->explodePassport()
            ->getPassSrc()
        );

        $this->assertEquals(
            654321, $this->helper->set($passport)
            ->setLanguage('ua')
            ->explodePassport()
            ->getPassNum()
        );

        $this->assertEquals(
            ['pass_src' => 'АК', 'pass_num' => 654321],
            $this->helper->set($passport)
                ->setLanguage('ua')
                ->explodePassport()
                ->get()
        );
    }

    public function testUaPassportError()
    {
        $passport = 'А1654321';

        $this->assertFalse(
            $this->helper->set($passport)
                ->setLanguage('ua')
                ->explodePassport()
                ->getPassSrc()
        );
    }
}