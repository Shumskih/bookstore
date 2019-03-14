<?php

abstract class Controller
{

    public function render(string $view, $var = false)
    {
        include $_SERVER['DOCUMENT_ROOT'] . $view;
    }

    public function renderError($errorCode)
    {
        switch ($errorCode) {
            case (int) 404:
                include ROOT . '/views/errors/404.html.php';
                break;
            case (int) 500:
                include ROOT . '/views/errors/404.html.php';
                break;
            default:
                include ROOT . '/views/errors/404.html.php';
                break;
        }
    }
}