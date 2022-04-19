<?php

defined( 'ABSPATH' ) || die( 'Direct file access is prohibited.' );

if ( ! isset( $content_width ) ) $content_width = 782;

class EpiqkTheme {

  public static function after_switch_theme() {
    update_option( 'image_default_link_type', 'none' );
  }
  
  public static function after_setup_theme() {
    
    register_nav_menus( [
      'primary' => esc_html__( 'Header navigation', 'epiqk' ),
    ] );
    register_nav_menus( [
      'footer' => esc_html__( 'Footer navigation', 'epiqk' ),
    ] );
  
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', [
      'search-form', 
      'comment-form',	
      'comment-list',	
      'gallery', 
      'caption',
    ] );
    add_theme_support( 'disable-custom-gradients' );
    add_theme_support( 'editor-gradient-presets', [] );

    $brand_colors = [
      'black' => [
        'label' => 'Black',
        'hex' => '#171717',
      ],
      'grey-xdark' => [
        'label' => 'Extra Dark Grey',
        'hex' => '#2F3438',
      ],
      'grey-dark' => [
        'label' => 'Dark Grey',
        'hex' => '#969491',
      ],
      'grey' => [
        'label' => 'Grey',
        'hex' => '#D8D8D8',
      ],
      'grey-light' => [
        'label' => 'Light Grey',
        'hex' => '#F5F5F5',
      ],
      'white' => [
        'label' => 'White',
        'hex' => '#FFF',
      ],
      'primary' => [
        'label' => 'Blue (Primary)',
        'hex' => '#00A9E0',
      ],
      
    ];

    add_theme_support( 'editor-color-palette', array_map( function( $slug, $color ) {

      return [
        'name' => __( $color['label'], 'epiqk' ),
        'slug'  => $slug,
        'color'	=> $color['hex'],
      ];

    }, array_keys( $brand_colors ), array_values( $brand_colors ) ) );
    
    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'disable-custom-font-sizes' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-font-sizes', [[]] );
  
    add_theme_support( 'editor-font-sizes', [
        [
            'name' => __( 'Normal', 'epiqk' ),
            'shortName' => __( 'N', 'epiqk' ),
            'size' => 21,
            'slug' => 'normal'
        ],
        [
            'name' => __( 'Leading Paragraph', 'epiqk' ),
            'shortName' => __( 'L', 'epiqk' ),
            'size' => 25,
            'slug' => 'lead'
        ],
    ] );
  
    add_image_size( 'headshot', 900, 1000, true );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
  
    remove_theme_support( 'automatic-feed-links' );
    remove_theme_support( 'custom-background' );
    remove_theme_support( 'custom-header' );
    remove_theme_support( 'post-formats' );
  
  }
  
  public static function init() {

    register_post_type('projects', array(
      'supports' => array(
        'title', // post title
        'editor', // post content
        'thumbnail', // featured images
        // 'excerpt', // post excerpt
        'custom-fields', // custom fields
        'revisions', // post revisions
        'post-formats', // post formats
      ),
      'labels' => array(
        'name' => _x('Projects', 'plural'),
        'singular_name' => _x('Project', 'singular'),
        'menu_name' => _x('Projects', 'admin menu'),
        'name_admin_bar' => _x('projects', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New project'),
        'new_item' => __('New project'),
        'edit_item' => __('Edit project'),
        'view_item' => __('View project'),
        'all_items' => __('All projects'),
        'search_items' => __('Search projects'),
        'not_found' => __('No project found.'),
      ),
      'public' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'has_archive' => true,
      'hierarchical' => false,
      'show_in_rest' => true,
      'rest_base' => 'projects',
      'menu_icon' => 'dashicons-hammer',
      'menu_position' => 6,
      'taxonomies' => array('industry', 'service'),
      'rewrite' => array(
        'with_front' => false,
        'slug'       => 'projects'
      )
    ));

    register_taxonomy( 'industry', array( 'projects' ), array(
      'labels'                     => array(
        'name'                       => _x( 'Industries', 'epiqk' ),
        'singular_name'              => _x( 'Industry', 'Taxonomy Singular Name', 'epiqk' ),
        'menu_name'                  => __( 'Industries', 'epiqk' ),
        'all_items'                  => __( 'All Items', 'epiqk' ),
        'parent_item'                => __( 'Parent Item', 'epiqk' ),
        'parent_item_colon'          => __( 'Parent Item:', 'epiqk' ),
        'new_item_name'              => __( 'New Item Name', 'epiqk' ),
        'add_new_item'               => __( 'Add New Item', 'epiqk' ),
        'edit_item'                  => __( 'Edit Item', 'epiqk' ),
        'update_item'                => __( 'Update Item', 'epiqk' ),
        'view_item'                  => __( 'View Item', 'epiqk' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'epiqk' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'epiqk' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'epiqk' ),
        'popular_items'              => __( 'Popular Items', 'epiqk' ),
        'search_items'               => __( 'Search Items', 'epiqk' ),
        'not_found'                  => __( 'Not Found', 'epiqk' ),
        'no_terms'                   => __( 'No items', 'epiqk' ),
        'items_list'                 => __( 'Items list', 'epiqk' ),
        'items_list_navigation'      => __( 'Items list navigation', 'epiqk' ),
      ),
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'show_in_rest'               => true,
    ) );

    register_taxonomy( 'service', array( 'projects' ), array(
      'labels'                     => array(
        'name'                       => _x( 'Services', 'epiqk' ),
        'singular_name'              => _x( 'Service', 'Taxonomy Singular Name', 'epiqk' ),
        'menu_name'                  => __( 'Services', 'epiqk' ),
        'all_items'                  => __( 'All Items', 'epiqk' ),
        'parent_item'                => __( 'Parent Item', 'epiqk' ),
        'parent_item_colon'          => __( 'Parent Item:', 'epiqk' ),
        'new_item_name'              => __( 'New Item Name', 'epiqk' ),
        'add_new_item'               => __( 'Add New Item', 'epiqk' ),
        'edit_item'                  => __( 'Edit Item', 'epiqk' ),
        'update_item'                => __( 'Update Item', 'epiqk' ),
        'view_item'                  => __( 'View Item', 'epiqk' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'epiqk' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'epiqk' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'epiqk' ),
        'popular_items'              => __( 'Popular Items', 'epiqk' ),
        'search_items'               => __( 'Search Items', 'epiqk' ),
        'not_found'                  => __( 'Not Found', 'epiqk' ),
        'no_terms'                   => __( 'No items', 'epiqk' ),
        'items_list'                 => __( 'Items list', 'epiqk' ),
        'items_list_navigation'      => __( 'Items list navigation', 'epiqk' ),
      ),
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'show_in_rest'               => true,
    ) );

    remove_theme_support( 'post-thumbnails' );
    add_theme_support( 
      'post-thumbnails', [ 
        'post',
        'page',
        'projects',
      ]
    );

    
    add_theme_support( 'menus' );
    add_theme_support( 'widgets' );
    add_post_type_support( 'post', 'excerpt' );
    add_post_type_support( 'page', 'excerpt' );
    add_post_type_support( 'project', 'excerpt' );
  
    // Remove wp emoji support.
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    
    add_editor_style( 'assets/css/app-editor.css' );
  }

  public static function admin_bar_init() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
  }
  
  public static function gutenberg_styles() {
    
    wp_enqueue_style( 'epiqk-fonts', 'https://use.typekit.net/dmw7asv.css', [], null );
    wp_enqueue_style( 'epiqk-base-style', get_theme_file_uri( 'assets/css/app-editor.css' ), [], Epiqk::theme_version() );
  
    wp_enqueue_script( 'epiqk-block-styles', get_theme_file_uri( 'assets/js/app-admin.js' ), array( 'wp-blocks', 'wp-dom' ), Epiqk::theme_version(), true );
    wp_enqueue_script( 'epiqk-editor-js', get_theme_file_uri( 'assets/js/app-editor.js' ), array( 'jquery', 'wp-blocks', 'wp-dom' ), Epiqk::theme_version(), true );
    
  }
  
  public static function wp_enqueue_scripts() {
    
    wp_enqueue_script( 'epiqk-libs', get_template_directory_uri() . '/assets/js/app-libs.js', [ 'jquery' ], Epiqk::theme_version(), true );
    wp_enqueue_script( 'epiqk', get_template_directory_uri() . '/assets/js/app.js', [ 'jquery', 'epiqk-libs' ], Epiqk::theme_version(), true );
    
    wp_enqueue_style( 'epiqk-fonts', 'https://use.typekit.net/dmw7asv.css', [], null );
    wp_enqueue_style( 'epiqk', get_template_directory_uri() . '/assets/css/app.css', ['epiqk-fonts'], Epiqk::theme_version() );
    
  }
  
  public static function wp_dequeue_scripts() {
    
    if ( !is_user_logged_in() ) {
      wp_deregister_script( 'wp-embed' );
    }
    
  }

  public static function pre_get_posts( $query ) {
  
    return $query;
  
  }
  
  public static function the_excerpt( $text ) {
    
    if( is_search() && !is_admin() ) {
          
      $keywords = preg_split( '/\s+/', get_query_var( 's' ) );
      $keywords = array_filter( $keywords, 'strip_tags' );
      $keywords = array_filter( $keywords, 'trim' );
      
      if ( !empty( $keywords ) ) {
        $text = preg_replace('/(' . implode('|', $keywords) .')/iu', '<strong>${1}</strong>', strip_tags( $text ) );
      }
    }
    
    return $text;
    
  }
  
  public static function upload_mimes( $mimes ) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
  }
  
  // Yoast SEO
  public static function wpseo_separator_options( $separators ) { 
    return $separators; 
  }
  
  // ACF
  public static function acf_init() {
      
    
    if( function_exists('acf_register_block_type') ) {

      acf_register_block_type( [
        'name' => 'st-slider',
        'title' => __( 'Slider' ),
        'description' => __( '' ),
        'render_template' => '/blocks-acf/st-slider/template.php',
        'enqueue_style' => get_template_directory_uri() . '/assets/css/app-blocks-acf.css',
        'enqueue_script' => get_template_directory_uri() . '/assets/js/app-blocks-acf.js',
        'category' => 'epiqk-blocks',
        'icon' => '',
        'supports' => [
          'align' => false,
          'anchor' => true,
        ],
      ] );

      acf_register_block_type( [
        'name' => 'st-team',
        'title' => __( 'Team' ),
        'description' => __( '' ),
        'render_template' => '/blocks-acf/st-team/template.php',
        'enqueue_style' => get_template_directory_uri() . '/assets/css/app-blocks-acf.css',
        'enqueue_script' => get_template_directory_uri() . '/assets/js/app-blocks-acf.js',
        'category' => 'epiqk-blocks',
        'icon' => '',
        'supports' => [
          'align' => false,
          'anchor' => true,
        ],
      ] );

      acf_register_block_type( [
        'name' => 'st-services',
        'title' => __( 'Services' ),
        'description' => __( '' ),
        'render_template' => '/blocks-acf/st-services/template.php',
        'enqueue_style' => get_template_directory_uri() . '/assets/css/app-blocks-acf.css',
        'enqueue_script' => get_template_directory_uri() . '/assets/js/app-blocks-acf.js',
        'category' => 'epiqk-blocks',
        'icon' => '',
        'supports' => [
          'align' => false,
          'anchor' => true,
        ],
      ] );

    }
    
  }

  public static function render_block( $block_content, $block ) {

    if ( !is_admin() ) {

      if ( 'core/cover' === $block['blockName'] ) {
        $block_content = str_replace(' playsinline', '', $block_content);
        $block_content = str_replace(' autoplay', ' autoplay playsinline', $block_content);
      }

    }
  
    return $block_content;
  }

  public static function custom_block_categories( $categories ) {
    return array_merge(
      array(
        array(
          'slug' => 'epiqk-blocks',
          'title' => __( 'Epiqk', 'epiqk-blocks' ),
        ),
      ),
      $categories
    );
  }

  public static function enable_more_buttons($buttons) {
    $buttons[] = 'subscript';
    $buttons[] = 'superscript';
    return $buttons;
  }

  public static function pre_get_posts_projects_archive( $wp_query ) {
    if ( !is_admin() && $wp_query->is_main_query() && is_post_type_archive( 'projects' ) ) {
      // $wp_query->set('posts_per_page',8);

      $tax_query = [];
      if ( !empty( $_GET['industryId'] ) ) {
        $tax_query[] = [
          'taxonomy' => 'industry',
          'field' => 'id',
          'terms' => (int)$_GET['industryId']
        ];
      }
      if ( !empty( $_GET['serviceId'] ) ) {
        $tax_query[] = [
          'taxonomy' => 'service', 
          'field' => 'id',
          'terms' => (int)$_GET['serviceId']
        ];
      }
      if ( !empty( $tax_query ) ) {
        $tax_query = array_merge( [ 'relation' => 'AND' ], $tax_query );
        $wp_query->set( 'tax_query', $tax_query );
        $wp_query->set( 'posts_per_page', -1 );
      }
    }

    return $wp_query;

  }

}

add_action( 'login_enqueue_scripts', function() {
    
  wp_dequeue_style( 'dashicons' );
  wp_dequeue_style( 'buttons' );
  wp_dequeue_style( 'forms' );
  wp_dequeue_style( 'l10n' );
  wp_dequeue_style( 'login' );
  wp_dequeue_style( 'genericons' );
  wp_dequeue_style( 'jetpack-sso-login' );

  wp_enqueue_style( 'epiqk-login', get_stylesheet_directory_uri() . '/style-login.css' );
  wp_enqueue_style( 'epiqk-login-2021', get_stylesheet_directory_uri() . '/assets/css/app-login.css' );

}, 20 );

add_action( 'after_switch_theme', array( 'EpiqkTheme', 'after_switch_theme' ) );
add_action( 'after_setup_theme', array( 'EpiqkTheme', 'after_setup_theme' ) );
add_action( 'init', array( 'EpiqkTheme', 'init' ) );

add_action( 'enqueue_block_editor_assets', array( 'EpiqkTheme', 'gutenberg_styles' ) );

add_action( 'wp_enqueue_scripts', array( 'EpiqkTheme', 'wp_enqueue_scripts' ) );
add_action( 'admin_bar_init', array( 'EpiqkTheme', 'admin_bar_init' ) );

add_action( 'acf/init', array( 'EpiqkTheme', 'acf_init' ) );

add_filter( 'pre_get_posts', array( 'EpiqkTheme', 'pre_get_posts_projects_archive' ) );
add_filter( 'block_categories', array( 'EpiqkTheme', 'custom_block_categories' ) );
add_filter( 'pre_get_posts', array( 'EpiqkTheme', 'pre_get_posts' ) );
add_filter( 'render_block', array( 'EpiqkTheme', 'render_block' ), 10, 2);
add_filter( 'the_excerpt', array( 'EpiqkTheme', 'the_excerpt' ) );
add_filter( 'upload_mimes', array( 'EpiqkTheme', 'upload_mimes' ) );
add_filter( 'mce_buttons', array( 'EpiqkTheme', 'enable_more_buttons' ) );

add_filter( 'rest_pre_echo_response', function( $result, $server, $request ) {
  if ( '/wp/v2/posts' === $request->get_route() ) {
    $result = array_map( function ( $post ) {
      $post_cats = get_the_terms( $post->ID, 'category' ); 
      $print_cats = [];
      foreach($post_cats as $cat) { array_push($print_cats, '<li>' . $cat->name . '</li>'); }
      $print_cats = implode('', $print_cats);

      return [ 'card' => '<div class="blog__listing content"><article class="blog__teaser"><a href="' . get_permalink( $post['id'] ) . '"><div class="blog__teaser__image-wrap">' . get_the_post_thumbnail( $post['id'], 'large' ) . '</div><div class="blog__teaser__content-wrap"><h2><sup><span>' . get_the_date('M d, Y', $post['id']) . ' - </span><ul class="blog__teaser__categories">' . $print_cats . '</ul></sup>' . esc_html( get_the_title( $post['id'] ) ) . '</h2><div class="wp-block-buttons"><div class="wp-block-button"><span class="wp-block-button__link">Read more</span></div></div></div></a></article></div>'];
    }, $result );
  }
  return $result;
}, 10, 3 );

// Show all Projects on Projects Archive Page
add_action( 'pre_get_posts', 'tl_project_tax_page' );
function tl_project_tax_page( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_category() ) {
            $query->set( 'posts_per_page', '-1' );
    }
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'epiqk/v1/', 'projects/', array(
      'methods' => 'GET',
      'callback' => function($request_data) {
        $args = array(
          'post_type' => 'projects',
          'posts_per_page' => -1
        );
      
        $posts = get_posts($args);
      
        foreach ($posts as $key => $post) {
                $posts[$key]->acf = get_fields($post->ID);
                $posts[$key]->link = get_permalink($post->ID);
                $posts[$key]->image = get_the_post_thumbnail_url($post->ID);
                $posts[$key]->industry = get_the_terms($post->ID, 'industry');
                $posts[$key]->service = get_the_terms($post->ID, 'service');
                $posts[$key]->the_content = apply_filters('the_content', $post->post_content);
        }
        return $posts;
      },
    )
  );

  register_rest_route('epiqk/v1','/projects/(?P<id>\d+)',[
    'methods' => 'GET',
    'callback' => function(WP_REST_Request $request) {
      $params = $request->get_params();

      $post = get_post($params['id']);
      $data['id'] = $post->ID;
      $data['slug'] = $post->post_name;
      $data['title'] = $post->post_title;
      $data['acf'] = get_fields($post->ID);
      $data['industry']= get_the_terms($post->ID, 'industry');
      $data['service'] = get_the_terms($post->ID, 'service');
      $data['image'] = get_the_post_thumbnail_url($post->ID, 'large');
      $data['the_content'] = apply_filters('the_content', $post->post_content);

      return $data;
    },
  ]);
});

// add_filter( 'rest_pre_echo_response', function( $result, $server, $request ) {

//   if ( '/wp/v1/projects' === $request->get_route() ) {

//     $result = array_map( function ( $post ) {
//       $post_service = get_the_terms( $post['id'], 'service' );
//       $service = $post_service[0] ? $post_service[0]->name : '';

//       return [ 'card' => '<li class="projects__listing content">
//                             <article class="projects__teaser">
//                                 <a href="#project' . $post['id'] . '" data-id="' . $post['id'] . '" data-populated="0" data-lity>
//                                   <div class="projects__teaser__image-wrap">' . get_the_post_thumbnail( $post['id'], 'large' ) . '</div>
//                                   <div class="projects__teaser__content-wrap">
//                                     <h2>' . get_the_title($post['id']) . '<sup>' . $service . '</sup></h2>
//                                   </div>
//                                 </a>
//                                 <div id="project' . $post['id'] . '" class="lity-hide projects__listing__lightbox">
//                                     <div class="projects__lightbox__slider">
//                                         <ul><li>' . get_the_post_thumbnail( $post['id'], 'large' ) . '</li></ul>
//                                         <div class="projects__lightbox__slider__nav">
//                                           <button class="slider__nav--prev slider__arrow prev" id="slider__prev" aria-label="previous slide"></button>
//                                           <button class="slider__nav--next slider__arrow next" id="slider__prev" aria-label="previous slide"></button>
//                                         </div>
//                                     </div>
//                                     <div class="projects__lightbox__content-wrap">
//                                         <h2><sup>' . $service . '</sup><br>' . get_the_title($post['id']) . '</h2>
//                                         <div class="projects__lightbox__content"></div>
//                                         <h3>Materials used:</h3>
//                                         <ul class="projects__lightbox__materials"></ul>
//                                     </div>
//                                 </div>
//                             </article>
//                         </li>' ];
//     }, $result );

//   }

//   return $result;

// }, 10, 3 );

