<?php

namespace App\Services\Test\Index;

class TestIndexResponse
{
    private array $tests;

    public function __construct(array $tests)
    {
        $this->tests = $tests;
    }

    public function getTests()
    {
        return $this->tests;
    }
}
