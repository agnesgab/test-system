<?php

namespace App\Repositories\User;

use App\Database;

class MysqlUserRepository implements UserRepository
{
    public function store(string $name, string $uuid)
    {
        Database::connection()
            ->insert('users', [
                'name' => $name,
                'uuid' => $uuid,
            ]);
    }
}
