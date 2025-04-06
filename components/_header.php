<header class="header">
    <div class="container">
        <div class="header__body">
            <a href="<?php echo home_url(); ?>" class="header__logo">
                <picture>
                    <source media="(min-width: 991.98px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-mobile.png" alt="Logo">
                </picture>
            </a>
            <?php
            wp_nav_menu([
                'menu'        => 'main menu',
                'container'   => 'nav',
                'container_class' => 'header__menu menu',
                'menu_class'  => 'menu__list',
            ]);
            ?>
            <div class="header__info">
                <?php
                $cart_count = WC()->cart->get_cart_contents_count(); ?>
                <? $cart_total = WC()->cart->get_cart_total();
                if (floatval(preg_replace('/[^\d.]/', '', $cart_total)) > 0) : ?>
                    <div class="header__price cart-total">
                        <?php echo $cart_total; ?>
                    </div>
                <?php endif; ?>

                <a href="/cart" class="header__cart icon-shopping-bag cart-count" data-count="<? echo $cart_count ?>"></a>
            </div>
            <div class="header__actions">
                <button type="button" aria-label="menu toggler" class="header__menu-toggler icon-menu">
                    <span></span><span></span><span></span>
                </button>
                <a href="/search" class="header__search icon-search"></a>
            </div>

        </div>
    </div>
</header>