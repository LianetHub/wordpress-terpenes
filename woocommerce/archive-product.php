<?php
defined('ABSPATH') || exit;

get_header();

if (have_posts()) :


?>
	<section class="products">
		<div class="container">
			<h1 class="products__title gradient-text">Our Products</h1>
			<div class="products__categories">
				<a href="" class="products__catregory">Vape & Tobacco</a>
				<a href="" class="products__catregory">Aromatherapy</a>
				<a href="" class="products__catregory">Skincare</a>
				<a href="" class="products__catregory">Functional food</a>
				<a href="" class="products__catregory">Pharma</a>
				<a href="" class="products__catregory">Perfumery</a>
			</div>
			<div class="products__content">
				<div class="row">
					<div class="col-3">
						<div class="products__filter">
							<div class="products__filter-title">FILTER BY:</div>

						</div>
					</div>
					<div class="col-9">
						<div class="row">
							<?php while (have_posts()) : the_post(); ?>
								<div class="col-lg-4 col-6">
									<? require(TEMPLATE_PATH . '_product.php'); ?>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>


<?php
	do_action('woocommerce_after_shop_loop');

else :
	do_action('woocommerce_no_products_found');
endif;

get_footer();
?>