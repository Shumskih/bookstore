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

    public function getUserByEmail($email)
    {
        return $this->user->readUserByEmail($email);
    }

    public function getAllUsers(): array
    {

    }

    public function create()
    {
        $this->user->create();
    }

    public function login($email, $password) : bool
    {
        return $this->user->login($email, $password);
    }

    public function register($email, $password) : bool
    {
        return $this->user->register($email, $password);
    }

    public function logout()
    {
        $this->user->logout();
    }
}