<?php

/**
 * Epiqk Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Load values and assign defaults.
$count = 1;
?>
<div class="wp-block-group">
    <div class="wp-block-group__inner-container">
        <div class="services">
            <?php if(have_rows('services')): ?>
                <?php while(have_rows('services')): the_row(); ?>
                    <div class="services__item">
                        <div class="services__item__image">
                            <?php echo wp_get_attachment_image(get_sub_field('image'), 'large'); ?>
                            <span><?php if($count < 10) { print '0'; } print $count; ?></span>
                        </div>
                        <div class="accordion__item">
                            <div class="accordion__item__title">
                                <h3><button><sup><?php if($count < 10) { print '0'; } print $count; ?></sup><span><?php echo esc_html( get_sub_field('title') ); ?></span><b>VIEW DETAILS</b></button></h3>
                            </div>
                            <div class="accordion__item__content">
                                <?php echo get_sub_field('content'); ?>
                                <div class="wp-block-buttons">
                                    <div class="wp-block-button">
                                        <a class="wp-block-button__link" href="/projects/?industryId=<?php echo get_sub_field('industry'); ?>&serviceId=<?php echo get_sub_field('service'); ?>/#!/project-list">VIEW PROJECTS</a>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php $count ++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
