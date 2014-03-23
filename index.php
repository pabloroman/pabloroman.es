<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>
	
	<?php if( is_category() || is_tag() ) { ?>
	<div id="header">
		<div class="wrapper">
			<h1>
				<?php
					if( is_category() ) {		
						printf( __( 'Art&iacute;culos en la categor&iacute;a %s', 'toolbox' ), '<strong>' . single_tag_title( '', false ) . '</strong>' );
					} else if( is_tag() ) {
					printf( __( 'Art&iacute;culos con el tag: %s', 'toolbox' ), '<strong>' . single_cat_title( '', false ) . '</strong>' );
					}
				?>
			</h1>
		</div>
	</div>
<?php } ?>
	
	<div id="content" class="clearfix">
		<div class="wrapper">
		
	<?php if ( have_posts() ) : ?>	
				
		<?php /* Start the Loop */ ?>
		<?php 	
			$i = 1;
			while ( have_posts() ) {
				the_post();
				?>
				<div class="row">
				<?php get_template_part( 'loop', get_post_format() ); ?>
				</div>
				<?php
			}  ?>
		
		<?php stijlfabriek_pagination(); ?>

		
	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'toolbox' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

<?php get_footer(); ?>