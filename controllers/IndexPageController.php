<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/Controller.php';

class IndexPageController extends Controller
{

    private $bookController;

    public function __construct()
    {
        $this->bookController = new BookController();
    }

    public function getNewBooks(int $quantity = 6): array
    {
        return $this->bookController->getNewBooks($quantity);
    }

    private function getBestsellers(int $quantity = 6)
    {

    }
}