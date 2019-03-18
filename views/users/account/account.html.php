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
    <!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
      <div class="container">
          <?php if (!empty($var)): ?>
              <?php if (is_object($var)): ?>
                  <?php
                  $user    = (object)$var;
                  $address = (object)$user->getAddress($user->getId());
                  ?>
              <?php else: ?>?>
                  <?php foreach ($var as $item): ?>
                      <?php if (is_array($item)): ?>
                  <p class="alert alert-danger">
                      <?php echo $item; ?>
                  </p>
                      <?php endif; ?>
                  <?php endforeach; ?>
              <?php endif; ?>
          <?php endif; ?>
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="my__account__wrapper">
              <h3 class="account__title">Personal Information</h3>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="account__form">
                  <div class="input__box">
                    <label for="name">Name <span>*</span></label>
                    <input type="text" name="name" id="name" value="<?php echo $user->getName(); ?>" autofocus>
                  </div>
                  <div class="input__box">
                    <label for="surname">Surname <span>*</span></label>
                    <input type="text" name="surname" id="surname" value="<?php echo $user->getSurname(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" value="<?php echo $user->getEmail(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="mobilePhone">Mobile Phone <span>*</span></label>
                    <input type="tel" name="mobilePhone" id="mobilePhone" placeholder="+7 (123) 45-67-891"
                           value="<?php echo $user->getMobilePhone(); ?>">
                  </div>
                  <div class="form__btn">
                    <button type="submit" name="personalInfo">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 col-12">
            <div class="my__account__wrapper">
              <h3 class="account__title">Delivery address</h3>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="account__form">
                  <div class="input__box">
                    <label for="country">Country <span>*</span></label>
                    <input type="text" name="country" id="country" value="<?php echo $address->getCountry(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="state">State <span>*</span></label>
                    <input type="text" name="state" id="state" value="<?php echo $address->getRegion(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="city">City <span>*</span></label>
                    <input type="text" name="city" id="city" value="<?php echo $address->getCity(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="street">Street <span>*</span></label>
                    <input type="text" name="street" id="street" value="<?php echo $address->getStreet(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="building">Building <span>*</span></label>
                    <input type="text" name="building" id="building" value="<?php echo $address->getBuilding(); ?>">
                  </div>
                  <div class="input__box">
                    <label for="apartment">Apartment <span>*</span></label>
                    <input type="text" name="apartment" id="apartment" value="<?php echo $address->getApartment(); ?>">
                  </div>
                  <div class="form__btn">
                    <button type="submit" name="deliveryAddress">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End My Account Area -->
    <!-- Footer Area -->
      <?php include ROOT . '/views/inc/footer.html.php' ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include ROOT . '/views/inc/scripts.html.php' ?>