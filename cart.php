<?php
defined('ABSPATH') || exit;

get_header(); ?>

<main class="cart-page">
    <div class="container">
        <h1 class="page-title">Корзина</h1>

        <?php if (WC()->cart->is_empty()) : ?>
            <p>Ваша корзина пуста.</p>
        <?php else : ?>
            <div class="cart-table">
                <table class="shop_table shop_table_responsive cart">
                    <thead>
                        <tr>
                            <th class="product-name">Продукт</th>
                            <th class="product-quantity">Количество</th>
                            <th class="product-total">Сумма</th>
                            <th class="product-remove">Удалить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                            $_product = $cart_item['data'];
                            $product_id = $cart_item['product_id'];
                            $product_name = $_product->get_name();
                            $product_price = WC()->cart->get_product_price($_product);
                        ?>
                            <tr class="cart_item">
                                <td class="product-name">
                                    <a href="<?php echo get_permalink($product_id); ?>"><?php echo $product_name; ?></a>
                                </td>
                                <td class="product-quantity">
                                    <?php
                                    echo apply_filters(
                                        'woocommerce_cart_item_quantity',
                                        sprintf(
                                            '<input type="number" class="qty" value="%s" min="1" step="1" name="cart[%s][qty]" />',
                                            esc_attr($cart_item['quantity']),
                                            $cart_item_key
                                        ),
                                        $cart_item_key,
                                        $cart_item
                                    );
                                    ?>
                                </td>
                                <td class="product-total">
                                    <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                </td>
                                <td class="product-remove">
                                    <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>" class="remove">×</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="cart-totals">
                <h2>Итого</h2>
                <table>
                    <tr>
                        <th>Сумма товаров</th>
                        <td><?php echo WC()->cart->get_cart_subtotal(); ?></td>
                    </tr>
                    <tr>
                        <th>Доставка</th>
                        <td><?php echo WC()->cart->get_cart_shipping_total(); ?></td>
                    </tr>
                    <tr>
                        <th>Общая сумма</th>
                        <td><?php echo WC()->cart->get_total(); ?></td>
                    </tr>
                </table>
                <div class="cart-actions">
                    <a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout-button">Перейти к оформлению</a>
                    <a href="<?php echo wc_get_cart_url(); ?>" class="button update-cart-button">Обновить корзину</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>