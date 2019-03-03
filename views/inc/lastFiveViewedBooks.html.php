<?php if (isset($_SESSION['lastFiveViewedBooks'])): ?>
  <h2>You are viewed these books</h2>
  <div class="recent-book-sec">
    <div class="row">
      <?php foreach ($_SESSION['lastFiveViewedBooks'] as $book): ?>
        <div class="col-md-3">
          <div class="item">
            <img src="assets/images/r1.jpg" alt="img">
            <h3><a href="/book?id=<?php echo $book['id']; ?>">
                <?php echo $book['title']; ?>
              </a>
            </h3>
            <h6><span class="price">$<?php echo $book['price']; ?></span>
              /
              <a href="#">Buy Now</a>
            </h6>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="btn-sec">
      <button class="btn gray-btn">load More books</button>
    </div>
  </div>
<?php endif; ?>