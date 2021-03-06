<?php

namespace Mvkasatkin\typecast\type;

class TypeInt extends Type
{

    /**
     * @param $value
     *
     * @return int|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (int)$value;
    }
}
