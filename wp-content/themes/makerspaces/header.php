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
  <!-- Global Site Tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-51157-26"></script>
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-51157-26');
   </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<!-- Header area -->
	<header id="universal-nav" class="universal-nav">

		<?php // Nav Level 1 and Hamburger
         $context = null;
         if(UNIVERSAL_ASSET_USER && UNIVERSAL_ASSET_PASS) {
            $context = stream_context_create(array(
                  'http' => array(
                     'header'  => "Authorization: Basic " . base64_encode(UNIVERSAL_ASSET_USER.':'.UNIVERSAL_ASSET_PASS)
                  )
            ));
         }
         echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-topnav.html', false, $context);
		?>

	  <div id="nav-level-2" class="nav-level-2">
		 <div class="container">
			  <div class="nav-2-banner">
			  <?php
				 wp_nav_menu( array(
					  'menu'              => 'secondary_universal_menu',
					  'theme_location'    => 'secondary_universal_menu',
					  'depth'             => 1,
					  'container'         => '',
					  'container_class'   => '',
					  'link_before'       => '<span>',
					  'link_after'        => '</span>',
					  'menu_class'        => 'nav navbar-nav',
					  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					  'walker'            => new wp_bootstrap_navwalker())
				 );
			  ?>
			  </div>
		 </div>
	  </div><!-- .nav-level-2 -->
	  <!--<div class="container search-container">
		 <ul class="search-button">
			  <li>
				 <div id="sb-search" class="sb-search">
					<i class="fa fa-search" aria-hidden="true"></i>
				 </div>
			  </li>
		 </ul>
	  </div>-->


	  <div id="nav-flyout">
         <?php
            echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-megamenu.html', false, $context);
         ?>
	  </div>

	</header>
	<div class="nav-flyout-underlay"></div>

    <!-- <div id="menu-container" class="collapse navbar-collapse">
      <div class="container">
        <?php
          /*wp_nav_menu( array(
            'menu'              => 'Header main menu',
            'theme_location'    => 'primary_menu',
            'depth'             => 1,
            'container'         => 'nav',
            'container_class'   => 'row',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
          );*/
        ?>
      </div>
    </div> -->


	<div class="main-content">

