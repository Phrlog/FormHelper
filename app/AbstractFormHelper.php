<?php

namespace FormHelper;

abstract class AbstractFormHelper
{
    public abstract function set($data);
    public abstract function get();

    public function isCyrillic($word)
    {
        return (bool) preg_match("/[\p{Cyrillic}]/ui", $word);
    }

    public function isLatin($word)
    {
        return (bool) preg_match("/[\p{Latin}]/ui", $word);
    }

    public function isText($word)
    {
        return (bool) preg_match("/(\p{Latin}+|[\p{Cyrillic}]+)$/u", $word);
    }

    public function isInteger($digit)
    {
        return preg_match("/^\d+$/", $digit);
    }
}