<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function store(string $name, string $uuid);
}
