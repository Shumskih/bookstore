<?php
require_once ROOT . '/models/Model.php';
require_once ROOT . '/controllers/DeliveryController.php';

class Order implements Model
{

    private $orderId = null;

    private $bookIdsAndQty = [];

    private $userId = null;

    private $userMessage = null;

    private $deliveryMethod = null;

    private $deliveryCost = null;

    private $status = null;

    private $pdo = null;

    /**
     * Order constructor.
     * Get instance of PDO object and assign it to $pdo variable
     */
    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

    public function createOrder(array $bookIdsAndQty, $userId, $userMessage)
    {

    }

    function create($order)
    {

        $order = (object) $order;
        // add order
        try {
            $query = SqlQueries::CREATE_ORDER;
            $this->pdo
              ->prepare($query)
              ->execute([
              'userMessage' => $order->getUserMessage(),
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t create order<br>' . $e->getMessage();
        }

        $order->setOrderId($this->pdo->lastInsertId());

        // add book
        foreach ($order->bookIdsAndQty as $key => $value) {
            $book     = (object)$value['book'];
            $quantity = $value['qty'];
            try {
                $query = SqlQueries::ADD_BOOK_TO_ORDER;
                $this->pdo
                  ->prepare($query)
                  ->execute([
                  'orderId'  => $order->getOrderId(),
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
            $this->pdo
              ->prepare($query)
              ->execute([
              'orderId' => $order->getOrderId(),
              'userId'  => $order->getUserId(),
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t add user to order in ' . $e->getFile() . ': line ' . $e->getLine() .  '<br>' . $e->getMessage();
        }

        $deliveryController = new DeliveryController();
        $delivery           = $deliveryController->getDeliveryByMethod($_SESSION['shippingMethod']);

        try {
            $query = SqlQueries::ADD_DELIVERY_TO_ORDER;
            $this->pdo
              ->prepare($query)
              ->execute([
                'orderId'    => $order->getOrderId(),
                'deliveryId' => $delivery->getId(),
              ]);
        } catch (PDOException $e) {
            echo 'Can\'t add delivery to order<br>' . $e->getMessage();
        }

        // get all statuses
        try {
            $query    = SqlQueries::GET_ALL_STATUSES;
            $statuses = $this->pdo
              ->query($query)
              ->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t add status to order<br>' . $e->getMessage();
        }

        // add status 'Open' to order
        foreach ($statuses as $status) {
            if ($status['status'] == 'Open') {
                try {
                    $query = SqlQueries::ADD_STATUS_TO_ORDER;
                    $this->pdo
                      ->prepare($query)
                      ->execute([
                        'orderId'  => $order->getOrderId(),
                        'statusId' => $status['id'],
                      ]);
                } catch (PDOException $e) {
                    echo 'Can\'t add status to order<br>' . $e->getMEssage();
                }
            }
        }

        unset($this->pdo);
        unset($order);
        unset($delivery);
        unset($deliveryController);
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {

    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
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
    public function getUserMessage()
    {
        return $this->userMessage;
    }

    /**
     * @param null $orderMessage
     */
    public function setUserMessage($userMessage): void
    {
        $this->userMessage = $userMessage;
    }

    /**
     * @return null
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
    }

    /**
     * @param null $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    /**
     * @param null $deliveryCost
     */
    public function setDeliveryCost($deliveryCost): void
    {
        $this->deliveryCost = $deliveryCost;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}