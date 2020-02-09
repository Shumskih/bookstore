<?php


class PaginationDaoImpl
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

    static function read($startPosition, $countItemsOnPage)
    {

        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_PAGINATED_BOOKS;
            $stmt = self::$pdo->prepare($query);
            $stmt->bindParam('startPosition', $startPosition, PDO::PARAM_INT);
            $stmt->bindParam('countItemsOnPage', $countItemsOnPage, PDO::PARAM_INT);
            $stmt->execute();
            $books = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get count records in book table<br>'
                . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $books;
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