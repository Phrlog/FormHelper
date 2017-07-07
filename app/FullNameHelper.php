<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 07.07.17
 * Time: 14:59
 */

namespace FormHelper;


class FullNameHelper extends AbstractFormHelper
{
    private $full_name;
    private $first;
    private $second;
    private $middle;

    public function set($full_name)
    {
        $this->full_name = $full_name;
        return $this;
    }

    public function isCyrillic($word = null)
    {
        if (!parent::isCyrillic($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    public function isLatin($word = null)
    {
        if (!parent::isLatin($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    public function isText($word = null)
    {
        if (!parent::isText($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    public function explodeName()
    {
        $name = explode(' ', $this->full_name);
        $count_name = count($name);

        if ($count_name == 3) {
            $this->first = $name[0];
            $this->second = $name[1];
            $this->middle = $name[2];
        } elseif ($count_name == 2) {
            $this->first = $name[0];
            $this->second = $name[1];
            $this->middle = false;
        } else {
            $this->first = $this->second = $this->middle = false;
        }

        return $this;
    }

    public function getFirstName()
    {
        return $this->first;
    }

    public function getSecondName()
    {
        return $this->second;
    }

    public function getMiddleName()
    {
        return $this->middle;
    }

    public function get()
    {
        return ['first' => $this->first, 'second' => $this->second, 'middle' => $this->middle];
    }
}