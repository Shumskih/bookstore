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

    public function getCategory($id)
    {
        return $this->category->read($id);
    }

    public function getAllCategories()
    {
        return $this->category->readAll();
    }

    public function getCountBooks()
    {
        return $this->getCountBooks();
    }
}