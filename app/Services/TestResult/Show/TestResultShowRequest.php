<?php

namespace App\Services\TestResult\Show;

class TestResultShowRequest
{
    private string $userUuid;
    private string $testId;

    public function __construct(string $userUuid, string $testId)
    {
        $this->userUuid = $userUuid;
        $this->testId = $testId;
    }

    /**
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }

    /**
     * @return string
     */
    public function getTestId(): string
    {
        return $this->testId;
    }
}