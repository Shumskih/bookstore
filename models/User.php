<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/sql/SqlQueries.php';
require_once ROOT . '/helpers/ConnectionUtil.php';
require_once ROOT . '/helpers/CheckUser.php';

class User implements Model
{

  private $id;

  private $name;

  private $surname;

  private $email;

  private $password;

  private $address;

  private $pdo;

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
   * @return mixed
   */
  public function getSurname()
  {
    return $this->surname;
  }

  /**
   * @param mixed $surname
   */
  public function setSurname($surname): void
  {
    $this->surname = $surname;
  }

  /**
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * @param mixed $address
   */
  public function setAddress($address): void
  {
    $this->address = $address;
  }

  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email): void
  {
    $this->email = $email;
  }

  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password): void
  {
    $this->password = $password;
  }

  function create()
  {
    // TODO: Implement create() method.
  }

  function read($id) : User
  {

    return $this;
  }

  function readAll()
  {
    // TODO: Implement readAll() method.
  }

  function update($id)
  {
    // TODO: Implement update() method.
  }

  function delete($id)
  {
    // TODO: Implement delete() method.
  }

  public function login($email, $password)
  {
    if (CheckUser::isUserExists($email, $password)) {
      $_SESSION['login'] = true;
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;

      return true;
    } else {
      return false;
    }
  }
}