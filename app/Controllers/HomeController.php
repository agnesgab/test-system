<?php

namespace App\Controllers;

use App\Services\Test\Index\TestIndexService;
use App\View;
use Psr\Container\ContainerInterface;

class HomeController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function index()
    {
        $testsService = $this->container->get(TestIndexService::class);
        $response = $testsService->execute();
        $tests = $response->getTests();

        return new View('home.html', ['tests' => $tests]);
    }
}
