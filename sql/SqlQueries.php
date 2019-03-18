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

    // Address
    const GET_USER_ADDRESS = 'SELECT * FROM addresses
                                   INNER JOIN users_addresses ON users_addresses.address_id = addresses.id
                                   INNER JOIN users ON users.id = users_addresses.user_id
                                   WHERE users_addresses.user_id = :id';
}