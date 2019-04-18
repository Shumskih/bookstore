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
  <!-- Start Breadcrumb area -->
    <?php include ROOT . '/views/inc/breadcrumbs.html.php'; ?>
  <!-- End Breadcrumb area -->
  <!-- Start main Content -->
  <div class="maincontent bg--white pt--80 pb--55">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-12">
          <div class="wn__single__product">
            <div class="row">
              <div class="col-lg-6 col-12">
                <div class="wn__fotorama__wrapper">
                  <div class="fotorama wn__fotorama__action"
                       data-nav="thumbs">
                      <?php foreach ($book->getImages() as $img): ?>
                      <?php $img = (object)$img; ?>
                        <a href="/assets/images/books/<?php echo $book->getId() . '/' . $img->getPath(); ?>"><img src="/assets/images/books/<?php echo $book->getId() . '/' . $img->getPath(); ?>" alt=""></a>
                      <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="product__info__main">
                  <h1><?php echo $book->getTitle(); ?></h1>
                  <div class="product-reviews-summary d-flex">
                    <ul class="rating-summary d-flex">
                      <li><i class="zmdi zmdi-star-outline"></i></li>
                      <li><i class="zmdi zmdi-star-outline"></i></li>
                      <li><i class="zmdi zmdi-star-outline"></i></li>
                      <li class="off"><i
                                class="zmdi zmdi-star-outline"></i>
                      </li>
                      <li class="off"><i
                                class="zmdi zmdi-star-outline"></i>
                      </li>
                    </ul>
                  </div>
                  <div class="price-box">
                    <span>$<?php echo $book->getPrice(); ?></span>
                  </div>
                  <div class="product__overview">
                    <p>
                      <strong>Author:&nbsp;&nbsp;</strong><?php echo $book->getAuthorSurname() . ' '
                                                                     . $book->getAuthorName(); ?>
                    </p>
                    <p>
                      <strong>Pages:&nbsp;&nbsp;</strong><?php echo $book->getPages(); ?>
                    </p>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="box-tocart d-flex">
                      <input type="hidden" name="id" value="<?php echo $book->getId(); ?>">
                      <span>Qty</span>
                      <input type="number" class="input-text qty" name="qty" min="1" value="1" title="Qty">
                      <div class="addtocart__actions">
                        <button class="tocart" type="submit" name="addToCart" title="Add to Cart">Add to Cart</button>
                      </div>
                      <div class="product-addto-links clearfix">
                        <a class="wishlist" href="#"></a>
                        <a class="compare" href="#"></a>
                      </div>
                    </div>
                      <?php
                      $userSession = new UserSessionController();
                      $user        = (object)$userSession->read();
                      $permissions = $user->checkPermissions();
                      ?>
                      <?php if ($permissions): ?>
                        <div>
                          <button type="submit" name="deleteBook" class="btn btn-outline-danger">Delete Book</button>
                        </div>
                      <?php endif; ?>
                  </form>
                  <div class="product_meta">
											<span class="posted_in">Categories:
                        <?php foreach ($book->getCategories() as $category): ?>
                            <?php $category = (object)$category; ?>
                          <a href="/category?id=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a>
                          <br>
                        <?php endforeach; ?>
											</span>
                  </div>
                  <div class="product-share">
                    <ul>
                      <li class="categories-title">Share :</li>
                      <li>
                        <a href="#">
                          <i class="icon-social-twitter icons"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-social-tumblr icons"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-social-facebook icons"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="icon-social-linkedin icons"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="product__info__detailed">
            <div class="pro_details_nav nav justify-content-start" role="tablist">
              <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
              <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
            </div>
            <div class="tab__container">
              <!-- Start Single Tab Content -->
              <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                <div class="description__attribute">
                  <p>
                      <?php echo $book->getDescription(); ?>
                  </p>
                </div>
              </div>
              <!-- End Single Tab Content -->
              <!-- Start Single Tab Content -->
              <div class="pro__tab_label tab-pane fade"
                   id="nav-review"
                   role="tabpanel">
                <div class="review__attribute">
                  <h1>Customer Reviews</h1>
                  <h2>Hastech</h2>
                  <div class="review__ratings__type d-flex">
                    <div class="review-ratings">
                      <div class="rating-summary d-flex">
                        <span>Quality</span>
                        <ul class="rating d-flex">
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>

                      <div class="rating-summary d-flex">
                        <span>Price</span>
                        <ul class="rating d-flex">
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>
                      <div class="rating-summary d-flex">
                        <span>value</span>
                        <ul class="rating d-flex">
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li><i class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>
                    </div>
                    <div class="review-content">
                      <p>Hastech</p>
                      <p>Review by Hastech</p>
                      <p>Posted on 11/6/2018</p>
                    </div>
                  </div>
                </div>
                <div class="review-fieldset">
                  <h2>You're reviewing:</h2>
                  <h3>Chaz Kangeroo Hoodie</h3>
                  <div class="review-field-ratings">
                    <div class="product-review-table">
                      <div class="review-field-rating d-flex">
                        <span>Quality</span>
                        <ul class="rating d-flex">
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>
                      <div class="review-field-rating d-flex">
                        <span>Price</span>
                        <ul class="rating d-flex">
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>
                      <div class="review-field-rating d-flex">
                        <span>Value</span>
                        <ul class="rating d-flex">
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                          <li class="off"><i
                                    class="zmdi zmdi-star"></i></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="review_form_field">
                    <div class="input__box">
                      <span>Nickname</span>
                      <input id="nickname_field" type="text"
                             name="nickname">
                    </div>
                    <div class="input__box">
                      <span>Summary</span>
                      <input id="summery_field" type="text"
                             name="summery">
                    </div>
                    <div class="input__box">
                      <span>Review</span>
                      <textarea name="review"></textarea>
                    </div>
                    <div class="review-form-actions">
                      <button>Submit Review</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Single Tab Content -->
            </div>
          </div>


          <div class="wn__related__product pt--80 pb--50">
            <div class="section__title text-center">
              <h2 class="title__be--2">Related Products</h2>
            </div>
            <div class="row mt--60">
              <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/1/1.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/2/2.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALLER</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">robin parrish</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/3/3.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/4/4.jpg"
                              alt="product image"></a>
                    <div class="hot__box color--2">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">The Remainng</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/7/7.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/8/8.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">Lando</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$50.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/9/9.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/10/10.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">Doctor Wldo</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/11.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/2/2.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALER</span>
                    </div>
                  </div>
                  <div class="product__content content--center content--center">
                    <h4><a href="single-product.html">Animals Life</a></h4>
                    <ul class="prize d-flex">
                      <li>$50.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/1/1.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/6/6.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALER</span>
                    </div>
                  </div>
                  <div class="product__content content--center content--center">
                    <h4><a href="single-product.html">Olio Madu</a></h4>
                    <ul class="prize d-flex">
                      <li>$50.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
              </div>
            </div>
          </div>
          <div class="wn__related__product">
            <div class="section__title text-center">
              <h2 class="title__be--2">upsell products</h2>
            </div>
            <div class="row mt--60">
              <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/1/1.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/2/2.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALLER</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">robin parrish</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/3/3.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/4/4.jpg"
                              alt="product image"></a>
                    <div class="hot__box color--2">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">The Remainng</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/7/7.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/8/8.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">Lando</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$50.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/9/9.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/10/10.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">HOT</span>
                    </div>
                  </div>
                  <div class="product__content content--center">
                    <h4><a href="single-product.html">Doctor Wldo</a></h4>
                    <ul class="prize d-flex">
                      <li>$35.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/11.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/2/2.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALER</span>
                    </div>
                  </div>
                  <div class="product__content content--center content--center">
                    <h4><a href="single-product.html">Animals Life</a></h4>
                    <ul class="prize d-flex">
                      <li>$50.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
                <!-- Start Single Product -->
                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                  <div class="product__thumb">
                    <a class="first__img" href="single-product.html"><img
                              src="/assets/images/books/1/1.jpg"
                              alt="product image"></a>
                    <a class="second__img animation1"
                       href="single-product.html"><img
                              src="/assets/images/books/6/6.jpg"
                              alt="product image"></a>
                    <div class="hot__box">
                      <span class="hot-label">BEST SALER</span>
                    </div>
                  </div>
                  <div class="product__content content--center content--center">
                    <h4><a href="single-product.html">Olio Madu</a></h4>
                    <ul class="prize d-flex">
                      <li>$50.00</li>
                      <li class="old_prize">$35.00</li>
                    </ul>
                    <div class="action">
                      <div class="actions_inner">
                        <ul class="add_to_links">
                          <li><a class="cart" href="cart.html"><i
                                      class="bi bi-shopping-bag4"></i></a>
                          </li>
                          <li><a class="wishlist" href="wishlist.html"><i
                                      class="bi bi-shopping-cart-full"></i></a>
                          </li>
                          <li><a class="compare" href="#"><i
                                      class="bi bi-heart-beat"></i></a></li>
                          <li><a data-toggle="modal" title="Quick View"
                                 class="quickview modal-view detail-link"
                                 href="#productmodal"><i
                                      class="bi bi-search"></i></a></li>
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
                <!-- Start Single Product -->
              </div>
            </div>
          </div>
        </div>
        <!-- Sidebar Start -->
        <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
          <div class="shop__sidebar">
              <?php include ROOT
                            . '/views/inc/sidebar/productCategories.html.php' ?>
              <?php include ROOT
                            . '/views/inc/sidebar/filterByPrice.html.php' ?>
              <?php include ROOT
                            . '/views/inc/sidebar/compareProducts.html.php' ?>
              <?php include ROOT . '/views/inc/sidebar/tags.html.php'; ?>
              <?php include ROOT . '/views/inc/sidebar/banner.html.php' ?>
          </div>
        </div>
        <!-- Sidebar End -->
      </div>
    </div>
  </div>
  <!-- End main Content -->
  <!-- Start Search Popup -->
  <div class="box-search-content search_active block-bg close__top">
    <form id="search_mini_form--2" class="minisearch" action="#">
      <div class="field__search">
        <input type="text" placeholder="Search entire store here...">
        <div class="action">
          <a href="#"><i class="zmdi zmdi-search"></i></a>
        </div>
      </div>
    </form>
    <div class="close__wrap">
      <span>close</span>
    </div>
  </div>
  <!-- End Search Popup -->
  <!-- Footer Area -->
    <?php include ROOT . '/views/inc/footer.html.php' ?>
  <!-- //Footer Area -->
</div>
<!-- //Main wrapper -->
<!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php' ?>
