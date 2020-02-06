<?php

class FiveLastViewedBooks
{
    /**
     * @param $book
     */
    public static function lastViewedBooks($book)
    {
        $viewedBooks = [];

        if (isset($_SESSION['lastFiveViewedBooks'])) {
            $viewedBooks = $_SESSION['lastFiveViewedBooks'];
            unset($_SESSION['lastFiveViewedBooks']);

            if (!self::isBookExistsInSession($viewedBooks, $book) && count($viewedBooks) < 5) {
                array_unshift($viewedBooks, $book);
            } elseif (!self::isBookExistsInSession($viewedBooks, $book)) {
                array_pop($viewedBooks);
                array_unshift($viewedBooks, $book);
            }
        } else {
            array_unshift($viewedBooks, $book);
        }
        $_SESSION['lastFiveViewedBooks'] = $viewedBooks;
        unset($viewedBooks);
    }


    /**
     * @param $viewedBooks array of viewed books
     * @param $book book object
     * @return bool
     */
    private static function isBookExistsInSession($viewedBooks, $book): bool
    {
        $book = (object)$book;
        foreach ($viewedBooks as $viewedBook) {
            $viewedBook = (object)$viewedBook;
            if ($viewedBook->getId() == $book->getId()) {
                return true;
            }
        }
        return false;
    }
}

