<?php


class SqlQueries
{

    // Books
    const GET_BOOK = 'SELECT * FROM books WHERE id = :id';

    const GET_ALL_BOOKS = 'SELECT * FROM books';

    const GET_BOOKS_BY_CATEGORY = 'SELECT * FROM books
                                   INNER JOIN categories_books ON categories_books.book_id = books.id
                                   INNER JOIN categories ON categories.id = categories_books.category_id
                                   WHERE categories_books.category_id = :id';

    const GET_CATEGORIES_OF_BOOK = 'SELECT * FROM books
                                    INNER JOIN categories_books ON categories_books.book_id = books.id
                                    INNER JOIN categories ON categories.id = categories_books.category_id
                                    WHERE categories_books.book_id = :id';

    const GET_NEW_BOOKS = 'SELECT * FROM books ORDER BY added DESC LIMIT :quantity';

    // Categories
    const GET_ALL_CATEGORIES = 'SELECT * FROM categories';

    const GET_CATEGORY = 'SELECT * FROM categories WHERE id = :id';

    const COUNT_BOOKS_IN_CATEGORY = 'SELECT COUNT(*) as count FROM books
                                   INNER JOIN categories_books ON categories_books.book_id = books.id
                                   INNER JOIN categories ON categories.id = categories_books.category_id
                                   WHERE categories_books.category_id = :id';

    // Users
    const GET_USER = 'SELECT * FROM users WHERE email = :email and password = :password';

    const GET_BY_EMAIL = 'SELECT * FROM users WHERE email = :email';

    const GET_USER_BY_EMAIL = 'SELECT * FROM users WHERE email = :email';

    const REGISTER_NEW_USER = 'INSERT INTO users(id, email, password) VALUES (null, :email, :password)';

    const UPDATE_USER = 'UPDATE users 
                          SET name = :name, 
                              surname = :surname,  
                              email = :email, 
                              mobile_phone = :mobilePhone
                          WHERE id = :id';

    // Address
    const GET_USER_ADDRESS = 'SELECT * FROM addresses
                                   INNER JOIN users_addresses ON users_addresses.address_id = addresses.id
                                   INNER JOIN users ON users.id = users_addresses.user_id
                                   WHERE users_addresses.user_id = :id';

    const UPDATE_ADDRESS = 'UPDATE addresses 
                          SET country   = :country, 
                              district  = :district, 
                              city      = :city, 
                              street    = :street,
                              building  = :building,
                              apartment = :apartment
                          WHERE id = :id';

    // Roles
    const GET_USER_ROLES = 'SELECT roles.id, roles.name, roles.description FROM roles
                                   INNER JOIN users_roles ON users_roles.role_id = roles.id
                                   INNER JOIN users ON users.id = users_roles.role_id
                                   WHERE users_roles.user_id = :id';

    // Orders
    const CREATE_ORDER = 'INSERT INTO orders(id, order_message) VALUES (null, :orderMessage)';

    const ADD_BOOK_TO_ORDER = 'INSERT INTO orders_books(order_id, book_id, quantity) VALUES (:orderId, :bookId, :quantity)';

    const ADD_USER_TO_ORDER = 'INSERT INTO orders_users(order_id, user_id) VALUES (:orderId, :userId)';

    const ADD_DELIVERY_TO_ORDER = 'INSERT INTO orders_deliveries(order_id, delivery_id) VALUES (:orderId, :deliveryId)';

    // Delivery
    const CREATE_DELIVERY = 'INSERT INTO deliveries (id, delivery_method, delivery_cost) VALUES (null, :deliveryMethod, :deliveryCost)';

    const GET_ALL_DELIVERIES = 'SELECT * FROM deliveries';

    const GET_DELIVERY_BY_METHOD = 'SELECT * FROM deliveries WHERE delivery_method = :deliveryMethod';
}