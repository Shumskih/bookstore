<?php include ROOT . '/views/inc/head.html.php' ?>
  <body>
<?php include ROOT . '/views/inc/outdatedBrowser.html.php' ?>
  <!-- Main wrapper -->
<div class="wrapper" id="wrapper">
  <!-- Header -->
    <?php include ROOT . '/views/inc/menu.html.php' ?>
  <!-- //Header -->
  <!-- Start Search Popup -->
    <?php include ROOT . '/views/inc/searchPopUp.html.php' ?>
  <!-- End Search Popup -->
  <!-- Start Slider area -->
  <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <!-- Start Single Slide -->
      <?php include ROOT . '/views/inc/indexPageSlider.html.php' ?>
    <!-- End Slider area -->
    <!-- Start New Products Area -->
    <section class="wn__product__area brown--color pt--80  pb--30">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section__title text-center">
              <h2 class="title__be--2">New <span
                        class="color--theme">Products</span></h2>
            </div>
          </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">


          <!-- Start Single Product -->

            <?php foreach ($var as $book): ?>
              <div class="product product__style--3">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img"
                       href="/book?id=<?php echo $book['id']; ?>"><img
                              src="/assets/images/books/1.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="/book?id=<?php echo $book['id']; ?>"><img
                              src="/assets/images/books/2.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SELLER</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4>
                      <a href="/book?id=<?php echo $book['id']; ?>"><?php echo $book['title']; ?></a>
                    </h4>
                    <ul class="prize d-flex">
                      <li><?php echo $book['price']; ?>$</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a></li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i class="bi bi-search"></i></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="product__hover--content">
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

          <!-- Start Single Product -->


        </div>
        <!-- End Single Tab Content -->
      </div>
    </section>
    <!-- End New Products Area -->
    <!-- Start NEwsletter Area -->
    <section class="wn__newsletter__area bg-image--2">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
            <div class="section__title text-center">
              <h2>Stay With Us</h2>
            </div>
            <div class="newsletter__block text-center">
              <p>Subscribe to our newsletters now and stay up-to-date with new
                collections, the latest lookbooks and exclusive offers.</p>
              <form action="#">
                <div class="newsletter__box">
                  <input type="email" placeholder="Enter your e-mail">
                  <button>Subscribe</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End NEwsletter Area -->

    <!-- Start Recent Post Area -->
    <section class="wn__recent__post bg--gray ptb--80">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section__title text-center">
              <h2 class="title__be--2">Our <span
                        class="color--theme">Blog</span></h2>
              <p>There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered lebmid alteration in some ledmid
                form</p>
            </div>
          </div>
        </div>
        <div class="row mt--50">
          <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="post__itam">
              <div class="content">
                <h3><a href="blog-details.html">International activities of the
                    Frankfurt Book </a></h3>
                <p>We are proud to announce the very first the edition of the
                  frankfurt news.We are proud to announce the very first of
                  edition of the fault frankfurt news for us.</p>
                <div class="post__time">
                  <span class="day">Dec 06, 18</span>
                  <div class="post-meta">
                    <ul>
                      <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                      <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="post__itam">
              <div class="content">
                <h3><a href="blog-details.html">Reading has a signficant info
                    number of benefits</a></h3>
                <p>Find all the information you need to ensure your
                  experience.Find all the information you need to ensure your
                  experience . Find all the information you of.</p>
                <div class="post__time">
                  <span class="day">Mar 08, 18</span>
                  <div class="post-meta">
                    <ul>
                      <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                      <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-sm-12">
            <div class="post__itam">
              <div class="content">
                <h3><a href="blog-details.html">The London Book Fair is to be
                    packed with exciting </a></h3>
                <p>The London Book Fair is the global area inon marketplace for
                  rights negotiation.The year London Book Fair is the global
                  area inon forg marketplace for rights.</p>
                <div class="post__time">
                  <span class="day">Nov 11, 18</span>
                  <div class="post-meta">
                    <ul>
                      <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                      <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Recent Post Area -->

    <!-- Start Last Viewed Books -->
      <?php if (isset($_SESSION['lastFiveViewedBooks'])): ?>
        <section class="wn__product__area brown--color pt--80  pb--30">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="section__title text-center">
                  <h2 class="title__be--2">Last <span
                            class="color--theme">Viewed</span></h2>
                  <p>You are viewed these products later</p>
                </div>
              </div>
            </div>
            <!-- Start Single Tab Content -->
            <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
              <!-- Start Single Product -->
                <?php foreach ($_SESSION['lastFiveViewedBooks'] as $book): ?>
                  <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                      <div class="product__thumb">
                        <a class="first__img"
                           href="/book?id=<?php echo $book['id']; ?>"><img
                                  src="/assets/images/books/1.jpg"
                                  alt="product image"></a>
                        <a class="second__img animation1"
                           href="/book?id=<?php echo $book['id']; ?>"><img
                                  src="/assets/images/books/2.jpg"
                                  alt="product image"></a>
                        <div class="hot__box">
                          <span class="hot-label">BEST SELLER</span>
                        </div>
                      </div>
                      <div class="product__content content--center">
                        <h4>
                          <a href="/book?id=<?php echo $book['id']; ?>"><?php echo $book['title']; ?></a>
                        </h4>
                        <ul class="prize d-flex">
                          <li><?php echo $book['price']; ?>$</li>
                        </ul>
                        <div class="action">
                          <div class="actions_inner">
                            <ul class="add_to_links">
                              <li><a class="cart" href="cart.html"><i
                                          class="bi bi-shopping-bag4"></i></a></li>
                              <li><a class="wishlist" href="wishlist.html"><i
                                          class="bi bi-shopping-cart-full"></i></a>
                              </li>
                              <li><a class="compare" href="#"><i
                                          class="bi bi-heart-beat"></i></a></li>
                              <li><a data-toggle="modal" title="Quick View"
                                     class="quickview modal-view detail-link"
                                     href="#productmodal"><i class="bi bi-search"></i></a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="product__hover--content">
                          <ul class="rating d-flex">
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li class="on"><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <!-- Start Single Product -->
            </div>
            <!-- End Single Tab Content -->
          </div>
        </section>
      <?php endif; ?>
    <!-- End Last Viewed Books -->
      <?php include ROOT . '/views/inc/footer.html.php' ?>
    <!-- QUICKVIEW PRODUCT -->
      <?php include ROOT . '/views/inc/quickViewProduct.html.php' ?>
    <!-- END QUICK VIEW PRODUCT -->
  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php' ?>