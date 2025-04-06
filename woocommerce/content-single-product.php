<?php
defined('ABSPATH') || exit;
global $product;
?>

<section class="single-product" id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
	<div class="container">
		<h1 class="single-product__title gradient-text"><?php the_title(); ?></h1>
		<div class="single-product__body">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-product__image">
						<div class="single-product__labels">
							<?php if (has_term('top', 'product_tag')) : ?>
								<div class="product__label product__label--blue">TOP</div>
							<?php endif; ?>
							<?php if (has_term('new', 'product_tag')) : ?>
								<div class="product__label product__label--red">NEW</div>
							<?php endif; ?>
							<?php if (has_term('hot', 'product_tag')) : ?>
								<div class="product__label product__label--dark">HOT</div>
							<?php endif; ?>
						</div>
						<?
						$image_url = wp_get_attachment_url($product->get_image_id());
						?>

						<a href="<?php echo $image_url ?>" data-fancybox class="single-product__image-block">
							<?php echo $product->get_image(); ?>
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-md-6">
					<p class="single-product__desc">
						<?php echo $product->get_short_description(); ?>
					</p>
					<div class="single-product__row">
						<div class="single-product__size">
							<?php
							$product = wc_get_product(get_the_ID());
							$attributes = $product->get_attributes();

							if (isset($attributes['pa_sizes'])) :
								echo '<select name="size" class="select">';
								echo '<option value="" disabled selected>Select size</option>';
								foreach ($attributes['pa_sizes']->get_terms() as $term) :
									echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
								endforeach;
								echo '</select>';
							endif;
							?>
						</div>
						<div class="single-product__price">
							<?php echo $product->get_price_html(); ?>
						</div>
						<div class="single-product__cart product__cart">
							<?php

							$product_id = get_the_ID();
							$in_cart = false;

							if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product_id))) {
								$in_cart = true;
							}

							if ($in_cart) : ?>
								<a href="<?php echo esc_url(WC()->cart->get_remove_url(WC()->cart->generate_cart_id($product_id))); ?>" class="btn btn-secondary icon-shopping-bag">remove from cart</a>
							<?php else : ?>
								<?php woocommerce_template_single_add_to_cart(); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="single-product__info">
						<div class="row">
							<?php $aroma_effects = get_field('aroma_effects') ?>
							<?php if ($aroma_effects) : ?>
								<div class="col-lg-6">
									<div class="single-product__info-block">
										<div class="single-product__info-header">
											<div class="single-product__info-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/smoke.svg" alt="icon">
											</div>
											<div class="single-product__info-caption">Aroma:</div>
										</div>
										<?php

										$main_profile = $aroma_effects['main_profile'];
										$top_notes = $aroma_effects['top_notes'];
										$middle_notes = $aroma_effects['middle_notes'];
										$base_notes = $aroma_effects['base_notes'];
										?>
										<ul class="single-product__info-body">
											<? if (!empty($main_profile)) : ?>
												<li><strong>Main profile:</strong> <?php echo implode(', ', $main_profile); ?>.</li>
											<?php endif; ?>
											<? if (!empty($top_notes)) : ?>
												<li><strong>Top notes:</strong> <?php echo implode(', ', $top_notes); ?>.</li>
											<?php endif; ?>
											<? if (!empty($middle_notes)) : ?>
												<li><strong>Middle notes:</strong> <?php echo implode(', ', $middle_notes); ?>.</li>
											<?php endif; ?>
											<? if (!empty($base_notes)) : ?>
												<li><strong>Base notes:</strong> <?php echo implode(', ', $base_notes); ?>.</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
							<?php $effects = get_field('effects') ?>
							<?php if ($effects) : ?>
								<div class="col-lg-6">
									<div class="single-product__info-block">
										<div class="single-product__info-header">
											<div class="single-product__info-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/brain.svg" alt="icon">
											</div>
											<div class="single-product__info-caption">Effects:</div>
										</div>
										<?php

										$physical_effects = $effects['physical_effects'];
										$psycho_emotional_effects = $effects['psycho_emotional_effects'];

										?>
										<ul class="single-product__info-body">
											<? if (!empty($physical_effects)) : ?>
												<li><strong>Physical effects:</strong> <?php echo implode(', ', $physical_effects); ?>.</li>
											<?php endif; ?>
											<? if (!empty($psycho_emotional_effects)) : ?>
												<li><strong>Psycho-emotional effects:</strong> <?php echo implode(', ', $psycho_emotional_effects); ?>.</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
							<?php $composition = get_field('composition') ?>
							<?php if ($composition) : ?>
								<div class="col-12">
									<div class="single-product__info-block">
										<div class="single-product__info-header">
											<div class="single-product__info-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/invoice-list-outline.svg" alt="icon">
											</div>
											<div class="single-product__info-caption">Composition (Terpene Profile):</div>
										</div>
										<?php
										$main_terpenes = $composition['main_terpenes'];
										?>
										<ul class="single-product__info-body">
											<? if (!empty($physical_effects)) : ?>
												<li><strong>Main terpenes:</strong> <?php echo implode(', ', $main_terpenes); ?>.</li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="single-product__bottom">
			<div class="row">
				<div class="col-lg-5">
					<?php if (have_rows('product_quality')): ?>
						<h3 class="single-product__title">Certification and quality</h3>
						<ul class="single-product__list">
							<?php while (have_rows('product_quality')): the_row(); ?>
								<li><?= get_sub_field('product_quality_item'); ?></li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="col-lg-7">
					<?php if (have_rows('product_benefits')): ?>
						<ul class="single-product__benefits">
							<?php while (have_rows('product_benefits')): the_row(); ?>
								<li class="single-product__benefits-item icon-check-circle"><?= get_sub_field('product_benefits_item'); ?></li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="single-product__more">
			<h3 class="single-product__more-title">Gallery product</h3>
			<div class="single-product__slider">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php

						$current_product_id = get_the_ID();


						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => 8,
							'post__not_in'   => array($current_product_id),
							'orderby'        => 'rand',

						);

						$query = new WP_Query($args);


						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post();
								global $product;
						?>
								<div class="swiper-slide">
									<? require(TEMPLATE_PATH . '_product.php'); ?>
								</div>
						<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>
				<button type="button" class="single-product__prev swiper-button-prev"></button>
				<button type="button" class="single-product__next swiper-button-next"></button>
			</div>
		</div>

	</div>

</section>