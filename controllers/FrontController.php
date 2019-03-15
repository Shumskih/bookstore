<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';

class FrontController
{
    public function indexPage()
    {
        $controller = new IndexPageController();
        $books      = $controller->getNewBooks();
        $controller->render(
          '/views/index.html.php',
          $books
        );
    }

    public function books()
    {
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
    }

    public function showBook($bookId)
    {
        $vars = [];

        $controller = new BookController();
        $book       = $controller->getBook($bookId);

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
    }

    public function showCategory($categoryId)
    {
        $vars = [];

        $controller = new CategoryController();
        $category   = $controller->getCategory($categoryId);
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
    }

    public function account()
    {
        echo 'You are already logged in!';
    }

    public function register()
    {
        $user = new UserController();

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

    public function login()
    {
        $user = new UserController();

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
    }

    public function logout()
    {
        $controller = new UserController();
        $controller->logout();
        unset($controller);

        header('Location: /books');
    }
}