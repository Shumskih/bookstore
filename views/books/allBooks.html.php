<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Books</title>
</head>
<body>
<?php foreach ($var as $book): ?>
  <h1><?php echo 'Название: ' . $book['title']; ?></h1>
  <h5><?php echo 'Автор: ' . $book['authorSurname'] . ' ' . $book['authorName']; ?></h5>
  <h6><?php echo 'Количество страниц: ' . $book['pages']; ?></h6>
  <p><?php echo 'Описание:<br>' . $book['description']; ?></p>
  <hr>
<?php endforeach; ?>
</body>
</html>