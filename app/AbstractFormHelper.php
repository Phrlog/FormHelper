<?php

namespace phrlog\FormHelper;

/**
 * Class AbstractFormHelper
 * @package FormHelper
 */
abstract class AbstractFormHelper
{
    /**
     * @param $data
     * @return $this
     */
    abstract public function set($data);

    /**
     * @return mixed
     */
    abstract public function get();
}