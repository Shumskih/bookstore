<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/sql/SqlQueries.php';
require_once ROOT . '/helpers/ConnectionUtil.php';

class Address implements Model
{

    private $id = null;

    private $country = null;

    private $district = null;

    private $city = null;

    private $street = null;

    private $building = null;

    private $apartment = null;

    private $postcode = null;

    // User object
    private $user = null;

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
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $region
     */
    public function setDistrict($district): void
    {
        $this->district = $district;
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

    /**
     * @return null
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param null $postcode
     */
    public function setPostcode($postcode): void
    {
        $this->postcode = $postcode;
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
            $this->pdo
              ->prepare($query)
              ->execute([
                'id'        => $address->getId(),
                'country'   => $address->getCountry(),
                'district'  => $address->getDistrict(),
                'city'      => $address->getCity(),
                'street'    => $address->getStreet(),
                'building'  => $address->getBuilding(),
                'apartment' => $address->getApartment(),
                'postcode'  => $address->getPostcode(),
              ]);
        } catch (PDOException $e) {
            echo 'Can\'t update address in database<br>' . $e->getMessage() . '<br>';
        }
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }


}