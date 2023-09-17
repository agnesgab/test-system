<?php

namespace App\Repositories\Test;

interface TestRepository
{
    public function index();
    public function show(int $testId);
    public function submitAnswer(array $vars);
}
