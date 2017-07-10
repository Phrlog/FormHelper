<?php

namespace FormHelper;

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
    public abstract function set($data);

    /**
     * @return mixed
     */
    public abstract function get();
}