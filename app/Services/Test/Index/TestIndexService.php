<?php

namespace App\Services\Test\Index;

use App\Models\Test;
use App\Repositories\Test\TestRepository;

class TestIndexService
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function execute()
    {
        $testsQuery = $this->testRepository->index();
        $tests = [];

        foreach ($testsQuery as $data) {
            $test = new Test($data['id'], $data['name']);

            $tests[] = $test;
        }

        return new TestIndexResponse($tests);
    }
}
