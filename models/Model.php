<?php


interface Model
{

    function create();

    function read($id);

    function readAll();

    function update($id);

    function delete($id);
}