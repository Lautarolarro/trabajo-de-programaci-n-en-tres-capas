<?php


class Conexion
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/config.php';
            $db     = $config['db'];

            self::$pdo = new PDO(
                $db['dsn'],
                $db['user'],
                $db['password'],
                $db['options']
            );
        }

        return self::$pdo;
    }
}
