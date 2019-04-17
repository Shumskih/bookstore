<?php
require_once ROOT . '/models/session/SessionInterface.php';

class UserSession implements SessionInterface
{

    // SESSION[self::ITEM]
    const USER = 'user';

    const CONTENT_MANAGER = 'content manager';

    const SUPER_USER = 'super user';

    const LOGIN = 'login';

    private $sessionUser = [];

    // User object
    private $user = null;

    private $roles = [];

    function create($user)
    {
        $_SESSION[self::LOGIN] = true;
        $_SESSION[self::USER]  = serialize($user);
    }

    function read()
    {
        if (isset($_SESSION[self::USER]))
            return unserialize($_SESSION[self::USER]);
    }

    function update($user)
    {
        unset($_SESSION[self::USER]);
        $_SESSION[self::USER] = serialize($user);
    }

    function delete()
    {
        unset($_SESSION[self::USER]);
        unset($_SESSION[self::LOGIN]);
        unset($this->sessionUser);
        if (isset($_SESSION[self::CONTENT_MANAGER]))
            unset($_SESSION[self::CONTENT_MANAGER]);
        if (isset($_SESSION[self::SUPER_USER]))
            unset($_SESSION[self::SUPER_USER]);
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
    public function getRoleContentManager()
    {
        if (isset($_SESSION[self::CONTENT_MANAGER])) {
            return true;
        }
        return false;
    }

    /**
     * @param null $roleContentManager
     */
    public function setRoleContentManager(): void
    {
        $_SESSION[self::CONTENT_MANAGER] = true;
    }

    /**
     * @return null
     */
    public function getRoleSuperUser()
    {
        if (isset($_SESSION[self::SUPER_USER])) {
            return true;
        }
        return false;
    }

    /**
     * @param null $roleSuperUser
     */
    public function setRoleSuperUser(): void
    {
        $_SESSION[self::SUPER_USER] = true;
    }
}