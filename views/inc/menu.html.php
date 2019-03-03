<div class="main-menu">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="books"><img
          src="assets/images/logo.png" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="navbar-item active">
            <a href="/books" class="nav-link">Shop</a>
          </li>
          <li class="navbar-item">
            <a href="/categories" class="nav-link">Categories</a>
          </li>
          <?php if (!isset($_SESSION['login'])): ?>
            <li class="navbar-item">
              <a href="/login" class="nav-link">Login</a>
            </li>
          <?php else: ?>
            <li class="navbar-item">
              <a href="/account" class="nav-link">Account(<?php echo $_SESSION['email'] ?>)</a>
            </li>
            <li class="navbar-item">
              <a href="/logout" class="nav-link">Logout</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class="cart my-2 my-lg-0">
                            <span>
                                <i class="fa fa-shopping-cart"
                                   aria-hidden="true"></i></span>
          <span class="quntity">3</span>
        </div>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search"
                 placeholder="Search here..." aria-label="Search">
          <span class="fa fa-search"></span>
        </form>
      </div>
    </nav>
  </div>
</div>