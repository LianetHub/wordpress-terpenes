<?php
get_header(); ?>

<section class="error-404">
    <div class="container">
        <div class="error-404__body">
            <h1 class="error-404__title">Oops! That page can’t be found.</h1>
            <p class="error-404__subtitle subtitle">
                It looks like nothing was found at this location. <br>
                Maybe try a search or visit our <a href="<?php echo home_url(); ?>">homepage</a>?
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>