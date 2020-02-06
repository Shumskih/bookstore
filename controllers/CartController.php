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
        $this->cart->getCart();
    }

    public function updateCart()
    {
        $this->cart->updateCart();
    }

    public function deleteBook()
    {
        $this->cart->deleteBook();
    }

    public function checkout($shippingMethod)
    {
        return $this->cart->checkout($shippingMethod);
    }

    public function deleteCart()
    {
        $this->cart->deleteCart();
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }


}