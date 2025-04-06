<?php
$posts_page_id = get_option('page_for_posts');
$posts_page_title = get_the_title($posts_page_id);
$posts_page_url = get_permalink($posts_page_id);
?>

<nav class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="<?php echo home_url(); ?>">Home</a></li>

            <?php

            if (is_home()) {
                echo '<li><span>' . $posts_page_title . '</span></li>';
            } elseif (is_shop()) {
                echo '<li><span>' . get_the_title(woocommerce_get_page_id('shop')) . '</span></li>';
            } elseif (is_product_category()) {

                $category = get_queried_object();
                echo '<li><a href="' . get_term_link($category) . '">' . $category->name . '</a></li>';
            } elseif (is_product()) {

                $categories = get_the_terms(get_the_ID(), 'product_cat');
                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<li><a href="' . get_term_link($category) . '">' . $category->name . '</a></li>';
                    }
                }
                echo '<li><span>' . get_the_title() . '</span></li>';
            } elseif (is_page()) {
                echo '<li><span>' . get_the_title() . '</span></li>';
            }
            ?>
        </ul>
    </div>
</nav>