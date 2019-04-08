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
              added         datetime                       not null,
              inStock       boolean                        not null,
              quantity      int                            not null',

  'users' => 'id           int auto_increment primary key not null,
              name         varchar(255)                   not null,
              surname      varchar(255),
              mobilePhone  varchar(255),
              email        varchar(255)                   not null,
              password     varchar(255)                   not null',

  'categories' => 'id   int auto_increment primary key not null,
                   name varchar(100)                   not null',

  'addresses' => 'id        int auto_increment primary key not null,
                  country   varchar (255),
                  district  varchar(255),
                  city      varchar(255),
                  street    varchar(255),
                  building  varchar(255),
                  apartment varchar(100),
                  postcode  varchar(100)',

  'roles' => 'id          int auto_increment primary key not null,
              name        varchar(150)                   not null,
              description varchar(250)                   not null',

  'orders' => 'id              int auto_increment primary key not null,
               userMessage     text',

  'statuses' => 'id              int auto_increment primary key not null,
                 status          varchar(250)',

  'deliveries' => 'id              int auto_increment primary key not null,
                   deliveryMethod  varchar(250),
                   deliveryCost    int',

  'orders_users' => 'order_id int not null,
                     user_id  int not null,
                     foreign key (order_id) references orders (id),
                     foreign key (user_id) references users (id)',

  'orders_books' => 'order_id int not null,
                     book_id  int not null,
                     quantity int not null,
                     foreign key (order_id) references orders (id),
                     foreign key (book_id) references books (id)',

  'orders_deliveries' => 'order_id     int not null,
                          delivery_id  int not null,
                          foreign key (order_id) references orders (id),
                          foreign key (delivery_id) references deliveries (id)',

  'orders_statuses' => 'order_id     int not null,
                        status_id    int not null,
                        foreign key (order_id) references orders (id),
                        foreign key (status_id) references statuses (id)',

  'categories_books' => 'category_id int not null,
                         book_id     int not null,
                         foreign key (category_id) references categories (id),
                         foreign key (book_id) references books (id)',

  'users_roles' => 'user_id int not null,
                    role_id int not null,
                    foreign key (user_id) references users (id),
                    foreign key (role_id) references roles (id)',

  'users_addresses' => 'user_id    int not null,
                        address_id int not null,
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
  'usersRolesRelations'      => [
    1 => [1, 2, 3],
    2 => [1, 2],
    3 => [1],
  ],
  'usersAddressesRelations'  => [
    1 => [1],
    2 => [2],
    3 => [3],
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
  [
    'country'   => 'Russian Federation',
    'district'  => 'Краснодарский край',
    'city'      => 'Краснодар',
    'street'    => 'Таганрогская',
    'building'  => '1',
    'apartment' => '57',
    'postcode'  => '350059',
  ],
  [
    'country'   => 'Russian Federation',
    'district'  => 'Краснодарский край',
    'city'      => 'Краснодар',
    'street'    => 'Таганрогская',
    'building'  => '110',
    'apartment' => '576',
    'postcode'  => '350061',
  ],
  [
    'country'   => 'Russian Federation',
    'district'  => 'Краснодарский край',
    'city'      => 'Краснодар',
    'street'    => 'Таганрогская',
    'building'  => '111',
    'apartment' => '577',
    'postcode'  => '350060',
  ],
];

$roles = [
  [
    'name'        => 'User',
    'description' => 'Brows site, buy books, edit his personal info and delivery address',
  ],
  [
    'name'        => 'Content Manager',
    'description' => 'Add, edit and delete books',
  ],
  [
    'name'        => 'Super User',
    'description' => 'Edit and delete roles of particular user',
  ],
];

$delivery = [
  [
    'deliveryMethod' => 'Courier',
    'deliveryCost'   => 28,
  ],
  [
    'deliveryMethod' => 'Flat Rate',
    'deliveryCost'   => 54,
  ],
];

$statuses = [
  [
    'status' => 'New',
  ],
  [
    'status' => 'In process',
  ],
  [
    'status' => 'Sent'
  ],
  [
    'status' => 'Delivered'
  ],
  [
    'status' => 'Canceled'
  ]
];