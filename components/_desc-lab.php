<?
$columns = get_field('columns');
?>

<?php if ($columns): ?>
    <section class="desc">
        <div class="container">
            <div class="desc__row row">
                <?php foreach ($columns as $item): ?>
                    <div class="desc__column col-lg-6">
                        <div class="desc__header">
                            <?php if ($item['columns_image']): ?>
                                <div class="desc__header-image">
                                    <img src="<?php echo esc_url($item['columns_image']['url']); ?>" alt="<?php echo esc_attr($item['columns_image']['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($item['columns_title']): ?>
                                <h3 class="desc__header-title">
                                    <?php echo esc_html($item['columns_title']); ?>
                                </h3>
                            <?php endif; ?>
                        </div>
                        <?php if ($item['columns_desc']): ?>
                            <div class="desc__text">
                                <?php echo wp_kses_post($item['columns_desc']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>