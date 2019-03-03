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

  // Categories
  const GET_ALL_CATEGORIES = 'SELECT * FROM categories';

  const GET_CATEGORY = 'SELECT * FROM categories WHERE id = :id';

  // Users
  const GET_USER = 'SELECT * FROM users WHERE email = :email and password = :password';

  const GET_USER_BY_EMAIL = 'SELECT * FROM users WHERE email = :email';
}