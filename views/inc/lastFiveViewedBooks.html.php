<?php if (isset($_SESSION['lastFiveViewedBooks'])): ?>
    <section class="wn__product__area brown--color pt--80  pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">Last <span
                                    class="color--theme">Viewed</span></h2>
                        <p>You are viewed these products earlier</p>
                    </div>
                </div>
            </div>
            <!-- Start Single Tab Content -->
            <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                <!-- Start Single Product -->
                <?php foreach ($_SESSION['lastFiveViewedBooks'] as $book): ?>
                    <div class="product product__style--3">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product__thumb">
                                <a class="first__img"
                                   href="/book?id=<?php echo $book['id']; ?>"><img
                                            src="/assets/images/books/1/1.jpg"
                                            alt="product image"></a>
                                <a class="second__img animation1"
                                   href="/book?id=<?php echo $book['id']; ?>"><img
                                            src="/assets/images/books/2/2.jpg"
                                            alt="product image"></a>
                                <div class="hot__box">
                                    <span class="hot-label">BEST SELLER</span>
                                </div>
                            </div>
                            <div class="product__content content--center">
                                <h4>
                                    <a href="/book?id=<?php echo $book['id']; ?>"><?php echo $book['title']; ?></a>
                                </h4>
                                <ul class="prize d-flex">
                                    <li><?php echo $book['price']; ?>$</li>
                                </ul>
                                <div class="action">
                                    <div class="actions_inner">
                                        <ul class="add_to_links">
                                            <li><a class="cart" href="cart.html"><i
                                                            class="bi bi-shopping-bag4"></i></a></li>
                                            <li><a class="wishlist" href="wishlist.html"><i
                                                            class="bi bi-shopping-cart-full"></i></a>
                                            </li>
                                            <li><a class="compare" href="#"><i
                                                            class="bi bi-heart-beat"></i></a></li>
                                            <li><a data-toggle="modal" title="Quick View"
                                                   class="quickview modal-view detail-link"
                                                   href="#productmodal"><i class="bi bi-search"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__hover--content">
                                    <ul class="rating d-flex">
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Start Single Product -->
            </div>
            <!-- End Single Tab Content -->
        </div>
    </section>
<?php endif; ?>