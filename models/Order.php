<?php
require_once ROOT . '/models/Model.php';
require_once ROOT . '/controllers/DeliveryController.php';

class Order implements Model
{

    private $id = null;

    private $userMessage = null;

    // Array of Book Objects
    private $booksAndQty = [];

    // User Object
    private $user = null;

    // Delivery Object
    private $delivery = null;

    // Status Object
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

    function create($order)
    {

        $order = (object)$order;
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

        $order->setId($this->pdo->lastInsertId());

        // add book
        foreach ($order->getBooksAndQty() as $key => $value) {
            $book     = (object)$value['book'];
            $quantity = $value['qty'];
            try {
                $query = SqlQueries::ADD_BOOK_TO_ORDER;
                $this->pdo
                  ->prepare($query)
                  ->execute([
                    'orderId'  => $order->getId(),
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
                'orderId' => $order->getId(),
                'userId'  => $order->getUser()->getId(),
              ]);
        } catch (PDOException $e) {
            echo 'Can\'t add user to order in ' . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        $deliveryController = new DeliveryController();
        $delivery           = $deliveryController->getDeliveryByMethod($_SESSION['shippingMethod']);

        try {
            $query = SqlQueries::ADD_DELIVERY_TO_ORDER;
            $this->pdo
              ->prepare($query)
              ->execute([
                'orderId'    => $order->getId(),
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
                        'orderId'  => $order->getId(),
                        'statusId' => $status['id'],
                      ]);
                } catch (PDOException $e) {
                    echo 'Can\'t add status to order<br>' .
                         $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
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

    function readAll(): array
    {
        try {
            $query  = SqlQueries::GET_ALL_ORDERS_WITH_STATUS;
            $orders = $this->pdo
              ->query($query)
              ->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t get all orders from database<br>'
                 . $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $orders;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    /**
     * @param null $userMessage
     */
    public function setUserMessage($userMessage): void
    {
        $this->userMessage = $userMessage;
    }

    /**
     * @return array
     */
    public function getBooksAndQty(): array
    {
        return $this->booksAndQty;
    }

    /**
     * @param array $booksAndQty
     */
    public function setBooksAndQty(array $booksAndQty): void
    {
        $this->booksAndQty = $booksAndQty;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param null $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return null
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param null $delivery
     */
    public function setDelivery($delivery): void
    {
        $this->delivery = $delivery;
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