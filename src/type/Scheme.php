<?php

namespace Mvkasatkin\typecast\type;

class Scheme implements CastInterface
{
    /**
     * @var CastInterface[]
     */
    protected $config = [];
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param array $config
     * @param Factory|null $factory
     *
     * @throws \Mvkasatkin\typecast\Exception
     */
    public function __construct(array $config = [], Factory $factory = null)
    {
        $this->factory = $factory ?? new Factory();
        $this->config = $this->parseConfig($config);
    }

    /**
     * @param array $config
     *
     * @return array
     * @throws \Mvkasatkin\typecast\Exception
     */
    protected function parseConfig(array $config): array
    {
        $result = [];
        foreach ($config as $key => $type) {
            if (\is_array($type)) {
                if ($arrayOfType = $this->factory->checkArrayOfType($type)) {
                    $result = $arrayOfType;
                } else {
                    $result = new self($type);
                }
            }
            if (!$type instanceof CastInterface) {
                $type = $this->factory->createType($type);
            }
            $this->addField($key, $type);
        }

        return $result;
    }

    /**
     * @param $key
     * @param Type|Scheme $rule
     */
    public function addField($key, $rule)
    {
        $this->config[$key] = $rule;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function cast($value): array
    {
        $result = [];
        foreach ((array)$value as $key => $itemValue) {
            $result[$key] = isset($this->config[$key])
                ? $this->config[$key]($itemValue)
                : $itemValue;
        }
        return $result;
    }
}
