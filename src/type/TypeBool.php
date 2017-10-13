<?php

namespace Mvkasatkin\typecast\type;

class TypeBool extends Type
{

    /**
     * @param bool $default
     */
    public function __construct($default = false)
    {
        parent::__construct($default);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function cast($value): bool
    {
        return $value === null ? (bool)$this->default : (bool)$value;
    }
}
