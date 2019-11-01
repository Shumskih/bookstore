<?php

class FiveLastViewedBooks
{

    public static function lastViewedBooks($book)
    {
        $viewedBooks = [];

        if (isset($_SESSION['lastFiveViewedBooks'])) {
            $viewedBooks = $_SESSION['lastFiveViewedBooks'];
            if (!in_array($book, $viewedBooks)) {
                if (count($viewedBooks) < 5) {
                    array_unshift($viewedBooks, $book);
                } else {
                    array_pop($viewedBooks);
                    array_unshift($viewedBooks, $book);
                }
            }
        }

        unset($_SESSION['lastFiveViewedBooks']);
        $_SESSION['lastFiveViewedBooks'] = $viewedBooks;
    }
}