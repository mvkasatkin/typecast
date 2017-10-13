<?php

namespace Mvkasatkin\typecast\type;

abstract class Type implements CastInterface
{

    /**
     * @var null
     */
    protected $default;

    /**
     * @param null $default
     */
    public function __construct($default = null)
    {
        $this->default = $default;
    }
}
