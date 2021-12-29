<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store()
    {
        $id = str_shuffle('joseph');

        $result = $this->service->store($id, 'value: '.$id);

        return $result;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function find(string $key)
    {
        $result = $this->service->find($key);

        return $result;
    }
}