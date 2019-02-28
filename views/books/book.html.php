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
      <span class="breadcrumb-item active">Terms and Condition</span>
    </div>
  </div>
  <section class="product-sec">
    <div class="container">
      <h1>
        <?php echo $var->getTitle(); ?>
      </h1>
      <div class="row">
        <div class="col-md-6 slider-sec">
          <!-- main slider carousel -->
          <div id="myCarousel" class="carousel slide">
            <!-- main slider carousel items -->
            <div class="carousel-inner">
              <div class="active item carousel-item" data-slide-number="0">
                <img src="assets/images/product1.jpg" class="img-fluid">
              </div>
              <div class="item carousel-item" data-slide-number="1">
                <img src="assets/images/product2.jpg" class="img-fluid">
              </div>
              <div class="item carousel-item" data-slide-number="2">
                <img src="assets/images/product3.jpg" class="img-fluid">
              </div>
            </div>
            <!-- main slider carousel nav controls -->
            <ul class="carousel-indicators list-inline">
              <li class="list-inline-item active">
                <a id="carousel-selector-0" class="selected" data-slide-to="0"
                   data-target="#myCarousel">
                  <img src="assets/images/product1.jpg" class="img-fluid">
                </a>
              </li>
              <li class="list-inline-item">
                <a id="carousel-selector-1" data-slide-to="1"
                   data-target="#myCarousel">
                  <img src="assets/images/product2.jpg" class="img-fluid">
                </a>
              </li>
              <li class="list-inline-item">
                <a id="carousel-selector-2" data-slide-to="2"
                   data-target="#myCarousel">
                  <img src="assets/images/product3.jpg" class="img-fluid">
                </a>
              </li>
            </ul>
          </div>
          <!--/main slider carousel-->
        </div>
        <div class="col-md-6 slider-content">
          <p>
            <?php echo $var->getDescription(); ?>
          </p>
          <ul>
            <li>
              <span class="name">Author</span><span
                      class="clm">:</span>
              <span class="price final"><?php echo $var->getAuthorSurname() . ' ' . $var->getAuthorName(); ?></span>
            </li>
            <li>
              <span class="name">Pages</span><span
                      class="clm">:</span>
              <span class="price final"><?php echo $var->getPages() ?></span>
            </li>
            <li>
              <span class="name">Price</span><span class="clm">:</span>
              <span class="price final">$<?php echo $var->getPrice(); ?></span>
            </li>
          </ul>
          <div class="btn-sec">
            <button class="btn ">Add To cart</button>
            <button class="btn black">Buy Now</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="related-books">
    <div class="container">
      <h2>You may also like these book</h2>
      <div class="recomended-sec">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img1.jpg" alt="img">
              <h3>how to be a bwase</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
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
                <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img3.jpg" alt="img">
              <h3>7-day self publish...</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <img src="assets/images/img4.jpg" alt="img">
              <h3>wendy doniger</h3>
              <h6><span class="price">$49</span> / <a href="#">Buy Now</a></h6>
              <div class="hover">
                <span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include_once ROOT . '/views/inc/footer.html.php' ?>
<?php include_once ROOT . '/views/inc/scripts.html.php' ?>