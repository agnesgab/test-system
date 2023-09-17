<?php

namespace App\Services\Test\Show;

class TestShowResponse
{
    private array $testData;

    public function __construct(array $testData)
    {
        $this->testData = $testData;
    }

    public function getTests()
    {
        return $this->testData;
    }

    public function getTestId()
    {
        foreach ($this->testData as $data){
            return $data['id'];
        }

        return false;
    }

    public function getTestName()
    {
        foreach ($this->testData as $data){
            return $data['name'];
        }

        return false;
    }

    public function getTestQuestionsWithAnswerOptions()
    {
        foreach ($this->testData as $data){
            return $data['questions'];
        }

        return false;
    }
}