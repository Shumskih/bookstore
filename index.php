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
ob_start("ob_gzhandler");

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
    FillTables::faker($tables, $relations, $users, $addresses, $roles, $delivery, $statuses);

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
    if (isset($_POST['updateCheckout'])) {
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

// /administration/orders/order?id=?
} elseif (isset($_GET['id'])
          && (URI == '/administration/orders/order?id=' . $_GET['id']
              || URI == '/administration/orders/order?id=' . $_GET['id'] . '/')) {
    if (isset($_POST['orderId']) && isset($_POST['orderInProcess'])) {
        $status = 'In process';
        $frontController->updateOrderStatus($status);
    }

    if (isset($_POST['orderId']) && isset($_POST['orderSent'])) {
        $status = 'Sent';
        $frontController->updateOrderStatus($status);
    }

    if (isset($_POST['orderId']) && isset($_POST['orderDelivered'])) {
        $status = 'Delivered';
        $frontController->updateOrderStatus($status);
    }

    if (isset($_POST['orderId']) && isset($_POST['orderCanceled'])) {
        $status = 'Canceled';
        $frontController->updateOrderStatus($status);
    }

    $frontController->order();

} elseif (isset($_GET['id'])
          && (URI == '/administration/orders/delete-order?id=' . $_GET['id']
              || URI == '/administration/orders/delete-order?id=' . $_GET['id'] . '/')) {
    $frontController->deleteOrder($_GET['id']);
    header('Location: /administration/orders');

    // /contact
} elseif (URI == '/contact' || URI == '/contacts/') {
    $frontController->contact();
} else {
    $controller = new UserController();
    $controller->renderError(404);
}