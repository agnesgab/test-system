<?php

namespace App;

use Doctrine\DBAL\DriverManager;

class Database
{
    private static $connection = null;

    public static function connection()
    {
        if (self::$connection === null) {
            $connectionParams = [
                'dbname' => 'test_system',
                'user' => 'agnese',
                'password' => 'password',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];

            self::$connection = DriverManager::getConnection($connectionParams);
        }

        return self::$connection;
    }
}
