<?php

namespace App\Controllers\User;

use App\Redirect;
use App\Services\Test\Index\TestIndexService;
use App\Services\User\Store\UserStoreRequest;
use App\Services\User\Store\UserStoreService;
use App\Validation\TestValidator;
use App\Validation\UserValidator;
use App\View;
use Psr\Container\ContainerInterface;

class UserController
{
    private ContainerInterface $container;

    public array $errors = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function store()
    {
        //IZTĪRĪT
        // ŠEIT UZTAISĪT GLOBĀLU VALIDATORU UN IZLAIST VISU CAURI
        if (isset($_POST)) {
            // VĒL CITĀ SERVISĀ IELIKT
            $userValidation = new UserValidator($_POST);
            $testValidation = new TestValidator($_POST);

            $userValidationResult = $userValidation->validateUser();
            $testValidationResult = $testValidation->validateSelectedTest();

            if (!empty($userValidationResult)) {
                $this->errors['name'] = $userValidationResult;
            } else {
                // If name is valid, remove the error (if it exists)
                unset($this->errors['name']);
            }

            if (!empty($testValidationResult)) {
                $this->errors['test'] = $testValidationResult;
            } else {
                // If test is valid, remove the error (if it exists)
                unset($this->errors['test']);
            }
        }

        if (!empty($this->errors)) {
            $testsService = $this->container->get(TestIndexService::class);
            $response = $testsService->execute();
            $tests = $response->getTests();

            return new View('home.html', ['errors' => $this->errors, 'tests' => $tests, 'name' => $_POST['name']]);
        }
        // Iztīrīt BEIGAS

        // ŠEIT ATSEVIŠĶS SERIVSS, KAS SAGLABĀ USERI UN UZSĀK SESIJU AR VIŅA ID
        $request = new UserStoreRequest($_POST['name']);
        $service = $this->container->get(UserStoreService::class);
        $response = $service->execute($request);

        $testId = $_POST['test'];

        $_SESSION['user_uuid'] = $response->getUuid();
        $_SESSION['user_name'] = $response->getName();
        $_SESSION['test_id'] = $testId;

        return new Redirect('/test/' . $testId);
    }

    public function endSession()
    {
        session_destroy();

        return new Redirect('/');
    }
}
