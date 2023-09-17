<?php

namespace App\Services\Test\Show;

use App\Models\Question;
use App\Models\QuestionAnswerOption;
use App\Models\Test;
use App\Repositories\Test\TestRepository;

class TestShowService
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function execute(TestShowRequest $request)
    {
        $results = $this->testRepository->show($request->getTestId());

        // Organize the result into a structured format
        $testData = [];
        foreach ($results as $row) {
            $testId = $row['test_id'];
            $questionId = $row['question_id'];

            if (!isset($testData[$testId])) {
                // Initialize the entry for the test if it doesn't exist
                $testData[$testId] = [
                    'id' => $testId,
                    'name' => $row['test_name'],
                    'questions' => [],
                ];
            }

            if (!isset($testData[$testId]['questions'][$questionId])) {
                // Initialize the entry for the question if it doesn't exist
                $testData[$testId]['questions'][$questionId] = [
                    'question_id' => $questionId,
                    'question_text' => $row['question_text'],
                ];
            }

            if ($row['question_id_for_option'] !== null) {
                // Add the answer information to the question's answers array
                $testData[$testId]['questions'][$questionId]['answer_options'][] = [
                    'question_answer_option_id' => $row['question_answer_option_id'],
                    'option_text' => $row['option_text'],
                    'is_correct' => $row['is_correct'],
                ];
            }
        }

        // Re-index the formatted result to remove the test and question IDs
        $testData = array_values($testData);

        return new TestShowResponse($testData);
    }
}
