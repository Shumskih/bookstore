﻿<?php include ROOT . '/views/inc/head.html.php'; ?>
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
    <!-- Start Bradcaump area -->
      <?php include ROOT . '/views/inc/breadcrumbs.html.php'; ?>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="wn_checkout_wrap">
              <div class="checkout_info">
                  <?php if (is_object($var)) {
                      $order = (object)$var;
                  } ?>
                <span>Order № <?php echo $order->getId(); ?></span>
              </div>
              <div class="checkout_info">
                <span>
                  <?php if (empty($order->getUserMessage())) {
                      echo 'User do not leave a message';
                  } else {
                      echo $order->getUserMessage();
                  }
                  ?>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="customer_details">
              <h3>Billing details</h3>
              <div class="customar__field">
                  <?php
                  $user    = (object)$order->getUser($order->getId());
                  $address = (object)$user->getAddress($user->getId());
                  ?>
                <p><strong>User:</strong></p>
                <hr>
                <p><strong>Name: </strong> <?php echo $user->getName(); ?></p>
                <p><strong>Surname: </strong> <?php echo $user->getSurname(); ?></p>
                <p><strong>Email: </strong> <?php echo $user->getEmail(); ?></p>
                <p><strong>Phone: </strong> <?php echo $user->getMobilePhone(); ?></p>
                <p><strong>Address: </strong></p>
                <hr>
                <p><strong>Country: </strong> <?php echo $address->getCountry(); ?></p>
                <p><strong>District: </strong> <?php echo $address->getDistrict(); ?></p>
                <p><strong>City: </strong> <?php echo $address->getCity(); ?></p>
                <p><strong>Street: </strong> <?php echo $address->getStreet(); ?></p>
                <p><strong>Building: </strong> <?php echo $address->getBuilding(); ?></p>
                <p><strong>Apartment: </strong> <?php echo $address->getApartment(); ?></p>
                <p><strong>Postcode: </strong> <?php echo $address->getPostcode(); ?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
            <div class="wn__order__box">
              <h3 class="onder__title">Books List</h3>
              <ul class="order__total">
                <li>Product</li>
                <li>Quantity</li>
              </ul>
                <?php $booksAndQty = $order->getBooksAndQty($order->getId()); ?>
              <ul class="order_product">
                  <?php foreach ($booksAndQty as $book): ?>
                    <li><?php echo $book['title']; ?><span><?php echo $book['quantity']; ?></span></li>
                  <?php endforeach; ?>
              </ul>
              <ul class="total__amount">
                <li>Shipping
                  <span>
                      <?php
                      $delivery = (object)$order->getDelivery($order->getId());
                      echo $delivery->getDeliveryMethod();
                      ?>
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="mt-5">
          <button type="button" class="btn btn-outline-success">Complete </button>
          <button type="button" class="btn btn-outline-danger ml-2">Cancel </button>
        </div>
      </div>
    </section>
    <!-- End Checkout Area -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php' ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php'; ?>