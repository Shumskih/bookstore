<?php


class ConnectionUtil
{
  private static $pdo = null;

  private const DB_HOST = 'localhost';
  private const DB_NAME = 'bookstore';
  private const DB_USER = 'root';
  private const DB_PASS = 'root';

  private function __construct() {}
  private function __clone() {}

  public static function getConnection() {
    if (!isset(self::$pdo)) {
      try {
        self::$pdo = new PDO(
          'mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
      } catch (PDOException $e) {
        $e->getMessage();
      }
    }
    return self::$pdo;
  }
  final public function __destruct() {
    self::$pdo = null;
  }
}