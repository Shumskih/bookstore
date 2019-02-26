<?php
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/Book.php';


class BookController extends Controller
{

  /**
   * @var \Book
   */
  private $book;
  private $id;

  public function __construct()
  {
    $this->book = new Book();
  }

  public function getBook($id)
  {
    return $this->book->read($id);
  }

  public function getAllBooks()
  {
    return $this->book->readAll();
  }
}