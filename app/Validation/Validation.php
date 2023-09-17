<?php

namespace App\Validation;

class Validation
{
    public UserValidator $userValidator;
    public TestValidator $testValidator;
    public array $errors = [];

    public function __construct(UserValidator $userValidator, TestValidator $testValidator)
    {
        $this->userValidator = $userValidator;
        $this->testValidator = $testValidator;
    }

    public function execute()
    {
        $userValidationResult = $this->userValidator->validateUser();
        $testValidationResult = $this->testValidator->validateSelectedTest();

        if (!empty($userValidationResult)) {
            $this->errors['name'] = $userValidationResult;
        } else {
            // If name is valid, remove the error (if it exists)
            unset($this->errors['name']);
        }

        if (!empty($testValidationResult)) {
            $this->errors['test'] = $testValidationResult;
        } else {
            // If test is valid, remove the error (if it exists)
            unset($this->errors['test']);
        }

        return $this->errors;
    }
}