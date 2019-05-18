<?php


class Router
{

    private $frontController = null;

    public function __construct()
    {
        $this->frontController = new FrontController();
    }

    public function route()
    {
        switch (URI) {
            case '/':
                $this->frontController->indexPage();
                break;

            case '/books' || '/books/':
                if (isset($_GET['id'])) {
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
                    exit();
                }

                $this->frontController->books();
                break;

            case '/account' || '/account/':
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

            case '/account/info' || '/account/info/':
                (isset($_SESSION['login'])) ? $this->frontController->accountInfo() : header('Location: /account');
                break;

            case '/my-orders' || '/my-orders/':
                (isset($_SESSION['login'])) ? $this->frontController->myOrders() : header('Location: /account');

                if (isset($_GET['id'])) {
                    if (isset($_POST['orderId']) && isset($_POST['cancelOrder'])) {
                        $this->frontController->cancelOrder($_POST['orderId']);
                    }
                }
                break;

            default:
                echo 'Error';
        }

    }
}