<?php

namespace Mvkasatkin\typecast\type;

class TypeString extends Type
{

    /**
     * @param $value
     *
     * @return string|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (string)$value;
    }
}
