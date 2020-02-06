<?php

class CategoryController extends Controller
{

    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function read($id)
    {
        return $this->category->read($id);
    }

    public function readAll()
    {
        return $this->category->readAll();
    }

    public function getCountBooks()
    {
        return $this->getCountBooks();
    }

    public function sortByName($o1, $o2)
    {
        return $this->category->sortByName($o1, $o2);
    }

    function create($model)
    {
        // TODO: Implement create() method.
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