<?php


class RoleController
{
    private $role = null;

    public function __construct()
    {
        $this->role = new Role();
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->role->getId();
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->role->setId($id);
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->role->getName();
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->role->setName($name);
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->role->getDescription();
    }

    /**
     * @param null $description
     */
    public function setDescription($description): void
    {
        $this->role->setDescription($description);
    }

    /**
     * @return null
     */
    public function getUsers()
    {
        return $this->role->getUsers();
    }

    /**
     * @param null $users
     */
    public function setUsers($users): void
    {
        $this->role->setUsers($users);
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}