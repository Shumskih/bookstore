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

    private $inStock = false;

    private $quantity = 0;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param null $authorName
     */
    public function setAuthorName($authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return null
     */
    public function getAuthorSurname()
    {
        return $this->authorSurname;
    }

    /**
     * @param null $authorSurname
     */
    public function setAuthorSurname($authorSurname): void
    {
        $this->authorSurname = $authorSurname;
    }

    /**
     * @return null
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param null $pages
     */
    public function setPages($pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param null $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return null
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param null $added
     */
    public function setAdded($added): void
    {
        $this->added = $added;
    }

    /**
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->inStock;
    }

    /**
     * @param bool $inStock
     */
    public function setInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
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
          'categories',
        ];
    }
}