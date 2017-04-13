<?php
/**
 * Template Name: Directory Map
 *
 * @package _makerspaces
 */

get_header(); ?>

  <div class="ms-map">

    <!-- Map -->
    <div id="map-wrapper">
      <div id="map-canvas"></div>
    </div>

  </div>

  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="<?php echo get_template_directory_uri() ?>/includes/js/min/map2.js"></script>

<?php get_footer(); ?>
