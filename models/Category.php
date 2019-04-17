<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Model.php';

class Category implements Model
{

    private $id;

    private $name;

    // Array of Book objects
    private $books = [];

    private $pdo;

    /**
     * Category constructor.
     * Get instance of PDO object and assign it to $pdo variable
     */
    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

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
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
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
        try {
            $query = SqlQueries::GET_CATEGORY;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);
            $category = $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Can\'t get category<br>' . $e->getMessage();
        }
        $this->id   = $category['id'];
        $this->name = $category['name'];

        $this->readBooksByCategory();

        return $this;
    }

    function readBooksByCategory()
    {
        try {
            $query = SqlQueries::GET_BOOKS_BY_CATEGORY;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $this->id,
            ]);
            $books = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t get books by category<br>' . $e->getMessage();
        }

        foreach ($books as $b) {
            $book = new Book();
            $book->setId($b[0]);
            $book->setTitle($b['title']);
            $book->setAuthorName($b['authorName']);
            $book->setAuthorSurname($b['authorSurname']);
            $book->setDescription($b['description']);
            $book->setPages($b['pages']);
            $book->setImg($b['img']);
            $book->setPrice($b['price']);
            $book->setAdded($b['added']);

            array_unshift($this->books, $book);
            unset($book);
        }
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

    public
    function getCountBooks(): int
    {
        try {
            $query = SqlQueries::COUNT_BOOKS_IN_CATEGORY;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $this->getId(),
            ]);
            $count = $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Can\'t get count of books<br>' . $e->getMessage();
        }

        return (int)$count['count'];
    }
}