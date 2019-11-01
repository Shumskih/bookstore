<?php

abstract class Dao implements DaoInterface
{
    private static $pdo = null;

    static function getCountOfTables()
    {
        $dbName = Database::DB_NAME;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ALL_TABLES;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'table_schema' => $dbName,
            ]);
            $count = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get book from database<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $count['TABLE_COUNT'];
    }

    abstract static function create($object);

    abstract static function read($id);

    abstract static function readAll();

    abstract static function update($object);

    abstract static function delete($id);

}