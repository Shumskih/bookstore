<?php
require_once ROOT . '/models/Session.php';

class CartSession implements Session
{

    // SESSION[self::ITEM]
    const CART = 'cart';

    private $cart = null;

    function create($cart)
    {
        $this->cart = (object) $cart;

        if (isset($_SESSION[self::CART])) {
            $this->update($cart);
        }

        if (!isset($_SESSION[self::CART])) {
            $_SESSION[self::CART] = [];
            array_push($_SESSION[self::CART], ['book' => serialize($this->cart->getBook()), 'qty' => $this->cart->getBooksQty()]);
        }

        unset($cart);
        unset($this->cart);
    }

    function read() : \Cart
    {
        // TODO: Implement read() method.
    }

    function update($cart)
    {
        $this->cart = (object) $cart;
        array_push($_SESSION[self::CART], ['book' => serialize($this->cart->getBook()), 'qty' => $this->cart->getBookQty()]);

        unset($cart);
        unset($this->cart);
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }
}