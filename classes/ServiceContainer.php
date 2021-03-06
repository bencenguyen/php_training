<?php

class ServiceContainer
{
    private $definitions;

    public function __construct(array $definititons = [])
    {
        $this->definitions = $definititons;
    }

    public function get($service)
    {
        if (array_key_exists($service, $this->definitions)) {
            if (is_callable($this->definitions[$service])) {
                $factory = $this->definitions[$service];
                $this->definitions[$service] = $factory($this);
            }
        } else {
            throw new Exception\ServiceNotFoundException($service);
        }

        return $this->definitions[$service];
    }

    public function put($key, $service)
    {
        $this->definitions[$key] = $service;
    }
}