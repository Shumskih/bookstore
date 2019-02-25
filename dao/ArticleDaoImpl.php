<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/dao/Dao.php';
require_once ROOT . '/dao/ConnectionUtil.php';

class ArticleDaoImpl implements Dao
{
  private $connection;

  public function __construct()
  {
    $this->connection = ConnectionUtil::getConnection();
  }

  function create()
  {
    // TODO: Implement create() method.
  }

  public function read($id)
  {
    $query = 'SELECT * FROM books WHERE id = :id';
    $stmt = $this->connection->prepare($query);
    $stmt->execute([
      'id' => $id
    ]);
    return $stmt->fetch();
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