<?php
$userSessionController = new UserSessionController();
$userSession           = $userSessionController->read();
?>
<header id="wn__header"
        class="<?php if (URI !== '/'): ?>oth-page <?php endif; ?>header__area header__absolute sticky__header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-6 col-lg-2">
        <div class="logo">
          <a href="/">
            <img src="/assets/images/logo/logo.png" alt="logo images">
          </a>
        </div>
      </div>
      <div class="col-lg-8 d-none d-lg-block">
        <nav class="mainmenu__nav">
          <ul class="meninmenu d-flex justify-content-start">
            <li class="drop with--one--item">
              <a href="/">Home</a>
            </li>
            <li class="drop"><a href="/books">Books</a>
            </li>
              <?php if ($userSessionController->getRoleSuperUser()): ?>
                <li class="drop"><a>Administration</a>
                  <div class="megamenu dropdown">
                    <ul class="item item01">
                      <li><a href="/administration/orders">Orders <span
                                  class="badge badge-info">New: <?php echo OrderDaoImpl::getCountNewOrders(); ?></span></a>
                      </li>
                      <li><a href="/administration/add-new-book">Add New Book</a></li>
                      <li><a href="/administration/delivery">Delivery</a></li>
                    </ul>
                  </div>
                </li>
              <?php endif; ?>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/fake-it">Fake-it</a></li>
          </ul>
        </nav>
      </div>
      <div class="col-md-6 col-sm-6 col-6 col-lg-2">
        <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
          <li class="shop_search"><a class="search__active" href="#"></a></li>
          <li class="wishlist"><a href="#"></a></li>
          <li class="shopcart"><a class="cartbox_active" href="#">
                  <?php if (isset($_SESSION['cart'])): ?>
                    <span class="product_qun"><?php echo count($_SESSION['cart']); ?></span>
                  <?php endif; ?>
            </a>
            <!-- Start Shopping Cart -->
            <div class="block-minicart minicart__active">
              <div class="minicart-content-wrapper">
                <div class="micart__close">
                  <span>close</span>
                </div>
                <div class="items-total d-flex justify-content-between">
                  <span>3 items</span>
                  <span>Cart Subtotal</span>
                </div>
                <div class="total_amount text-right">
                  <span>$66.00</span>
                </div>
                <div class="mini_action checkout">
                  <a class="checkout__btn" href="cart/checkout">Go to Checkout</a>
                </div>
                <div class="single__items">
                  <div class="miniproduct">
                    <div class="item01 d-flex">
                      <div class="thumb">
                        <a href="product-details.html"><img src="/assets/images/product/sm-img/1.jpg"
                                                            alt="product images"></a>
                      </div>
                      <div class="content">
                        <h6><a href="product-details.html">Voyage Yoga Bag</a></h6>
                        <span class="prize">$30.00</span>
                        <div class="product_prize d-flex justify-content-between">
                          <span class="qun">Qty: 01</span>
                          <ul class="d-flex justify-content-end">
                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="item01 d-flex mt--20">
                      <div class="thumb">
                        <a href="product-details.html"><img src="/assets/images/product/sm-img/3.jpg"
                                                            alt="product images"></a>
                      </div>
                      <div class="content">
                        <h6><a href="product-details.html">Impulse Duffle</a></h6>
                        <span class="prize">$40.00</span>
                        <div class="product_prize d-flex justify-content-between">
                          <span class="qun">Qty: 03</span>
                          <ul class="d-flex justify-content-end">
                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="item01 d-flex mt--20">
                      <div class="thumb">
                        <a href="product-details.html"><img src="/assets/images/product/sm-img/2.jpg"
                                                            alt="product images"></a>
                      </div>
                      <div class="content">
                        <h6><a href="product-details.html">Compete Track Tote</a></h6>
                        <span class="prize">$40.00</span>
                        <div class="product_prize d-flex justify-content-between">
                          <span class="qun">Qty: 03</span>
                          <ul class="d-flex justify-content-end">
                            <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mini_action cart">
                  <a class="cart__btn" href="/cart">View and edit cart</a>
                </div>
              </div>
            </div>
            <!-- End Shopping Cart -->
          </li>
          <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
            <div class="searchbar__content setting__block">
              <div class="content-inner">
                <div class="switcher-currency">
                  <strong class="label switcher-label">
                    <span>My Account</span>
                  </strong>
                  <div class="switcher-options">
                    <div class="switcher-currency-trigger">
                      <div class="setting__menu">
                          <?php
                          if (isset($_SESSION['login'])): ?>
                              <?php
                              $userSessionController = new UserSessionController();
                              $userSession           = $userSessionController->read();
                              ?>
                            <span><a href="">
                              <?php echo 'Hello, ' . $userSession->getSurname() . ' ' . $userSession->getName(); ?>
                        </a></span>
                          <?php endif; ?>
                        <span><a href="#">Compare Product</a></span>
                        <span><a href="/account">My Account</a></span>
                        <span><a href="/wishlist">My Wishlist</a></span>
                        <span><a href="/my-orders">My Orders</a></span>
                          <?php if (!isset($_SESSION['login'])): ?>
                            <span><a href="/account">Sign In</a></span>
                            <span><a href="/account">Create An Account</a></span>
                          <?php else: ?>
                            <span><a href="/logout">Logout</a></span>
                          <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- Start Mobile Menu -->
    <div class="row d-none">
      <div class="col-lg-12 d-none">
        <nav class="mobilemenu__nav">
          <ul class="meninmenu">
            <li>
              <a href="/">Home</a>
            </li>
            <li><a href="/books">Books</a></li>
            <li><a href="blog.html">Blog</a>
              <ul>
                <li><a href="blog.html">Blog Page</a></li>
                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                <li><a href="blog-details.html">Blog Details</a></li>
              </ul>
            </li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- End Mobile Menu -->
    <div class="mobile-menu d-block d-lg-none">
    </div>
    <!-- Mobile Menu -->
  </div>
</header>