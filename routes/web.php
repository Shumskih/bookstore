<?php

Route::get('/books', 'BookController@index');
Route::get('/book/:1', 'BookController@book');