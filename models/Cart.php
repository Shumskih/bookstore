<?php
require_once ROOT . '/models/Model.php';

class Cart implements Model
{

    private $bookId = null;

    private $qty = null;

    private $book = null;

    private $total = null;

    private $books = [];

    private $session = [];

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

    public function addToCart()
    {
        $this->bookId = $_POST['id'];
        $this->qty    = $_POST['qty'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        array_unshift($_SESSION['cart'], ['bookId' => $this->bookId, 'qty' => $this->qty]);
    }

}