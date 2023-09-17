<?php

namespace App\Services\TestResult\Show;

class TestResultShowResponse
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getTotalTestQuestions(): string
    {
        return $this->data['total_test_questions'];
    }

    /**
     * @return string
     */
    public function getTotalCorrectAnswers(): string
    {
        return $this->data['total_correct_answers'];
    }
}
