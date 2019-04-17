<?php

class FrontController extends Controller
{

    public function indexPage()
    {
        $controller = new IndexPageController();
        $books      = $controller->getNewBooks();
        $controller->render(
          '/views/index.html.php',
          $books
        );
    }

    public function books()
    {
        $vars = [];

        $bookController = new BookController();
        $books          = $bookController->readAll();

        $categoryController = new Category();
        $categories         = $categoryController->readAll();

        array_unshift($vars, ['books' => $books]);
        array_unshift($vars, ['categories' => $categories]);

        $bookController->render(
          '/views/books/allBooks.html.php',
          $vars
        );
    }

    public function showBook($bookId)
    {
        $vars = [];

        $controller = new BookController();
        $book       = (object)$controller->read($bookId);

        $categoryController = new Category();
        $categories         = $categoryController->readAll();

        array_unshift($vars, ['book' => $book]);
        array_unshift($vars, ['categories' => $categories]);

        if (!empty($book->getId())) {
            unset($book);
            unset($category);

            $controller->render(
              '/views/books/book.html.php',
              $vars
            );
        } else {
            $controller->renderError(404);
        }
    }

    public function showCategory($categoryId)
    {
        $vars = [];

        $controller = new CategoryController();
        $category   = $controller->getCategory($categoryId);
        $categories = $controller->getAllCategories();

        array_unshift($vars, ['category' => $category]);
        array_unshift($vars, ['categories' => $categories]);

        if (!empty($category->getId())) {
            unset($category);
            unset($categories);

            $controller->render(
              '/views/categories/category.html.php',
              $vars
            );
        } else {
            $controller->renderError(404);
        }
    }

    public function account()
    {
        $user = new UserController();

        $user->render(
          '/views/users/account/account.html.php'
        );
    }

    public function accountInfo()
    {
        $userController = new UserController();
        $session = new UserSession();

        // User
        $userId      = null;
        $name        = null;
        $surname     = null;
        $email       = null;
        $mobilePhone = null;

        // Address
        $addressId = null;
        $country   = null;
        $district  = null;
        $city      = null;
        $street    = null;
        $building  = null;
        $apartment = null;

        $user = $session->read();

        $errors         = [];
        $incorrectField = false;

        if (isset($_POST['personalInfo'])) {
            // User
            if (!empty($_POST['userId'])) {
                $userId = $_POST['userId'];
            }

            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else {
                $incorrectField = true;
                $errorName      = 'Incorrect field \'Name\'';
                array_unshift($errors, $errorName);
            }

            if (!empty($_POST['surname'])) {
                $surname = $_POST['surname'];
            } else {
                $incorrectField = true;
                $errorSurname   = 'Incorrect field \'Surname\'';
                array_unshift($errors, $errorSurname);
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $incorrectField = true;
                $errorEmail     = 'Incorrect field \'Email\'';
                array_unshift($errors, $errorEmail);
            }

            if (!empty($_POST['mobilePhone'])) {
                $mobilePhone = $_POST['mobilePhone'];
            } else {
                $incorrectField = true;
                $errorPhone     = 'Incorrect field \'Mobile Phone\'';
                array_unshift($errors, $errorPhone);
            }

            // Address
            if (!empty($_POST['addressId'])) {
                $addressId = $_POST['addressId'];
            }

            if (!empty($_POST['country'])) {
                $country = $_POST['country'];
            } else {
                $incorrectField = true;
                $errorCountry   = 'Incorrect field \'Country\'';
                array_unshift($errors, $errorCountry);
            }

            if (!empty($_POST['state'])) {
                $region = $_POST['state'];
            } else {
                $incorrectField = true;
                $errorState     = 'Incorrect field \'State\'';
                array_unshift($errors, $errorState);
            }

            if (!empty($_POST['city'])) {
                $city = $_POST['city'];
            } else {
                $incorrectField = true;
                $errorCity      = 'Incorrect field \'City\'';
                array_unshift($errors, $errorCity);
            }

            if (!empty($_POST['street'])) {
                $street = $_POST['street'];
            } else {
                $incorrectField = true;
                $errorStreet    = 'Incorrect field \'Street\'';
                array_unshift($errors, $errorStreet);
            }

            if (!empty($_POST['building'])) {
                $building = $_POST['building'];
            } else {
                $incorrectField = true;
                $errorBuilding  = 'Incorrect field \'Building\'';
                array_unshift($errors, $errorBuilding);
            }

            if (!empty($_POST['apartment'])) {
                $apartment = $_POST['apartment'];
            } else {
                $incorrectField = true;
                $errorApartment = 'Incorrect field \'Apartment\'';
                array_unshift($errors, $errorApartment);
            }
        }

        if ($incorrectField) {
            $userController->render(
              '/views/users/account/account.html.php',
              $errors
            );
        } elseif (isset($_POST['personalInfo']) && !$incorrectField) {
            $user = new User();
            $user->setId($userId);
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setMobilePhone($mobilePhone);

            $address = new Address();
            $address->setId($addressId);
            $address->setCountry($country);
            $address->setDistrict($district);
            $address->setCity($city);
            $address->setStreet($street);
            $address->setBuilding($building);
            $address->setApartment($apartment);

            $user->setAddress($address);

            $userController->update($user);

            header('Location: /account');
        }

        if (!isset($_POST['personalInfo'])) {
            $userController->render(
              '/views/users/account/account.html.php',
              $user
            );
        }
    }

    public function register()
    {
        $user = new UserController();

        $email    = htmlspecialchars($_POST['registerEmail'], ENT_QUOTES, 'UTF-8');
        $password = md5(htmlspecialchars($_POST['registerPassword'], ENT_QUOTES, 'UTF-8') . 'bookstore');

        if ($user->register($email, $password)) {
            header('Location: /books');
        } else {
            $error = 'Incorrect email or password';
            $user->render(
              '/views/users/loginOrRegister.html.php',
              $error
            );
        }
    }

    public function login()
    {
        $user = new UserController();

        $email    = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

        if (!$user->login($email, $password)) {
            $error = 'Incorrect email or password';
            $user->render(
              '/views/users/loginOrRegister.html.php',
              $error
            );
        }
    }

    public function logout()
    {
        $controller = new UserController();
        $controller->logout();
        unset($controller);

        header('Location: /books');
    }

    public function cart()
    {
        $cartController = new CartController();
        $books          = $cartController->getCart();

        $this->render(
          '/views/cart/cart.html.php',
          $books
        );
    }

    public function checkout($shippingMethod = 'Courier')
    {
        $cartController = new CartController();
        $vars           = $cartController->checkout($shippingMethod);

        $this->render(
          '/views/cart/checkout/checkout.html.php',
          $vars
        );
    }

    public function submitCheckout()
    {
        // user
        $userName     = $_POST['userName'];
        $userSurname  = $_POST['surname'];
        $phone        = $_POST['phone'];
        $email        = $_POST['email'];

        // address
        $country      = $_POST['country'];
        $district     = $_POST['district'];
        $city         = $_POST['city'];
        $street       = $_POST['street'];
        $building     = $_POST['building'];
        $apartment    = $_POST['apartment'];
        $postcode     = $_POST['postcode'];

        // order message
        $userMessage = $_POST['userMessage'];

        $userSession = new UserSessionController();
        $user = $userSession->read();
        $user->setName($userName);
        $user->setSurname($userSurname);
        $user->setMobilePhone($phone);

        $userController = new UserController();
        $userController->update($user);

        $address = $userController->getAddress($user->getId());
        $address->setCountry($country);
        $address->setDistrict($district);
        $address->setCity($city);
        $address->setStreet($street);
        $address->setBuilding($building);
        $address->setApartment($apartment);
        $address->setPostcode($postcode);

        $address->update($address);

        if ($email != $_SESSION['email'])
            $_SESSION['email'] = $email;

        $booksAndQty = [];

        // get books
        $count = count($_SESSION['cart']);
        for ($i = 0; $i < $count; $i++) {
            $book = (object) unserialize($_SESSION['cart'][$i]['book']);
            $qty = $_SESSION['cart'][$i]['qty'];
            array_push($booksAndQty, ['book' => $book, 'qty' => $qty]);
            unset($book);
        }

        $order = new OrderController();
        $order->setBooksAndQty($booksAndQty);
        $order->setUser($user);
        $order->setUserMessage($userMessage);
        $order->create($order);

        $cart = new CartController();
        $cart->deleteCart();

        unset($cart);
        unset($order);
        unset($booksAndQty);
        unset($address);
        unset($user);
    }

    public function orders()
    {
        $userController = new UserController();
        $permissions = $userController->checkPermissions();

        if ($permissions) {
            $orderController = new OrderController();
            $orders = $orderController->readAll();

            $this->render(
              '/views/administration/orders/orders.html.php',
              $orders
            );
        } else {
            header('Location: /account');
        }
    }

    public function order()
    {
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $orderController = new OrderController();
        $order = $orderController->read($id);
        $this->render(
          '/views/administration/orders/order.html.php',
          $order
        );
    }

    public function updateOrderStatus($status)
    {
        if (isset($_GET['id']))
            $id = $_GET['id'];

        $newStatusId = null;

        $statusController = new StatusController();
        $statuses = $statusController->readAll();

        foreach ($statuses as $s) {
            if ($s['status'] === $status) {
                $newStatusId = $s['id'];
            }
        }

        $status = $statusController->read($newStatusId);

        $orderController = new OrderController();
        $order = $orderController->read($id);
        $order->setStatus($status);
    }

    public function deleteOrder($id)
    {
        $orderController = new OrderController();
        $orderController->delete($id);
    }

    public function contact()
    {
        $this->render(
          '/views/contacts/contact.html.php'
        );
    }

    public function myOrders()
    {
        $userSession = new UserSessionController();
        $user = (object)$userSession->read();
        $orders = $user->getOrders();

        $this->render(
          '/views/users/orders/my-orders.html.php',
          $orders
        );
    }

    public function myOrder()
    {
        $orderController = new OrderController();
        $userSession = new UserSessionController();

        $orderId = $orderController
          ->read($_GET['id'])
          ->getId();
        $user = (object)$userSession->read();
        $order = (object)$user->getOrder($orderId);


        $this->render(
          '/views/users/orders/my-order.html.php',
          $order
        );
    }

    public function cancelOrder($orderId) {
        $newStatusId = null;

        $statusController = new StatusController();
        $statuses = $statusController->readAll();

        foreach ($statuses as $s) {
            if ($s['status'] === 'Canceled') {
                $newStatusId = $s['id'];
            }
        }

        $status = $statusController->read($newStatusId);

        $orderController = new OrderController();
        $order = $orderController->read($orderId);
        $order->setStatus($status);
    }
}