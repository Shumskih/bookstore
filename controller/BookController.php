<?php
require_once ROOT . '/dao/ArticleDaoImpl.php';
require_once ROOT . '/controller/Controller.php';
require_once ROOT . '/model/Book.php';


class BookController extends Controller
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
    return $this->articleDao->read($id);
  }

  public function getAllBooks()
  {

  }
}