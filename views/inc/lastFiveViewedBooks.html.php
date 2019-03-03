<?php if (isset($_SESSION['lastFiveViewedBooks'])): ?>
  <h2>You are viewed these books</h2>
  <?php $idOfBooks = []; ?>
  <div class="recent-book-sec">
    <div class="row">
      <?php foreach ($_SESSION['lastFiveViewedBooks'] as $book): ?>
        <?php if (in_array($book['id'], $idOfBooks)): ?>
          <?php continue; ?>
        <?php else: ?>
          <?php array_unshift($idOfBooks, $book['id']); ?>
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
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>