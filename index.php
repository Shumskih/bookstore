<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controllers/FrontController.php';
require_once ROOT . '/controllers/IndexPageController.php';
require_once ROOT . '/controllers/BookController.php';
require_once ROOT . '/controllers/CategoryController.php';
require_once ROOT . '/controllers/CartController.php';
require_once ROOT . '/controllers/UserController.php';
require_once ROOT . '/helpers/FillTables.php';
require_once ROOT . '/helpers/Countries.php';
require_once ROOT . '/sql/tablesData.php';

session_start();

$frontController = new FrontController();

// home page
if (URI == '/') {
    $frontController->indexPage();

    // /account
} elseif (URI == '/account' || URI == '/account/') {
    if (!isset($_SESSION['login']) && isset($_POST['login'])) {
        $frontController->login();

    } elseif (!isset($_SESSION['login']) && !isset($_POST['login']) && !isset($_POST['register'])) {
        $controller = new UserController();
        $controller->render(
          '/views/users/loginOrRegister.html.php'
        );
    }

    if (!isset($_SESSION['login']) && isset($_POST['register'])) {
        $frontController->register();
    }

    if (isset($_SESSION['login'])) {
        header('Location: /account/info');
    }

    // /account/info
} elseif (URI == '/account/info' || URI == '/account/info/') {
    if (!isset($_SESSION['login'])) {
        header('Location: /account');
    } else {
        $frontController->accountInfo();
    }

} // /restore-password
elseif (URI == '/restore-password' || URI == '/restore-password/') {
    echo 'Restore Password';

    // /logout
} elseif (URI == '/logout' || URI == '/logout/') {
    $frontController->logout();

    // /fake-it
} elseif (URI == '/fake-it' || URI == '/fake-it/') {
    FillTables::faker($tables, $relations, $users, $addresses, $roles, $delivery);

    // /book?id=?
} elseif (isset($_GET['id']) && URI == '/book?id=' . $_GET['id']
          || isset($_GET['id'])
             && URI == '/book?id=' . $_GET['id'] . '/') {

    if (isset($_POST['addToCart']) && isset($_POST['id']) && isset($_POST['qty'])) {
        $cartController = new CartController();
        $cartController->addToCart();
        unset($cartController);
    }

    $frontController->showBook($_GET['id']);

    // /books
} elseif (URI == '/books' || URI == '/books/') {
    $frontController->books();

    // /category?id=?
} elseif (isset($_GET['id']) && URI == '/category?id=' . $_GET['id']
          || isset($_GET['id']) && URI == '/category?id=' . $_GET['id'] . '/') {
    $frontController->showCategory($_GET['id']);

    // /cart
} elseif (URI == '/cart' || URI == '/cart/') {
    if (isset($_POST['updateCart'])) {
        $cartController = new cartController();
        $cartController->updateCart();
    }
    $frontController->cart();

// /cart/delete-from-cart
} elseif (isset($_GET['id']) && URI == '/cart/delete-from-cart?id=' . $_GET['id']
          || isset($_GET['id']) && URI == '/cart/delete-from-cart?id=' . $_GET['id'] . '/') {
    $cartController = new CartController();

    if (isset($_SESSION['cart'])) {
        $cartController->deleteBook();
        header('Location: /cart');
    } else {
        $cartController->getCart();
    }

    // /cart/checkout
} elseif (URI == '/cart/checkout' || URI == '/cart/checkout/') {
    if(isset($_POST['updateCheckout'])) {
        $shippingMethod = $_POST['shippingMethod'];
        $frontController->checkout($shippingMethod);
    } elseif (isset($_POST['submitCheckout'])) {
        $frontController->submitCheckout();
        header('Location: /books');
    } else {
        $frontController->checkout();
    }

    // /administration/orders
} elseif (URI == '/administration/orders' || URI == '/administration/orders/') {
    $frontController->orders();

    // /contact
} elseif (URI == '/contact' || URI == '/contacts/') {
    $frontController->contact();
} else {
    $controller = new UserController();
    $controller->renderError(404);
}