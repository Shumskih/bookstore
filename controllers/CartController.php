<?php
require_once ROOT . '/helpers/consts.php';
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Book.php';
require_once ROOT . '/models/Cart.php';

class CartController extends Controller
{

    private $cart = null;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function addToCart()
    {
        $this->cart->addToCart();
    }

    public function getCart()
    {
        return $this->cart->getCart();
    }

    public function updateCart()
    {
        $this->cart->updateCart();
    }

    public function deleteBook()
    {
        $this->cart->deleteBook();
    }
}