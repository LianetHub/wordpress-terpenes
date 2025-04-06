<section id="request" class="request">
    <div class="request__wrapper">
        <div class="container">
            <div class="request__body row">
                <div class="col-lg-6">
                    <div class="request__header">
                        <div class="request__icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/auction.svg" alt="icon">
                        </div>
                        <h2 class="request__title">
                            Leave a request <span class="color-blue">right now!</span>
                        </h2>
                    </div>
                    <p class="request__subtitle subtitle">
                        Fill out the feedback form, we will contact you and select the right product!
                    </p>
                </div>
                <div class="col-lg-6">
                    <?php echo do_shortcode('[contact-form-7 id="9d9ab13" title="Request Right Now Form"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>