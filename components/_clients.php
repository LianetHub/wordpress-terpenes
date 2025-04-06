<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="clients__header">
                    <h2 class="clients__title">Our Clients</h2>
                    <p class="clients__subtitle subtitle">
                        We collaborate with companies across various industries,
                        helping them create <span class="color-blue">unique aromas, flavors, and experiences</span>
                        with high-purity terpenes. Choose your sector and discover how our solutions can give you a competitive edge.
                    </p>
                </div>

                <?php if (have_rows('clients_cards')) :
                    $counter = 1;
                    while (have_rows('clients_cards')) : the_row();
                        if ($counter % 2 != 0) :
                            include(TEMPLATE_PATH . '_client-card.php');
                        endif;
                        $counter++;
                    endwhile;
                endif; ?>
            </div>

            <div class="col-6">
                <?php if (have_rows('clients_cards')) :
                    $counter = 1;
                    reset_rows('clients_cards');
                    while (have_rows('clients_cards')) : the_row();
                        if ($counter % 2 == 0) :
                            include(TEMPLATE_PATH . '_client-card.php');
                        endif;
                        $counter++;
                    endwhile;
                endif; ?>

                <div class="clients__footer">
                    <div class="clients__footer-caption">Don’t see your industry?</div>
                    <p class="clients__footer-desc">Terpenes have applications across many sectors. Let’s explore how they can work <span class="color-blue">for you!</span></p>
                    <a href="/contacts" class="clients__footer-btn btn btn-secondary">CONTACT US</a>
                </div>
            </div>
        </div>
    </div>
</section>