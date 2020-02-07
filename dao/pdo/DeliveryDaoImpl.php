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

    static function read($id): \Delivery
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_DELIVERY_BY_ID;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id,
            ]);
            $delivery = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get delivery from database<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $delivery;
    }

    static function readAll(): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ALL_DELIVERIES;
            $deliveries = self::$pdo->query($query)->fetchAll();
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all deliveries<br>' . $e->getMessage();
        }

        return $deliveries;
    }

    static function update($delivery)
    {
        $delivery = (object)$delivery;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::UPDATE_DELIVERY;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $delivery->getId(),
                'deliveryMethod' => $delivery->getDeliveryMethod(),
                'deliveryCost' => $delivery->getDeliveryCost()
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t update delivery<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    static function delete($id)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::DELETE_DELIVERY;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t delete delivery<br>' .
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