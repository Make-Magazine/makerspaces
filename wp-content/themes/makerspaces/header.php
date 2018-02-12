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
  
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">
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
          <p class="header-make-img"><a href="https://makezine.com/?utm_source=spaces.makerspace.com/&utm_medium=brand+bar&utm_campaign=explore+all+of+make" target="_blank">Explore all of <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make_logo.png" alt="Make: Magazine Logo" /></a></p>
        </div>
      </div>
    </div>   
  </div>

  <!-- Header area -->
  <header id="site-header">
    <div class="container">
      <div class="row">

        <!-- LOGO & TAG LINE -->
        <div class="col-sm-7 col-md-8 col-lg-9 logo-container">
          <a href="/">
            <img src="<?php echo get_template_directory_uri() . '/img/Make_logo.svg' ?>" class="img-responsive" alt="Make: magazine logo" />
            <span>makerspaces</span>
          </a>

          <p class="hidden-xs">Stay in the loop with our newsletter</p>
        </div>
        <?php
          $isSecure = "http://";
          if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $isSecure = "https://";
          }
        ?>
        <!-- Newlsetter signup -->
        <div class="col-sm-5 col-md-4 col-lg-3 header-newsletter hidden-xs">
          <form class="whatcounts-signup form-inline sub-form" action="https://secure.whatcounts.com/bin/listctrl" method="POST">
            <input type="hidden" name="slid" value="6B5869DC547D3D467B33E192ADD9BE4B" /><!-- MakerPro -->
            <input type="hidden" name="cmd" value="subscribe" />
            <input type="hidden" name="custom_source" value="makerspace-header" />
            <input type="hidden" name="custom_incentive" value="none" />
            <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
            <input type="hidden" id="format_mime" name="format" value="mime" />
            <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
            <div id="recapcha-header" class="g-recaptcha" data-size="invisible"></div>
            <div class="form-group">
              <input name="email" type="email" class="form-control" required placeholder="YOUR EMAIL">
            </div>
            <input type="submit" value="SIGN UP" class="btn btn-lt-blue">
          </form>
        </div>

        <!-- MENUS -->
        <button type="button" class="visible-xs-block navbar-toggle" data-target="#menu-container" data-toggle="collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>
    </div>

    <div id="menu-container" class="collapse navbar-collapse">
      <div class="container">
        <?php
          wp_nav_menu( array(
            'menu'              => 'Header main menu',
            'theme_location'    => 'primary_menu',
            'depth'             => 1,
            'container'         => 'nav',
            'container_class'   => 'row',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
          );
        ?>
      </div>
    </div>
  </header>

	<div class="main-content">

