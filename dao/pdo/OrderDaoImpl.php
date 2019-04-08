<?php
require_once ROOT . '/dao/DaoInterface.php';
require_once ROOT . '/models/Order.php';
require_once ROOT . '/models/Status.php';

class OrderDaoImpl implements DaoInterface
{

    private static $pdo;

    /**
     * Constructor.
     * Get instance of PDO object and assign it to a $pdo variable
     */
    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

    static function create($order)
    {
        self::$pdo = ConnectionUtil::getConnection();

        $order = (object)$order;
        try {
            self::$pdo->beginTransaction();

            //add order
            $query = SqlQueries::CREATE_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'userMessage' => $order->getUserMessage(),
              ]);

            $order->setId(self::$pdo->lastInsertId());

            // add book
            foreach ($order->getBooksAndQty() as $key => $value) {
                $book     = (object)$value['book'];
                $quantity = $value['qty'];

                $query = SqlQueries::ADD_BOOK_TO_ORDER;
                self::$pdo
                  ->prepare($query)
                  ->execute([
                    'orderId'  => $order->getId(),
                    'bookId'   => $book->getId(),
                    'quantity' => $quantity,
                  ]);
            }

            // add user
            $query = SqlQueries::ADD_USER_TO_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'orderId' => $order->getId(),
                'userId'  => $order->getUser()->getId(),
              ]);

            $deliveryController = new DeliveryController();
            $delivery
                                = $deliveryController->getDeliveryByMethod($_SESSION['shippingMethod']); // TODO: SessionInterface

            $query = SqlQueries::ADD_DELIVERY_TO_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'orderId'    => $order->getId(),
                'deliveryId' => $delivery->getId(),
              ]);

            // get all statuses
            $query    = SqlQueries::GET_ALL_STATUSES;
            $statuses = self::$pdo
              ->query($query)
              ->fetchAll();

            // add status 'Open' to order
            $query = SqlQueries::ADD_STATUS_TO_ORDER;
            $stmt  = self::$pdo->prepare($query);
            foreach ($statuses as $status) {
                if ($status['status'] == 'New') {
                    $stmt->execute([
                      'orderId'  => $order->getId(),
                      'statusId' => $status['id'],
                    ]);
                }
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t create order<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        unset($order);
    }

    static function read($id): Order
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $order = $stmt->fetchObject(\Order::class);
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t read order<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $order;
    }

    static function readAll()
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query  = SqlQueries::GET_ALL_ORDERS_WITH_STATUS;
            $orders = self::$pdo
              ->query($query)
              ->fetchAll();
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all orders from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $orders;
    }

    static function update($order)
    {
        // TODO: Implement update() method.
    }

    static function delete($id)
    {
        self::$pdo = ConnectionUtil::getConnection();

        try {
            self::$pdo->beginTransaction();

            // delete books from order
            $query = SqlQueries::DELETE_BOOKS_FROM_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'orderId' => $id,
              ]);

            // delete user
            $query = SqlQueries::DELETE_USER_FROM_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'orderId' => $id,
              ]);

            // delete delivery from order
            $query = SqlQueries::DELETE_DELIVERY_FROM_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'orderId' => $id,
              ]);

            // delete status from order
            $query = SqlQueries::DELETE_STATUS_FROM_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'orderId' => $id,
            ]);

            // delete order
            $query = SqlQueries::DELETE_ORDER;
            self::$pdo
              ->prepare($query)
              ->execute([
                'id' => $id,
              ]);
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t delete order<br>' .
                 $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    public static function getBooksAndQty($orderId): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_BOOKS_BY_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $orderId,
            ]);
            $result = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get books by order from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $result;
    }

    public static function getDelivery($orderId): \Delivery
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_DELIVERY_BY_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $orderId,
            ]);
            $delivery = $stmt->fetchObject(\Delivery::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get delivery by order from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $delivery;
    }

    public static function getUser($orderId): \User
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_USER_BY_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $orderId,
            ]);
            $user = $stmt->fetchObject(\User::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get user by order from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $user;
    }

    public static function getStatus($orderId): \Status
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_STATUS_BY_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'id' => $orderId,
            ]);
            $status = $stmt->fetchObject(\Status::class);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get status by order from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $status;
    }

    public static function setStatus(Status $status, $orderId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::ADD_NEW_STATUS_TO_ORDER;
            $stmt  = self::$pdo->prepare($query);
            $stmt->execute([
              'statusId' => $status->getId(),
              'orderId' => $orderId
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t set status by order from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    public static function getNewOrders(): int
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_COUNT_NEW_ORDERS;
            $stmt  = self::$pdo->query($query);
            $result = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new orders from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $result['COUNT(*)'];
    }
}