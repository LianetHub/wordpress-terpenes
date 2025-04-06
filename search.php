<?php

/**
 * Template Name: Search Page Template
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="search">
    <div class="container">
        <? echo do_shortcode('[woocommerce_product_search show_description="no" limit="20"]') ?>
    </div>
</div>

<?php get_footer(); ?>