<?php

namespace Mvkasatkin\typecast\type;

class TypeBinary extends Type
{

    /**
     * @param string $default
     */
    public function __construct($default = '')
    {
        parent::__construct($default);
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function cast($value): string
    {
        return $value === null ? (binary)$this->default : (binary)$value;
    }
}
