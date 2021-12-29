<?php

namespace App\Libraries;

class RedisHandler
{
    private $service;

    public function __construct()
    {
        $this->service = app('redis');
    }

    public function set($key, $value)
    {
        return $this->service->set($key, $value);
    }

    public function get($key)
    {
        return $this->service->get($key);
    }

    public function keys()
    {
        return $this->service->keys('*');
    }
}