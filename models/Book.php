<?php
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

    function create($book)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param int $id
     *
     * @return $this object
     */
    function read($id): Book
    {
        $book = BookDaoImpl::read($id);
        $this->id = $book['id'];
        $this->title = $book['title'];
        $this->authorName = $book['authorName'];
        $this->authorSurname = $book['authorSurname'];
        $this->pages = $book['pages'];
        $this->description = $book['description'];
        $this->img = $book['img'];
        $this->price = $book['price'];
        $this->added = $book['added'];
        $this->inStock = $book['inStock'];
        $this->quantity = $book['quantity'];

        FiveLastViewedBooks::lastViewedBooks($book);

        unset($book);

        return $this;
    }

    function readAll(): array
    {
        return BookDaoImpl::readAll();
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
        return BookDaoImpl::getNewBooks($quantity);
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

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $categories = BookDaoImpl::getCategories($this->id);

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
          'inStock',
          'quantity'
        ];
    }
}