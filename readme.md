# Simple Test System

Project is created with:

* PHP 7.4

## Setup

**1. install Composer:**

```
$ composer install
```
**2. set up database:** <br>
[Database](app/Database.php) - provide connection parameters - 'dbname', 'user', 'password', 'host'<br>
[Database Schema ](schema.sql) can be found here <br>

**3. open project locally, e.g.**
```
$ php -S 127.0.0.1:8000
```

## Packages & documentation: <br>

* [Nikic/Fast-route](https://github.com/nikic/FastRoute) - request router
* [Doctrine/Dbal](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/) - database abstraction layer
* [Twig](https://twig.symfony.com/doc/3.x/) - template language for PHP
* [PHP-DI](https://php-di.org/doc/) - dependency injection container for PHP
* [Axios](https://axios-http.com/docs/intro) - promise based HTTP client for the browser and node.js
