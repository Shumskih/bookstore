<?php include ROOT . '/views/inc/head.html.php'; ?>
  <body>
<?php include ROOT . '/views/inc/outdatedBrowser.html.php'; ?>

  <!-- Main wrapper -->
  <div class="wrapper" id="wrapper">

    <!-- Header -->
      <?php include ROOT . '/views/inc/menu.html.php'; ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
      <?php include ROOT . '/views/inc/searchPopUp.html.php'; ?>
    <!-- End Search Popup -->
    <!-- Start breadcrumbs area -->
      <?php include ROOT . '/views/inc/breadcrumbs.html.php'; ?>
    <!-- End breadcrumbs area -->
    <!-- cart-main-area start -->
    <div class="wishlist-area section-padding--lg bg__white">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="wishlist-content">
              <form action="#">
                <div class="wishlist-table wnro__table table-responsive">
                  <table>
                    <thead>
                    <tr>
                      <th class="product-remove"></th>
                      <th class="product-thumbnail">Order ID</th>
                      <th class="product-stock-stauts"><span class="nobr"> Status </span></th>
                      <th class="product-name"><span class="nobr">User Message</span></th>
                      <th class="product-add-to-cart">View Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($var as $order): ?>
                      <tr>
                        <td class="product-remove"><a href="#">&#10003;</a></td>
                        <td class="product-name"><a href="/orders?id=<?php echo $order['id']; ?>"><?php echo $order['id']; ?></a></td>
                        <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $order['status'] ?></span></td>
                        <td class="product-name"><a href="/orders?id=<?php echo $order['id']; ?>"><?php echo $order['userMessage'] ?></a></td>
                        <td class="product-add-to-cart"><a href="/orders?id=<?php echo $order['id']; ?>"> View Order</a></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- cart-main-area end -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php'; ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php'; ?>