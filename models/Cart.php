<?php
require_once ROOT . '/models/Model.php';
require_once ROOT . '/controllers/UserController.php';
require_once ROOT . '/controllers/DeliveryController.php';

class Cart
{

    // Cart id
    private $id = null;

    // Quantity of books
    private $qty = null;

    // Book object
    private $book = null;

    private $total = null;

    private $cartTotal = null;

    private $subTotal = null;

    private $grandTotal = null;

    private $shippingMethod = null;

    // Array of Delivery objects
    private $deliveries = [];

    // Array of Book objects
    private $books = [];

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
        if (isset($_SESSION['cart'])) {
            $grandTotal = null;
            $bookTotal  = null;
            $count      = count($_SESSION['cart']);
            for ($i = 0; $i < $count; $i++) {
                $this->book = (object)unserialize($_SESSION['cart'][$i]['book']);
                $bookTotal  = $this->book->getPrice() * $_SESSION['cart'][$i]['qty'];
                $grandTotal += $bookTotal;
                unset($this->book);
            }
            $_SESSION['grandTotal'] = $grandTotal;
        }
    }

    public function updateCart()
    {
        $count = count($_SESSION['cart']);
        for ($i = 0; $i < $count; $i++) {
            $this->book                  = (object)unserialize($_SESSION['cart'][$i]['book']);
            $inputName                   = strtr($this->book->getTitle(), " ", "_");
            $inputName                   = strtr($inputName, ".", "_");
            $_SESSION['cart'][$i]['qty'] = $_POST[$inputName];
            unset($this->book);
        }
    }

    public function deleteBook()
    {
        $count = count($_SESSION['cart']);
        if ($count == 1) {
            unset($_SESSION['cart']);
        } else {
            for ($i = 0; $i < $count; $i++) {
                $this->book = (object)unserialize($_SESSION['cart'][$i]['book']);

                if ($_GET['id'] == $this->book->getId()) {
                    unset($_SESSION['cart'][$i]);
                }
                unset($this->book);
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    public function checkout($shippingMethod = 'Courier')
    {
        $vars = [];

        $this->shippingMethod = $shippingMethod;

        $userController = new UserController();
        $user           = $userController->getUserByEmail($_SESSION['email']);

        $count = count($_SESSION['cart']);
        for ($i = 0; $i < $count; $i++) {
            $this->book = (object)unserialize($_SESSION['cart'][$i]['book']);
            $qty        = $_SESSION['cart'][$i]['qty'];
            array_push($this->books, ['book' => $this->book, 'qty' => $qty]);
            unset($this->book);
        }

        $deliveryController = new DeliveryController();
        $this->deliveries   = $deliveryController->readAll();

        foreach ($this->deliveries as $delivery) {
            if ($delivery['delivery_method'] == $shippingMethod) {
                $_SESSION['shippingMethod'] = $delivery['delivery_method'];
                $_SESSION['shippingCost']   = $delivery['delivery_cost'];
            }
        }

        array_push($vars, ['user' => $user]);
        array_push($vars, ['books' => $this->books]);
        array_push($vars, ['deliveries' => $this->deliveries]);


        unset($userController);
        unset($deliveryController);
        unset($user);
        unset($count);
        unset($qty);

        return $vars;
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
     * @return null
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * @param null $shippingMethod
     */
    public function setShippingMethod($shippingMethod): void
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * @return array
     */
    public function getDeliveries(): array
    {
        return $this->deliveries;
    }

    /**
     * @param array $deliveries
     */
    public function setDeliveries(array $deliveries): void
    {
        $this->deliveries = $deliveries;
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

}