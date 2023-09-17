<?php

use App\Redirect;
use App\Repositories\Test\MysqlTestRepository;
use App\Repositories\Test\TestRepository;
use App\Repositories\TestResult\MysqlTestResultRepository;
use App\Repositories\TestResult\TestResultRepository;
use App\Repositories\User\MysqlUserRepository;
use App\Repositories\User\UserRepository;
use App\View;
use FastRoute\Dispatcher;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

//Possible to change data source using dependency injections (e.g. switch from MysqlUserRepository to CSVUserRepository)
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    UserRepository::class => DI\create(MysqlUserRepository::class),
    TestRepository::class => DI\create(MysqlTestRepository::class),
    TestResultRepository::class => DI\create(MysqlTestResultRepository::class),
]);
$container = $builder->build();

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    // Home
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);

    // User
    $r->addRoute('POST', '/submit', ['App\Controllers\User\UserController', 'store']);
    $r->addRoute('GET', '/leave', ['App\Controllers\User\UserController', 'endSession']);

    // Tests
    $r->addRoute('GET', '/test/{test_id}', ['App\Controllers\Test\TestController', 'show']);
    $r->addRoute('POST', '/test-done', ['App\Controllers\TestResult\TestResultController', 'store']);
    $r->addRoute('GET', '/test-result', ['App\Controllers\TestResult\TestResultController', 'show']);

    // Answers
    $r->addRoute('GET', '/submit-answer/{question_id}/{option_id}', ['App\Controllers\Test\TestController', 'submitAnswer']);

});

function fetchMethodAndURIFromSomewhere(Dispatcher $dispatcher, $container): void
{
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            break;
        case FastRoute\Dispatcher::FOUND:
            $controller = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = $routeInfo[2];

            $response = (new $controller($container))->$method($vars);

            $loader = new FilesystemLoader('resources/views');
            $twig = new Environment($loader);

            if ($response instanceof View) {
                echo $twig->render($response->getPath(), $response->getVariables());
            }

            if ($response instanceof Redirect) {
                header('Location: ' . $response->getLocation());
                exit;
            }

            break;
    }
}

fetchMethodAndURIFromSomewhere($dispatcher, $container);
