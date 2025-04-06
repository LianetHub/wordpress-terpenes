<?php require_once(COMPONENTS_PATH . '_request.php'); ?>
</main>
<footer class="footer">
    <?
    $company_address = get_field('company_address', 'option');

    $phone_number = get_field('phone_number', 'option');
    $formatted_phone_number = preg_replace('/[^0-9+]/', '', $phone_number);

    $emergency_contact_number = get_field('emergency_contact_number', 'option');
    $formatted_emergency_contact_number = preg_replace('/[^0-9+]/', '', $emergency_contact_number);

    $email = get_field('email', 'option');

    $registration_number = get_field('registration_number', 'option');

    $linkedin_url = get_field('linkedin_url', 'option');
    $instagram_url = get_field('instagram_url', 'option');
    $facebook_url = get_field('facebook_url', 'option');
    $x_url = get_field('x_url', 'option');

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer__main">
                    <a href="/" class="footer__logo">
                        <picture>
                            <source media="(min-width: 767.98px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo-white.png">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-white-mobile.png" alt="Logo">
                        </picture>
                    </a>
                    <?php
                    wp_nav_menu([
                        'menu'        => 'main menu',
                        'container'   => 'nav',
                        'container_class' => 'footer__menu',
                        'menu_class'  => 'menu',
                    ]);
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer__body">
                    <?php if ($company_address): ?>
                        <address class="footer__address"><?php echo esc_html($company_address); ?></address>
                    <?php endif; ?>
                    <?php if ($registration_number): ?>
                        <div class="footer__registration">
                            Registration Number: <?php echo esc_html($registration_number); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($email || $formatted_phone_number || $formatted_emergency_contact_number): ?>
                        <ul class="footer__contacts">
                            <?php if ($email): ?>
                                <li class="footer__contacts-item icon-envelope">
                                    <a href="mailto:<?php echo esc_attr($email); ?>">
                                        Email: <?php echo esc_html($email); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($formatted_phone_number): ?>
                                <li class="footer__contacts-item icon-phone">
                                    <a href="tel:<?php echo esc_attr($formatted_phone_number); ?>">
                                        Phone Number: <?php echo esc_html($phone_number); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if ($formatted_emergency_contact_number): ?>
                                <li class="footer__contacts-item icon-phone">
                                    <a href="tel:<?php echo esc_attr($formatted_emergency_contact_number); ?>">
                                        Emergency Contact Number: <?php echo esc_html($emergency_contact_number); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($linkedin_url || $instagram_url || $facebook_url): ?>
                        <div class="footer__socials">
                            <?php if ($linkedin_url): ?>
                                <a href="<?php echo esc_url($linkedin_url); ?>" class="footer__social icon-linkedin" target="_blank" rel="noopener noreferrer"></a>
                            <?php endif; ?>
                            <?php if ($instagram_url): ?>
                                <a href="<?php echo esc_url($instagram_url); ?>" class="footer__social icon-instagram" target="_blank" rel="noopener noreferrer"></a>
                            <?php endif; ?>
                            <?php if ($facebook_url): ?>
                                <a href="<?php echo esc_url($facebook_url); ?>" class="footer__social icon-facebook" target="_blank" rel="noopener noreferrer"></a>
                            <?php endif; ?>
                            <?php if ($x_url): ?>
                                <a href="<?php echo esc_url($x_url); ?>" class="footer__social icon-x" target="_blank" rel="noopener noreferrer"></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>