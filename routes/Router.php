<?php

class Router
{
    private $frontController = null;

    public function __construct()
    {
        $this->frontController = new FrontController();
    }

    public function run()
    {
        switch (URI) {
            case '/':
                $this->frontController->indexPage();
                break;

            case $this->getBook():
                if (isset($_POST['addToCart']) && isset($_POST['id']) && isset($_POST['qty'])) {
                    $cartController = new CartController();
                    $cartController->addToCart();
                    unset($cartController);
                }
                if (isset($_POST['deleteBook'])) {
                    $bookController = new BookController();
                    $bookController->delete($_POST['id']);
                    header('Location: /books');
                }

                $this->frontController->showBook($_GET['id']);
                break;

            case $this->getBooks():
                $this->frontController->books();
                break;

            case '/administration/add-new-book':
            case '/administration/add-new-book/':
                if (isset($_POST['publish'])) {
                    $errors = $this->frontController->publishBook();
                    if (isset($errors) && count($errors) > 0) {
                        $this->frontController->addABook($errors);
                        exit();
                    }
                }
                if (!isset($_POST['publish']) || !isset($_POST['cancel']) || !isset($_POST['uploadImg'])) {
                    $this->frontController->addABook();
                }
                if (isset($_POST['cancel'])) {
                    header('Location: /books');
                }
                break;

            case '/categories':
            case '/categories/':
                if (isset($_GET['id'])) {
                    if (isset($_POST['deleteCategory'])) {
                        $categoryController = new CategoryController();
                        $categoryController->delete($_POST['id']);
                        header('Location: /categories');
                    }

                    $this->frontController->showCategory($_GET['id']);
                    exit();
                }
                $this->frontController->categories();
                break;

            case $this->getCategory():
                $this->frontController->showCategory($_GET['id']);
                break;

            case '/account':
            case '/account/':
                if (!isset($_SESSION['login']) && isset($_POST['login'])) {
                    $this->frontController->login();

                } elseif (!isset($_SESSION['login']) && !isset($_POST['login']) && !isset($_POST['register'])) {
                    $controller = new UserController();
                    $controller->render(
                        '/views/users/loginOrRegister.html.php'
                    );
                }

                if (!isset($_SESSION['login']) && isset($_POST['register'])) {
                    $this->frontController->register();
                }

                if (isset($_SESSION['login'])) {
                    header('Location: /account/info');
                }
                break;

            case '/account/info':
            case '/account/info/':
                (isset($_SESSION['login'])) ? $this->frontController->accountInfo() : header('Location: /account');
                break;

            case '/my-orders':
            case '/my-orders/':
                (isset($_SESSION['login'])) ? $this->frontController->myOrders() : header('Location: /account');

                if (isset($_GET['id'])) {
                    if (isset($_POST['orderId']) && isset($_POST['cancelOrder'])) {
                        $this->frontController->cancelOrder($_POST['orderId']);
                    }
                }
                break;

            case '/restore-password':
            case '/restore-password/':
                echo 'Restore Password';
                break;

            case '/logout':
            case '/logout/':
                $this->frontController->logout();
                break;

            case '/cart':
            case '/cart/':
                if (isset($_POST['updateCart'])) {
                    $cartController = new cartController();
                    $cartController->updateCart();
                }
                $this->frontController->cart();
                break;

            case '/cart/delete-from-cart':
            case '/cart/delete-from-cart/':
                if (isset($_GET['id'])) {
                    $cartController = new CartController();

                    if (isset($_SESSION['cart'])) {
                        $cartController->deleteBook();
                        header('Location: /cart');
                    } else {
                        $cartController->getCart();
                    }
                }
                $this->frontController->cart();
                break;

            case '/cart/checkout':
            case '/cart/checkout/':
                if (isset($_POST['updateCheckout'])) {
                    $shippingMethod = $_POST['shippingMethod'];
                    $this->frontController->checkout($shippingMethod);
                }
                if (isset($_POST['submitCheckout'])) {
                    $this->frontController->submitCheckout();
                    header('Location: /books');
                }
                $this->frontController->checkout();
                break;

            case '/administration/orders':
            case '/administration/orders/':
                $this->frontController->orders();
                break;

            case '/administration/orders/order':
            case '/administration/orders/order/':
                if (isset($_GET['id'])) {
                    if (isset($_POST['orderId']) && isset($_POST['orderInProcess'])) {
                        $status = 'In process';
                        $this->frontController->updateOrderStatus($status);
                    }

                    if (isset($_POST['orderId']) && isset($_POST['orderSent'])) {
                        $status = 'Sent';
                        $this->frontController->updateOrderStatus($status);
                    }

                    if (isset($_POST['orderId']) && isset($_POST['orderDelivered'])) {
                        $status = 'Delivered';
                        $this->frontController->updateOrderStatus($status);
                    }

                    if (isset($_POST['orderId']) && isset($_POST['orderCanceled'])) {
                        $status = 'Canceled';
                        $this->frontController->updateOrderStatus($status);
                    }
                }
                $this->frontController->order();
                break;

            case '/administration/orders/delete-order':
            case '/administration/orders/delete-order/':
                if (isset($_GET['id'])) {
                    $this->frontController->deleteOrder($_GET['id']);
                    header('Location: /administration/orders');
                }
                break;

            case '/administration/delivery':
            case '/administration/delivery/':
                $this->frontController->delivery();
                break;

            case '/contact':
            case '/contact/':
                $this->frontController->contact();
                break;

            case '/fake-it':
            case '/fake-it/':
                FillTables::faker(
                    $tables = TablesData::$tables,
                    $relations = TablesData::$relations,
                    $users = TablesData::$users,
                    $addresses = TablesData::$addresses,
                    $roles = TablesData::$roles,
                    $delivery = TablesData::$delivery,
                    $statuses = TablesData::$statuses,
                    $images = TablesData::$images);
                break;

            default:
                $this->frontController->renderError(404);
                break;
        }
    }

    private function getBooks(): string
    {
        if(URI == '/books' || URI == '/books/') {
            return '/books';
        }
        if (isset($_GET['page']) && URI == '/books?page='.$_GET['page'] ||
            isset($_GET['page']) && URI == '/books?page='.$_GET['page'].'/') {
            return '/books?page=' . $_GET['page'];
        }
    }

    private function getBook(): string
    {
        if (isset($_GET['id'])) {
            return '/book?id=' . $_GET['id'];
        }
        return '/book?id=0';
    }

    private function getCategory(): string
    {
        if (isset($_GET['id'])) {
            return '/category?id=' . $_GET['id'];
        }
        return '/category?id=0';
    }
}