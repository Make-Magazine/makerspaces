<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package _makerspaces
 */

get_header(); ?>

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

				<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
				<section class="content-padder error-404 not-found">

					<header>
						<h2 class="page-title"><?php _e( 'Oops! Something went wrong here.', '_makerspaces' ); ?></h2>
					</header><!-- .page-header -->

					<div class="page-content">

						<p><?php _e( 'Nothing could be found at this location. Maybe try a search?', '_makerspaces' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->

				</section><!-- .content-padder -->

      </div>

    </div>

  </div>

<?php get_footer(); ?>