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
    <!-- Start Breadcrumbs area -->
      <?php include ROOT . '/views/inc/breadcrumbs.html.php' ?>
    <!-- End Breadcrumbs area -->
    <!-- Start Shop Page -->
    <section
            class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                  <div class="shop__list nav justify-content-center"
                       role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab"
                       href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                    <a class="nav-item nav-link" data-toggle="tab"
                       href="#nav-list" role="tab"><i
                              class="fa fa-list"></i></a>
                  </div>
                  <p>Showing 1–12 of 40 results</p>
                  <div class="orderby__wrapper">
                    <span>Sort By</span>
                    <select class="shot__byselect">
                      <option>Default sorting</option>
                      <option>HeadPhone</option>
                      <option>Furniture</option>
                      <option>Jewellery</option>
                      <option>Handmade</option>
                      <option>Kids</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab__container">
              <div class="shop-grid tab-pane fade show active" id="nav-grid"
                   role="tabpanel">
                <div class="row">
                  <!-- Start Single Product -->
                    <?php if (isset($category)): ?>
                        <?php foreach ($category->getBooks() as $b): ?>
                            <?php $book = (object) $b; ?>
                        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                          <div class="product__thumb">
                            <a class="first__img"
                               href="/book?id=<?php echo $book->getId(); ?>"><img
                                      src="/assets/images/books/1.jpg"
                                      alt="product image"></a>
                            <a class="second__img animation1"
                               href="/book?id=<?php echo $book->getId(); ?>"><img
                                      src="/assets/images/books/2.jpg"
                                      alt="product image"></a>
                            <div class="hot__box">
                              <span class="hot-label">BEST SELLER</span>
                            </div>
                          </div>
                          <div class="product__content content--center">
                            <h4>
                              <a href="/book?id=<?php echo $book->getId(); ?>"><?php echo $book->getTitle(); ?></a>
                            </h4>
                            <ul class="prize d-flex">
                              <li>$<?php echo $book->getPrice(); ?></li>
                            </ul>
                            <div class="action">
                              <div class="actions_inner">
                                <ul class="add_to_links">
                                  <li><a class="cart" href="cart.html"><i
                                              class="bi bi-shopping-bag4"></i></a>
                                  </li>
                                  <li><a class="wishlist"
                                         href="wishlist.html"><i
                                              class="bi bi-shopping-cart-full"></i></a>
                                  </li>
                                  <li><a class="compare" href="#"><i
                                              class="bi bi-heart-beat"></i></a>
                                  </li>
                                  <li><a data-toggle="modal"
                                         title="Quick View"
                                         class="quickview modal-view detail-link"
                                         href="#productmodal"><i
                                              class="bi bi-search"></i></a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <div class="product__hover--content">
                              <ul class="rating d-flex">
                                <li class="on"><i class="fa fa-star-o"></i>
                                </li>
                                <li class="on"><i class="fa fa-star-o"></i>
                                </li>
                                <li class="on"><i class="fa fa-star-o"></i>
                                </li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                  <!-- End Single Product -->
                </div>
                <ul class="wn__pagination">
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a>
                  </li>
                </ul>
              </div>
              <div class="shop-grid tab-pane fade" id="nav-list"
                   role="tabpanel">
                <div class="list__view__wrapper">
                  <!-- Start Single Product -->
                  <div class="list__view">
                    <div class="thumb">
                      <a class="first__img" href="single-product.html"><img
                                src="/assets/images/product/1.jpg"
                                alt="product images"></a>
                      <a class="second__img animation1"
                         href="single-product.html"><img
                                src="/assets/images/product/2.jpg"
                                alt="product images"></a>
                    </div>
                    <div class="content">
                      <h2><a href="single-product.html">Ali Smith</a></h2>
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <ul class="prize__box">
                        <li>$111.00</li>
                        <li class="old__prize">$220.00</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nam fringilla augue nec est tristique auctor.
                        Donec non est at libero vulputate rutrum. Morbi ornare
                        lectus quis justo gravida semper. Nulla tellus mi,
                        vulputate adipiscing cursus eu, suscipit id nulla.</p>
                      <ul class="cart__action d-flex">
                        <li class="cart"><a href="cart.html">Add to cart</a>
                        </li>
                        <li class="wishlist"><a href="cart.html"></a></li>
                        <li class="compare"><a href="cart.html"></a></li>
                      </ul>

                    </div>
                  </div>
                  <!-- End Single Product -->
                  <!-- Start Single Product -->
                  <div class="list__view mt--40">
                    <div class="thumb">
                      <a class="first__img" href="single-product.html"><img
                                src="/assets/images/product/2.jpg"
                                alt="product images"></a>
                      <a class="second__img animation1"
                         href="single-product.html"><img
                                src="/assets/images/product/4.jpg"
                                alt="product images"></a>
                    </div>
                    <div class="content">
                      <h2><a href="single-product.html">Blood In Water</a></h2>
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <ul class="prize__box">
                        <li>$111.00</li>
                        <li class="old__prize">$220.00</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nam fringilla augue nec est tristique auctor.
                        Donec non est at libero vulputate rutrum. Morbi ornare
                        lectus quis justo gravida semper. Nulla tellus mi,
                        vulputate adipiscing cursus eu, suscipit id nulla.</p>
                      <ul class="cart__action d-flex">
                        <li class="cart"><a href="cart.html">Add to cart</a>
                        </li>
                        <li class="wishlist"><a href="cart.html"></a></li>
                        <li class="compare"><a href="cart.html"></a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- End Single Product -->
                  <!-- Start Single Product -->
                  <div class="list__view mt--40">
                    <div class="thumb">
                      <a class="first__img" href="single-product.html"><img
                                src="/assets/images/product/3.jpg"
                                alt="product images"></a>
                      <a class="second__img animation1"
                         href="single-product.html"><img
                                src="/assets/images/product/6.jpg"
                                alt="product images"></a>
                    </div>
                    <div class="content">
                      <h2><a href="single-product.html">Madeness Overated</a>
                      </h2>
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <ul class="prize__box">
                        <li>$111.00</li>
                        <li class="old__prize">$220.00</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nam fringilla augue nec est tristique auctor.
                        Donec non est at libero vulputate rutrum. Morbi ornare
                        lectus quis justo gravida semper. Nulla tellus mi,
                        vulputate adipiscing cursus eu, suscipit id nulla.</p>
                      <ul class="cart__action d-flex">
                        <li class="cart"><a href="cart.html">Add to cart</a>
                        </li>
                        <li class="wishlist"><a href="cart.html"></a></li>
                        <li class="compare"><a href="cart.html"></a></li>
                      </ul>

                    </div>
                  </div>
                  <!-- End Single Product -->
                  <!-- Start Single Product -->
                  <div class="list__view mt--40">
                    <div class="thumb">
                      <a class="first__img" href="single-product.html"><img
                                src="/assets/images/product/4.jpg"
                                alt="product images"></a>
                      <a class="second__img animation1"
                         href="single-product.html"><img
                                src="/assets/images/product/6.jpg"
                                alt="product images"></a>
                    </div>
                    <div class="content">
                      <h2><a href="single-product.html">Watching You</a></h2>
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <ul class="prize__box">
                        <li>$111.00</li>
                        <li class="old__prize">$220.00</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nam fringilla augue nec est tristique auctor.
                        Donec non est at libero vulputate rutrum. Morbi ornare
                        lectus quis justo gravida semper. Nulla tellus mi,
                        vulputate adipiscing cursus eu, suscipit id nulla.</p>
                      <ul class="cart__action d-flex">
                        <li class="cart"><a href="cart.html">Add to cart</a>
                        </li>
                        <li class="wishlist"><a href="cart.html"></a></li>
                        <li class="compare"><a href="cart.html"></a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- End Single Product -->
                  <!-- Start Single Product -->
                  <div class="list__view mt--40">
                    <div class="thumb">
                      <a class="first__img" href="single-product.html"><img
                                src="/assets/images/product/5.jpg"
                                alt="product images"></a>
                      <a class="second__img animation1"
                         href="single-product.html"><img
                                src="/assets/images/product/9.jpg"
                                alt="product images"></a>
                    </div>
                    <div class="content">
                      <h2><a href="single-product.html">Court Wings Run</a></h2>
                      <ul class="rating d-flex">
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li class="on"><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                      </ul>
                      <ul class="prize__box">
                        <li>$111.00</li>
                        <li class="old__prize">$220.00</li>
                      </ul>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nam fringilla augue nec est tristique auctor.
                        Donec non est at libero vulputate rutrum. Morbi ornare
                        lectus quis justo gravida semper. Nulla tellus mi,
                        vulputate adipiscing cursus eu, suscipit id nulla.</p>
                      <ul class="cart__action d-flex">
                        <li class="cart"><a href="cart.html">Add to cart</a>
                        </li>
                        <li class="wishlist"><a href="cart.html"></a></li>
                        <li class="compare"><a href="cart.html"></a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- End Single Product -->
                </div>
              </div>
            </div>
          </div>
          <!-- Sidebar Start -->
          <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
            <div class="shop__sidebar">
                <?php include ROOT . '/views/inc/sidebar/productCategories.html.php' ?>
                <?php include ROOT . '/views/inc/sidebar/filterByPrice.html.php' ?>
                <?php include ROOT . '/views/inc/sidebar/compareProducts.html.php' ?>
                <?php include ROOT . '/views/inc/sidebar/tags.html.php'; ?>
                <?php include ROOT . '/views/inc/sidebar/banner.html.php' ?>
            </div>
          </div>
          <!-- Sidebar End -->
        </div>
      </div>
    </section>
    <!-- End Shop Page -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php' ?>
    <!-- //Footer Area -->
    <!-- QUICK VIEW PRODUCT -->
      <?php include ROOT . '/views/inc/quickViewProduct.html.php' ?>
    <!-- END QUICK VIEW PRODUCT -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php' ?>