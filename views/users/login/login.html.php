<?php include_once ROOT . '/views/inc/head.html.php' ?>
  <body>
  <header>
      <?php include_once ROOT . '/views/inc/menu.html.php' ?>
  </header>
  <div class="breadcrumb">
    <div class="container">
      <a class="breadcrumb-item" href="/books">Home</a>
      <span class="breadcrumb-item active">Login</span>
    </div>
  </div>
  <section class="static about-sec">
    <div class="container">
      <h1>My Account / Login</h1>
      <p>
          <?php if ($var == 'loginError'): ?>
            All fields are required!
          <?php endif; ?>
      </p>
      <div class="form">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="row">
            <div class="col-md-12">
              <input type="email" name="email" placeholder="Email Address">
              <span class="required-star">*</span>
            </div>
            <div class="col-md-12">
              <input type="password" name="password" placeholder="Password">
              <span class="required-star">*</span>
            </div>
            <div class="col-lg-8 col-md-12">
              <button class="btn black">Login</button>
              <h5>not Registered? <a href="/registration">Register here</a></h5>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php include_once ROOT . '/views/inc/footer.html.php' ?>
<?php include_once ROOT . '/views/inc/scripts.html.php' ?>