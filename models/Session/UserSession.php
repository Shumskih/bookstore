<?php
require_once ROOT . '/models/Session/Session.php';

class UserSession implements Session
{

    // SESSION[self::ITEM]
    const USER = 'user';

    const CONTENT_MANAGER = 'content manager';

    const SUPER_USER = 'super user';

    const LOGIN = 'login';

    private $sessionUser = [];

    // User object
    private $user = null;

    private $roleUser = null;

    private $roleContentManager = null;

    private $roleSuperUser = null;

    private $roles = [];

    function create($user)
    {
        $this->user            = $user;
        $_SESSION[self::LOGIN] = true;
        $_SESSION[self::USER]  = serialize($this->user);

        array_push($this->sessionUser, $_SESSION[self::LOGIN]);
        array_push($this->sessionUser, $_SESSION[self::USER]);
    }

    function read() : \User
    {
        // TODO: Implement read() method.
    }

    function update($user)
    {
        // TODO: Implement update() method.
    }

    function delete()
    {
        unset($_SESSION[self::USER]);
        unset($_SESSION[self::LOGIN]);
        unset($this->sessionUser);
        unset($this->roles);
    }

    /**
     * @return null
     */
    public function getUser()
    {
        if (isset($_SESSION[self::USER])) {
            return $_SESSION[self::USER];
        }

        return false;
    }

    /**
     * @param null $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return null
     */
    public function getRoleUser()
    {
        if (isset($_SESSION[self::USER])) {
            return $_SESSION[self::USER];
        }
        return false;
    }

    /**
     * @param null $roleUser
     */
    public function setRoleUser(): void
    {
        $this->roleUser = self::USER;
        array_push($roles, $this->roleUser);
        $_SESSION[$this->roleUser] = true;
    }

    /**
     * @return null
     */
    public function getRoleContentManager()
    {
        if (isset($_SESSION[self::CONTENT_MANAGER])) {
            return $_SESSION[self::CONTENT_MANAGER];
        }
        return false;
    }

    /**
     * @param null $roleContentManager
     */
    public function setRoleContentManager(): void
    {
        $this->roleContentManager = self::CONTENT_MANAGER;
        array_push($roles, $this->roleContentManager);
        $_SESSION[$this->roleContentManager] = true;
    }

    /**
     * @return null
     */
    public function getRoleSuperUser()
    {
        if (isset($_SESSION[self::SUPER_USER])) {
            return $_SESSION[self::SUPER_USER];
        }
        return false;
    }

    /**
     * @param null $roleSuperUser
     */
    public function setRoleSuperUser(): void
    {
        $this->roleSuperUser = self::SUPER_USER;
        array_push($roles, $this->roleSuperUser);
        $_SESSION[$this->roleSuperUser] = true;
    }
}