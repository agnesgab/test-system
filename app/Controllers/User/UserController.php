<?php

namespace App\Controllers\User;

use App\Redirect;
use App\Services\Session\Session;
use App\Services\Test\Index\TestIndexService;
use App\Services\User\Store\UserStoreRequest;
use App\Services\User\Store\UserStoreService;
use App\Validation\TestValidator;
use App\Validation\UserValidator;
use App\Validation\Validation;
use App\View;
use Psr\Container\ContainerInterface;

class UserController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function store()
    {
        if (isset($_POST)) {
            $validator = new Validation(new UserValidator($_POST), new TestValidator($_POST));
            $errors = $validator->execute();
        }

        if (!empty($errors)) {
            $testsService = $this->container->get(TestIndexService::class);
            $response = $testsService->execute();
            $tests = $response->getTests();

            return new View('home.html', ['errors' => $errors, 'tests' => $tests, 'name' => $_POST['name']]);
        }

        $request = new UserStoreRequest($_POST['name']);
        $service = $this->container->get(UserStoreService::class);
        $response = $service->execute($request);

        $testId = $_POST['test'];

        $sessionService = new Session($response, $testId);
        $sessionService->setSessionValues();

        return new Redirect('/test/' . $testId);
    }

    public function endSession()
    {
        session_destroy();

        return new Redirect('/');
    }
}
