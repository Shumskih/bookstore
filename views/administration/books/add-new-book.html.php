<?php include_once ROOT . '/views/inc/head.html.php'; ?>
  <body>
<?php include_once ROOT . '/views/inc/outdatedBrowser.html.php'; ?>

  <!-- Main wrapper -->
  <div class="wrapper" id="wrapper">

    <!-- Header -->
      <?php include_once ROOT . '/views/inc/menu.html.php'; ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
      <?php include_once ROOT . '/views/inc/searchPopUp.html.php'; ?>
    <!-- End Search Popup -->
    <!-- Start breadcrumbs area -->
      <?php include_once ROOT . '/views/inc/breadcrumbs.html.php'; ?>
    <!-- End breadcrumbs area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
      <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
              <div class="customer_details">
                <h3>Add New Book</h3>
                <div class="customar__field">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input_box">
                      <label for="title">Title <span>*</span></label>
                      <input type="text" id="title" name="title" placeholder="Book Title" autofocus>
                    </div>
                    <div class="input_box">
                      <label for="category">Category <span>*</span></label>
                      <select class="select__option" name="category" id="category">
                        <?php
                        $categoryController = new CategoryController();
                        $categories = $categoryController->readAll();
                        ?>
                          <?php foreach ($categories as $category): ?>
                          <?php $category = (object)$category; ?>
                            <option name="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="margin_between">
                      <div class="input_box space_between">
                        <label for="authorName">Author Name <span>*</span></label>
                        <input type="text" id="authorName" name="authorName" placeholder="Author Name">
                      </div>
                      <div class="input_box space_between">
                        <label for="authorSurname">Author Surname <span>*</span></label>
                        <input type="text" id="authorSurname" name="authorSurname" placeholder="Author Surname">
                      </div>
                    </div>
                    <div class="input_box">
                      <label for="pages">Pages <span>*</span></label>
                      <input type="text" id="pages" name="pages" placeholder="Pages">
                    </div>
                    <div class="input_box">
                      <label for="price">Price <span>*</span></label>
                      <input type="number" id="price" name="price" placeholder="Price">
                    </div>
                    <div class="input_box">
                      <label for="quantity">Quantity <span>*</span></label>
                      <input type="number" id="quantity" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="contact-form-wrap">
                      <div class="single-contact-form message input_box">
                        <label for="description">Description <span>*</span></label>
                        <textarea name="description" id="description"
                                  placeholder="Type book's description here.."></textarea>
                      </div>
                    </div>
                    <div class="mt-4">
                      <button type="submit" name="publish" class="btn btn-outline-info">Publish</button>
                      <button type="submit" name="cancel" class="btn btn-outline-danger">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
              <img src="https://fakeimg.pl/125/ff7675/fff" class="rounded mx-auto" alt="...">
              <img src="https://fakeimg.pl/125/6c5ce7/fff" class="rounded mx-auto" alt="...">
              <img src="https://fakeimg.pl/125/fd79a8/fff" class="rounded mx-auto" alt="...">
              <img src="https://fakeimg.pl/125/ffeaa7/fff" class="rounded mx-auto" alt="...">
              <div class="input_box">
                <label for="file">Add Images <span>*</span></label>
                <input type="file" id="file" name="img" class="form-control-file">
              </div>
              <div class="mt-4">
                <button type="submit" name="uploadImg" class="btn btn-outline-info mr-1">Upload Image</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Checkout Area -->
    <!-- Footer Area -->
      <?php include_once ROOT . '/views/inc/footer.html.php'; ?>
    <!-- //Footer Area -->

  </div>
  <!-- //Main wrapper -->

  <!-- JS Files -->
<?php include_once ROOT . '/views/inc/scripts.html.php'; ?>