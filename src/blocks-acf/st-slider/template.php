<?php

/**
 * Epiqk Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 $style = get_field('style');

?>
<div class="slider slider--<?php echo esc_html($style); ?>">
    <?php if(have_rows('slides')) : ?>
        <div class="slider__slides">
            <?php $count = 1; ?>
            <?php while(have_rows('slides')): the_row(); ?>
                <?php 
                    $link = get_sub_field('link');
                    $title = get_sub_field('title');
                    $subtitle = get_sub_field('subtitle');
                ?>
                <div class="slider__slide">
                    <a <?php if($link) { echo 'href="' . $link['url'] . '" class="has-link"';  } ?>>
                        <div class="slider__slide__image">
                            <?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?>
                        </div>
                        <div class="slider__slide__content">
                            <b>0<?php echo $count; ?></b>
                            <?php if($title) { echo '<h3>' . esc_html($title) . '</h3>'; } ?>
                            <?php if($subtitle) { echo '<span>' . esc_html($subtitle) . '</span>'; } ?>
                        </div>
                    </a>
                </div>
                <?php $count ++; ?>
            <?php endwhile; ?>
        </div>
        <div class="slider__nav">
            <div class="slider__dots"></div>
            <div class="slider__buttons"></div>
        </div>
    <?php endif; ?>
</div>