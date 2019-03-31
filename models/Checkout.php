<?php


class Checkout implements Model
{

    // Checkout id
    private $id = null;

    // User object
    private $user = null;

    // Book object
    private $book = null;

    // Book quantity
    private $qty = null;

    // Book objects with quantities
    private $books = [];

    // Delivery object
    private $delivery = null;

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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return null
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param null $book
     */
    public function setBook($book): void
    {
        $this->book = $book;
    }

    /**
     * @return null
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param null $qty
     */
    public function setQty($qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * @param array $books
     */
    public function setBooks(array $books): void
    {
        $this->books = $books;
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
    public function setDelivery($delivery): void
    {
        $this->delivery = $delivery;
    }
}