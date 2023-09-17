<?php

namespace App\Controllers\TestResult;

use App\Redirect;
use App\Services\TestResult\Show\TestResultShowRequest;
use App\Services\TestResult\Show\TestResultShowService;
use App\Services\TestResult\Store\TestResultStoreRequest;
use App\Services\TestResult\Store\TestResultStoreService;
use App\View;
use Psr\Container\ContainerInterface;

class TestResultController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function store()
    {
        $userUuid = $_SESSION['user_uuid'];
        $testId = $_SESSION['test_id'];

        $request = new TestResultStoreRequest($userUuid, $testId);
        $service = $this->container->get(TestResultStoreService::class);
        $service->execute($request);

        return new Redirect('/test-result');
    }

    public function show(): View
    {
        $userUuid = $_SESSION['user_uuid'];
        $userName = $_SESSION['user_name'];
        $testId = $_SESSION['test_id'];

        $request = new TestResultShowRequest($userUuid, $testId);
        $service = $this->container->get(TestResultShowService::class);
        $response = $service->execute($request);

        return new View('/results/show.html', [
            'userName' => $userName,
            'totalTestQuestions' => $response->getTotalTestQuestions(),
            'totalCorrectAnswers' => $response->getTotalCorrectAnswers()
        ]);
    }
}