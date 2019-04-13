<?php


class BookController extends Controller
{

    /**
     * @var \Book
     */
    private $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function read($id): Book
    {
        return $this->book->read($id);
    }

    public function readAll()
    {
        return $this->book->readAll();
    }

    public function getNewBooks(int $quantity = 6): array
    {
        return $this->book->getNewBooks($quantity);
    }
}