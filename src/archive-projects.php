<?php defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' );

get_header();

$projects_archive_hero = get_post( 200 );
//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$fab_cats = get_terms( array( 
    'post_type' => 'project',
    'orderby'   => 'name',
    'order'     => 'ASC',
    'taxonomy'  => 'industry',
    'hide_empty'=> false
));

$service_cats = get_terms( array( 
    'post_type' => 'project',
    'orderby'   => 'name',
    'order'     => 'ASC',
    'taxonomy'  => 'service',
    'hide_empty'=> false
));

?>
<main id="site-main" class="site-main">
    <?php print apply_filters( 'the_content', $projects_archive_hero->post_content ); ?>
    <div class="wp-block-group wp-block-section has-grey-light-background-color has-background no-observer is-style-section-wrap" id="project-list">
        <div class="wp-block-group__inner-container">
            <div class="projects__header">
                <div class="projects__filter">
                    <span>LOOKING FOR SPECIFIC PROJECTS?</span>
                    <form class="projects__filter__form" id="projects-sort">
                        <span>Filter by</span>
                        <div class="projects__filter-wrap">
                            <select id="industry" name="industryId">
                                <option value="">Industry</option>
                                <?php foreach($fab_cats as $cat) : ?>
                                    <option value="<?php echo $cat->term_id; ?>"<?php if($_GET['industryId'] && $_GET['industryId'] == $cat->term_id) { echo ' selected'; } ?>><?php echo $cat->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="projects__filter-wrap">
                            <select id="service" name="serviceId">
                                <option value="">Service</option>
                                <?php foreach($service_cats as $service) : ?>
                                    <option value="<?php echo $service->term_id; ?>"<?php if( $_GET['serviceId'] && $_GET['serviceId'] == $service->term_id ) { echo ' selected'; } ?>><?php echo $service->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input id="projects-sort-submit" type="submit" value="Submit" class="screen-reader-text">
                    </form>
                </div>
            </div>
            <?php if ( have_posts() ): ?>
                <div class="projects__list" id="project-list">
                    <?php
                        while ( have_posts() ) :
                            the_post(); 
                            $post_service = get_the_terms( $post->ID, 'service' );
                            $post_industry = get_the_terms( $post->ID, 'industry' );
                    ?>
                        <div class="projects__listing content">
                            <article class="projects__teaser">
                                <a href="#project<?php echo get_the_id(); ?>" data-id="<?php echo get_the_id(); ?>" data-populated="0" data-lity>
                                    <div class="projects__teaser__image-wrap">
                                        <?php echo get_the_post_thumbnail( $post, 'large' ); ?>
                                    </div>
                                    <div class="projects__teaser__content-wrap">
                                        <h2>
                                            <?php echo the_title(); ?>
                                            <sup><?php if(!empty($post_service)) { echo $post_service[0]->name; } ?></sup>
                                        </h2>
                                    </div>
                                </a>
                                <div id="project<?php echo get_the_id(); ?>" class="lity-hide projects__listing__lightbox">
                                    <div>
                                        <div class="projects__lightbox__slider">
                                            <ul><li><?php echo get_the_post_thumbnail( $post, 'large' ); ?></li></ul>
                                            <div class="projects__lightbox__slider__nav">
                                                <button class="slider__nav--prev slider__arrow prev" id="slider__prev" aria-label="previous slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.99 14.62"><defs><style>.cls-1{fill:none;stroke:#00a9e0;stroke-miterlimit:10}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Artwork"><path class="cls-1" d="M7.66.35.71 7.31l6.95 6.96M.71 7.31h15.28"/></g></g></svg></button>
                                                <button class="slider__nav--next slider__arrow next" id="slider__prev" aria-label="previous slide"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.99 14.62"><defs><style>.cls-1{fill:none;stroke:#00a9e0;stroke-miterlimit:10}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Artwork"><path class="cls-1" d="m8.33.35 6.95 6.96-6.95 6.96M15.28 7.31H0"/></g></g></svg></button>
                                            </div>
                                        </div>
                                        <div class="projects__lightbox__content-wrap">
                                            <h2>
                                                <sup><?php if(!empty($post_service)) { echo $post_service[0]->name; } ?></sup>
                                                <?php echo the_title(); ?>
                                            </h2>
                                            <div class="projects__lightbox__content"></div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                    
                </div>
                <!-- <div class="wp-block-buttons">
                    <div class="next-page-link-wrapper-projects wp-block-button" data-page-current="<?php echo $paged; ?>" data-per-page="8"><?php print get_next_posts_link(); ?></div>
                </div> -->

            <?php else: ?>
                <p>Sorry, there are no projects matching those terms.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php if( !empty( $_GET['industryId'] ) || !empty( $_GET['serviceId'] ) ): ?>
    <script>
        (function() {
            var resourceList = document.getElementById('project-list');
            resourceList.scrollIntoView();
        })();
    </script>
<?php endif; ?>
<?php

get_footer();