<?php

namespace Mvkasatkin\typecast\type;

class TypeBool extends Type
{

    /**
     * @param $value
     *
     * @return bool|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (bool)$value;
    }
}
