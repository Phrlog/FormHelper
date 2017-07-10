<?php
namespace FormHelper;

/**
 * Class FullNameHelper
 * @package FormHelper
 */
class FullNameHelper extends AbstractFormHelper
{
    use ValidationTrait;

    private $full_name;
    private $first;
    private $second;
    private $middle;

    /**
     * @param $full_name
     * @return $this
     */
    public function set($full_name)
    {
        $this->full_name = $full_name;
        return $this;
    }

    /**
     * @return $this
     */
    public function isCyrillic()
    {
        if (!ValidationTrait::isCyrillic($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function isLatin()
    {
        if (!ValidationTrait::isLatin($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function isText()
    {
        if (!ValidationTrait::isText($this->full_name)) {
            $this->full_name = false;
        }
        return $this;
    }

    /**
     * @return $this
     */
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

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first;
    }

    /**
     * @return string
     */
    public function getSecondName()
    {
        return $this->second;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middle;
    }

    /**
     * @return array
     */
    public function get()
    {
        return ['first' => $this->first, 'second' => $this->second, 'middle' => $this->middle];
    }
}