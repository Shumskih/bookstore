<?php

$tables = [
  'books' => 'id            int auto_increment primary key not null, 
              title         varchar(250)                   not null,
              authorName    varchar(500)                   not null,
              authorSurname text                           not null,
              description   text                           null,
              pages         int                            not null,
              img           text,
              price         decimal                        not null,
              added         datetime                       not null',

  'categories' => 'id   int auto_increment primary key not null,
                   name varchar(100)                   not null',

  'categories_books' => 'category_id int,
                         book_id     int,
                         foreign key (category_id) references categories (id),
                         foreign key (book_id) references books (id)',

  'users' => 'id           int auto_increment primary key not null,
              name         varchar(100)                   not null,
              surname      varchar(200),
              mobile_phone varchar(200),
              email        varchar(200)                   not null,
              password     varchar(200)                   not null',

  'addresses' => 'id        int auto_increment primary key not null,
                  country   varchar (200),
                  region    varchar(200),
                  city      varchar(200),
                  street    varchar(200),
                  building  varchar(200),
                  apartment varchar(100)',

  'users_addresses' => 'user_id    int,
                        address_id int,
                        foreign key (user_id) references users (id),
                        foreign key (address_id) references addresses (id)',
];

$relations = [
  'categoriesBooksRelations' => [
    1 => [1, 2],
    2 => [3, 4],
    3 => [5, 6],
    4 => [7, 8],
    5 => [9, 10],
  ],
  'usersAddressesRelations' => [

  ],
];

$users = [
  [
    'name'     => 'Aleksander',
    'surname'  => 'Shumskih',
    'email'    => 'shumskih@email.com',
    'password' => '6457773',
  ],
  [
    'name'     => 'Dimon',
    'surname'  => 'Dimonov',
    'email'    => 'dimon@email.com',
    'password' => 'password',
  ],
  [
    'name'     => 'Siri',
    'surname'  => 'Smith',
    'email'    => 'siri@apple.com',
    'password' => '5555555',
  ],
];

$addresses = [

];
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