<?
$promo_title = get_field('promo_title');
$promo_subtitle = get_field('promo_subtitle');
$promo_image = get_field('promo_image');
?>

<section class="promo">
    <div class="container">
        <div class="promo__row row">
            <div class="col-5">
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
            <div class="col-7">
                <div class="promo__image">
                    <?
                    if ($promo_image) {
                        $image_url = $promo_image['url'];
                        $image_alt = $promo_image['alt'];
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="cover-image">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>