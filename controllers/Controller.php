<?php

abstract class Controller
{

    public function render($var, string $view)
    {
        include $_SERVER['DOCUMENT_ROOT'] . $view;
    }
}