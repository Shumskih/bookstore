<?php
require_once ROOT . '/models/Session/CartSession.php';

class CartSessionController
{

    private $cartSession = null;

    public function __construct()
    {
        $this->cartSession = new CartSession();
    }

    public function create($cart)
    {
        $this->cartSession->create($cart);
    }

    function read()
    {
        return $this->cartSession->read();
    }

    function update($cart)
    {
        $this->cartSession->update($cart);
    }

    function delete()
    {
        $this->cartSession->delete();
    }
}