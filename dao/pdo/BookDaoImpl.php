<?php

class BookDaoImpl extends Dao
{
    private static $pdo = null;

    static function create($book): int
    {
        $book = (object)$book;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::INSERT_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'title' => $book->getTitle(),
                'authorName' => $book->getAuthorName(),
                'authorSurname' => $book->getAuthorSurname(),
                'description' => $book->getDescription(),
                'pages' => $book->getPages(),
                'price' => $book->getPrice(),
                'inStock' => $book->isInStock(),
                'quantity' => $book->getQuantity()
            ]);
            $bookId = self::$pdo->lastInsertId();

            self::$pdo->commit();

        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t create new book<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        if (!empty($book->getCategories)) {
            foreach ($book->getCategories() as $category) {
                $category = (object)$category;
                self::addCategoriesBooks($category->getId(), $bookId);
            }
        }

        if (!empty($book->getImages)) {
            foreach ($book->getImages() as $image) {
                $image = (object)$image;
                self::addBooksImages($book->getId(), $image->getId());
            }
        }


        return $bookId;
    }

    static function read($id): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id,
            ]);
            $book = $stmt->fetch();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get book from database<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $book;
    }

    static function readAll(): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_ALL_BOOKS;
            $stmt = self::$pdo->query($query);
            $array = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get all books<br>' . $e->getMessage();
        }
        return $array;
    }

    static function update($book): void
    {
        $book = (object)$book;
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::UPDATE_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'authorName' => $book->getAuthorName(),
                'authorSurname' => $book->getAuthorSurname(),
                'description' => $book->getDescription(),
                'pages' => $book->getPages(),
                'price' => $book->getPrice(),
                'addedAt' => $book->getAddedAt(),
                'inStock' => $book->isInStock(),
                'quantity' => $book->getQuantity()
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        if (!empty($book->getImages())) {
            foreach ($book->getImages() as $image) {
                $image = (object)$image;
                self::addBooksImages($book->getId(), $image->getId());
            }
        }
    }

    static function delete($id): void
    {
        self::deleteBookFromCategory($id);
        self::deleteBooksImages($id);
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::DELETE_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    static function deleteBookFromCategory($id): void
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::DELETE_BOOK_FROM_CATEGORY;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    static function deleteBooksImages($id): void
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::DELETE_BOOKS_IMAGES;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $id
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    public static function getNewBooks(int $quantity): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_NEW_BOOKS;
            $stmt = self::$pdo->prepare($query);
            $stmt->bindParam(
                ':quantity', $quantity, PDO::PARAM_INT
            );
            $stmt->execute();
            $books = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get new books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
        return $books;
    }

    public static function getCategories($bookId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_CATEGORIES_OF_BOOK;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $bookId,
            ]);
            $categories = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get categories of book<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $categories;
    }

    public static function getImages($bookId): array
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::GET_BOOK_IMAGES;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'id' => $bookId,
            ]);
            $images = $stmt->fetchAll();

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t get book images<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $images;
    }

    public static function addBooksImages($bookId, $imageId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::INSERT_BOOKS_IMAGES;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'bookId' => $bookId,
                'imageId' => $imageId
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t insert to books_images<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }

    public static function addCategoriesBooks($categoryId, $bookId)
    {
        try {
            self::$pdo = ConnectionUtil::getConnection();
            self::$pdo->beginTransaction();

            $query = SqlQueries::INSERT_BOOKS_IMAGES;
            $stmt = self::$pdo->prepare($query);
            $stmt->execute([
                'categoryId' => $categoryId,
                'bookId' => $bookId
            ]);

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t insert to categories_books<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }
    }
}