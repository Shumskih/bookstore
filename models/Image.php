<?php


class Image implements Model
{
    private $id = null;
    private $path = null;

    function create($image)
    {
        return ImageDaoImpl::create($image);
    }

    function read($id)
    {
        return ImageDaoImpl::read($id);
    }

    function readAll()
    {
        return null;
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param null $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

}