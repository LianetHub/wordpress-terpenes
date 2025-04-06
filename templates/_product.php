<div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
    <div class="product__header">
        <div class="product__labels">
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
        <a href="<?php the_permalink(); ?>" class="product__image-wrapper">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>
        </a>
        <div class="product__detail">
            <div class="product__detail-title icon-info">More details</div>
        </div>
    </div>
    <div class="product__body">
        <a href="<?php the_permalink(); ?>" class="product__name"><?php the_title(); ?></a>
        <div class="product__main">
            <div class="product__size">
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
            <div class="product__price"><?php echo $product->get_price_html(); ?></div>
        </div>

        <?php
        woocommerce_template_loop_add_to_cart();
        ?>
    </div>
</div>