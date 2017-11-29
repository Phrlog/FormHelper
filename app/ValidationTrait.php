<?php
namespace phrlog\FormHelper;

/**
 * Class ValidationTrait
 * @package FormHelper
 */
trait ValidationTrait
{
    /**
     * @param $word
     * @return bool
     */
    public static function isCyrillic($word)
    {
        return (bool) preg_match("/[\p{Cyrillic}]/ui", $word);
    }

    /**
     * @param $word
     * @return bool
     */
    public static function isLatin($word)
    {
        return (bool) preg_match("/[\p{Latin}]/ui", $word);
    }

    /**
     * @param $word
     * @return bool
     */
    public static function isText($word)
    {
        return (bool) preg_match("/(\p{Latin}+|[\p{Cyrillic}]+)$/u", $word);
    }

    /**
     * @param $digit
     * @return bool
     */
    public static function isInteger($digit)
    {
        return (bool) preg_match("/^\d+$/", $digit);
    }
}