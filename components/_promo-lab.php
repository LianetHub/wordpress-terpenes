<?
$promo_title = get_field('promo_title');
$promo_desc = get_field('promo_desc');
$promo_image = get_field('promo_image');
?>

<section class="promo">
    <div class="container">
        <h1 class="promo__title">
            <? echo $promo_title ?>
        </h1>
        <div class="promo__body">
            <div class="row">
                <div class="col-xl-7 col-lg-6">
                    <div class="promo__desc">
                        <? echo $promo_desc ?>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="promo__photo">
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
    </div>
</section>