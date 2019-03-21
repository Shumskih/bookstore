<?php include ROOT . '/views/inc/head.html.php' ?>
  <body>
<?php include ROOT . '/views/inc/outdatedBrowser.html.php'; ?>

  <!-- Main wrapper -->
  <div class="wrapper" id="wrapper">

    <!-- Header -->
      <?php include ROOT . '/views/inc/menu.html.php' ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
      <?php include ROOT . '/views/inc/searchPopUp.html.php' ?>
    <!-- End Search Popup -->
    <!-- Start breadcrumbs area -->
      <?php include ROOT . '/views/inc/breadcrumbs.html.php' ?>
    <!-- End breadcrumbs area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area section-padding--lg bg--white">
      <div class="container">
        <div class="row">
            <?php if (!isset($_SESSION['cart'])): ?>
              <div class="col-md-12 col-sm-12 ol-lg-12">
                <p class="alert alert-dark text-center mb-5">Cart is empty</p>
              </div>
            <?php else: ?>
          <div class="col-md-12 col-sm-12 ol-lg-12">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="table-content wnro__table table-responsive">
                <table>
                  <thead>
                  <tr class="title-top">
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-subtotal">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($_SESSION['cart'] as $b): ?>
                      <?php $book = (object)unserialize($b['book']); ?>
                    <tr>
                      <td class="product-thumbnail"><a href="/book?id=<?php echo $book->getId(); ?>">
                          <img src="/assets/images/product/sm-3/3.jpg" alt="product img"></a>
                      </td>
                      <td class="product-name"><a
                                href="/book?id=<?php echo $book->getId(); ?>"><?php echo $book->getTitle(); ?></a></td>
                      <td class="product-price"><span class="amount">$<?php echo $book->getPrice(); ?></span></td>
                      <td class="product-quantity">
                        <input type="number" name="<?php echo $book->getTitle(); ?>" value="<?php echo $b['qty'] ?>">
                      </td>
                      <td class="product-subtotal">$<?php echo $book->getPrice() * $b['qty']; ?></td>
                      <td class="product-remove"><a href="/cart/delete-from-cart?id=<?php echo $book->getId(); ?>">X</a></td>
                    </tr>
                  <?php unset($book); ?>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="cartbox__btn">
                <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                  <li><a href="#">Coupon Code</a></li>
                  <li><a href="#">Apply Code</a></li>
                  <li><button class="cart-button-list" type="submit" name="updateCart">Update Cart</button></li>
                  <li><a href="#">Check Out</a></li>
                </ul>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 offset-lg-6">
            <div class="cartbox__total__area">
              <div class="cart__total__amount">
                <span>Grand Total</span>
                <span>$<?php echo $_SESSION['grandTotal'] ?></span>
              </div>
            </div>
          </div>
        </div>
          <?php endif; ?>
      </div>
    </div>
    <!-- cart-main-area end -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php'; ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php' ?>