<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _makerspaces
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- TOP BRAND BAR -->
  <div class="hidden-xs top-header-bar-brand">
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 text-center">
          <p class="header-make-img"><a href="http://makezine.com/?utm_source=makercamp.com&utm_medium=brand+bar&utm_campaign=explore+all+of+make" target="_blank">Explore all of <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make_logo.png" alt="Make: Magazine Logo" /></a></p>
        </div>
      </div>
    </div>   
  </div>

  <!-- Header area -->
  <header id="site-header">
    <div class="container">
      <div class="row">

        <!-- LOGO & TAG LINE -->
        <div class="col-md-2 col-sm-3 logo-container">
          <a href="/">
            <img src="<?php echo get_template_directory_uri() . '/img/logo-makerspace.png' ?>" class="header-logo img-responsive" alt="Makerspaces logo" />
          </a>
        </div>

        <!-- MENUS -->
        <nav class="header-top-nav col-md-7 col-sm-9">
          <div class="row">
            <button type="button" class="menu-bar visible-xs-block navbar-toggle" data-target="#mc-menu" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <div id="mc-menu" class="collapse navbar-collapse">

              <!-- Main Menu -->
              <?php
                wp_nav_menu( array(
                  'menu'              => 'Header main menu',
                  'theme_location'    => 'primary_menu',
                  'depth'             => 1,
                  'container'         => 'div',
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker())
                );
              ?>

              <div class="mobile-subscribe-link hidden-sm hidden-md hidden-lg">
                <a href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M6GMKZ">SUBSCRIBE to Make: and save</a>
              </div>

            </div>

          </div>
        </nav>

        <!-- New Header Subscribe stuff -->
        <div id="mz-header-subscribe" class="hidden-xs">
          <div>
            <a id="trigger-overlay" href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M6GMKZ" target="_blank">
              <img src="<?php echo get_template_directory_uri() . '/img/Subscribe_CTA_2x.png'; ?>" alt="Make: Magazine latest magazine cover, subscribe here" />
            </a>
            <a class="subscribe-red-btn" href="https://readerservices.makezine.com/mk/default.aspx?pc=MK&pk=M6GMKZ" target="_blank">SUBSCRIBE</a>
          </div>
        </div>

      </div>
    </div>
  </header>

	<div class="main-content">

