<section class="info">
    <div class="info__wrapper">
        <div class="container">
            <div class="info__header">
                <div class="info__icon">
                    <img src="<?php echo esc_url($icon_image['url']); ?>" alt="Icon">
                </div>
                <h2 class="info__title">
                    <?php echo esc_html($title); ?>
                </h2>
            </div>
            <?php if ($desc): ?>
                <p class="info__desc">
                    <?php echo esc_html($desc); ?>
                </p>
            <?php endif; ?>
            <?php if ($caption): ?>
                <div class="info__caption">
                    <?php echo esc_html($caption); ?>
                </div>
            <?php endif; ?>

            <?php if ($list_items): ?>
                <ul class="info__list">
                    <?php foreach ($list_items as $item): ?>
                        <li class="info__list-item">
                            <?php if ($item['list_item_title']): ?>
                                <div class="info__list-item-title">
                                    <?php echo esc_html($item['list_item_title']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($item['list_item_desc']): ?>
                                <p class="info__list-item-desc">
                                    <?php echo esc_html($item['list_item_desc']); ?>
                                </p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($hint): ?>
                <div class="info__hint">
                    <?php echo esc_html($hint); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>