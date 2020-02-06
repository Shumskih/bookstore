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

    private $price = null;

    private $addedAt = null;

    private $updatedAt = null;

    private $inStock = false;

    private $quantity = 0;

    /**
     * @var array of Category objects
     */
    private $categories = [];

    /**
     * @var array of Image objects
     */
    private $images = [];

    public function __construct(
        $id = NULL,
        $title = NULL,
        $authorName = NULL,
        $authorSurname = NULL,
        $pages = NULL,
        $description = NULL,
        $price = NULL,
        $addedAt = NULL,
        $inStock = NULL,
        $quantity = NULL
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->authorName = $authorName;
        $this->authorSurname = $authorSurname;
        $this->pages = $pages;
        $this->description = $description;
        $this->price = $price;
        $this->addedAt = $addedAt;
        $this->inStock = $inStock;
        $this->quantity = $quantity;
    }

    function create($book): int
    {
        return BookDaoImpl::create($book);
    }

    /**
     * @param int $id
     *
     * @return $this object
     */
    function read($id): Book
    {
        $book = $this->createBookObject(BookDaoImpl::read($id));

        return $book;
    }

    function readAll(): array
    {
        return BookDaoImpl::readAll();
    }


    function update($book)
    {
        BookDaoImpl::update($book);
    }

    function delete($id)
    {
        BookDaoImpl::delete($id);
    }


    /**
     * @param int $quantity
     * @return array of books objects
     */
    public function getNewBooks(int $quantity = 6): array
    {
        $books = BookDaoImpl::getNewBooks($quantity);
        $bookObjects = [];

        foreach ($books as $book) {
            array_unshift($bookObjects, $this->createBookObject($book));
        }

        return $bookObjects;
    }

    private function createBookObject($book): \Book
    {
        return new Book(
            $book['id'],
            $book['title'],
            $book['authorName'],
            $book['authorSurname'],
            $book['pages'],
            $book['description'],
            $book['price'],
            $book['addedAt'],
            $book['inStock'],
            $book['quantity']
        );
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
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * @param null $addedAt
     */
    public function setAddedAt($addedAt): void
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param null $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
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

    /**
     * @return array
     */
    public function getImages(): array
    {
        if (!empty($this->images)) {
            return $this->images;
        } else {
            $images = BookDaoImpl::getImages($this->id);

            foreach ($images as $image) {
                $imageController = new ImageController();
                $image = $imageController->read($image['id']);

                array_push($this->images, $image);
                unset($imageController);
            }
        }
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
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
            'price',
            'addedAt',
            'categories',
            'images',
            'inStock',
            'quantity',
        ];
    }
}