<?php

class ConnectionUtil
{
    private static $pdo = null;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=' . Database::DB_HOST . ';dbname=' . Database::DB_NAME, Database::DB_USER, Database::DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
        return self::$pdo;
    }

    final public function __destruct()
    {
        self::$pdo = null;
    }

    private function __clone()
    {
    }
}