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
        <div class="product__detail" data-tooltip="<? echo $product->get_short_description(); ?>">
            <div class="product__detail-title icon-info">More details</div>
        </div>
    </div>
    <div class="product__body">
        <a href="<?php the_permalink(); ?>" class="product__name"><?php the_title(); ?></a>

        <?php
        $product_id = get_the_ID();
        $in_cart = false;

        foreach (WC()->cart->get_cart() as $cart_item) {
            $cart_product = $cart_item['data'];
            if (
                $cart_product->get_id() == $product_id ||
                $cart_product->get_parent_id() == $product_id
            ) {
                $in_cart = true;
                break;
            }
        }

        if ($in_cart) : ?>
            <p class="product__in-cart">Product added to cart</p>
            <div class="product__cart">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="btn btn-secondary icon-shopping-bag">Go to cart</a>
            </div>
        <?php else : ?>
            <div class="product__cart">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>