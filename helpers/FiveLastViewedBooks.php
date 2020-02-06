<?php

class FiveLastViewedBooks
{
    public static function lastViewedBooks($book)
    {
        $viewedBooks = [];
        $idExists = false;

        if (isset($_SESSION['lastFiveViewedBooks'])) {
            $viewedBooks = $_SESSION['lastFiveViewedBooks'];
            $book = (object)$book;
            foreach ($viewedBooks as $viewedBook) {
                $viewedBook = (object)$viewedBook;
                if ($viewedBook->getId() == $book->getId()) {
                    $idExists = true;
                    break 1;
                }
            }
            if (!$idExists && count($viewedBooks) < 5) {
                array_unshift($viewedBooks, $book);
            } elseif (!$idExists) {
                array_pop($viewedBooks);
                array_unshift($viewedBooks, $book);
            }
        }

        unset($_SESSION['lastFiveViewedBooks']);
        $_SESSION['lastFiveViewedBooks'] = $viewedBooks;
        unset($viewedBooks);
    }
}

