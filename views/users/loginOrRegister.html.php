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
          <?php if ($var !== false): ?>
            <p class="alert alert-danger">
                <?php echo $var; ?>
            </p>
          <?php endif; ?>
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="my__account__wrapper">
              <h3 class="account__title">Login</h3>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="account__form">
                  <div class="input__box">
                    <label for="email">Email address <span>*</span></label>
                    <input type="email" name="email" id="email" autofocus>
                  </div>
                  <div class="input__box">
                    <label for="password">Password<span>*</span></label>
                    <input type="password" name="password" id="password">
                  </div>
                  <div class="form__btn">
                    <button type="submit" name="login">Login</button>
                    <label class="label-for-checkbox">
                      <input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
                      <span>Remember me</span>
                    </label>
                  </div>
                  <a class="forget_pass" href="/restore-password">Lost your password?</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 col-12">
            <div class="my__account__wrapper">
              <h3 class="account__title">Register</h3>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="account__form">
                  <div class="input__box">
                    <label for="registerEmail">Email address <span>*</span></label>
                    <input type="email" name="registerEmail" id="registerEmail">
                  </div>
                  <div class="input__box">
                    <label for="registerPassword">Password<span>*</span></label>
                    <input type="password" name="registerPassword" id="registerPassword">
                  </div>
                  <div class="form__btn">
                    <button type="submit" name="register">Register</button>
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