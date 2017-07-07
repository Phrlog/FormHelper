<?php

namespace FormHelper\tests;

use FormHelper\PhoneHelper;


/**
 * Class FullNameTest
 *
 * @package FormHelper\tests
 */
class PhoneTest extends \PHPUnit_Framework_TestCase
{
    public $helper;

    public function __construct($name = NULL, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->helper = new PhoneHelper();
    }

    public function testRuPhone()
    {
        $phone = '+7(986)-123-21-42';
        $this->assertEquals(
            '9861232142', $this->helper->set($phone)
            ->removePhoneSpecifications()
            ->formatPhoneLength(10)
            ->get()
        );

        $phone = '8(986)-123-21-42';
        $this->assertEquals(
            '89861232142', $this->helper->set($phone)
            ->removePhoneSpecifications()
            ->formatPhoneLength(11)
            ->get()
        );
    }

    public function testUaPhone()
    {
        $phone = '380-462-616-1 11';
        $this->assertEquals(
            '380462616111', $this->helper->set($phone)
            ->removePhoneSpecifications()
            ->formatPhoneLength(12)
            ->get()
        );

        $phone = '+(380)462-616-111';
        $this->assertEquals(
            '380462616111', $this->helper->set($phone)
            ->removePhoneSpecifications()
            ->formatPhoneLength(12)
            ->get()
        );
    }

}