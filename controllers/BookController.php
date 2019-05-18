<?php


class BookController extends Controller
{

    /**
     * @var \Book
     */
    private $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function create($book)
    {
        return $this->book->create($book);
    }

    public function read($id): Book
    {
        return $this->book->read($id);
    }

    public function readAll()
    {
        return $this->book->readAll();
    }

    public function update($book)
    {
        $this->book->update($book);
    }

    public function delete($id)
    {
        $this->book->delete($id);
    }

    public function getNewBooks(int $quantity = 6): array
    {
        return $this->book->getNewBooks($quantity);
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->book->getId();
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->book->setId($id);
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->book->getTitle();
    }

    /**
     * @param null $title
     */
    public function setTitle($title): void
    {
        $this->book->setTitle($title);
    }

    /**
     * @return null
     */
    public function getAuthorName()
    {
        return $this->book->getAuthorName();
    }

    /**
     * @param null $authorName
     */
    public function setAuthorName($authorName): void
    {
        $this->book->setAuthorName($authorName);
    }

    /**
     * @return null
     */
    public function getAuthorSurname()
    {
        return $this->book->getAuthorSurname();
    }

    /**
     * @param null $authorSurname
     */
    public function setAuthorSurname($authorSurname): void
    {
        $this->book->setAuthorSurname($authorSurname);
    }

    /**
     * @return null
     */
    public function getPages()
    {
        return $this->book->getPages();
    }

    /**
     * @param null $pages
     */
    public function setPages($pages): void
    {
        $this->book->setPages($pages);
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->book->getDescription();
    }

    /**
     * @param null $description
     */
    public function setDescription($description): void
    {
        $this->book->setDescription($description);
    }

    public function getImages(): array
    {
        return $this->book->getImages();
    }

    public function setImages(array $images)
    {
        $this->book->setImages($images);
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->book->getPrice();
    }

    /**
     * @param null $price
     */
    public function setPrice($price): void
    {
        $this->book->setPrice($price);
    }

    /**
     * @return null
     */
    public function getAddedAt()
    {
        return $this->book->getAddedAt();
    }

    /**
     * @param null $added
     */
    public function setAddedAt($added): void
    {
        $this->book->setAddedAt($added);
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->book->setUpdatedAt($updatedAt);
    }

    public function getUpdatedAt()
    {
        return $this->book->getUpdatedAt();
    }

    /**
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->book->isInStock();
    }

    /**
     * @param bool $inStock
     */
    public function setInStock(bool $inStock): void
    {
        $this->book->setInStock($inStock);
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->book->getQuantity();
    }

    public function setQuantity($quantity)
    {
        $this->book->setQuantity($quantity);
    }

    public function getCategories()
    {
        return $this->book->getCategories();
    }

    public function setCategories($categories)
    {
        $this->book->setCategories($categories);
    }
}