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

    function read($id) : Order
    {
        // TODO: Implement read() method.
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
    public function setUser(User $user): void
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
    public function setDelivery(Delivery $delivery): void
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
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}