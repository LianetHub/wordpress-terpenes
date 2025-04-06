<?php

/**
 * Template Name: Lab Page Template
 */

get_header(); ?>
<?php require_once(COMPONENTS_PATH . '_promo-lab.php'); ?>

<?php if (have_rows('info_block_1')): ?>
    <?php while (have_rows('info_block_1')): the_row(); ?>

        <?php
        $icon_image = get_sub_field('icon_image');
        $title = get_sub_field('title');
        $desc = get_sub_field('desc');
        $caption = get_sub_field('caption');
        $list_items  = get_sub_field('list_items');
        $hint  = get_sub_field('hint');
        require COMPONENTS_PATH . '_info.php';
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('desc_block_1')): ?>
    <?php while (have_rows('desc_block_1')): the_row(); ?>

        <?php
        $title = get_sub_field('title');
        $body = get_sub_field('body');
        $text_block_size  = get_sub_field('text_block_size');
        $btn_text = get_sub_field('btn_text');
        $btn_link = get_sub_field('btn_link');
        $icon_image = get_sub_field('icon_image');
        $main_image = get_sub_field('main_image');
        $image_position = get_sub_field('image_position');
        $image_item_class = get_sub_field('image_item_class');

        require COMPONENTS_PATH . '_desc.php';
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('desc_block_2')): ?>
    <?php while (have_rows('desc_block_2')): the_row(); ?>

        <?php
        $title = get_sub_field('title');
        $body = get_sub_field('body');
        $text_block_size  = get_sub_field('text_block_size');
        $btn_text = get_sub_field('btn_text');
        $btn_link = get_sub_field('btn_link');
        $icon_image = get_sub_field('icon_image');
        $main_image = get_sub_field('main_image');
        $image_position = get_sub_field('image_position');
        $image_item_class = get_sub_field('image_item_class');

        require COMPONENTS_PATH . '_desc.php';
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php if (have_rows('info_block_2')): ?>
    <?php while (have_rows('info_block_2')): the_row(); ?>

        <?php
        $icon_image = get_sub_field('icon_image');
        $title = get_sub_field('title');
        $desc = get_sub_field('desc');
        $caption = get_sub_field('caption');
        $list_items  = get_sub_field('list_items');
        $hint  = get_sub_field('hint');

        require COMPONENTS_PATH . '_info.php';
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php require_once(COMPONENTS_PATH . '_desc-lab.php'); ?>

<?php get_footer(); ?>