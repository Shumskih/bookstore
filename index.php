<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controllers/FrontController.php';
require_once ROOT . '/controllers/IndexPageController.php';
require_once ROOT . '/controllers/BookController.php';
require_once ROOT . '/controllers/CategoryController.php';
require_once ROOT . '/controllers/UserController.php';
require_once ROOT . '/helpers/FillTables.php';
require_once ROOT . '/sql/tablesData.php';

session_start();

$frontController = new FrontController();

// home page
if (URI == '/') {
    $frontController->indexPage();

    // /account
} elseif (URI == '/account') {
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
        $frontController->account();
    }

    // /restore-password
} elseif
(URI == '/restore-password') {
    echo 'Restore Password';

    // /logout
} elseif (URI == '/logout') {
    $frontController->logout();

    // /fake-it
} elseif (URI == '/fake-it') {
    FillTables::faker($tables, $relations, $users, $addresses);

    // /book?id=?
} elseif (isset($_GET['id']) && URI == '/book?id=' . $_GET['id']) {
    $frontController->showBook($_GET['id']);

    // /books
} elseif (URI == '/books') {
    $frontController->books();

    // /category?id=?
} elseif (isset($_GET['id']) && URI == '/category?id=' . $_GET['id']) {
    $frontController->showCategory($_GET['id']);

} else {
    $controller = new UserController();
    $controller->renderError(404);
}