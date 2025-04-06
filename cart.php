<?php

/**
 * Template Name: Cart Page Template
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="cart">
    <div class="container">
        <? echo do_shortcode('[woocommerce_cart]') ?>
    </div>
</div>

<?php get_footer(); ?>