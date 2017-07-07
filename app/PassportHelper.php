<?php

namespace FormHelper;


class PassportHelper extends AbstractFormHelper
{
    public $passport;
    public $language;

    public $pass_srs;
    public $pass_num;

    /**
     * @param $passport
     * @return $this
     */
    public function set($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * @param $language
     * @return $this
     */
    public function setLanguage($language)
    {
        if (in_array($language, ['ru', 'ua'])) {
            $this->language = $language;
        } else {
            $this->language = false;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function explodePassport()
    {
        $pass_length = mb_strlen($this->passport);
        $is_valid_ru = $this->language == 'ru' && $pass_length == 10;
        $is_valid_ua = $this->language == 'ua' && $pass_length == 8;

        if (!($is_valid_ru || $is_valid_ua)) {
            $this->passport = $this->pass_num = $this->pass_srs = false;
            return $this;
        }

        if ($is_valid_ru) {
            if (parent::isInteger($this->passport)) {
                $this->pass_srs = mb_substr($this->passport, 0, 4);
                $this->pass_num = mb_substr($this->passport, 4, 6);
            } else {
                $this->passport = $this->pass_num = $this->pass_srs = false;
            }
        }

        if ($is_valid_ua) {
            $this->pass_srs = mb_substr($this->passport, 0, 2);
            $this->pass_num = mb_substr($this->passport, 2, 6);
            if (!(parent::isText($this->pass_srs) && parent::isInteger($this->pass_num))) {
                $this->passport = $this->pass_num = $this->pass_srs = false;
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassSrc()
    {
        return $this->pass_srs;
    }

    /**
     * @return mixed
     */
    public function getPassNum()
    {
        return $this->pass_num;
    }

    /**
     * @return array
     */
    public function get()
    {
        return ['pass_src' => $this->pass_srs, 'pass_num' => $this->pass_num];
    }
}