<?php

namespace App\Repositories\TestResult;

interface TestResultRepository
{
    public function store(string $userUuid, string $testId);
    public function show(string $userUuid, string $testId);
}