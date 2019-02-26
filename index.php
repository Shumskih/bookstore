<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controller/BookController.php';
require_once ROOT . '/helpers/FillTables.php';
require_once ROOT . '/sql/tablesData.php';
require_once ROOT . '/dao/ConnectionUtil.php';

if (URI == '/') {
  echo 'Главная страница';

} else if (URI == '/fake-it') {
  $dao = ConnectionUtil::getConnection();
  FillTables::faker($dao, $tables, $relations);

} else if (isset($_GET['id']) && URI == '/book?id='.$_GET['id']) {
  $controller = new BookController($_GET['id']);
  $book = $controller->getBook($_GET['id']);
  $controller->render(
    $book,
    '/views/book.html.php'
  );
} else {
  echo "404!";
}