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
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="my__account__wrapper">
              <h3 class="account__title">Personal Information</h3>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="account__form">
                  <div class="input__box">
                    <label for="name">Name <span>*</span></label>
                    <input type="text" name="name" id="name" autofocus>
                  </div>
                  <div class="input__box">
                    <label for="surname">Surname <span>*</span></label>
                    <input type="text" name="surname" id="surname">
                  </div>
                  <div class="input__box">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
                  </div>
                  <div class="input__box">
                    <label for="mobilePhone">Mobile Phone <span>*</span></label>
                    <input type="tel" name="mobilePhone" id="mobilePhone" placeholder="+7 (123) 45-67-891" >
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
                    <input type="text" name="country" id="country">
                  </div>
                  <div class="input__box">
                    <label for="state">State <span>*</span></label>
                    <input type="text" name="state" id="state">
                  </div>
                  <div class="input__box">
                    <label for="city">City <span>*</span></label>
                    <input type="text" name="city" id="city">
                  </div>
                  <div class="input__box">
                    <label for="street">Street <span>*</span></label>
                    <input type="text" name="street" id="street">
                  </div>
                  <div class="input__box">
                    <label for="building">Building <span>*</span></label>
                    <input type="text" name="building" id="building">
                  </div>
                  <div class="input__box">
                    <label for="apartment">Apartment <span>*</span></label>
                    <input type="text" name="apartment" id="apartment">
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