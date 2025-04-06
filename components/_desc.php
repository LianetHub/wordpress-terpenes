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
                    <div class="desc__image-item clipped <? echo esc_attr($image_item_class) ?>">
                        <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_url($main_image['alt']); ?>">
                        <?php if ($image_item_class): ?>
                            <svg class="svg">
                                <? if (esc_attr($image_item_class) === 'mask-1'): ?>
                                    <clipPath id="desk-mask-1" clipPathUnits="objectBoundingBox">
                                        <path d="M0.394,0.025 C0.514,-0.006,0.659,-0.017,0.757,0.054 C0.852,0.124,0.818,0.266,0.866,0.37 C0.902,0.448,0.999,0.5,1,0.585 C1,0.672,0.94,0.748,0.875,0.811 C0.814,0.868,0.731,0.891,0.651,0.921 C0.558,0.955,0.467,1,0.371,0.995 C0.274,0.97,0.231,0.869,0.17,0.793 C0.104,0.711,0.016,0.638,0.003,0.536 C-0.01,0.426,0.032,0.315,0.101,0.224 C0.173,0.13,0.275,0.056,0.394,0.025"></path>
                                    </clipPath>
                                <?php endif; ?>
                                <? if (esc_attr($image_item_class) === 'mask-2'): ?>
                                    <clipPath id="desk-mask-2" clipPathUnits="objectBoundingBox">
                                        <path d="M0.502,0.002 C0.61,-0.016,0.689,0.099,0.776,0.164 C0.86,0.227,0.983,0.273,0.999,0.375 C1,0.478,0.885,0.546,0.853,0.645 C0.821,0.747,0.893,0.881,0.815,0.956 C0.738,1,0.609,0.992,0.502,0.98 C0.407,0.969,0.319,0.94,0.238,0.891 C0.149,0.838,0.05,0.784,0.016,0.689 C-0.018,0.592,0.007,0.48,0.061,0.393 C0.11,0.315,0.221,0.308,0.29,0.247 C0.373,0.173,0.392,0.021,0.502,0.002"></path>
                                    </clipPath>
                                <?php endif; ?>
                                <? if (esc_attr($image_item_class) === 'mask-3'): ?>
                                    <clipPath id="desk-mask-3" clipPathUnits="objectBoundingBox">
                                        <path d="M0.487,0.046 C0.587,0.064,0.675,0.102,0.756,0.164 C0.857,0.24,1,0.309,1,0.437 C0.995,0.566,0.817,0.591,0.73,0.684 C0.638,0.782,0.615,0.949,0.487,0.985 C0.341,1,0.163,0.987,0.063,0.87 C-0.034,0.756,0.011,0.588,0.018,0.437 C0.025,0.298,-0.004,0.132,0.102,0.044 C0.205,-0.042,0.356,0.022,0.487,0.046"></path>
                                    </clipPath>
                                <?php endif; ?>
                                <? if (esc_attr($image_item_class) === 'mask-4'): ?>
                                    <clipPath id="desk-mask-3" clipPathUnits="objectBoundingBox">
                                        <path d="M0.517,0.054 C0.603,0.064,0.688,0.014,0.769,0.062 C0.863,0.116,0.947,0.214,0.982,0.327 C1,0.442,0.993,0.561,0.959,0.665 C0.925,0.769,0.868,0.859,0.789,0.918 C0.709,0.977,0.612,1,0.509,0.999 C0.408,0.987,0.29,0.948,0.226,0.848 C0.161,0.746,0.236,0.615,0.193,0.502 C0.155,0.404,0.02,0.368,0.003,0.266 C-0.014,0.167,0.047,0.078,0.114,0.028 C0.175,-0.017,0.263,0.009,0.342,0.014 C0.401,0.018,0.457,0.048,0.517,0.054"></path>
                                    </clipPath>
                                <?php endif; ?>
                            </svg>
                        <?php endif; ?>
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