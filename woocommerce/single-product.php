<?php
defined('ABSPATH') || exit;

get_header();
?>

<?php
while (have_posts()) :
	the_post();
	wc_get_template_part('content', 'single-product');
endwhile;
?>

<?php
get_footer();
