<?php

namespace App\Services\Test\SubmitAnswer;

class SubmitAnswerRequest
{
    private array $vars;

    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }
}