<?php

namespace Mvkasatkin\typecast\type;

class TypeObject extends Type
{

    /**
     * @param $value
     *
     * @return \stdClass|null
     */
    public function cast($value)
    {
        return $value === null ? $this->default : (object)$value;
    }
}
