<?php

class User implements Model
{

    private $id;

    private $name;

    private $surname;

    private $email;

    private $password;

    private $mobilePhone;

    // Object Address
    private $address;

    // Array of Role Objects
    private $roles = [];

    public function __sleep()
    {
        return [
          'id',
          'name',
          'surname',
          'email',
          'mobilePhone',
          'address',
          'roles'
        ];
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
     * @return Address
     */
    public function getAddress(): Address
    {
        if (!empty($this->address)) {
            return $this->address;
        } else {
            return UserDaoImpl::getAddress($this->id);
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
    public function getRoles(): Role
    {
        if (!empty($this->roles)) {
            return $this->roles;
        } else {
            return UserDaoImpl::getRoles($this->id);
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

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function update($user)
    {
        $user = (object)$user;
        UserDaoImpl::update($user);

        $address = (object)$user->getAddress();
        $addressController = new AddressController();
        $addressController->update($address);
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function login($email, $password)
    {
        if ($user = CheckUser::isUserExists($email, $password)) {
            $roles = $user->getRoles();

            $session = new UserSessionController();

            foreach ($roles as $role) {
                $role = (object)$role;

                if ($role->getName() == 'User') {
                    $session->setRoleUser();
                }

                if ($role->getName() == 'Content Manager') {
                    $session->setRoleContentManager();
                }

                if ($role->getName() == 'Super User') {
                    $session->setRoleSuperUser();
                }
            }
            $session->create($user);

            unset($role);
            unset($user);

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
        $session = new UserSessionController();
        $session->delete();
        unset($session);
    }

    public function checkPermissions() : bool
    {
        if (!isset($_SESSION['email']))
            return false;
        else {
            $userController = new UserController();
            $user           = $userController->getUserByEmail($_SESSION['email']);
            $roles          = $user->getRoles();
            $permission     = false;
            foreach ($roles as $role) {
                $role = (object)$role;
                $name = $role->getName();
                if ($name == 'Content Manager' || $name == 'Super User') {
                    $permission = true;
                }
                unset($role);
                unset($userController);
                unset($user);
            }
        }

        if ($permission)
            return true;

        return false;
    }
}