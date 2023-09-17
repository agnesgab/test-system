<?php

namespace App\Services\TestResult\Store;

use App\Repositories\TestResult\TestResultRepository;

class TestResultStoreService
{
    private TestResultRepository $testResultRepository;

    public function __construct(TestResultRepository $testResultRepository)
    {
        $this->testResultRepository = $testResultRepository;
    }

    public function execute(TestResultStoreRequest $request)
    {
        $this->testResultRepository->store($request->getUserUuid(), $request->getTestId());
    }
}
