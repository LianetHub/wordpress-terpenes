<?php

/**
 * Template Name: Checkout Page Template
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="checkout">
    <div class="container">
        <? echo do_shortcode('[woocommerce_checkout]') ?>
    </div>
</div>

<?php get_footer(); ?>