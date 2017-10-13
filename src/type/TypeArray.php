<?php

namespace Mvkasatkin\typecast\type;

class TypeArray extends Type
{

    /**
     * @param array $default
     */
    public function __construct($default = [])
    {
        parent::__construct($default);
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function cast($value): array
    {
        return $value === null ? (array)$this->default : (array)$value;
    }
}
