<?php

namespace Mvkasatkin\typecast;

use Mvkasatkin\typecast\type\CastInterface;
use Mvkasatkin\typecast\type\Factory;
use Mvkasatkin\typecast\type\Scheme;
use Mvkasatkin\typecast\type\TypeArrayOfType;

if (!\function_exists('\Mvkasatkin\typecast\cast')) {
    /**
     * @param $value
     * @param CastInterface|string|array $config
     *
     * @return mixed|null
     */
    function cast($value, $config)
    {
        $factory = new Factory();
        if (\is_array($config)) {
            /** @var TypeArrayOfType $arrayOfType */
            $config = ($arrayOfType = $factory->checkArrayOfType($config))
                ? $arrayOfType
                : new Scheme($config, $factory);
        } elseif (!$config instanceof CastInterface) {
            $config = $factory->createType($config);
        }

        $cast = new Cast($config);
        return $cast->process($value);
    }
}
