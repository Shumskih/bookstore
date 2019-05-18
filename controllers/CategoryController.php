<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/Controller.php';

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
}