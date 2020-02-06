<?php
require_once ROOT . '/models/session/SessionInterface.php';

class CartSession implements SessionInterface
{

    // SESSION[self::ITEM]
    const CART = 'cart';

    private $cart = null;

    function create($cart)
    {
        $this->cart = (object)$cart;

        if (isset($_SESSION[self::CART])) {
            $this->update($cart);
        }

        if (!isset($_SESSION[self::CART])) {
            $_SESSION[self::CART] = [];
            array_push($_SESSION[self::CART], ['book' => serialize($this->cart->getBook()), 'qty' => $this->cart->getBookQty()]);
        }

        unset($cart);
        unset($this->cart);
    }

    function read(): array
    {
        return $_SESSION[self::CART];
    }

    function update($cart)
    {
        $this->cart = (object)$cart;
        array_push($_SESSION[self::CART], ['book' => serialize($this->cart->getBook()), 'qty' => $this->cart->getBookQty()]);

        unset($cart);
        unset($this->cart);
    }

    function delete()
    {
        unset($_SESSION[self::CART]);
    }
}