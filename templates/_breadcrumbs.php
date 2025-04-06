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
            } elseif (is_category() || is_single()) {
                if (is_category()) {
                    if (is_category('blog')) {
                        echo '<li><a href="' . $posts_page_url . '">' . $posts_page_title . '</a></li>';
                    } else {
                        echo '<li><a href="' . get_category_link(get_queried_object_id()) . '">' . single_cat_title('', false) . '</a></li>';
                    }
                } elseif (is_single()) {
                    $categories = get_the_category();
                    if ($categories) {
                        foreach ($categories as $category) {
                            if ($category->slug == 'blog') {
                                echo '<li><a href="' . $posts_page_url . '">' . $posts_page_title . '</a></li>';
                            } else {
                                echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                            }
                        }
                    }

                    echo '<li><span>' . get_the_title() . '</span></li>';
                }
            } elseif (is_page()) {
                echo '<li><span>' . get_the_title() . '</span></li>';
            }
            ?>
        </ul>
    </div>
</nav>