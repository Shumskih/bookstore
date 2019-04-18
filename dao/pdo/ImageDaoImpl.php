<?php


class ImageDaoImpl implements DaoInterface
{
    private static $pdo;

    static function create($image)
    {
        $image = (object)$image;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::INSERT_IMAGE;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'path' => $image->getPath(),
            ]);

            $imageId = self::$pdo->lastInsertId();
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get user\'s address from database<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $imageId;
    }

    static function read($id)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::SELECT_IMAGE;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $image = $stmt->fetchObject(Image::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get user\'s address from database<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $image;
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