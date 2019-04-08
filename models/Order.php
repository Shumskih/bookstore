<?php
require_once ROOT . '/models/Model.php';
require_once ROOT . '/controllers/DeliveryController.php';
require_once ROOT . '/dao/pdo/OrderDaoImpl.php';

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


    function create($order)
    {
        OrderDaoImpl::create($order);
        unset($order);
    }

    function read($id): Order
    {
        return OrderDaoImpl::read($id);
    }

    function readAll(): array
    {
        return OrderDaoImpl::readAll();
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        OrderDaoImpl::delete($id);
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
    public function setId(int $id): void
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
    public function setUserMessage(string $userMessage): void
    {
        $this->userMessage = $userMessage;
    }

    /**
     * @return array
     */
    public function getBooksAndQty($orderId = null): array
    {
        if (!empty($this->booksAndQty)) {
            return $this->booksAndQty;
        } else {
            return OrderDaoImpl::getBooksAndQty($this->id);
        }
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
    public function getUser(): \User
    {
        if (!empty($this->user)) {
            return $this->user;
        } else {
            return OrderDaoImpl::getUser($this->id);
        }
    }

    /**
     * @param null $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return null
     */
    public function getDelivery(): \Delivery
    {
        if (!empty($this->delivery)) {
            return $this->delivery;
        } else {
            return OrderDaoImpl::getDelivery($this->id);
        }
    }

    /**
     * @param null $delivery
     */
    public function setDelivery(Delivery $delivery): void
    {
        $this->delivery = $delivery;
    }

    /**
     * @return null
     */
    public function getStatus(): \Status
    {
        if (!empty($this->status)) {
            return $this->status;
        } else {
            return OrderDaoImpl::getStatus($this->id);
        }
    }

    /**
     * @param null $status
     */
    public function setStatus(Status $status): void
    {
        if (!empty($this->status)) {
            $this->status = $status;
        } else {
            OrderDaoImpl::setStatus($status, $this->id);
        }
    }
}