<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>


<?php get_header(); 

$background_image = get_field('404_background', 'option');

?>

<main id="site-main" class="site-main">
    <div class="wp-block-cover has-background-dim-40 has-background-dim is-style-hero">
        <?php echo wp_get_attachment_image(get_field('404_background', 'options'), 'large', '', array( "class" => "wp-block-cover__image-background" )); ?>
        <div class="wp-block-cover__inner-container">
            <h1 class="has-text-align-center">404: not found</h1>
            <p class="has-text-align-center has-lead-font-size"><a href="/" class="has-inline-color has-white-color">Back to home</a></p>
        </div>
    </div>
</main>

<?php get_footer(); ?>