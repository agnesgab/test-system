<?php

namespace App\Services\TestResult\Show;

use App\Repositories\TestResult\TestResultRepository;

class TestResultShowService
{
    private TestResultRepository $testResultRepository;

    public function __construct(TestResultRepository $testResultRepository)
    {
        $this->testResultRepository = $testResultRepository;
    }

    public function execute(TestResultShowRequest $request)
    {
        $data = $this->testResultRepository->show($request->getUserUuid(), $request->getTestId());

        return new TestResultShowResponse($data);
    }
}