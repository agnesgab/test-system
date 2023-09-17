<?php

namespace App\Services\Test\SubmitAnswer;

use App\Repositories\Test\TestRepository;

class SubmitAnswerService
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function execute(SubmitAnswerRequest $request)
    {
        $this->testRepository->submitAnswer($request->getVars());
    }
}