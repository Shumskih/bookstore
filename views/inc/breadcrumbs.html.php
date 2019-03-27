<div class="ht__bradcaump__area bg-image--4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="bradcaump__inner text-center">
          <h2 class="bradcaump-title">
              <?php
              if (URI !== '/books' && URI !== '/account' && URI !== '/account/info' && URI !== '/cart'
                  && URI !== '/cart/'
                  && URI !== '/cart/checkout'
                  && URI !== '/cart/checkout/'
                  && URI !== '/contact'
                  && URI !== '/contact/'
                  && URI !== '/administration/orders'
                  && URI !== '/administration/orders/'
              ) {
                  foreach ($var as $k => $v) {
                      if (isset($v['book'])) {
                          $book = (object)$v['book'];
                      }
                      if (isset($v['category'])) {
                          $category = (object)$v['category'];
                      }
                  }
              } ?>
          </h2>
          <nav class="bradcaump-content">
            <a class="breadcrumb_item" href="/">Home</a>
            <span class="brd-separetor">/</span>
            <span class="breadcrumb_item active">
              <?php if (URI == '/books' || URI == '/books/') {
                  echo 'Books';
              } elseif (isset($category)) {
                  echo $category->getName();
              } elseif (isset($book)) {
                  echo $book->getTitle();
              } elseif (URI == '/account' || URI == '/account/') {
                  echo 'Account';
              } elseif (URI == '/account/info' || URI == '/account/info/') {
                  echo '<a class="breadcrumb_item" href="/account">Account</a>
                        <span class="brd-separetor">/</span>';
                  echo 'Account Info';
              } elseif (URI == '/cart' || URI == '/cart/') {
                  echo 'Shopping Cart';
              } elseif (URI == '/cart/checkout' || URI == '/cart/checkout/') {
                  echo '<a class="breadcrumb_item" href="/cart">Shopping Cart</a>
                        <span class="brd-separetor">/</span>';
                  echo 'Checkout';
              } elseif (URI == '/contact' || URI == '/contact/') {
                  echo 'Contact';
              } elseif (URI == '/administration/orders' || URI == '/administration/orders/') {
                  echo '<span class="breadcrumb_item active">Administration</span>
                        <span class="brd-separetor">/</span>';
                  echo 'Orders';
              }
              ?>
            </span>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>