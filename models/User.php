<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/models/Address.php';
require_once ROOT . '/models/Role.php';
require_once ROOT . '/controllers/AddressController.php';
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

    // Object
    private $address;

    // Array of Roles Objects
    private $roles = [];

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
    public function getAddress($userId): \Address
    {
        if (!empty($this->address)) {
            return $this->address;
        } else {
            try {
                $query = SqlQueries::GET_USER_ADDRESS;
                $stmt  = $this->pdo->prepare($query);
                $stmt->execute([
                  'id' => $userId,
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
    public function getRoles($userId): array
    {
        if (!empty($this->roles)) {
            return $this->roles;
        } else {
            try {
                $query = SqlQueries::GET_USER_ROLES;
                $stmt  = $this->pdo->prepare($query);
                $stmt->execute([
                  'id' => $userId,
                ]);
            } catch (PDOException $e) {
                echo 'Can\'t get user\'s roles from database<br>' . $e->getMessage();
            }
            $result = $stmt->fetchAll();

            foreach ($result as $r) {
                $role = new Role();
                $role->setId($r['id']);
                $role->setName($r['name']);
                $role->setDescription($r['description']);

                array_unshift($this->roles, $role);

                $role = null;
            }

            return $this->roles;
        }
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
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

    function create($user)
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

    function update($user)
    {
        $user = (object)$user;
        try {
            $query = SqlQueries::UPDATE_USER;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id'          => $user->getId(),
              'name'        => $user->getName(),
              'surname'     => $user->getSurname(),
              'email'       => $user->getEmail(),
              'mobilePhone' => $user->getMobilePhone(),
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t update user!<br>' . $e->getMessage();
        }

        $address = (object)$user->getAddress($user->getId());
        vardump($address);
        $addressController = new AddressController();
        $addressController->update($address);
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function login($email, $password)
    {
        if (CheckUser::isUserExists($email, $password)) {
            $user  = $this->readUserByEmail($email);
            $roles = $user->getRoles($user->getId());
            foreach ($roles as $role) {
                $role = (object)$role;

                if ($role->getName() == 'Content Manager') {
                    $_SESSION['content manager'] = true;
                }

                if ($role->getName() == 'Super User') {
                    $_SESSION['super user'] = true;
                }
            }
            $_SESSION['user']        = true;
            $_SESSION['userName']    = $user->getName();
            $_SESSION['userSurname'] = $user->getSurname();
            $_SESSION['login']       = true;
            $_SESSION['email']       = $email;
            $_SESSION['password']    = $password;

            $role = null;

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