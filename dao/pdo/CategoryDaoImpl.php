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
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_CATEGORY;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $category = $stmt->fetchObject(Category::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get category<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $category;
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

    static function getBooks($categoryId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_BOOKS_BY_CATEGORY;
            $stmt = self::$pdo->query($query);
            $stmt->execute([
              'id' => $categoryId
            ]);
            $books = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all orders from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $books;
    }

    public static function getCountBooks($categoryId): int
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::COUNT_BOOKS_IN_CATEGORY;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $categoryId,
            ]);
            $count = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get count of books<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return (int)$count['count'];
    }

}