<?php


class ConnectionUtil
{

    private const DB_HOST = 'localhost';

    private const DB_NAME = 'bookstore';

    private const DB_USER = 'root';

    private const DB_PASS = 'root';

    private static $pdo = null;

    private function __construct()
    {
    }

    public static function getConnection()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                  'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS,
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