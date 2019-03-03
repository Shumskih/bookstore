<?php include_once ROOT . '/views/inc/head.html.php' ?>
  <body>
  <header>
    <?php include_once ROOT . '/views/inc/menu.html.php'?>
  </header>
  <div class="breadcrumb">
    <div class="container">
      <a class="breadcrumb-item" href="/books">Home</a>
      <a class="breadcrumb-item" href="/categories">Categories</a>
      <span class="breadcrumb-item active"><?php echo $var->getName(); ?></span>
    </div>
  </div>
  <section class="static about-sec">
    <div class="container">
      <h1><?php echo $var->getName(); ?></h1>
      <div class="recent-book-sec">
        <div class="row">
          <?php foreach ($var->getBooks() as $book): ?>
            <div class="col-md-3">
              <div class="item">
                <img src="assets/images/r1.jpg" alt="img">
                <h3><a href="/book?id=<?php echo $book->getId(); ?>">
                    <?php echo $book->getTitle(); ?>
                  </a>
                </h3>
                <h6><span class="price">$<?php echo $book->getPrice(); ?></span> / <a href="#">Buy Now</a>
                </h6>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="btn-sec">
          <button class="btn gray-btn">load More books</button>
        </div>
      </div>
    </div>
  </section>
<?php include_once ROOT . '/views/inc/footer.html.php' ?>
<?php include_once ROOT . '/views/inc/scripts.html.php' ?>