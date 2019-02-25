<?php
require_once ROOT . '/dao/ArticleDaoImpl.php';
require_once ROOT . '/model/Book.php';


class BookController
{

  private $articleDao;

  private $id;

  public function __construct($id)
  {
    $this->articleDao = new ArticleDaoImpl();
    $this->id         = $id;
  }

  public function getBook($id)
  {
    $book    = $this->articleDao->read($id);
    $setBook = new Book(
      $book['title'], $book['authorName'], $book['authorSurname'],
      $book['description'], $book['pages']
    );

    return $setBook;
  }

  public function render()
  {
    $book = $this->getBook($this->id);
    include ROOT . '/views/book.html.php';
  }
}