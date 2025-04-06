<?php
define('COMPONENTS_PATH', dirname(__FILE__) . '/components/');
define('TEMPLATE_PATH', dirname(__FILE__) . '/templates/');

function theme_enqueue_styles()
{

	wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/libs/swiper-bundle.min.css');
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/libs/fancybox.css');
	wp_enqueue_style('input-tel', get_template_directory_uri() . '/assets/css/libs/input-tel.css');
	wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.min.css');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.min.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function theme_enqueue_scripts()
{
	wp_deregister_script('jquery');

	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery-3.7.1.min.js', array(), null, true);

	wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/js/libs/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('fancybox-js', get_template_directory_uri() . '/assets/js/libs/fancybox.umd.js', array(), null, true);
	wp_enqueue_script('imask-js', get_template_directory_uri() . '/assets/js/libs/imask.js', array(), null, true);
	wp_enqueue_script('intlTelInput-js', get_template_directory_uri() . '/assets/js/libs/intlTelInput.min.js', array(), null, true);

	wp_enqueue_script('ui-js', get_template_directory_uri() . '/assets/js/ui.min.js', array(), null, true);
	wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function allow_svg_uploads($mimes)
{

	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');


function register_my_menus()
{
	register_nav_menus([
		'main_menu' => 'main menu',
	]);
}
add_action('after_setup_theme', 'register_my_menus');


function set_global_acf_fields()
{
	$GLOBALS['global_acf_fields'] = [
		'company_address' => get_field('company_address', 'option'),
		'phone_number' => get_field('phone_number', 'option'),
		'emergency_contact_number' => get_field('emergency_contact_number', 'option'),
		'email' => get_field('email', 'option'),
		'phone_number' => get_field('phone_number', 'option'),
		'registration_number' => get_field('registration_number', 'option'),
		'linkedin_url' => get_field('linkedin_url', 'option'),
		'instagram_url' => get_field('instagram_url', 'option'),
		'facebook_url' => get_field('facebook_url', 'option'),
		'x_url' => get_field('x_url', 'option'),
	];
}

add_action('wp', 'set_global_acf_fields');
add_filter('wpcf7_autop_or_not', '__return_false');
add_theme_support('woocommerce');

add_action('wp_ajax_update_cart', 'update_cart');
add_action('wp_ajax_nopriv_update_cart', 'update_cart');

function update_cart()
{
	if (WC()->cart) {

		WC()->cart->calculate_totals();


		$cart_count = WC()->cart->get_cart_contents_count();
		$cart_total = WC()->cart->get_cart_total();

		wp_send_json_success(array(
			'count' => $cart_count,
			'total' => $cart_total
		));
	}
	wp_die();
}


remove_action('woocommerce_add_to_cart', 'wc_add_to_cart_message', 10);

function custom_product_filter($query)
{
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {

		if (isset($_GET['filter_product_cat']) && !empty($_GET['filter_product_cat'])) {
			$categories = explode(',', sanitize_text_field($_GET['filter_product_cat']));
			$tax_query = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $categories,
					'operator' => 'IN',
				),
			);
			$query->set('tax_query', $tax_query);
		}

		if (isset($_GET['filter_main_profile']) && !empty($_GET['filter_main_profile'])) {
			$main_profiles = explode(',', sanitize_text_field($_GET['filter_main_profile']));
			$meta_query = array(
				'relation' => 'OR',
			);

			foreach ($main_profiles as $profile_value) {
				$meta_query[] = array(
					'key'     => 'aroma_effects_main_profile',
					'value'   => $profile_value,
					'compare' => 'LIKE',
				);
			}

			if (!isset($query->query_vars['meta_query'])) {
				$query->set('meta_query', $meta_query);
			} else {
				$query->query_vars['meta_query'] = array_merge($query->query_vars['meta_query'], $meta_query);
			}
		}


		if (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) {
			$brands = explode(',', sanitize_text_field($_GET['filter_brand']));
			$tax_query[] = array(
				'taxonomy' => 'product_brand',
				'field'    => 'slug',
				'terms'    => $brands,
				'operator' => 'IN',
			);
			$query->set('tax_query', $tax_query);
		}
	}
}
add_action('pre_get_posts', 'custom_product_filter');
