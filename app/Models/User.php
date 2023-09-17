<?php

namespace App\Models;

class User
{
    private ?int $id;
    private string $name;

    public function __construct(?int $id = null, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}