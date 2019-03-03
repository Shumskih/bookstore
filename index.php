<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controllers/BookController.php';
require_once ROOT . '/controllers/CategoryController.php';
require_once ROOT . '/helpers/FillTables.php';
require_once ROOT . '/sql/tablesData.php';

session_start();

if (URI == '/') {
  echo 'Главная страница';

} elseif (URI == '/fake-it') {
  FillTables::faker($tables, $relations);

} elseif (isset($_GET['id']) && URI == '/book?id=' . $_GET['id']) {
  $controller = new BookController();
  $book       = $controller->getBook($_GET['id']);
  $controller->render(
    $book,
    '/views/books/book.html.php'
  );
} elseif (URI == '/books') {
  $controller = new BookController();
  $books      = $controller->getAllBooks();
  $controller->render(
    $books,
    '/views/books/allBooks.html.php'
  );

} elseif (URI == '/categories') {
  $controller = new CategoryController();
  $categories = $controller->getAllCategories();
  $controller->render(
    $categories,
    '/views/categories/categories.html.php'
  );

} elseif (isset($_GET['id']) && URI == '/category?id=' . $_GET['id']) {
  $controller = new CategoryController();
  $category   = $controller->getCategory($_GET['id']);
  if (!empty($category->getId())) {
    $controller->render(
      $category,
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