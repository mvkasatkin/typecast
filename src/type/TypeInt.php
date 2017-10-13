<?php

namespace Mvkasatkin\typecast\type;

class TypeInt extends Type
{

    /**
     * @param int $default
     */
    public function __construct($default = 0)
    {
        parent::__construct($default);
    }

    /**
     * @param $value
     *
     * @return int
     */
    public function cast($value): int
    {
        return $value === null ? (int)$this->default : (int)$value;
    }
}
