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

    private $user;

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

    function create($address)
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

    function update($address)
    {
        $address = (object)$address;
        try {
            $query = SqlQueries::UPDATE_ADDRESS;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $address->getId(),
              'country' => $address->getCountry(),
              'region' => $address->getRegion(),
              'city' => $address->getCity(),
              'street' => $address->getStreet(),
              'building' => $address->getBuilding(),
              'apartment' => $address->getApartment()
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t update address in database<br>' . $e->getMessage();
        }
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }


}