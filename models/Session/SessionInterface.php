<?php


interface SessionInterface
{

    function create($model);

    function read();

    function update($model);

    function delete();
}