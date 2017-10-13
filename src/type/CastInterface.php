<?php

namespace Mvkasatkin\typecast\type;

interface CastInterface
{

    /**
     * @param $value
     *
     * @return mixed
     */
    public function cast($value);
}
