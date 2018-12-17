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


/*
   Set some CONST for universal assets (nav and footer)
   enclosed in a function for safety
   this needs to appear before the scripts/styles are enqueued 
*/
function set_universal_asset_constants() {
   // Assume that we're in prod; only change if we are definitively in another
   $universal_asset_env = 'make.co';
   $universal_asset_proto = 'https://';
   $universal_asset_user = false;
   $universal_asset_pass = false;
   $host = $_SERVER['HTTP_HOST'];
   // dev environments
   if(strpos($host, 'dev.') === 0) {
      $universal_asset_env = 'dev.make.co';
      $universal_asset_user = 'makecodev';
      $universal_asset_pass = '8f86ba87';
   }
   // stage environments
   else if(strpos($host, 'stage.') === 0) {
      $universal_asset_env = 'stage.make.co';
      $universal_asset_user = 'makecstage';
      $universal_asset_pass = 'c2792563';
   }
   // legacy staging environments
   else if(strpos($host, '.staging.wpengine.com') > -1) {
      $universal_asset_env = 'makeco.staging.wpengine.com';
      $universal_asset_user = 'makeco';
      $universal_asset_pass = 'memberships';
   }
   // local environments
   else if(strpos($host, ':8888') > -1) {
      $universal_asset_env = 'makeco:8888'; // this will require that we use `makeco` as our local
      $universal_asset_proto = 'http://';
   }
   // Set the important bits as CONSTANTS that can easily be used elsewhere
   define('UNIVERSAL_ASSET_URL_PREFIX', $universal_asset_proto . $universal_asset_env);
   define('UNIVERSAL_ASSET_USER', $universal_asset_user);
   define('UNIVERSAL_ASSET_PASS', $universal_asset_pass);
}
set_universal_asset_constants();


/**
 * Enqueue scripts and styles
 */

function _makerspaces_scripts() {
	$my_theme = wp_get_theme();
   $my_version = $my_theme->get('Version');
	// Load styles
	wp_enqueue_style( '_makerspaces-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( '_makerspaces-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0' );
	wp_enqueue_style('linearicons', 'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css', '', 'all' );
  wp_enqueue_style( '_makerspaces-font-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', array(), null, 'all' );
  wp_enqueue_style( '_makerspaces-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all' );
  wp_enqueue_style( '_makerspaces-fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css', array(), null, 'all' );
	wp_enqueue_style( '_makerspaces-style', THEME_DIR_URI . '/includes/css/style.css?v=1.4' );
	wp_enqueue_style('universal.css', UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/css/universal.css');

	// load scripts
	wp_enqueue_script( '_makerspaces-bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( '_makerspaces-fancyboxjs', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js', array( 'jquery' ), false, true );

	//auth0
   wp_enqueue_script('auth0', 'https://cdn.auth0.com/js/auth0/9.3.1/auth0.min.js', array(), false, true );
	wp_enqueue_script( '_makerspaces-scripts', THEME_DIR_URI . '/includes/js/min/scripts.min.js', array('jquery'), $my_version, true );
	wp_enqueue_script('universal', 'https://make.co/wp-content/themes/memberships/universal-nav/js/min/universal.min.js');
	// need to localize scripts to use the admin-ajax.php
   wp_localize_script('_makerspaces-scripts', 'ajax_object',
	  array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'home_url' => get_home_url(),
			'logout_nonce' => wp_create_nonce('ajax-logout-nonce'),
	  )
	);

	// Map page only
	if (is_page_template('page-map-angular.php')) {

	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// only load on the image attachment pages
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_makerspaces-keyboard-image-navigation', THEME_DIR_URI . '/includes/js/min/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_makerspaces_scripts' );

/** Set up the Ajax Logout */
add_action( 'wp_ajax_mm_wplogout',        'MM_wordpress_logout' );
add_action( 'wp_ajax_nopriv_mm_wplogout', 'MM_wordpress_logout' );

function MM_wordpress_logout(){
    //check_ajax_referer( 'ajax-logout-nonce', 'ajaxsecurity' );
    wp_logout();
    ob_clean(); // probably overkill for this, but good habit
    wp_send_json_success();
}

add_action( 'wp_ajax_mm_wplogin', 'MM_WPlogin' );
add_action( 'wp_ajax_nopriv_mm_wplogin', 'MM_WPlogin' );

/** Set up the Ajax WP Login */
function MM_WPlogin(){
  //check_ajax_referer( 'ajax-login-nonce', 'ajaxsecurity' );
  global $wpdb; // access to the database

  //use auth0 plugin to log people into wp
  $a0_plugin  = new WP_Auth0();
  $a0_options = WP_Auth0_Options::Instance();
  $users_repo = new WP_Auth0_UsersRepo( $a0_options );
  $users_repo->init();

  $login_manager = new WP_Auth0_LoginManager( $users_repo, $a0_options );
  $login_manager->init();

  //get the user information passed from auth0
  $userinput     = filter_input_array(INPUT_POST);
  $userinfo      = (object) $userinput['auth0_userProfile'];
  $userinfo->email_verified = true;
  $access_token = filter_input(INPUT_POST, 'auth0_access_token', FILTER_SANITIZE_STRING);
  $id_token     = filter_input(INPUT_POST, 'auth0_id_token', FILTER_SANITIZE_STRING);

  if($login_manager->login_user( $userinfo, $id_token, $access_token)) {
    wp_send_json_success();
  }else{
    wp_send_json_error();
  }
}

	
	
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
