<?php

namespace App\Services\User\Store;

class UserStoreResponse
{
    private string $uuid;
    private string $name;

    public function __construct(string $name, string $uuid)
    {
        $this->name = $name;
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }
}
