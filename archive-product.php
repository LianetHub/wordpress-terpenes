<?php

/**
 * Template Name: Catalog Page Template
 */

defined('ABSPATH') || exit;

get_header();

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
                        <?php
                        $args = array(
                            'post_type' => 'product',
                        );
                        $loop = new WP_Query($args);
                        if ($loop->have_posts()) :
                            while ($loop->have_posts()) : $loop->the_post();
                                global $product;
                        ?>
                                <div class="col-4">
                                    <? require_once(TEMPLATE_PATH . '_product.php'); ?>
                                </div>
                        <? endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No products found</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if (have_rows('desc_block_1')): ?>
    <?php while (have_rows('desc_block_1')): the_row(); ?>

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
<?php
get_footer();
