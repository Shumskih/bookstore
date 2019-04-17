<?php


class CategoryDaoImpl implements DaoInterface
{

    private static $pdo;

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
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_ALL_CATEGORIES;
            $categories = self::$pdo
              ->query($query)
              ->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all orders from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $categories;
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