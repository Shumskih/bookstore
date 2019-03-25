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
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="wn_checkout_wrap">
              <div class="checkout_info">
                <span>Returning customer ?</span>
                <a class="showlogin" href="#">Click here to login</a>
              </div>
              <div class="checkout_login">
                <form class="wn__checkout__form" action="#">
                  <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new
                    customer please proceed to the Billing & Shipping section.</p>

                  <div class="input__box">
                    <label>Username or email <span>*</span></label>
                    <input type="text">
                  </div>

                  <div class="input__box">
                    <label>password <span>*</span></label>
                    <input type="password">
                  </div>
                  <div class="form__btn">
                    <button>Login</button>
                    <label class="label-for-checkbox">
                      <input id="rememberme" name="rememberme" value="forever" type="checkbox">
                      <span>Remember me</span>
                    </label>
                    <a href="#">Lost your password?</a>
                  </div>
                </form>
              </div>
              <div class="checkout_info">
                <span>Have a coupon? </span>
                <a class="showcoupon" href="#">Click here to enter your code</a>
              </div>
              <div class="checkout_coupon">
                <form action="#">
                  <div class="form__coupon">
                    <input type="text" placeholder="Coupon code">
                    <button>Apply coupon</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="customer_details">
                <?php foreach ($var as $k => $v) {
                    if ($k == 'user') {
                        $user    = (object)$v['user'];
                        $address = (object)$user->getAddress($user->getId());
                    }
                } ?>
              <h3>Billing details</h3>
              <div class="customar__field">
                <div class="margin_between">
                  <div class="input_box space_between">
                    <label>First name <span>*</span></label>
                    <input type="text" name="userName" value="<?php echo $user->getName(); ?>">
                  </div>
                  <div class="input_box space_between">
                    <label>last name <span>*</span></label>
                    <input type="text" name="Surname" value="<?php echo $user->getSurname(); ?>">
                  </div>
                </div>
                <div class="input_box">
                  <label>Country<span>*</span></label>
                  <select class="select__option">
                      <?php foreach (Countries::$countries as $code => $name): ?>
                        <option name="<?php echo $name; ?>" <?php if ($name == $address->getCountry()) {
                            echo 'selected';
                        } ?>><?php echo $name; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="input_box">
                  <label>City <span>*</span></label>
                  <input type="text" name="street" placeholder="Street address"
                         value="<?php echo $address->getCity(); ?>">
                </div>
                <div class="input_box">
                  <label>Street <span>*</span></label>
                  <input type="text" name="street" placeholder="Street address"
                         value="<?php echo $address->getStreet() . ', ' . $address->getBuilding(); ?>">
                </div>
                <div class="input_box">
                  <input type="text" placeholder="Apartment, suite, unit etc. (optional)"
                         value="<?php echo $address->getApartment(); ?>">
                </div>
                <div class="input_box">
                  <label>District<span>*</span></label>
                  <select class="select__option">
                    <option>Select a country…</option>
                    <option>Afghanistan</option>
                    <option>American Samoa</option>
                    <option>Anguilla</option>
                    <option>American Samoa</option>
                    <option>Antarctica</option>
                    <option>Antigua and Barbuda</option>
                  </select>
                </div>
                <div class="input_box">
                  <label>Postcode / ZIP <span>*</span></label>
                  <input type="text" name="postcode" value="<?php echo $address->getPostcode(); ?>">
                </div>
                <div class="margin_between">
                  <div class="input_box space_between">
                    <label>Phone <span>*</span></label>
                    <input type="tel" name="phone" value="<?php echo $user->getMobilePhone(); ?>">
                  </div>

                  <div class="input_box space_between">
                    <label>Email address <span>*</span></label>
                    <input type="email" name="email" value="<?php echo $user->getEmail(); ?>">
                  </div>
                </div>
              </div>
              <div class="create__account">
                <div class="wn__accountbox">
                  <input class="input-checkbox" name="createaccount" value="1" type="checkbox">
                  <span>Create an account ?</span>
                </div>
                <div class="account__field">
                  <form action="#">
                    <label>Account password <span>*</span></label>
                    <input type="text" placeholder="password">
                  </form>
                </div>
              </div>
            </div>
            <div class="customer_details mt--20">
              <div class="differt__address">
                <input name="ship_to_different_address" value="1" type="checkbox">
                <span>Ship to a different address ?</span>
              </div>
              <div class="customar__field differt__form mt--40">
                <div class="margin_between">
                  <div class="input_box space_between">
                    <label>First name <span>*</span></label>
                    <input type="text">
                  </div>
                  <div class="input_box space_between">
                    <label>last name <span>*</span></label>
                    <input type="text">
                  </div>
                </div>
                <div class="input_box">
                  <label>Company name <span>*</span></label>
                  <input type="text">
                </div>
                <div class="input_box">
                  <label>Country<span>*</span></label>
                  <select class="select__option">
                    <option>Select a country…</option>
                    <option>Afghanistan</option>
                    <option>American Samoa</option>
                    <option>Anguilla</option>
                    <option>American Samoa</option>
                    <option>Antarctica</option>
                    <option>Antigua and Barbuda</option>
                  </select>
                </div>
                <div class="input_box">
                  <label>Address <span>*</span></label>
                  <input type="text" placeholder="Street address">
                </div>
                <div class="input_box">
                  <input type="text" placeholder="Apartment, suite, unit etc. (optional)">
                </div>
                <div class="input_box">
                  <label>District<span>*</span></label>
                  <select class="select__option">
                    <option>Select a country…</option>
                    <option>Afghanistan</option>
                    <option>American Samoa</option>
                    <option>Anguilla</option>
                    <option>American Samoa</option>
                    <option>Antarctica</option>
                    <option>Antigua and Barbuda</option>
                  </select>
                </div>
                <div class="input_box">
                  <label>Postcode / ZIP <span>*</span></label>
                  <input type="text">
                </div>
                <div class="margin_between">
                  <div class="input_box space_between">
                    <label>Phone <span>*</span></label>
                    <input type="text">
                  </div>
                  <div class="input_box space_between">
                    <label>Email address <span>*</span></label>
                    <input type="email">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="wn__order__box">
                <h3 class="onder__title">Your order</h3>
                <ul class="order__total">
                  <li>Product</li>
                  <li>Total</li>
                </ul>
                <ul class="order_product">
                    <?php foreach ($var as $k => $v): ?>
                        <?php foreach ($v as $key => $value): ?>
                            <?php if ($key == 'books'): ?>
                                <?php foreach ($value as $book): ?>
                                    <?php
                                    $qty  = $book['qty'];
                                    $book = (object)$book['book'];
                                    ?>
                            <li><?php echo $book->getTitle() . '× ' . $qty; ?><span>$<?php echo $book->getPrice()
                                                                                                * $qty ?></span></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
                <ul class="shipping__method">
                  <li>Cart Subtotal <span>$<?php echo $_SESSION['grandTotal']; ?></span></li>

                  <li>Shipping
                    <ul>
                        <?php foreach (Delivery::$delivery as $name => $cost): ?>
                          <li>
                            <input name="shippingMethod" data-index="0" value="<?php echo $name ?>"
                              <?php if ($_SESSION['shippingMethod'] == $name)
                                  echo 'checked="checked"' ?>
                                   type="radio">
                            <label><?php echo $name; ?>: $<?php echo $cost; ?></label>
                          </li>
                        <?php endforeach; ?>
                    </ul>
                  </li>
                </ul>
                <ul class="total__amount">
                  <li>Order Total
                    <button type="submit" name="updateCheckout">Update</button>
                    <span>$<?php echo $_SESSION['grandTotal'] + $_SESSION['shippingCost']; ?></span></li>
                </ul>
              </div>
            </form>
            <div id="accordion" class="checkout_accordion mt--30" role="tablist">
              <div class="payment">
                <div class="che__header" role="tab" id="headingOne">
                  <a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                     aria-controls="collapseOne">
                    <span>Direct Bank Transfer</span>
                  </a>
                </div>
                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                     data-parent="#accordion">
                  <div class="payment-body">Make your payment directly into our bank account. Please use your Order ID
                    as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
                  </div>
                </div>
              </div>
              <div class="payment">
                <div class="che__header" role="tab" id="headingTwo">
                  <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseTwo" aria-expanded="false"
                     aria-controls="collapseTwo">
                    <span>Cheque Payment</span>
                  </a>
                </div>
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                     data-parent="#accordion">
                  <div class="payment-body">Please send your cheque to Store Name, Store Street, Store Town, Store State
                    / County, Store Postcode.
                  </div>
                </div>
              </div>
              <div class="payment">
                <div class="che__header" role="tab" id="headingThree">
                  <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseThree"
                     aria-expanded="false" aria-controls="collapseThree">
                    <span>Cash on Delivery</span>
                  </a>
                </div>
                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                     data-parent="#accordion">
                  <div class="payment-body">Pay with cash upon delivery.</div>
                </div>
              </div>
              <div class="payment">
                <div class="che__header" role="tab" id="headingFour">
                  <a class="collapsed checkout__title" data-toggle="collapse" href="#collapseFour" aria-expanded="false"
                     aria-controls="collapseFour">
                    <span>PayPal <img src="/assets/images/icons/payment.png" alt="payment images"> </span>
                  </a>
                </div>
                <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour"
                     data-parent="#accordion">
                  <div class="payment-body">Pay with cash upon delivery.</div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- End Checkout Area -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php'; ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php'; ?>