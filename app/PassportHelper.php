<?php

namespace FormHelper;

/**
 * Class PassportHelper
 * @package FormHelper
 */
class PassportHelper extends AbstractFormHelper
{
    use ValidationTrait;

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
        mb_internal_encoding("UTF-8");

        $pass_length = mb_strlen($this->passport);
        $is_valid_ru = $this->language == 'ru' && $pass_length == 10 && $this->isInteger($this->passport);
        $is_valid_ua = $this->language == 'ua' && $pass_length == 8;

        if ($is_valid_ru) {
            return $this->explodeRuPassport();
        } elseif ($is_valid_ua) {
            return $this->explodeUaPassport();
        }

        $this->passport = $this->pass_num = $this->pass_srs = false;

        return $this;
    }

    /**
     * Explode ru passport
     *
     * @return $this
     */
    protected function explodeRuPassport()
    {
        $this->pass_srs = mb_substr($this->passport, 0, 4);
        $this->pass_num = mb_substr($this->passport, 4, 6);

        return $this;
    }

    /**
     * Explode ua passport
     *
     * @return $this
     */
    protected function explodeUaPassport()
    {
        $this->pass_srs = mb_substr($this->passport, 0, 2);
        $this->pass_num = mb_substr($this->passport, 2, 6);
        if (!($this->isText($this->pass_srs) && $this->isInteger($this->pass_num))) {
            $this->passport = $this->pass_num = $this->pass_srs = false;
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