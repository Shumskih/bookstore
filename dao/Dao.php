<?php


interface Dao
{
  function create();
  function read($id);
  function update($id);
  function delete($id);
}