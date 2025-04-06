<?php get_header(); ?>

<section class="blog">
    <div class="container">
        <h1 class="blog__title gradient-text">Blog</h1>
        <div class="blog__body">
            <div class="row">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-4">
                            <?php require(TEMPLATE_PATH . '_blog-card.php'); ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No posts found</p>
                <?php endif; ?>

            </div>
        </div>
        <!-- <a href="#" class="blog__loadmore" id="load-more">LOAD MORE</a> -->
    </div>
</section>

<?php get_footer(); ?>