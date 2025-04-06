<header class="header">
    <div class="container">
        <div class="header__body">
            <a href="<?php echo home_url(); ?>" class="header__logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Логотип">
            </a>
            <?php
            wp_nav_menu([
                'menu'        => 'main menu',
                'container'   => 'nav',
                'container_class' => 'header__menu',
                'menu_class'  => 'menu',
            ]);
            ?>
            <div class="header__info">
                <div class="header__price">20, 000 $</div>
                <a href="/cart" class="header__cart icon-shopping-bag">
                    <span>1</span>
                </a>
            </div>
        </div>
    </div>
</header>