create table books
(
  id   int auto_increment primary key not null,
  title varchar(150) not null,
  authorName varchar(150) not null,
  authorSurname varchar(150) not null,
  pages int null,
  description text not null
);