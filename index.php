<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controller/BookController.php';

if (URI == '/') {

} else if (isset($_GET['id']) && URI == '/book?id='.$_GET['id']) {
  $book = new BookController($_GET['id']);
  $book->render();
} else {
  echo "404!";
}