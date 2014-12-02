<?php
/**
 * portfolio functions and definitions
 *
 * @package portfolio
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portfolio_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on portfolio, use a find and replace
	 * to change 'portfolio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'portfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'portfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // portfolio_setup
add_action( 'after_setup_theme', 'portfolio_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'portfolio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portfolio_scripts() {
	wp_enqueue_style( 'portfolio-style', get_stylesheet_uri() );

	wp_enqueue_script( 'portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'portfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'portfolio_scripts' );

wp_enqueue_style( 'portfolio-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,400italic,700,900,900italic|PT+Serif:400,700,400italic,700italic' );
                    
// FontAwesome
wp_enqueue_style('portfolio_fontawesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
  
wp_enqueue_style( 'portfolio-layout-style' , get_template_directory_uri() . '/layouts/sidebar-content.css');

add_image_size( 'index-thumb', 300, 9999, false);
add_image_size( 'works-thumb', 200, 200, true);
add_image_size( 'large',9999, 200, true );
add_image_size( 'worksimage');

function my_add_works( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ($query->is_home() || $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'works' ) );
        }
    }
}

add_action( 'pre_get_posts', 'my_add_works' );

// Equeue Isotope and isotope settings
function works_scripts() {
    if(is_archive('works')){
        wp_enqueue_script( 'isotope-lib', get_stylesheet_directory_uri() . '/js/isotope.min.js', array('jquery'), 11112014, false );
        wp_enqueue_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/imagesloaded.js', 11112014, false );
        wp_enqueue_script( 'isotope-settings', get_stylesheet_directory_uri() . '/js/isotope.settings.js', array('isotope-lib'), 11112014, false );
    }
}   

add_action( 'wp_enqueue_scripts', 'works_scripts' );

// Output all terms as classes for filtering with Isotope
function custom_taxonomies_terms_links($post_ID){
    // get post by post id
    $post = get_post( $post_ID );
    
    // get post type by post
    $post_type = $post->post_type;
    
    // get post type taxonomies
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );
    
    $out = array();
    
    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
    
        // get the terms related to post
        $terms = get_the_terms( $post->ID, $taxonomy_slug );
        
        if ( !empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $out[] = $term->slug;
            }
        }
        
    }

  return implode(' ', $out );
}
/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
