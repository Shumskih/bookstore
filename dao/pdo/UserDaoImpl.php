<?php

class UserDaoImpl implements DaoInterface
{
    private static $pdo;

    static function create($user)
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

    static function update($user)
    {
        $user = (object)$user;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::UPDATE_USER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id'          => $user->getId(),
              'name'        => $user->getName(),
              'surname'     => $user->getSurname(),
              'email'       => $user->getEmail(),
              'mobilePhone' => $user->getMobilePhone(),
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t update user!<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function getAddress($userId): Address
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_USER_ADDRESS;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $userId,
            ]);
            $address = $stmt->fetchObject( 'Address');

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get user\'s address from database<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $address;
    }

    public static function getRoles($userId): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_USER_ROLES;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $userId,
            ]);
            $roles = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get user\'s roles from database<br>' . $e->getMessage();
        }

        return $roles;
    }

    public static function getOrders($userId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ORDERS_OF_USER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $userId,
            ]);
            $orders = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get user\'s orders from database<br>' . $e->getMessage();
        }

        return $orders;
    }

    public static function getOrder($orderId, $userId): Order
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ORDER_OF_USER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'orderId' => $orderId,
              'userId' => $userId
            ]);
            $order = $stmt->fetchObject(Order::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            echo 'Can\'t get user\'s order from database<br>' . $e->getMessage();
        }

        return $order;
    }
}