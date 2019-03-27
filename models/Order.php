<?php
require_once ROOT . '/controllers/DeliveryController.php';

class Order
{

    private $orderId = null;

    private $bookIdsAndQty = [];

    private $userId = null;

    private $orderMessage = null;

    private $deliveryMethod = null;

    private $deliveryCost = null;

    private $pdo = null;

    /**
     * Order constructor.
     * Get instance of PDO object and assign it to $pdo variable
     */
    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

    public function createOrder(array $bookIdsAndQty, $userId, $orderMessage)
    {
        $this->bookIdsAndQty = $bookIdsAndQty;
        $this->userId        = $userId;
        $this->orderMessage  = $orderMessage;

        // add order
        try {
            $query = SqlQueries::CREATE_ORDER;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'orderMessage' => $this->orderMessage,
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t create order<br>' . $e->getMessage();
        }

        $this->orderId = $this->pdo->lastInsertId();

        // add book
        foreach ($this->bookIdsAndQty as $key => $value) {
            $book     = (object)$value['book'];
            $quantity = $value['qty'];
            try {
                $query = SqlQueries::ADD_BOOK_TO_ORDER;
                $stmt  = $this->pdo->prepare($query);
                $stmt->execute([
                  'orderId'  => $this->orderId,
                  'bookId'   => $book->getId(),
                  'quantity' => $quantity,
                ]);
            } catch (PDOException $e) {
                echo 'Can\'t add book to order<br>' . $e->getMessage();
            }
        }

        // add user
        try {
            $query = SqlQueries::ADD_USER_TO_ORDER;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'orderId' => $this->orderId,
              'userId'  => $this->userId,
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t add user to order<br>' . $e->getMessage();
        }

        $deliveryController = new DeliveryController();
        $delivery           = $deliveryController->getDeliveryByMethod($_SESSION['shippingMethod']);

        try {
            $query = SqlQueries::ADD_DELIVERY_TO_ORDER;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'orderId'    => $this->orderId,
              'deliveryId' => $delivery->getId(),
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t add delivery to order<br>' . $e->getMessage();
        }

        unset($this->pdo);
        unset($this->bookId);
        unset($this->userId);
        unset($this->orderId);
        unset($delivery);
        unset($deliveryController);
    }

    /**
     * @return null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param null $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return array
     */
    public function getBookIdsAndQty(): array
    {
        return $this->bookIdsAndQty;
    }

    /**
     * @param array $bookIdsAndQty
     */
    public function setBookIdsAndQty(array $bookIdsAndQty): void
    {
        $this->bookIdsAndQty = $bookIdsAndQty;
    }

    /**
     * @return null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param null $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return null
     */
    public function getOrderMessage()
    {
        return $this->orderMessage;
    }

    /**
     * @param null $orderMessage
     */
    public function setOrderMessage($orderMessage): void
    {
        $this->orderMessage = $orderMessage;
    }
}