<?php
namespace FormHelper;

/**
 * Class PhoneHelper
 * @package FormHelper
 */
class PhoneHelper extends AbstractFormHelper
{
    private $phone;

    /**
     * @param $phone
     * @return $this
     */
    public function set($phone)
    {
        $this->phone = (string) $phone;

        return $this;
    }

    /**
     * @return $this
     */
    public function removePhoneSpecifications()
    {
        $trans = ['(' => '', ')' => '', '-' => '', '+' => '', ' '  => ''];
        $this->phone = strtr($this->phone, $trans);

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function formatPhoneLength($length = 10)
    {
        $phone_length = strlen($this->phone);
        $phone_diff = $phone_length - $length;

        if ($phone_diff == 1) {
            $this->phone = mb_substr($this->phone, 1);
        } elseif ($phone_diff !== 0) {
            $this->phone = false;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->phone;
    }

}
