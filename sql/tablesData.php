<?php

$tables = [
  'books' =>    'id                      int auto_increment primary key not null, 
                 title                   varchar(250)                   not null,
                 authorName              varchar(500)                   not null,
                 authorSurname           text                           not null,
                 description             text                           null,
                 pages                   int                            not null,
                 img                     text,
                 price                   decimal                        not null',

  'categories' => 'id   int auto_increment primary key not null,
                   name varchar(100) not null',

  'categories_books' => 'category_id int,
                         book_id  int,
                         foreign key (category_id) references categories (id),
                         foreign key (book_id) references books (id)'
];

$relations = [
  'categoriesBooksRelations' => [
    1 => [1, 2],
    2 => [3, 4],
    3 => [5, 6],
    4 => [7, 8],
    5 => [9, 10]
  ]
];
//
//$users = [
//  Array (
//    'name' =>     'Shumskih',
//    'email' =>    'shumskih@email.com',
//    'password' => '6457773'
//  ),
//  Array (
//    'name' =>     'Dimon',
//    'email' =>    'dimon@email.com',
//    'password' => 'password'
//  ),
//  Array(
//    'name' =>     'Siri',
//    'email' =>    'siri@apple.com',
//    'password' => '5555555'
//  )
//];
//
//$roles = [
//  Array(
//    'name' => 'Editor',
//    'description' => 'Adding, deleting and editing articles'
//  ),
//  Array(
//    'name' => 'Account administrator',
//    'description' => 'Adding, deleting and editing users'
//  ),
//  Array(
//    'name' => 'Site administrator',
//    'description' => 'Adding, deleting and editing categories'
//  ),
//  Array (
//    'name' => 'Writer',
//    'description' => 'User can write and edit his own articles'
//  ),
//  Array (
//    'name' => 'Moderator',
//    'description' => 'Moderate articles. Approve or disapprove publication'
//  )
//];