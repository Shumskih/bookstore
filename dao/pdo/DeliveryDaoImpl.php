<?php

class DeliveryDaoImpl extends Dao
{
    private static PDO $pdo;

    static function create($delivery): int
    {
        $delivery = (object)$delivery;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::INSERT_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'deliveryMethod' => $delivery->getDeliveryByMethod(),
                'deliveryCost' => $delivery->getDeliveryCost()
            ]);
            $deliveryId = self::$pdo->lastInsertId();

            self::$pdo->commit();

        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t create new delivery<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $deliveryId;
    }

    static function read($id)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id,
            ]);
            $book = $stmt->fetch();

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

            $query = SqlQueries::GET_ALL_DELIVERIES;
            $deliveries = self::$pdo->query($query)->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t get all deliveries<br>' . $e->getMessage();
        }

        return $deliveries;
    }

    static function update($book)
    {
        $book = (object)$book;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::UPDATE_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'authorName' => $book->getAuthorName(),
                'authorSurname' => $book->getAuthorSurname(),
                'description' => $book->getDescription(),
                'pages' => $book->getPages(),
                'price' => $book->getPrice(),
                'addedAt' => $book->getAddedAt(),
                'inStock' => $book->isInStock(),
                'quantity' => $book->getQuantity()
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        if (!empty($book->getImages())) {
            foreach ($book->getImages() as $image) {
                $image = (object)$image;
                self::addBooksImages($book->getId(), $image->getId());
            }
        }
    }

    static function delete($id)
    {
        self::deleteBookFromCategory($id);
        self::deleteBooksImages($id);
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::DELETE_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    static function getDeliveryByMethod($deliveryMethod): Delivery
    {
        try {
            $query = SqlQueries::GET_DELIVERY_BY_METHOD;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'deliveryMethod' => $deliveryMethod
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get delivery by method<br>' . $e->getMessage();
        }

        $result = $stmt->fetch();

        return new Delivery(
            $result['id'],
            $result['deliveryMethod'],
            $result['deliveryCost']
        );
    }
}