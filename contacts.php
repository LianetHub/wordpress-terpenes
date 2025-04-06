<?php

/**
 * Template Name: Contacts Page Template
 */

get_header(); ?>

<section class="contacts">
    <?php
    $company_address = get_field('company_address', 'option');

    $phone_number = get_field('phone_number', 'option');
    $formatted_phone_number = preg_replace('/[^0-9+]/', '', $phone_number);

    $emergency_contact_number = get_field('emergency_contact_number', 'option');
    $formatted_emergency_contact_number = preg_replace('/[^0-9+]/', '', $emergency_contact_number);

    $email = get_field('email', 'option');

    $linkedin_url = get_field('linkedin_url', 'option');
    $instagram_url = get_field('instagram_url', 'option');
    $facebook_url = get_field('facebook_url', 'option');
    $x_url = get_field('x_url', 'option');

    $location = get_field('google_map');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="contacts__title gradient-text">Our Contacts</h1>

                <?php if ($company_address || $phone_number || $emergency_contact_number || $email): ?>
                    <ul class="contacts__list">

                        <?php if ($phone_number || $emergency_contact_number): ?>
                            <li class="contacts__item">
                                <div class="contacts__item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/phone-call.svg" alt="Иконка">
                                </div>
                                <div class="contacts__item-content">
                                    <?php if ($formatted_phone_number): ?>
                                        <div class="contacts__item-row">
                                            <span class="color-blue">Phone Number:</span>
                                            <a href="tel:<?php echo esc_attr($formatted_phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($formatted_emergency_contact_number): ?>
                                        <div class="contacts__item-row">
                                            <span class="color-blue">Emergency Contact Number:</span>
                                            <a href="tel:<?php echo esc_attr($formatted_emergency_contact_number); ?>"><?php echo esc_html($emergency_contact_number); ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if ($email): ?>
                            <li class="contacts__item">
                                <div class="contacts__item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/mail.svg" alt="Иконка">
                                </div>
                                <div class="contacts__item-content">
                                    <div class="contacts__item-row">
                                        <span class="color-blue">Email:</span>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if ($company_address): ?>
                            <li class="contacts__item">
                                <div class="contacts__item-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/map-pin.svg" alt="Иконка">
                                </div>
                                <div class="contacts__item-content">
                                    <div class="contacts__item-row">
                                        <span class="color-blue">Address:</span>
                                        <?php echo esc_html($company_address); ?>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>

                    </ul>
                <?php endif; ?>

                <?php if ($linkedin_url || $instagram_url || $facebook_url): ?>
                    <div class="contacts__socials">
                        <?php if ($linkedin_url): ?>
                            <a href="<?php echo esc_url($linkedin_url); ?>" class="contacts__social icon-linkedin" target="_blank" rel="noopener noreferrer"></a>
                        <?php endif; ?>
                        <?php if ($instagram_url): ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" class="contacts__social icon-instagram" target="_blank" rel="noopener noreferrer"></a>
                        <?php endif; ?>
                        <?php if ($facebook_url): ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" class="contacts__social icon-facebook" target="_blank" rel="noopener noreferrer"></a>
                        <?php endif; ?>
                        <?php if ($x_url): ?>
                            <a href="<?php echo esc_url($x_url); ?>" class="contacts__social icon-x" target="_blank" rel="noopener noreferrer"></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <div class="contacts__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d486.090253302576!2d100.91937391028138!3d12.925579142371916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31029596b85ea3cb%3A0xd9e2db7c1559f4b5!2zMTQwIOC4nuC4seC4l-C4ouC4suC4o-C4uOC5iOC4h-C5gOC4o-C4t-C4reC4hyDguIvguK3guKIgMTEgTXVhbmcgUGF0dGF5YSwgQW1waG9lIEJhbmcgTGFtdW5nLCBDaGFuZyBXYXQgQ2hvbiBCdXJpIDIwMTUwLCDQotCw0LjQu9Cw0L3QtA!5e0!3m2!1sru!2sro!4v1743609706787!5m2!1sru!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>