<?php
/**
 * Template Name: Angular Map
 *
 * @package _makerspaces
 */

get_header(); ?>
<div class="makerspaces-map-wrp" ng-app="makerSpacesApp" ng-strict-di>
  <div class="container">
    <div class="row map-header">
      <div class="col-xs-12 col-md-9 col-lg-9">
        <h1>Makerspaces represent the democratization of design, engineering, fabrication, and education.</h1>
        <h2>We put together a world-wide directory for Makers to connect:</h2>
      </div>
      <div class="col-xs-12 col-md-3 col-lg-3">
        <a href="/register" class="btn btn-info btn-block">ADD YOUR OWN MAKERSPACE! <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        <p>By adding your makerspace to this listing, you not only become part of our searchable database for Makers seeking like-minded people in their area but you also contribute to our study of the Makers Movement as a whole.</p>
      </div>
    </div>

    <div class="row">
      <?php echo do_shortcode( '[makemap form="2" searchtext="Find a MakerSpace"]' );?>

      <aside class="col-xs-12 col-md-3 col-lg-3">

        <div class="posts-feeds-wrapper">
          <?php
          $rss = fetch_feed('https://makezine.com/tag/makerspaces/feed/');
          if (!is_wp_error($rss)) :
            $maxitems = $rss -> get_item_quantity(5); //gets latest 5 items, this can be changed to suit your requirements
            $rss_items = $rss -> get_items(0, $maxitems);
          endif;

          //grabs our post thumbnail image
          function get_first_image_url($html) {
            if (preg_match('/<img.+?src="(.+?)"/', $html, $matches)) {
              return $matches[1];
            }
          }

          //shortens description
          function shorten($string, $length) {
            $suffix = '&hellip;';
            $short_desc = trim(str_replace(array("\r", "\n", "\t"), ' ', strip_tags($string)));
            $desc = trim(substr($short_desc, 0, $length));
            $lastchar = substr($desc, -1, 1);
            if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?')
            $suffix = '';
            $desc .= $suffix;
            return $desc;
          }
          ?>
          <h3 class="feed-title">
            <i class="fa fa-newspaper-o feed-icon"></i> Makerspace News
          </h3>
          <ul class="posts-feeds">
            <?php
            if ($maxitems == 0) echo '<li>No items.</li>';
            else foreach ( $rss_items as $item ) :
            ?>
            <li class="post-feed">
              <a class="full-link" href="<?php echo esc_url($item -> get_permalink()); ?>" target="_blank"></a>

              <div class="title">
                <img src="<?php echo get_first_image_url($item -> get_content()); ?>" alt="Makerspace post featured image">
                <p class="p-title"><?php echo esc_html($item -> get_title()); ?></p>
              </div>
            </li>
            <?php endforeach; ?>
            <a class="all-projects-title" href="http://makezine.com/tag/makerspaces/" target="_blank">See All News</a>
          </ul>
        </div>

        <div class="posts-feeds-wrapper">
          <?php
          $rss = fetch_feed('https://makezine.com/projects/feed/');
          if (!is_wp_error($rss)) :
            $maxitems = $rss -> get_item_quantity(5); //gets latest 5 items, this can be changed to suit your requirements
            $rss_items = $rss -> get_items(0, $maxitems);
          endif;

          //grabs our post thumbnail image
          function get_first_image_url_p($html) {
            if (preg_match('/<img.+?src="(.+?)"/', $html, $matches)) {
              return $matches[1];
            }
          }

          //shortens description
          function shorten_p($string, $length) {
            $suffix = '&hellip;';
            $short_desc = trim(str_replace(array("\r", "\n", "\t"), ' ', strip_tags($string)));
            $desc = trim(substr($short_desc, 0, $length));
            $lastchar = substr($desc, -1, 1);
            if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?')
            $suffix = '';
            $desc .= $suffix;
            return $desc;
          }
          ?>
          <h3 class="feed-title">
            <i class="fa fa-newspaper-o feed-icon"></i> Latest Projects
          </h3>
          <ul class="posts-feeds">
            <?php
            if ($maxitems == 0) echo '<li>No items.</li>';
            else foreach ( $rss_items as $item ) :
            ?>
            <li class="post-feed">
              <a class="full-link" href="<?php echo esc_url($item -> get_permalink()); ?>" target="_blank"></a>

              <div class="title">
                <img src="<?php echo get_first_image_url_p($item -> get_content()); ?>" alt="Makerspace post featured image">
                <p class="p-title"><?php echo esc_html($item -> get_title()); ?></p>
              </div>
            </li>
            <?php endforeach; ?>
            <a class="all-projects-title" href="http://makezine.com/tag/makerspaces/" target="_blank">See All Projects</a>
          </ul>
        </div>

      </aside>
    </div>
  </div>
</div>
<?php get_footer(); ?>

