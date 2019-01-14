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


if (!function_exists('_makerspaces_setup')) :

   /**
    * Set up theme defaults and register support for various WordPress features.
    *
    * Note that this function is hooked into the after_setup_theme hook, which runs
    * before the init hook. The init hook is too late for some features, such as indicating
    * support post thumbnails.
    */
   function _makerspaces_setup() {
      // Add html 5 behavior for some theme elements
      add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

      // This theme styles the visual editor with editor-style.css to match the theme style.
      add_editor_style();

      /**
       * Add default posts and comments RSS feed links to head
       */
      add_theme_support('automatic-feed-links');

      /**
       * Enable support for Post Thumbnails on posts and pages
       *
       * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
       */
      add_theme_support('post-thumbnails');

      /**
       * Enable support for Post Formats
       */
      add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

      /**
       * Make theme available for translation
       * Translations can be filed in the /languages/ directory
       */
      load_theme_textdomain('_makerspaces', THEME_DIR_PATH . '/languages');

      /**
       * This theme uses wp_nav_menu() in one location.
       */
      register_nav_menus(array(
          'primary' => __('Header menu', '_makerspaces'),
      ));
   }

endif; // _makerspaces_setup
add_action('after_setup_theme', '_makerspaces_setup');

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
   if (strpos($host, 'dev.') === 0) {
      $universal_asset_env = 'dev.make.co';
      $universal_asset_user = 'makecodev';
      $universal_asset_pass = '8f86ba87';
   }
   // stage environments
   else if (strpos($host, 'stage.') === 0) {
      $universal_asset_env = 'stage.make.co';
      $universal_asset_user = 'makecstage';
      $universal_asset_pass = 'c2792563';
   }
   // legacy staging environments
   else if (strpos($host, '.staging.wpengine.com') > -1) {
      $universal_asset_env = 'makeco.staging.wpengine.com';
      $universal_asset_user = 'makeco';
      $universal_asset_pass = 'memberships';
   }
   // local environments
   else if (strpos($host, ':8888') > -1) {
      $universal_asset_env = 'makeco:8888'; // this will require that we use `makeco` as our local
      $universal_asset_proto = 'http://';
   }
   // Set the important bits as CONSTANTS that can easily be used elsewhere
   define('UNIVERSAL_ASSET_URL_PREFIX', $universal_asset_proto . $universal_asset_env);
   define('UNIVERSAL_ASSET_USER', $universal_asset_user);
   define('UNIVERSAL_ASSET_PASS', $universal_asset_pass);
}

set_universal_asset_constants();

/* Login scripts */
/* redirect wp-login.php to the auth0 login page */

function load_auth0_js() {
   //auth0
   wp_enqueue_script('auth0', 'https://cdn.auth0.com/js/auth0/9.6.1/auth0.min.js', array(), false);
   wp_enqueue_script('auth0Login', get_stylesheet_directory_uri() . '/auth0/js/auth0login.js', array(), false);
}

add_action('login_enqueue_scripts', 'load_auth0_js', 10);

/**
 * Enqueue scripts and styles
 */
function _makerspaces_scripts() {
   $my_theme = wp_get_theme();
   $my_version = $my_theme->get('Version');
   // Load styles
   wp_enqueue_style('_makerspaces-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
   wp_enqueue_style('_makerspaces-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0');
   wp_enqueue_style('linearicons', 'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css', '', 'all');
   wp_enqueue_style('_makerspaces-font-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', array(), null, 'all');
   wp_enqueue_style('_makerspaces-font-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', array(), null, 'all');
   wp_enqueue_style('_makerspaces-fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css', array(), null, 'all');
   wp_enqueue_style('_makerspaces-style', THEME_DIR_URI . '/includes/css/style.min.css', array(), false, false);
   wp_enqueue_style('universal.css', UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/css/universal.min.css');

   // load scripts
   wp_enqueue_script('_makerspaces-bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'));
   wp_enqueue_script('_makerspaces-fancyboxjs', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js', array('jquery'), '', true);

   //auth0
   wp_enqueue_script('auth0', 'https://cdn.auth0.com/js/auth0/9.3.1/auth0.min.js', array(), false, true);
   wp_enqueue_script('_makerspaces-scripts', THEME_DIR_URI . '/includes/js/min/scripts.min.js', array('jquery'), $my_version, true);
   wp_enqueue_script('universal', UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/js/min/universal.min.js', array(), $my_version, true);
   // need to localize scripts to use the admin-ajax.php
   wp_localize_script('_makerspaces-scripts', 'ajax_object', array(
       'ajax_url' => admin_url('admin-ajax.php'),
       'home_url' => get_home_url(),
       'logout_nonce' => wp_create_nonce('ajax-logout-nonce'),
           )
   );

   // Map page only
   if (is_page_template('page-map-angular.php')) {
      
   }

   if (is_singular() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
   }

   // only load on the image attachment pages
   if (is_singular() && wp_attachment_is_image()) {
      wp_enqueue_script('_makerspaces-keyboard-image-navigation', THEME_DIR_URI . '/includes/js/min/keyboard-image-navigation.js', array('jquery'), '20120202');
   }
}

add_action('wp_enqueue_scripts', '_makerspaces_scripts');

/** Set up the Ajax Logout */
add_action('wp_ajax_mm_wplogout', 'MM_wordpress_logout');
add_action('wp_ajax_nopriv_mm_wplogout', 'MM_wordpress_logout');

function MM_wordpress_logout() {
   //check_ajax_referer( 'ajax-logout-nonce', 'ajaxsecurity' );
   wp_logout();
   ob_clean(); // probably overkill for this, but good habit
   wp_send_json_success();
}

add_action('wp_ajax_mm_wplogin', 'MM_WPlogin');
add_action('wp_ajax_nopriv_mm_wplogin', 'MM_WPlogin');

/** Set up the Ajax WP Login */
function MM_WPlogin() {
   //check_ajax_referer( 'ajax-login-nonce', 'ajaxsecurity' );
   global $wpdb; // access to the database
   //use auth0 plugin to log people into wp
   $a0_plugin = new WP_Auth0();
   $a0_options = WP_Auth0_Options::Instance();
   $users_repo = new WP_Auth0_UsersRepo($a0_options);
   $users_repo->init();

   $login_manager = new WP_Auth0_LoginManager($users_repo, $a0_options);
   $login_manager->init();

   //get the user information passed from auth0
   $userinput = filter_input_array(INPUT_POST);
   $userinfo = (object) $userinput['auth0_userProfile'];
   $userinfo->email_verified = true;
   $access_token = filter_input(INPUT_POST, 'auth0_access_token', FILTER_SANITIZE_STRING);
   $id_token = filter_input(INPUT_POST, 'auth0_id_token', FILTER_SANITIZE_STRING);

   if ($login_manager->login_user($userinfo, $id_token, $access_token)) {
      wp_send_json_success();
   } else {
      wp_send_json_error();
   }
}

// Making error logs for ajax to call
add_action('wp_ajax_make_error_log', 'make_error_log');
add_action('wp_ajax_nopriv_make_error_log', 'make_error_log');

/** Set up the Ajax WP Login */
function make_error_log() {
   $error = filter_input(INPUT_POST, 'make_error', FILTER_SANITIZE_STRING);
   error_log(print_r($error, TRUE));
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


// This code modifies what text is displayed to the users when there are no entries for them to edit
add_filter('gravityview/template/text/no_entries', 'modify_gravityview_no_entries_text', 10, 3);

/**
 * Modify the text displayed when there are no entries. (Requires GravityView 2.0 or newer)
 * @param string $existing_text The existing "No Entries" text
 * @param bool $is_search  Is the current page a search result, or just a multiple entries screen?
 * @param \GV\Template_Context $context The context.
 */
function modify_gravityview_no_entries_text($existing_text, $is_search = false, $context = null) {
   $return = $existing_text . "<br /><a href='/register'>Add a new Makerspace</a>";

   return $return;
}

// trigger an email to admin when an entry is updated via gravity view
add_action('gform_after_update_entry', 'update_entry', 10, 3);

function update_entry($form, $entry_id, $original_entry) {
   error_log('Entry ' . $entry_id . ' updated');
   //get updated entry
   $updatedEntry = GFAPI::get_entry(esc_attr($entry_id));
   $updates = array();

   foreach ($form['fields'] as $field) {
      //send notification after entry is updated in maker admin
      $input_id = $field->id;

      //if field type is checkbox we need to compare each of the inputs for changes
      $inputs = $field->get_entry_inputs();

      if (is_array($inputs)) {
         foreach ($inputs as $input) {
            $input_id = $input['id'];
            $origField = (isset($orig_entry[$input_id]) ? $orig_entry[$input_id] : '');
            $updatedField = (isset($updatedEntry[$input_id]) ? $updatedEntry[$input_id] : '');
            $fieldLabel = ($field['adminLabel'] != '' ? $field['adminLabel'] : $field['label']);
            if ($origField != $updatedField) {
               //update field id
               $updates[] = array(
                   'field_id' => $input_id,
                   'field_before' => $origField,
                   'field_after' => $updatedField,
                   'fieldLabel' => $fieldLabel);
            }
         }
      } else {
         $origField = (isset($orig_entry[$input_id]) ? $orig_entry[$input_id] : '');
         $updatedField = (isset($updatedEntry[$input_id]) ? $updatedEntry[$input_id] : '');
         $fieldLabel = ($field['adminLabel'] != '' ? $field['adminLabel'] : $field['label']);
         if ($origField != $updatedField) {
            //update field id
            $updates[] = array('field_id' => $input_id,
                'field_before' => $origField,
                'field_after' => $updatedField,
                'fieldLabel' => $fieldLabel);
         }
      }
   }

   //if there are changes to the record, send them to the admin
   if (!empty($updates)) {
      $current_user = wp_get_current_user();
      $message = 'Entry ' . $entry_id . ' was updated by ' . $current_user->user_email . '. The following changes were made:';

      // Build  table of changed items
      $message .= '<br/>'
               . '<table>'
               . ' <tr>'
               . '    <td>Field Id</td>'
               . '    <td>Field</td>'
               . '    <td>Before</td>'
               . '    <td>After</td>'
               . ' </tr>';

      //process updates
      foreach ($updates as $update) {
         $message .= '<tr><td>' . $update['field_id'] . '</td><td>' . $update['fieldLabel'] . '</td><td>' . $update['field_before'] . '</td><td>' . $update['field_after'] . '</td></tr>';
      }
      $message .= '</table>';

      $to = 'webmaster@makermedia.com';
      $subject = 'A makerspace has been updated';      
      wp_mail($to, $subject, $message);
   }
}
