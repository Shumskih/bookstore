<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Model.php';

class Category implements Model
{

    private $id;

    private $name;

    // Array of Book objects
    private $books = [];

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
     * @param $categoryId
     * @return array
     */
    public function getBooks(): array
    {
        if (!empty($this->books))
        {
            return $this->books;
        } else {
            $this->id = $_GET['id'];
            $books = CategoryDaoImpl::getBooks($this->id);

            foreach ($books as $book) {
                $bookController = new BookController();
                $bookController->setId($book['book_id']);
                $bookController->setTitle($book['book_title']);
                $bookController->setPrice($book['book_price']);

                array_push($this->books, $bookController);
            }
            return $this->books;
        }
    }

    /**
     * @param mixed $books
     */
    public function setBooks($books): void
    {
        $this->books = $books;
    }

    function create($category)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        return CategoryDaoImpl::read($id);
    }

    /**
     * @return int
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

    function readAll(): array
    {
        $categoriesArray = [];

        $categories = CategoryDaoImpl::readAll();

        foreach ($categories as $c) {
            $category = new Category();
            $category->setId($c['id']);
            $category->setName($c['name']);

            array_unshift($categoriesArray, $category);
            unset($category);
        }

        return $categoriesArray;
    }

    function update($category)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getCountBooks(): int
    {
        return CategoryDaoImpl::getCountBooks($this->id);
    }

    public function sortByName($o1, $o2)
    {
        return $o1->name <=> $o2->name;
    }
}