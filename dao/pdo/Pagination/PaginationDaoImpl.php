<?php


class PaginationDaoImpl implements DaoInterface
{
    private static $pdo = null;

    public static function getCountRecordsInDb(): int
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_COUNT_BOOKS;
            $stmt   = self::$pdo->query($query);
            $result = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get count records in book table<br>'
                . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $result['COUNT(*)'];
    }

    static function create($object)
    {
        // TODO: Implement create() method.
    }

    static function read($id)
    {
        // TODO: Implement read() method.
    }

    static function readAll()
    {
        // TODO: Implement readAll() method.
    }

    static function update($object)
    {
        // TODO: Implement update() method.
    }

    static function delete($id)
    {
        // TODO: Implement delete() method.
    }

}