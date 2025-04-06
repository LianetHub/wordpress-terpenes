<?
$promo_title = get_field('promo_title');
$promo_subtitle = get_field('promo_subtitle');
$promo_image = get_field('promo_image');
?>

<section class="promo">
    <div class="container">
        <div class="promo__row row">
            <div class="col-xl-5 col-lg-6">
                <div class="promo__offer">
                    <h1 class="promo__title">
                        <? echo $promo_title ?>
                    </h1>
                    <p class="promo__subtitle subtitle">
                        <? echo $promo_subtitle ?>
                    </p>
                    <a href="#request" class="promo__btn btn btn-primary btn-fullwidth icon-arrow">Request samples</a>
                </div>
            </div>
            <?php if ($promo_image): ?>
                <div class="col-xl-7 col-lg-6">
                    <div class="promo__image clipped">
                        <?
                        $image_url = $promo_image['url'];
                        $image_alt = $promo_image['alt'];
                        ?>
                        <img src="<? echo esc_url($image_url) ?>" alt="<? echo esc_attr($image_alt) ?>" class="cover-image">
                        <svg class="svg">
                            <clipPath id="promo-clip" clipPathUnits="objectBoundingBox">
                                <path d="M0.508,0.001 C0.585,-0.001,0.663,0.017,0.73,0.059 C0.797,0.099,0.846,0.164,0.886,0.232 C0.924,0.297,0.937,0.371,0.956,0.444 C0.975,0.521,1,0.598,0.997,0.675 C0.981,0.751,0.922,0.808,0.869,0.863 C0.818,0.917,0.764,0.972,0.694,0.993 C0.626,1,0.553,0.984,0.481,0.98 C0.409,0.975,0.332,1,0.268,0.966 C0.204,0.93,0.181,0.849,0.139,0.787 C0.098,0.727,0.045,0.674,0.023,0.605 C-0.001,0.531,-0.006,0.453,0.01,0.379 C0.026,0.304,0.063,0.235,0.114,0.18 C0.164,0.126,0.231,0.095,0.298,0.065 C0.365,0.034,0.433,0.002,0.508,0.001"></path>
                            </clipPath>
                        </svg>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>