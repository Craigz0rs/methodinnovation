<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>


<?php get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$categories = get_categories( array(
  'post_type' => 'post',
  'orderby'   => 'name',
  'order'     => 'ASC',
  'taxonomy'  => 'category',
  'hide_empty' => true,
) );

$category = get_queried_object();
$currentcatid = $category->term_id;

$sticky_posts = get_option( 'sticky_posts' );
if ( empty( $sticky_posts ) ) {
  $sticky_posts = array_map( function( $post ) {
    return $post['ID'];
  }, wp_get_recent_posts( [ 'numberposts' => '1' ] ) );
}

$featured_post = get_post( $sticky_posts[0] );
wp_reset_postdata(  );

?>

<main id="site-main" class="site-main">
    <div class="wp-block-cover is-style-hero is-style-hero--blog has-grey-xdark-background-color">
        <?php echo wp_get_attachment_image(get_field('blog_hero', 'options'), 'large', '', array( "class" => "wp-block-cover__image-background" )); ?>
        <div class="wp-block-cover__inner-container">
            <?php echo get_field('blog_hero_content', 'options'); ?>
            <ul class="blog__sorting">
                <li>
                    <a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="wp-block-button__link<?php if(!$currentcatid) { echo ' selected'; } ?>">ALL POSTS</a>
                </li>
                <?php foreach($categories as $cat) : ?>
                    <li>
                        <a href="<?php echo get_category_link($cat->term_id); ?>/#!/blog-list" class="wp-block-button__link<?php if($currentcatid == $cat->term_id) { echo ' selected'; } ?>"><?php echo $cat->name; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <article class="blog__featured">
            <b class="plus-parallax"></b>
            <div class="blog__featured__image">
                <?php echo get_the_post_thumbnail( $featured_post->ID, 'large' ); ?>
            </div>
            <div class="blog__featured__content">
                <?php $featured_post_cats = wp_get_post_categories( $featured_post->ID, array('fields' => 'names') ); ?>
                <div>
                    <h2><sup><span><?php echo get_the_date( 'F d, Y', $featured_post->ID ); ?> - </span><ul class="blog__teaser__categories"><?php foreach($featured_post_cats as $cat) { echo '<li>' . $cat . '</li>'; } ?></ul></sup><?php echo $featured_post->post_title; ?></h2>
                    <?php the_excerpt($featured_post->ID); ?>
                    <div class="wp-block-buttons">
                        <div class="wp-block-button intersected">
                            <a class="wp-block-button__link" href="<?php echo get_permalink( $featured_post->ID ); ?>">READ MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <div class="wp-block-group" id="blog-list">
        <div class="wp-block-group__inner-container blog__wrap">
            <?php if ( have_posts() ): ?>
                <div class="blog__list">
                    <?php
                        while ( have_posts() ) :
                            the_post();
                            $post_cats = get_the_terms( $post->ID, 'category' ); 
                    ?>
                        <div class="blog__listing content">
                            <article class="blog__teaser">
                                <a href="<?php echo get_permalink(); ?>">
                                    <div class="blog__teaser__image-wrap">
                                        <?php echo get_the_post_thumbnail( $post, 'large' ); ?>
                                    </div>
                                    <div class="blog__teaser__content-wrap">
                                        <h2>
                                            <sup><span><?php echo get_the_date('M d, Y'); ?> - </span><ul class="blog__teaser__categories"><?php foreach($post_cats as $cat) { echo '<li>' . $cat->name . '</li>'; } ?></ul></sup>
                                            <?php echo the_title(); ?>
                                        </h2>
                                        <div class="wp-block-buttons">
                                            <div class="wp-block-button intersected">
                                                <span class="wp-block-button__link">Read more</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="wp-block-buttons">
                    <div class="next-page-link-wrapper wp-block-button" data-page-current="<?php echo $paged; ?>" data-per-page="<?php echo get_option('posts_per_page'); ?>"><?php print get_next_posts_link(); ?></div>
                </div>
            <?php else: ?>
                <p>Sorry, there are no posts to show.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
