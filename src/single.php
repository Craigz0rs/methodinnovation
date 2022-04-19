<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' ); ?>

<?php get_header(); 

if ( have_posts() ) {
  while ( have_posts() ) {

      the_post(); 

?>
<main id="site-main" class="site-main">
  <article class="blog__single">
    <div class="wp-block-cover is-style-hero is-style-hero--blog-single">
        <span aria-hidden="true" class="has-black-background-color has-background-dim-50 wp-block-cover__gradient-background has-background-dim"></span>
        <?php echo get_the_post_thumbnail($post, 'large', array( "class" => "wp-block-cover__image-background" )); ?>
        <div class="wp-block-cover__inner-container">
            <h1>
              <sup>
                <?php
                  $post_cats = get_the_terms( $post->ID, 'category' );
                  foreach($post_cats as $cat) {
                    echo '<span>' . $cat->name . '</span>';
                  }
                ?>
              </sup>
              <?php echo the_title(); ?></h1>
              <p class="has-lead-font-size"><?php echo get_the_excerpt(); ?></p>
        </div>
    </div>
    <div class="wp-block-group">
      <div class="wp-block-group__inner-container blog__single__wrap">
        <span class="blog__single__date"><span><?php echo get_the_date('d'); ?></span><?php echo get_the_date('M'); ?></span>
        <div class="blog__single__share">
          <ul class="blog__single__share-list">
              <?php $url = get_permalink(); ?>
              <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php print esc_url( $url ) ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.45 23.03"><path d="M12 0H9C5.64 0 3.47 2.22 3.47 5.67v2.61h-3a.47.47 0 00-.47.47v3.79a.47.47 0 00.47.46h3v9.55a.47.47 0 00.47.47h3.92a.47.47 0 00.47-.47V13h3.51a.47.47 0 00.47-.47V8.75a.47.47 0 00-.14-.33.44.44 0 00-.33-.14H8.33V6.07c0-1.07.25-1.61 1.67-1.61h2a.47.47 0 00.45-.46V.47A.48.48 0 0012 0z" data-name="Layer 2"/></svg></a></li>
              <li><a href="https://twitter.com/intent/tweet?url=<?php print esc_url( $url ) ?>&text=<?php print (string) get_the_title(); ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.67 17.6"><path d="M21.67 2.08a8.83 8.83 0 01-2.56.7 4.49 4.49 0 002-2.46 8.89 8.89 0 01-2.87 1.08 4.44 4.44 0 00-7.68 3 4.9 4.9 0 00.11 1A12.64 12.64 0 011.51.81a4.36 4.36 0 00-.6 2.24 4.42 4.42 0 002 3.69 4.4 4.4 0 01-2-.55 4.47 4.47 0 003.57 4.37 5 5 0 01-1.17.15 4.6 4.6 0 01-.84-.08 4.46 4.46 0 004.15 3.09 8.92 8.92 0 01-5.52 1.89A9.28 9.28 0 010 15.6a12.51 12.51 0 006.82 2A12.56 12.56 0 0019.46 5v-.58a8.71 8.71 0 002.23-2.3z" data-name="Layer 2"/></svg></a></li>
              <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print esc_url( $url ) ?>" target="_blank" rel="noopener noreferrer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.35 21.35"><g data-name="Layer 2"><path d="M21.34 21.35v-7.83c0-3.83-.83-6.78-5.3-6.78A4.64 4.64 0 0011.86 9h-.06V7.09H7.55v14.26H12v-7.06c0-1.86.35-3.66 2.66-3.66s2.3 2.13 2.3 3.78v6.94zM.35 7.1h4.43v14.25H.35zM2.56 0a2.58 2.58 0 102.57 2.56A2.56 2.56 0 002.56 0z"/></g></svg></a></li>
            </ul>
        </div>
        <div class="blog__single__body">
          <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>" aria-label="Back to main posts page"><i class="fas fa-arrow-left"></i>BACK TO NEWS</a>
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <div class="blog__single__pagination wp-block-group">
      <div class="wp-block-group__inner-container">
        <?php
          $related = new WP_Query(
            array(
                'post_type' => 'post',
                'category__in'   => wp_get_post_categories( $post->ID ),
                'posts_per_page' => 2,
                'post__not_in'   => array( $post->ID )
            )
          );
          // if(!$related) {
          //   $related = new WP_Query(
          //     array(
          //       'post_type' => 'post',
          //       'posts_per_page' => 2,
          //       'post__not_in'   => array( $post->ID )
          //     )
          //   );
          // }

          if( $related->have_posts() ) { 
              print '<h2><sup>RELATED POSTS</h2>';
              while( $related->have_posts() ) { 
                  $related->the_post(); 
                  $post_cats = get_the_terms( $post->ID, 'category' ); 
        ?>
                  <div class="blog__listing content">
                      <article class="blog__teaser">
                          <a href="<?php echo get_permalink(); ?>">
                              <div class="blog__teaser__image-wrap">
                                  <?php echo get_the_post_thumbnail( $post, 'large' ); ?>
                              </div>
                              <div class="blog__teaser__content-wrap">
                                  <h3>
                                      <sup><span><?php echo get_the_date('M d, Y'); ?> - </span><ul class="blog__teaser__categories"><?php foreach($post_cats as $cat) { echo '<li>' . $cat->name . '</li>'; } ?></ul></sup>
                                      <?php echo the_title(); ?>
                                  </h3>
                                  <div class="wp-block-buttons">
                                      <div class="wp-block-button intersected">
                                          <span class="wp-block-button__link">Read more</span>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </article>
                  </div>

        <?php
              }
              wp_reset_postdata();
          }
        ?>
      </div>
    </div>
  </article>
</main>
<?php 
  }
}
?>
<?php get_footer(); ?>

