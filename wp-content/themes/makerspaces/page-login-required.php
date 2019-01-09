<?php
/**
 * Template Name: Login Required
 */
if (!is_user_logged_in())
    auth_redirect();
get_header(); ?>

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

      	<?php while ( have_posts() ) : the_post(); ?>

      		<?php get_template_part( 'content', 'page' ); ?>

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
