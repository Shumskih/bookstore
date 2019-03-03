<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/sql/SqlQueries.php';
require_once ROOT . '/helpers/ConnectionUtil.php';

class Address implements Model
{
  private $id;

  private $country;

  private $region;

  private $city;

  private $street;

  private $building;

  private $apartment;

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
  public function getCountry()
  {
    return $this->country;
  }

  /**
   * @param mixed $country
   */
  public function setCountry($country): void
  {
    $this->country = $country;
  }

  /**
   * @return mixed
   */
  public function getRegion()
  {
    return $this->region;
  }

  /**
   * @param mixed $region
   */
  public function setRegion($region): void
  {
    $this->region = $region;
  }

  /**
   * @return mixed
   */
  public function getCity()
  {
    return $this->city;
  }

  /**
   * @param mixed $city
   */
  public function setCity($city): void
  {
    $this->city = $city;
  }

  /**
   * @return mixed
   */
  public function getStreet()
  {
    return $this->street;
  }

  /**
   * @param mixed $street
   */
  public function setStreet($street): void
  {
    $this->street = $street;
  }

  /**
   * @return mixed
   */
  public function getBuilding()
  {
    return $this->building;
  }

  /**
   * @param mixed $building
   */
  public function setBuilding($building): void
  {
    $this->building = $building;
  }

  /**
   * @return mixed
   */
  public function getApartment()
  {
    return $this->apartment;
  }

  /**
   * @param mixed $apartment
   */
  public function setApartment($apartment): void
  {
    $this->apartment = $apartment;
  }

  function create()
  {
    // TODO: Implement create() method.
  }

  function read($id)
  {

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


}