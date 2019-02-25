<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $book->getTitle(); ?></title>
</head>
<body>
<h1><?php echo 'Название: ' . $book->getTitle(); ?></h1>
<h5><?php echo 'Автор: ' . $book->getAuthorSurname() . ' ' . $book->getAuthorName(); ?></h5>
<h6><?php echo 'Количество страниц: ' . $book->getPages(); ?></h6>
<p><?php echo 'Описание:<br>' . $book->getDescription(); ?></p>
</body>
</html>