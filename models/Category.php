<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Model.php';

class Category implements Model
{
  private $id;

  private $name;

  private $books;

  private $pdo;

  /**
   * Category constructor.
   * Get instance of PDO object and assign it to $pdo variable
   */
  public function __construct()
  {
    $this->pdo = ConnectionUtil::getConnection();
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name): void
  {
    $this->name = $name;
  }

  /**
   * @return array
   */
  public function getBooks()
  {
    return $this->books;
  }

  /**
   * @param mixed $books
   */
  public function setBooks($books): void
  {
    $this->books = $books;
  }

  function create()
  {
    // TODO: Implement create() method.
  }

  function read($id)
  {
    // TODO: Implement read() method.
  }

  function readAll()
  {
    try {
      $query = SqlQueries::GET_ALL_CATEGORIES;
      $stmt = $this->pdo->query($query);
    } catch (PDOException $e) {
      echo 'Can\'t get all categories<br>' . $e->getMessage();
    }
    return $stmt->fetchAll();
  }

  function update($id)
  {
    // TODO: Implement update() method.
  }

  function delete($id)
  {
    // TODO: Implement delete() method.
  }


}