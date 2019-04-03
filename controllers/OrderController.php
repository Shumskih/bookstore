<?php
require_once ROOT . '/models/Order.php';

class OrderController
{

    private $order = null;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function create($model)
    {
        $this->order->create($model);
    }

    public function readAll()
    {
        return $this->order->readAll();
    }

    public function setId($id)
    {
        $this->order->setId($id);
    }

    public function getId()
    {
        return $this->order->getId();
    }

    public function getBooksAndQty()
    {
        return $this->order->getBooksAndQty();
    }

    public function setBooksAndQty($data)
    {
        $this->order->setBooksAndQty($data);
    }

    public function getUser()
    {
        return $this->order->getUser();
    }

    public function setUser($user)
    {
        $this->order->setUser($user);
    }

    public function getUserMessage()
    {
        return $this->order->getUserMessage();
    }

    public function setUserMessage($userMessage)
    {
        $this->order->setUserMessage($userMessage);
    }
}