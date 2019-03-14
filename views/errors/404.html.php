<?php include ROOT . '/views/inc/head.html.php'; ?>
<body>
	<?php include ROOT . '/views/inc/outdatedBrowser.html.php'; ?>

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		
		<!-- Header -->
		<?php include ROOT . '/views/inc/menu.html.php'; ?>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<?php include ROOT . '/views/inc/searchPopUp.html.php'; ?>
		<!-- End Search Popup -->
        <!-- Start Breadcrumbs area -->
        <?php include ROOT . '/views/inc/breadcrumbsErrorPage.html.php'; ?>
        <!-- End Breadcrumbs area -->

		<!-- Start Error Area -->
		<section class="page_error section-padding--lg bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="error__inner text-center">
							<div class="error__logo">
								<a href="#"><img src="/assets/images/others/404.png" alt="error 404"></a>
							</div>
							<div class="error__content">
								<h2>error - not found</h2>
								<p>It looks like you are lost! Try searching here</p>
								<div class="search_form_wrapper">
									<form action="#">
										<div class="form__box">
											<input type="text" placeholder="Search...">
											<button><i class="fa fa-search"></i></button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Error Area -->

		<!-- Footer Area -->
		<?php include ROOT . '/views/inc/footer.html.php'; ?>
		<!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	<?php include ROOT . '/views/inc/scripts.html.php'; ?>