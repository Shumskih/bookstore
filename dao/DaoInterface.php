<?php


interface DaoInterface
{
    static function create($object);

    static function read($id);

    static function readAll();

    static function update($object);

    static function delete($id);
}