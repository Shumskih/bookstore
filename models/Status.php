<?php
require_once ROOT . '/models/Model.php';
require_once ROOT . '/dao/pdo/StatusDaoImpl.php';

class Status implements Model
{

    private $id = null;

    private $status = null;

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id): \Status
    {
        return StatusDaoImpl::read($id);
    }

    function readAll(): array
    {
        return StatusDaoImpl::readAll();
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}