<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _makerspaces
 */

get_header(); ?>

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php // _makerspaces_content_nav( 'nav-below' ); ?>
					<?php _makerspaces_pagination(); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

				<?php endwhile; // end of the loop. ?>

      </div>

    </div>

  </div>

<?php get_footer(); ?>