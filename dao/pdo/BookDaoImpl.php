<?php

class BookDaoImpl implements DaoInterface
{
    private static $pdo;

    static function create($object)
    {
        // TODO: Implement create() method.
    }

    static function read($id): Book
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_BOOK;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $book = $stmt->fetchObject(Book::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get book from database<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $book;
    }

    static function readAll(): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ALL_BOOKS;
            $stmt  = self::$pdo->query($query);
            $array = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get all books<br>' . $e->getMessage();
        }
        return $array;
    }

    static function update($object)
    {
        // TODO: Implement update() method.
    }

    static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function getNewBooks(int $quantity): array
    {
        try {
            $pdo = ConnectionUtil::getConnection();
            $pdo->beginTransaction();

            $query = SqlQueries::GET_NEW_BOOKS;
            $stmt  = self::$pdo->prepare($query);
            $stmt->bindParam(
              ':quantity', $quantity, PDO::PARAM_INT
            );
            $stmt->execute();
            $array = $stmt->fetchAll();

            $pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get new books<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $array;
    }

    public static function getCategories($bookId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_CATEGORIES_OF_BOOK;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $bookId,
            ]);
            $categories = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get categories of book<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $categories;
    }
}