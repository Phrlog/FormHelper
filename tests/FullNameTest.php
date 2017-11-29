<?php

namespace phrlog\FormHelper\tests;

use phrlog\FormHelper\FullNameHelper;


/**
 * Class FullNameTest
 *
 * @package FormHelper\tests
 */
class FullNameTest extends \PHPUnit_Framework_TestCase
{
    public $helper;

    public function __construct($name = NULL, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->helper = new FullNameHelper();
    }

    public function testCyrillicName()
    {
        $name = 'Имя Фамилия Отчество';

        $this->assertEquals(
            'Имя', $this->helper->set($name)
            ->isCyrillic()
            ->explodeName()
            ->getFirstName()
        );

        $this->assertEquals(
            'Фамилия', $this->helper->set($name)
            ->isCyrillic()
            ->explodeName()
            ->getSecondName()
        );

        $this->assertEquals(
            'Отчество', $this->helper->set($name)
            ->isCyrillic()
            ->explodeName()
            ->getMiddleName()
        );

        $this->assertEquals(
            ['first' => 'Имя', 'second' => 'Фамилия', 'middle' => 'Отчество'],
            $this->helper->set($name)
                ->isCyrillic()
                ->explodeName()
                ->get()
        );

    }

    public function testWrongCyrillicName()
    {
        $name = 'John Smith';

        $this->assertFalse(
            $this->helper->set($name)
            ->isCyrillic()
            ->explodeName()
            ->getFirstName()
        );
    }

    public function testLatinName()
    {
        $name = 'John Smith';

        $this->assertEquals('John',
            $this->helper->set($name)
                ->isLatin()
                ->explodeName()
                ->getFirstName()
        );

        $this->assertEquals('Smith',
            $this->helper->set($name)
                ->isLatin()
                ->explodeName()
                ->getSecondName()
        );

        $this->assertFalse(
            $this->helper->set($name)
                ->isLatin()
                ->explodeName()
                ->getMiddleName()
        );

        $this->assertEquals(
            ['first' => 'John', 'second' => 'Smith', 'middle' => false],
            $this->helper->set($name)
                ->isLatin()
                ->explodeName()
                ->get()
        );
    }

    public function testWrongLatinName()
    {
        $name = 'Вася Пупкин';

        $this->assertFalse(
            $this->helper->set($name)
                ->isLatin()
                ->explodeName()
                ->getFirstName()
        );
    }

    public function testTextName()
    {
        $name = 'Имя Smith Отчество';

        $this->assertEquals(
            'Имя', $this->helper->set($name)
            ->isText()
            ->explodeName()
            ->getFirstName()
        );

        $this->assertEquals(
            'Smith', $this->helper->set($name)
            ->isText()
            ->explodeName()
            ->getSecondName()
        );

        $this->assertEquals(
            'Отчество', $this->helper->set($name)
            ->isText()
            ->explodeName()
            ->getMiddleName()
        );
    }

    public function testWrongTextName()
    {
        $name = 'Вася Пупкин1';

        $this->assertFalse(
            $this->helper->set($name)
                ->isText()
                ->explodeName()
                ->getFirstName()
        );
    }
}