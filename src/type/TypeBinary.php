<?php

namespace Mvkasatkin\typecast\type;

class TypeBinary extends Type
{

    /**
     * @param $value
     *
     * @return string|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (binary)$value;
    }
}
