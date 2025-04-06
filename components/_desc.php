<section class="desc">
    <div class="container">
        <div class="desc__content <?php echo esc_attr($image_position); ?>">
            <div class="desc__main <?php echo esc_attr($text_block_size); ?>">
                <h2 class="desc__title"><?php echo esc_html($title); ?></h2>
                <div class="desc__text"><?php echo wp_kses_post($body); ?></div>
                <?php if ($btn_text && $btn_link): ?>
                    <a href="<?php echo esc_url($btn_link); ?>" class="desc__btn btn btn-primary icon-arrow"><?php echo esc_html($btn_text); ?></a>
                <?php endif; ?>
            </div>
            <div class="desc__image">
                <?php if ($main_image): ?>
                    <div class="desc__image-item <?php echo esc_attr($image_item_class); ?>">
                        <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_url($main_image['alt']); ?>">
                    </div>
                <?php endif; ?>
                <?php if ($icon_image): ?>
                    <div class="desc__icon">
                        <img src="<?php echo esc_url($icon_image['url']); ?>" alt="Icon">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>