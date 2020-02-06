<?php


class InfoMessage
{
    public static function showMessage($message)
    {
        return '<div class="alert alert-primary" role="alert">' . $message . '</div>';
    }
}