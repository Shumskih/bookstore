<?php

class StatusDaoImpl
{
    private static $pdo;

    /**
     * Constructor.
     * Get instance of PDO object and assign it to a $pdo variable
     */
    public function __construct()
    {
        self::$pdo = ConnectionUtil::getConnection();
    }

    public static function create($status)
    {

    }

    public static function read($id): \Status
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_STATUS;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $status = $stmt->fetchObject(Status::class);
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t read order<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $status;
    }

    public static function readAll()
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_ALL_STATUSES;
            $statuses = self::$pdo
              ->query($query)
              ->fetchAll();
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all statuses from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $statuses;
    }

    public static function update($status)
    {

    }

    public static function delete($id)
    {

    }
}