<?php

namespace Mvkasatkin\typecast\type;

class TypeFloat extends Type
{

    /**
     * @param $value
     *
     * @return float|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (float)$value;
    }
}
