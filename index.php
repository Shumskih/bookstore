<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controllers/IndexPageController.php';
require_once ROOT . '/controllers/BookController.php';
require_once ROOT . '/controllers/CategoryController.php';
require_once ROOT . '/controllers/UserController.php';
require_once ROOT . '/helpers/FillTables.php';
require_once ROOT . '/sql/tablesData.php';

session_start();

// home page
if (URI == '/') {
    $controller = new IndexPageController();
    $books      = $controller->getNewBooks();
    $controller->render(
      '/views/index.html.php',
      $books
    );

    // /account
} elseif (URI == '/account') {
    $user = new UserController();

    if (!isset($_SESSION['login']) && isset($_POST['login'])) {
        $email    = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = md5(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8') . 'bookstore');

        if ($user->login($email, $password)) {
            header('Location: /books');
        } else {
            $error = 'Incorrect email or password';
            $user->render(
              '/views/users/loginOrRegister.html.php',
              $error
            );
        }
    } elseif (!isset($_SESSION['login']) && !isset($_POST['login']) && !isset($_POST['register'])) {
        $controller = new UserController();
        $controller->render(
          '/views/users/loginOrRegister.html.php'
        );
    }

    if (!isset($_SESSION['login']) && isset($_POST['register'])) {
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

    if (isset($_SESSION['login'])) {
        echo 'You are already logged in!';
    }
} elseif
(URI == '/restore-password') {
    echo 'Restore Password';

    // /logout
} elseif (URI == '/logout') {
    $controller = new UserController();
    $controller->logout();
    unset($controller);
    header('Location: /books');

    // /fake-it
} elseif (URI == '/fake-it') {
    FillTables::faker($tables, $relations, $users, $addresses);

    // /book?id=?
} elseif (isset($_GET['id']) && URI == '/book?id=' . $_GET['id']) {
    $vars = [];

    $controller = new BookController();
    $book       = $controller->getBook($_GET['id']);

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

    // /books
} elseif (URI == '/books') {
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

    // categories
} elseif (URI == '/categories') {
    $controller = new CategoryController();
    $categories = $controller->getAllCategories();
    $controller->render(
      '/views/categories/categories.html.php',
      $categories
    );

    // /category?id=?
} elseif (isset($_GET['id']) && URI == '/category?id=' . $_GET['id']) {
    $vars = [];

    $controller = new CategoryController();
    $category   = $controller->getCategory($_GET['id']);
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

} else {
    $controller = new UserController();
    $controller->renderError(404);
}