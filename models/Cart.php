<?php
require_once ROOT . '/models/Model.php';

class Cart implements Model
{

    private $bookId = null;

    private $qty = null;

    private $book = null;

    private $total = null;

    private $cartTotal = null;

    private $subTotal = null;

    private $grandTotal = null;

    private $books = [];

    /**
     * @return null
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param null $bookId
     */
    public function setBookId($bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return null
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param null $qty
     */
    public function setQty($qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return null
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param null $book
     */
    public function setBook($book): void
    {
        $this->book = $book;
    }

    /**
     * @return null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param null $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return null
     */
    public function getCartTotal()
    {
        return $this->cartTotal;
    }

    /**
     * @param null $cartTotal
     */
    public function setCartTotal($cartTotal): void
    {
        $this->cartTotal = $cartTotal;
    }

    /**
     * @return null
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * @param null $subTotal
     */
    public function setSubTotal($subTotal): void
    {
        $this->subTotal = $subTotal;
    }

    /**
     * @return null
     */
    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    /**
     * @param null $grandTotal
     */
    public function setGrandTotal($grandTotal): void
    {
        $this->grandTotal = $grandTotal;
    }

    /**
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * @param array $books
     */
    public function setBooks(array $books): void
    {
        $this->books = $books;
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function addToCart()
    {
        $bookController = new BookController();

        $this->book = $bookController->getBook($_POST['id']);
        $this->qty  = $_POST['qty'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        array_push($_SESSION['cart'], ['book' => serialize($this->book), 'qty' => $this->qty]);
    }

    public function getCart()
    {

    }

    public function updateCart()
    {
        $count = count($_SESSION['cart']);
        for ($i = 0; $i < $count; $i++) {
            $book = (object) unserialize($_SESSION['cart'][$i]['book']);
            $inputName = strtr($book->getTitle(), " ", "_");
            $inputName = strtr($inputName, ".", "_");
            $_SESSION['cart'][$i]['qty'] = $_POST[$inputName];
            unset($book);
        }
    }

    public function deleteBook()
    {
        $count = count($_SESSION['cart']);
        if ($count == 1) {
            unset($_SESSION['cart']);
        } else {
            for ($i = 0; $i < $count; $i++) {
                if ($_GET['id'] == $_SESSION['cart'][$i]['bookId']) {
                    unset($_SESSION['cart'][$i]);
                }
            }
        }
    }
}