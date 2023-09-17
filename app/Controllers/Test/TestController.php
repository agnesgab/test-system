<?php

namespace App\Controllers\Test;

use App\Services\Test\Show\TestShowRequest;
use App\Services\Test\Show\TestShowService;
use App\Services\Test\SubmitAnswer\SubmitAnswerRequest;
use App\Services\Test\SubmitAnswer\SubmitAnswerService;
use App\View;
use Psr\Container\ContainerInterface;

class TestController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function show(array $vars): View
    {
        try {
            $testId = (int)$vars['test_id'] == $_SESSION['test_id'] ? (int)$vars['test_id'] : $_SESSION['test_id'];
            $request = new TestShowRequest($testId);

            $service = $this->container->get(TestShowService::class);
            $response = $service->execute($request);

            $questions = $response->getTestQuestionsWithAnswerOptions();
            $testName = $response->getTestName();
            $testId = $response->getTestId();

            if (!$questions) {
                // No questions available, throw an exception
                throw new \Error('No questions available for this test.');
            }

            // Return Test question view
            return new View('tests/show.html', [
                'questions' => $questions,
                'testName' => $testName,
                'testId' => $testId
            ]);
        } catch (\Error $e) {
            return new View('tests/no_questions.html', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }


    /**
     * @param array $vars
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function submitAnswer(array $vars)
    {
        $request = new SubmitAnswerRequest($vars);
        $service = $this->container->get(SubmitAnswerService::class);
        $service->execute($request);
    }
}
