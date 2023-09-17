<?php

namespace App\Services\Test\Show;

class TestShowRequest
{
    protected int $testId;

    public function __construct(int $testId)
    {
        $this->testId = $testId;
    }

    public function getTestId()
    {
        return $this->testId;
    }
}