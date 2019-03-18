<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/models/Address.php';
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

    private $mobilePhone;

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
     * @return \Address
     */
    public function getAddress($userId) : \Address
    {
        try {
            $query = SqlQueries::GET_USER_ADDRESS;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $userId
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get user\'s address from database<br>' . $e->getMessage();
        }
        $result = $stmt->fetch();

        $this->address = new Address();
        $this->address->setId($result['id']);
        $this->address->setCountry($result['country']);
        $this->address->setRegion($result['region']);
        $this->address->setCity($result['city']);
        $this->address->setStreet($result['street']);
        $this->address->setBuilding($result['building']);
        $this->address->setApartment($result['apartment']);

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

    /**
     * @return mixed
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param mixed $mobilePhone
     */
    public function setMobilePhone($mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    function create()
    {
        echo 'Creating user info.';
    }

    function read($id): User
    {

        return $this;
    }

    public function readUserByEmail($email): \User
    {
        try {
            $query = SqlQueries::GET_BY_EMAIL;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'email' => $email,
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get user from database<br>' . $e->getMessage();
        }

        $user = $stmt->fetch();

        $this->setId($user['id']);
        $this->setName($user['name']);
        $this->setSurname($user['surname']);
        $this->setMobilePhone($user['mobile_phone']);
        $this->setEmail($user['email']);

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
            $_SESSION['login']    = true;
            $_SESSION['email']    = $email;
            $_SESSION['password'] = $password;

            return true;
        } else {
            return false;
        }
    }

    public function register($email, $password)
    {
        if (CheckUser::isEmailExists($email)) {
            return false;
        } else {
            try {
                $query = SqlQueries::REGISTER_NEW_USER;
                $stmt  = $this->pdo->prepare($query);
                $stmt->execute([
                  'email'    => $email,
                  'password' => $password,
                ]);
            } catch (PDOException $e) {
                echo 'Can\'t insert new user to database<br>' . $e->getMessage();
            }

            $this->login($email, $password);

            return true;
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
    }
}