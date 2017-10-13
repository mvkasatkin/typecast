<?php

namespace Mvkasatkin\typecast\type;

class TypeUnset extends Type
{

    /**
     * @param $value
     *
     * @return mixed
     */
    public function cast($value)
    {
        return (unset)$value;
    }
}
