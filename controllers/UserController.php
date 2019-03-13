<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/controllers/Controller.php';
require_once ROOT . '/models/User.php';

class UserController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getUser($id): User
    {
        return $this->user->read($id);
    }

    public function getAllUsers(): array
    {

    }

    public function checkUser($email, $password)
    {
        return $this->user->login($email, $password);
    }

    public function logout()
    {
        $this->user->logout();
    }
}