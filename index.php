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
      $books,
      '/views/index.html.php'
    );

// /login
} elseif (URI == '/login') {
    if ((isset($_POST['email']) && !isset($_POST['password']))
        || ((isset($_POST['password']) && !isset($_POST['email'])))) {
        $controller = new UserController();
        $error      = 'loginError';
        $controller->render(
          $error,
          '/views/users/login/login.html.php'
        );
    } elseif (isset($_POST['email']) && isset($_POST['password'])) {
        $controller = new UserController();
        $login      = $controller->checkUser($_POST['email'],
          $_POST['password']);
        if ($login) {
            header('Location: /books');
        } else {
            $controller = new UserController();
            $error      = false;
            $controller->render(
              $error,
              '/views/users/login/login.html.php'
            );
        }
    } else {
        $controller = new UserController();
        $error      = false;
        $controller->render(
          $error,
          '/views/users/login/login.html.php'
        );
    }

// /registration
} elseif (URI == '/registration') {
    ;
    $controller = new UserController();

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

    $controller->render(
      $vars,
      '/views/books/book.html.php'
    );

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
      $vars,
      '/views/books/allBooks.html.php'
    );

// categories
} elseif (URI == '/categories') {
    $controller = new CategoryController();
    $categories = $controller->getAllCategories();
    $controller->render(
      $categories,
      '/views/categories/categories.html.php'
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
          $vars,
          '/views/categories/category.html.php'
        );
    } else {
        $error = 'error';
        $controller->render(
          $error,
          '/views/errors/404.html.php'
        );
    }

} else {
    echo "404!";
}