<?php

/**
 * Epiqk Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 $team = get_field('team_members');

?>
<div class="team">
    <div class="team__inner-wrap">
        <h2><?php echo esc_html(get_field('section_heading')); ?></h2>
        <div class="team__nav">
            <?php foreach($team as $member): ?>
                <button class="team__nav__button" data-name="<?php echo sanitize_title($member['name']); ?>"><?php echo $member['name']; ?></button>
            <?php endforeach; ?>
        </div>
        <div class="team__member__container">
            <?php foreach($team as $member): ?>
                <div id="<?php echo sanitize_title($member['name']); ?>" class="team__member">
                    <div>
                        <div class="team__member__image">
                            <?php echo wp_get_attachment_image($member['image'], 'large'); ?>
                        </div>
                        <div class="team__member__bio">
                            <?php echo $member['bio']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>