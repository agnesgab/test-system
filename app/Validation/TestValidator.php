<?php

namespace App\Validation;

class TestValidator
{
    private array $data;
    private string $requiredErrorMessage = 'Please select test';

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validateSelectedTest()
    {
        if (empty($this->data['test'])) {
            return $this->requiredErrorMessage;
        }

        return false;
    }
}