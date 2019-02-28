<?php include_once ROOT . '/views/inc/head.html.php' ?>
  <body>
  <header>
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-3"><a href="#"
                                   class="web-url">www.bookstore.com</a></div>
          <div class="col-md-6">
            <h5>Free Shipping Over $99 + 3 Free Samples With Every Order</h5>
          </div>
          <div class="col-md-3">
            <span class="ph-number">Call : 800 1234 5678</span>
          </div>
        </div>
      </div>
    </div>
    <?php include_once ROOT . '/views/inc/menu.html.php'?>
  </header>
  <div class="breadcrumb">
    <div class="container">
      <a class="breadcrumb-item" href="index.html">Home</a>
      <span class="breadcrumb-item active">Shop</span>
    </div>
  </div>
  <section class="static about-sec">
    <div class="container">
      <h2>highly recommendes books</h2>
      <div class="recomended-sec">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img1.jpg" alt="img">
              <h3>how to be a bwase</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <a href="book.html.php">
                  <span><i class="fa fa-long-arrow-right"
                           aria-hidden="true"></i></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img2.jpg" alt="img">
              <h3>How to write a book...</h3>
              <h6><span class="price">$19</span> / <a href="#">Buy Now</a></h6>
              <span class="sale">Sale !</span>
              <div class="hover">
                <a href="book.html.php">
                  <span><i class="fa fa-long-arrow-right"
                           aria-hidden="true"></i></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img3.jpg" alt="img">
              <h3>7-day self publish...</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <a href="book.html.php">
                  <span><i class="fa fa-long-arrow-right"
                           aria-hidden="true"></i></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img4.jpg" alt="img">
              <h3>wendy doniger</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <a href="book.html.php">
                  <span><i class="fa fa-long-arrow-right"
                           aria-hidden="true"></i></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <h2>recently added books to our store</h2>
      <div class="recent-book-sec">
        <div class="row">
          <?php foreach ($var as $book): ?>
            <div class="col-md-3">
              <div class="item">
                <img src="assets/images/r1.jpg" alt="img">
                <h3><a href="/book?id=<?php echo $book['id'] ?>">
                    <?php echo $book['title'] ?>
                  </a>
                </h3>
                <h6><span class="price">$<?php echo $book['price'] ?></span> / <a href="#">Buy Now</a>
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