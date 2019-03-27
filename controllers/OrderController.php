<?php
require_once ROOT . '/models/Order.php';

class OrderController
{
    private $order = null;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function createOrder(array $bookId, $userId, $orderMessage)
    {
        $this->order->createOrder($bookId, $userId, $orderMessage);
    }
}