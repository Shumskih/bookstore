<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/models/Model.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/helpers/ConnectionUtil.php';
require_once ROOT . '/helpers/FiveLastViewedBooks.php';
require_once ROOT . '/sql/SqlQueries.php';

/**
 * Class Book
 */
class Book implements Model
{

    private $id = null;

    private $title = null;

    private $authorName = null;

    private $authorSurname = null;

    private $pages = null;

    private $description = null;

    private $img = null;

    private $price = null;

    private $added = null;

    /**
     * @var array of Category objects
     */
    private $categories = [];

    /**
     * @var \PDO|null
     */
    private $pdo;

    /**
     * Book constructor.
     * Get instance of PDO object and assign it to $pdo variable
     */
    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

    function create($book)
    {
        // TODO: Implement create() method.
    }


    /**
     * @param int $id
     *
     * @return $this object
     */
    function read($id)
    {
        try {
            $query = SqlQueries::GET_BOOK;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $id,
            ]);

            $book = $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Can\'t get book from database<br>' . $e->getMessage();
        }
        $this->id            = $book['id'];
        $this->title         = $book['title'];
        $this->authorName    = $book['authorName'];
        $this->authorSurname = $book['authorSurname'];
        $this->description   = $book['description'];
        $this->pages         = $book['pages'];
        $this->img           = $book['img'];
        $this->price         = $book['price'];

        FiveLastViewedBooks::lastViewedBooks($book);

        return $this;
    }

    function readAll(): array
    {
        try {
            $query = SqlQueries::GET_ALL_BOOKS;
            $stmt  = $this->pdo->query($query);
        } catch (PDOException $e) {
            echo 'Can\'t get all books<br>' . $e->getMessage();
        }
        return $stmt->fetchAll();
    }


    function update($book)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getNewBooks(int $quantity = 6): array
    {
        try {
            $query = SqlQueries::GET_NEW_BOOKS;
            $stmt  = $this->pdo->prepare($query);
            $stmt->bindParam(
              ':quantity', $quantity, PDO::PARAM_INT
            );
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Can\'t get new books<br>' . $e->getMessage();
        }
        return $stmt->fetchAll();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages(int $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string
     */
    public function getAuthorSurname()
    {
        return $this->authorSurname;
    }

    /**
     * @param string $authorSurname
     */
    public function setAuthorSurname($authorSurname): void
    {
        $this->authorSurname = $authorSurname;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
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

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param mixed $added
     */
    public function setAdded($added): void
    {
        $this->added = $added;
    }


    /**
     * @return array
     */
    public function getCategories()
    {
        try {
            $query = SqlQueries::GET_CATEGORIES_OF_BOOK;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
              'id' => $this->getId(),
            ]);
            $categories = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t get categories of book<br>' . $e->getMessage();
        }

        foreach ($categories as $c) {
            $category = new Category();
            $category->setId($c['id']);
            $category->setName($c['name']);

            array_unshift($this->categories, $category);

            unset($category);
        }

        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function __sleep()
    {
        return [
          'id',
          'title',
          'authorName',
          'authorSurname',
          'pages',
          'description',
          'img',
          'price',
          'added',
          'categories'
        ];
    }
}