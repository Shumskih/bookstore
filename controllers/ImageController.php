<?php


class ImageController extends Controller
{
    private $image = null;

    public function __construct()
    {
        $this->image = new Image();
    }

    function create($image)
    {
        return $this->image->create($image);
    }

    function read($id)
    {
        return $this->image->read($id);
    }

    function readAll()
    {
        return $this->image->readAll();
    }

    function update($image)
    {
        $this->image->update($image);
    }

    function delete($id)
    {
        $this->image->delete($id);
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->image->getId();
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->image->setId($id);
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->image->getPath();
    }

    /**
     * @param null $path
     */
    public function setPath($path): void
    {
        $this->image->setPath($path);
    }
}