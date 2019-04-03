<?php


interface Session
{

    function create($model);

    function read();

    function update($model);

    function delete();
}