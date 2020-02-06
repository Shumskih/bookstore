<?php

class IndexPageController extends Controller
{

    private BookController $bookController;

    public function __construct()
    {
        $this->bookController = new BookController();
    }

    public function getNewBooks(int $quantity = 6): array
    {
        return $this->bookController->getNewBooks($quantity);
    }

    private function getBestSellers(int $quantity = 6){}

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        // TODO: Implement readAll() method.
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }


}