<?php

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    /**
     * @param string $userMessage
     */
    public function setUserMessage(string $userMessage): void
    {
        $this->userMessage = $userMessage;
    }

    /**
     * @return array
     */
    public function getBooksAndQty(): array
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
     * @return User
     */
    public function getUser(): User
    {
        if (!empty($this->user)) {
            return $this->user;
        } else {
            return OrderDaoImpl::getUser($this->id);
        }
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Delivery
     */
    public function getDelivery(): Delivery
    {
        if (!empty($this->delivery)) {
            return $this->delivery;
        } else {
            return OrderDaoImpl::getDelivery($this->id);
        }
    }

    /**
     * @param Delivery $delivery
     */
    public function setDelivery(Delivery $delivery): void
    {
        $this->delivery = $delivery;
    }

    /**
     * @return Status.class
     */
    public function getStatus(): Status
    {
        if (!empty($this->status)) {
            return $this->status;
        } else {
            return OrderDaoImpl::getStatus($this->id);
        }
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status): void
    {
        if (!empty($this->status)) {
            $this->status = $status;
        } else {
            OrderDaoImpl::setStatus($status, $this->id);
        }
    }

    /**
     * @return int
     */
    public function getCountNewOrders(): int
    {
        return OrderDaoImpl::getCountNewOrders();
    }
}