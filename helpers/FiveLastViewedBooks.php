<?php
require_once ROOT . '/helpers/vardump.php';

class FiveLastViewedBooks
{
  public static function lastViewedBooks($book)
  {
    $viewedBooks = array();

    if (isset($_SESSION['lastFiveViewedBooks'])) {
      $viewedBooks = $_SESSION['lastFiveViewedBooks'];
    }

    if (count($viewedBooks) <= 4) {
      array_unshift( $viewedBooks, $book);
    } else {
      array_pop($viewedBooks);
      array_unshift($viewedBooks, $book);
    }

    unset($_SESSION['lastFiveViewedBooks']);
    $_SESSION['lastFiveViewedBooks'] = $viewedBooks;
  }
}