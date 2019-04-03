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
}