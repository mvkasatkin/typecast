<?php

namespace Mvkasatkin\typecast\type;

class TypeObject extends Type
{

    /**
     * @param $default
     */
    public function __construct($default = null)
    {
        parent::__construct($default ?? new \stdClass());
    }

    /**
     * @param $value
     *
     * @return \stdClass
     */
    public function cast($value): \stdClass
    {
        return $value === null ? (object)$this->default : (object)$value;
    }
}
