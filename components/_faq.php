<?php
$faq_items = get_field('faq_items');
?>

<section class="faq">
    <div class="container">
        <div class="faq__header">
            <h2 class="faq__title">FAQ</h2>
            <a href="#" class="faq__btn btn btn-secondary">ASK QUESTION</a>
        </div>

        <?php if ($faq_items): ?>
            <ul class="faq__list">
                <?php foreach ($faq_items as $item): ?>
                    <li class="faq__item">
                        <button type="button" class="faq__item-title icon-arrow-right"><?php echo esc_html($item['question']); ?></button>
                        <p class="faq__item-answer"><?php echo esc_html($item['answer']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>