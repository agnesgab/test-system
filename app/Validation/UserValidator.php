<?php

namespace App\Validation;

class UserValidator
{
    private array $data;
    private string $requiredErrorMessage = 'Please enter your name';

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validateUser()
    {
        return $this->validateName();
    }

    public function validateName()
    {
        $value = trim($this->data['name']);

        if (empty($value)) {
            return $this->requiredErrorMessage;
        }

        return false;
    }
}
