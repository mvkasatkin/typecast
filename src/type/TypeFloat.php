<?php

namespace Mvkasatkin\typecast\type;

class TypeFloat extends Type
{

    /**
     * @param float $default
     */
    public function __construct($default = 0.0)
    {
        parent::__construct($default);
    }

    /**
     * @param $value
     *
     * @return float
     */
    public function cast($value): float
    {
        return $value === null ? (float)$this->default : (float)$value;
    }
}
