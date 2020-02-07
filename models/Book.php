<?php

class Book implements Model
{

    private int $id;
    private string $title;
    private string $authorName;
    private string $authorSurname;
    private int $pages;
    private string $description;
    private float $price;
    private string $addedAt;
    private string $updatedAt;
    private bool $inStock;
    private int $quantity;

    /**
     * @var array of Category objects
     */
    private array $categories = [];

    /**
     * @var array of Image objects
     */
    private array $images = [];

    public function __construct(
        int $id = 0,
        string $title = '',
        string $authorName = '',
        string $authorSurname = '',
        int $pages = 0,
        string $description = '',
        float $price = 0,
        string $addedAt = '',
        string $inStock = '',
        int $quantity = 0
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


    /**
     * @param $book
     * @return int
     */
    function create($book): int
    {
        $this->createBookObject($book);
        return BookDaoImpl::create($book);
    }

    /**
     * @param int $id
     *
     * @return $this object
     */
    function read($id): Book
    {
        return $this->createBookObject(BookDaoImpl::read($id));
    }

    function readAll(): array
    {
        $booksArray = BookDaoImpl::readAll();
        $booksArrayOfObjects = [];

        foreach ($booksArray as $book) {
            $newBookObj = new Book();
            $newBookObj->setId($book['id']);
            $newBookObj->setTitle($book['title']);
            $newBookObj->setAuthorName($book['authorName']);
            $newBookObj->setAuthorSurname($book['authorSurname']);
            $newBookObj->setDescription($book['description']);
            $newBookObj->setPrice($book['price']);

            array_unshift($booksArrayOfObjects, $newBookObj);
        }
        return $booksArrayOfObjects;
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

    private function createBookObject($book): Book
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
     * @param int $pages
     */
    public function setPages(int $pages): void
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
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getAddedAt(): string
    {
        return $this->addedAt;
    }

    /**
     * @param string $addedAt
     */
    public function setAddedAt(string $addedAt): void
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
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


    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
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