<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $var['title']; ?></title>
</head>
<body>
<h1><?php echo 'Название: ' . $var['title']; ?></h1>
<h5><?php echo 'Автор: ' . $var['authorSurname'] . ' ' . $var['authorName']; ?></h5>
<h6><?php echo 'Количество страниц: ' . $var['pages']; ?></h6>
<p><?php echo 'Описание:<br>' . $var['description']; ?></p>
</body>
</html>