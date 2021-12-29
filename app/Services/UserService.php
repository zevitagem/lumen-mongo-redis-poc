<?php

namespace App\Services;

use App\Libraries\RedisHandler;

class UserService
{

    public function __construct(RedisHandler $handler)
    {
        $this->handler = $handler;
    }

    public function store($id, $value)
    {
        return $this->handler->set($id, json_encode(['teste' => $value]));
    }

    public function find($id)
    {
        return $this->handler->get($id);
    }

    public function list()
    {
        return $this->handler->keys();
    }
}