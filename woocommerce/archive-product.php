<?php
defined('ABSPATH') || exit;

get_header(); ?>


<section class="products products-shop">
	<div class="container">
		<h1 class="products__title gradient-text">Our Products</h1>
		<div class="products__content">
			<div class="row">
				<div class="col-12">
					<div class="products__categories">
						<?php
						$brands = get_terms(array(
							'taxonomy'   => 'product_brand',
							'orderby'    => 'name',
							'hide_empty' => true,
						));
						if (!empty($brands) && !is_wp_error($brands)) :
							foreach ($brands as $brand) :
						?>
								<label class="products__category">
									<input type="checkbox" name="brand[]" value="<?php echo esc_attr($brand->slug); ?>" class="products__category-input hidden">
									<span class="products__category-field">
										<?php echo esc_html($brand->name); ?>
									</span>
								</label>
						<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 order-first-tablet">
					<button type="button" class="products__filter-toggler icon-filter">FILTER BY:</button>
					<div class="products__filter">
						<div class="products__filter-blocks">
							<div class="products__filter-block">
								<div class="products__filter-title">FILTER BY:</div>
								<div class="products__filter-items">
									<?php
									function get_acf_filter_values_from_group($group_field_name)
									{
										$values = [];

										$args = array(
											'post_type'      => 'product',
											'posts_per_page' => -1,
											'fields'         => 'ids'
										);

										$posts = get_posts($args);

										foreach ($posts as $post_id) {

											$aroma_effects = get_field($group_field_name, $post_id);

											if ($aroma_effects) {

												$fields_to_check = ['main_profile'];

												foreach ($fields_to_check as $field_name) {
													if (isset($aroma_effects[$field_name])) {
														foreach ($aroma_effects[$field_name] as $value) {
															if (!in_array($value, $values)) {
																$values[] = $value;
															}
														}
													}
												}
											}
										}

										return $values;
									}

									$main_profile_values = get_acf_filter_values_from_group('aroma_effects');
									?>

								</div>
								<div class="products__filter-items">
									<?php foreach ($main_profile_values as $value): ?>
										<a href="javascript:void(0)" class="products__filter-item" data-value="<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></a>
									<?php endforeach; ?>

								</div>
							</div>
							<div class="products__filter-block">
								<div class="products__filter-title">Cannabis strains:</div>
								<div class="products__filter-items">
									<?php
									$args = array(
										'taxonomy'   => 'product_cat',
										'orderby'    => 'name',
										'hide_empty' => true,
									);

									$product_categories = get_terms($args);
									if (!empty($product_categories) && !is_wp_error($product_categories)) :
										foreach ($product_categories as $category) :
									?>
											<label>
												<input type="checkbox" name="category[]" value="<?php echo esc_attr($category->slug); ?>">
												<?php echo esc_html($category->name); ?>
											</label>
									<?php
										endforeach;
									endif;
									?>
								</div>
							</div>
						</div>
						<a href="/shop" class="products__filter-btn btn btn-primary-outline icon-arrow">SEE ALL</a>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="row">
						<? if (have_posts()) : ?>
							<?php while (have_posts()) : the_post(); ?>
								<div class="col-lg-4 col-sm-6">
									<? require(TEMPLATE_PATH . '_product.php'); ?>
								</div>
							<?php endwhile; ?>
						<?php do_action('woocommerce_after_shop_loop');
						else :
							do_action('woocommerce_no_products_found');
						endif; ?>

					</div>
				</div>
			</div>
		</div>

	</div>
</section>



<?php if (have_rows('desc_block_1', "option")): ?>
	<?php while (have_rows('desc_block_1', "option")): the_row(); ?>

		<?php
		$title = get_sub_field('title');
		$body = get_sub_field('body');
		$text_block_size  = get_sub_field('text_block_size');
		$btn_text = get_sub_field('btn_text');
		$btn_link = get_sub_field('btn_link');
		$icon_image = get_sub_field('icon_image');
		$main_image = get_sub_field('main_image');
		$image_position = get_sub_field('image_position');
		$image_item_class = get_sub_field('image_item_class');

		require COMPONENTS_PATH . '_desc.php';
		?>
	<?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('desc_block_2', "option")): ?>
	<?php while (have_rows('desc_block_2', "option")): the_row(); ?>

		<?php
		$title = get_sub_field('title');
		$body = get_sub_field('body');
		$subtitle = get_sub_field('subtitle');
		$text_block_size  = get_sub_field('text_block_size');
		$btn_text = get_sub_field('btn_text');
		$btn_link = get_sub_field('btn_link');
		$icon_image = get_sub_field('icon_image');
		$main_image = get_sub_field('main_image');
		$image_position = get_sub_field('image_position');
		$image_item_class = get_sub_field('image_item_class');

		require COMPONENTS_PATH . '_desc.php';
		?>
	<?php endwhile; ?>
<?php endif; ?>
<? get_footer();
?>