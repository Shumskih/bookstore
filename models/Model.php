<?php


interface Model
{

    function create($model);

    function read($id);

    function readAll();

    function update($model);

    function delete($id);
}