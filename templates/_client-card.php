<div class="clients__card">
    <div class="clients__card-header">
        <div class="clients__card-icon">
            <?php
            $icon = get_sub_field('card_icon');
            if ($icon && is_array($icon) && isset($icon['url'])) {
                echo '<img src="' . esc_url($icon['url']) . '" alt="' . esc_attr($icon['alt']) . '">';
            } elseif (!empty($icon) && !is_array($icon)) {
                echo $icon;
            }
            ?>
        </div>
        <?php if ($title = get_sub_field('card_title')) : ?>
            <div class="clients__card-title"><?php echo esc_html($title); ?></div>
        <?php endif; ?>
    </div>
    <div class="clients__card-body">
        <div class="clients__card-main">
            <?php if (have_rows('card_desc')) : ?>
                <ul class="clients__card-desc">
                    <?php while (have_rows('card_desc')) : the_row(); ?>
                        <?php if ($desc = get_sub_field('card_desc_item')) : ?>
                            <li><?php echo esc_html($desc); ?></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php if ($text = get_sub_field('card_text')) : ?>
                <p class="clients__card-text"><?php echo $text ?></p>
            <?php endif; ?>

            <?php if (have_rows('card_list')) : ?>
                <ul class="clients__card-list">
                    <?php while (have_rows('card_list')) : the_row(); ?>
                        <?php if ($item = get_sub_field('item')) : ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php if ($link = get_sub_field('card_link')) : ?>
                <a href="<?php echo esc_url($link); ?>" class="clients__card-btn btn btn-primary icon-arrow">Learn more</a>
            <?php endif; ?>
        </div>
        <?php
        $image = get_sub_field('card_image');
        if ($image && isset($image['url'])) :
        ?>
            <div class="clients__card-image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>