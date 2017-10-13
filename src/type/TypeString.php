<?php

namespace Mvkasatkin\typecast\type;

class TypeString extends Type
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
        return $value === null ? (string)$this->default : (string)$value;
    }
}
