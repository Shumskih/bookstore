<?php include_once ROOT . '/views/inc/head.html.php' ?>
  <body>
  <header>
      <?php include_once ROOT . '/views/inc/menu.html.php' ?>
  </header>
  <div class="breadcrumb">
    <div class="container">
      <a class="breadcrumb-item" href="/books">Home</a>
      <span class="breadcrumb-item active">Categories</span>
    </div>
  </div>
  <section class="product-sec">
    <div class="container">
      <h1>Categories:</h1>
      <hr>
      <ul class="list-group list-group-flus">
          <?php foreach ($var as $category): ?>
            <li class="list-group-item">
              <a href="/category?id=<?php echo $category['id'] ?>">
                  <?php echo $category['name'] ?>
              </a>
            </li>
          <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php include_once ROOT . '/views/inc/footer.html.php' ?>
<?php include_once ROOT . '/views/inc/scripts.html.php' ?>