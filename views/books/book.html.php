<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $var->getTitle(); ?></title>
</head>
<body>
<h1><?php echo 'Название: ' . $var->getTitle(); ?></h1>
<h5><?php echo 'Автор: ' . $var->getAuthorSurname() . ' ' . $var->getAuthorName(); ?></h5>
<h6><?php echo 'Количество страниц: ' . $var->getPages(); ?></h6>
<p><?php echo 'Описание:<br>' . $var->getDescription(); ?></p>
</body>
</html>