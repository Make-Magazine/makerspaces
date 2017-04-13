<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package _makerspaces
 */

get_header(); ?>

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

				<?php if ( have_posts() ) : ?>

					<header>
						<h2 class="page-title"><?php printf( __( 'Search Results for: %s', '_makerspaces' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					</header><!-- .page-header -->

					<?php // start the loop. ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>

					<?php _makerspaces_pagination(); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'search' ); ?>

				<?php endif; // end of loop. ?>

      </div>

    </div>

  </div>

<?php get_footer(); ?>