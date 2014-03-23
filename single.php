<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div id="content">
		<div class="wrapper">
		
	<?php get_template_part( 'content', 'single' ); ?>
		
		<div class="comments">
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template( '', true );
		?>
		</div>

<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>