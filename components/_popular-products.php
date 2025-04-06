<section class="products">
    <div class="container">
        <div class="products__header">
            <h2 class="products__title">Popular products</h2>
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="products__btn btn btn-secondary">SEE ALL PRODUCTS</a>
        </div>
        <div class="products__body">
            <div class="row">
                <?php

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );

                $loop = new WP_Query($args);

                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                ?>
                        <div class="col-3">
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
</section>