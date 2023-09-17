<?php

namespace App\Services\Session;

use App\Services\User\Store\UserStoreResponse;

class Session
{
    private UserStoreResponse $response;
    private string $testId;

    public function __construct(UserStoreResponse $response, string $testId)
    {
        $this->response = $response;
        $this->testId = $testId;
    }

    public function setSessionValues()
    {
        $_SESSION['user_uuid'] = $this->response->getUuid();
        $_SESSION['user_name'] = $this->response->getName();
        $_SESSION['test_id'] = $this->testId;
    }
}