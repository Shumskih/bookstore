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
        $user = new UserController();

        $user->render(
          '/views/users/account/account.html.php'
        );
    }

    public function accountInfo()
    {
        $userController = new UserController();

        // User
        $userId      = null;
        $name        = null;
        $surname     = null;
        $email       = null;
        $mobilePhone = null;

        // Address
        $addressId = null;
        $country   = null;
        $region     = null;
        $city      = null;
        $street    = null;
        $building  = null;
        $apartment = null;

        $user = (object)$userController->getUserByEmail($_SESSION['email']);

        $errors         = [];
        $incorrectField = false;

        if (isset($_POST['personalInfo'])) {
            // User
            if (!empty($_POST['userId'])) {
                $userId = $_POST['userId'];
            }

            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else {
                $incorrectField = true;
                $errorName      = 'Incorrect field \'Name\'';
                array_unshift($errors, $errorName);
            }

            if (!empty($_POST['surname'])) {
                $surname = $_POST['surname'];
            } else {
                $incorrectField = true;
                $errorSurname   = 'Incorrect field \'Surname\'';
                array_unshift($errors, $errorSurname);
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                $incorrectField = true;
                $errorEmail     = 'Incorrect field \'Email\'';
                array_unshift($errors, $errorEmail);
            }

            if (!empty($_POST['mobilePhone'])) {
                $mobilePhone = $_POST['mobilePhone'];
            } else {
                $incorrectField = true;
                $errorPhone     = 'Incorrect field \'Mobile Phone\'';
                array_unshift($errors, $errorPhone);
            }

            // Address
            if (!empty($_POST['addressId'])) {
                $addressId = $_POST['addressId'];
            }

            if (!empty($_POST['country'])) {
                $country = $_POST['country'];
            } else {
                $incorrectField = true;
                $errorCountry   = 'Incorrect field \'Country\'';
                array_unshift($errors, $errorCountry);
            }

            if (!empty($_POST['state'])) {
                $region = $_POST['state'];
            } else {
                $incorrectField = true;
                $errorState     = 'Incorrect field \'State\'';
                array_unshift($errors, $errorState);
            }

            if (!empty($_POST['city'])) {
                $city = $_POST['city'];
            } else {
                $incorrectField = true;
                $errorCity      = 'Incorrect field \'City\'';
                array_unshift($errors, $errorCity);
            }

            if (!empty($_POST['street'])) {
                $street = $_POST['street'];
            } else {
                $incorrectField = true;
                $errorStreet    = 'Incorrect field \'Street\'';
                array_unshift($errors, $errorStreet);
            }

            if (!empty($_POST['building'])) {
                $building = $_POST['building'];
            } else {
                $incorrectField = true;
                $errorBuilding  = 'Incorrect field \'Building\'';
                array_unshift($errors, $errorBuilding);
            }

            if (!empty($_POST['apartment'])) {
                $apartment = $_POST['apartment'];
            } else {
                $incorrectField = true;
                $errorApartment = 'Incorrect field \'Apartment\'';
                array_unshift($errors, $errorApartment);
            }
        }

        if ($incorrectField) {
            $userController->render(
              '/views/users/account/account.html.php',
              $errors
            );
        } elseif (isset($_POST['personalInfo']) && !$incorrectField) {
            $user = new User();
            $user->setId($userId);
            $user->setName($name);
            $user->setSurname($surname);
            $user->setEmail($email);
            $user->setMobilePhone($mobilePhone);

            $address = new Address();
            $address->setId($addressId);
            $address->setCountry($country);
            $address->setRegion($region);
            $address->setCity($city);
            $address->setStreet($street);
            $address->setBuilding($building);
            $address->setApartment($apartment);

            $user->setAddress($address);

            $userController->update($user);

            header('Location: /account');
        }

        if (!isset($_POST['personalInfo']) && !isset($_POST['deliveryAddress'])) {
            $userController->render(
              '/views/users/account/account.html.php',
              $user
            );
        }
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