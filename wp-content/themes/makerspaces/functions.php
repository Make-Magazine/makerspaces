<?php
/**
 * _makerspaces functions and definitions
 *
 * @package _makerspaces
 */

 /**
  * Store the theme's directory path and uri in constants
  */
 define('THEME_DIR_PATH', get_template_directory());
 define('THEME_DIR_URI', get_template_directory_uri());


if ( ! function_exists( '_makerspaces_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _makerspaces_setup() {
	// Add html 5 behavior for some theme elements
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

  // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	*/
	load_theme_textdomain( '_makerspaces', THEME_DIR_PATH . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header menu', '_makerspaces' ),
	) );

}
endif; // _makerspaces_setup
add_action( 'after_setup_theme', '_makerspaces_setup' );


// Define our current version number using the stylesheet version
function my_wp_default_styles($styles) {
  $my_theme = wp_get_theme();
  $my_version = $my_theme->get('Version');
  $styles->default_version = $my_version;
}
add_action('wp_default_styles', 'my_wp_default_styles');


/**
 * Enqueue scripts and styles
 */
function _makerspaces_scripts() {
	// Load styles
	wp_enqueue_style( '_makerspaces-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( '_makerspaces-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0' );
  wp_enqueue_style( '_makerspaces-font-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', array(), null, 'all' );
  wp_enqueue_style( '_makerspaces-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all' );
  wp_enqueue_style( '_makerspaces-fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css', array(), null, 'all' );
	wp_enqueue_style( '_makerspaces-style', THEME_DIR_URI . '/includes/css/style.css?v=1.4' );

	// load scripts
	wp_enqueue_script( '_makerspaces-bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( '_makerspaces-fancyboxjs', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( '_makerspaces-scripts', THEME_DIR_URI . '/includes/js/min/scripts.min.js?v=1.6', array('jquery') );

	// Map page only
  if (is_page_template('page-map-angular.php')) {

  }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// only load on the image attachemnt pages
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_makerspaces-keyboard-image-navigation', THEME_DIR_URI . '/includes/js/min/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_makerspaces_scripts' );



/**
 * Custom template tags for this theme.
 */
require THEME_DIR_PATH . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require THEME_DIR_PATH . '/includes/extras.php';

/**
 * Customizer additions.
 */
require THEME_DIR_PATH . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require THEME_DIR_PATH . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require THEME_DIR_PATH . '/includes/bootstrap-wp-navwalker.php';

/**
 * Load the Makerspace entry page rules.
 */
require THEME_DIR_PATH . '/includes/entry-rules.php';
