<?php

abstract class Controller
{

    /**
     * @param string $view
     * @param bool   $var
     */
    public function render(string $view, $var = false)
    {
        include ROOT . $view;
    }

    public function renderError($errorCode)
    {
        switch ($errorCode) {
            case (int) 404:
                include ROOT . '/views/errors/404.html.php';
                break;
            case (int) 500:
                include ROOT . '/views/errors/500.html.php';
                break;
            default:
                include ROOT . '/views/errors/200.html.php';
                break;
        }
    }

    abstract function create($model);
    abstract function read($id);
    abstract function readAll();
    abstract function update($model);
    abstract function delete($id);
}