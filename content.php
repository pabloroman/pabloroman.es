<?php
/**
 * @package Stijlfabriek
 */
?>



<article id="post-<?php the_ID(); ?>" class="post">
	
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta clearfix">
		<?php 
			if(function_exists('render_tnwsc_button')) {
				echo render_tnwsc_button();
			} 
		?>	
			<div class="toolbar-postmeta">
			<?php toolbox_posted_on(); ?>
			</div>
		</div><!-- .entry-meta -->
<?php /* 
		<div class="social-shares-wrapper">
			<div class="do-share sprite">Compartir</div>
			<?php toolbox_social_shares(); ?>
		</div>
*/ ?>
	</header><!-- .entry-header -->
	
	<?php if(!get_post_meta(get_the_ID(), 'hide_featured_image', true)) {
		the_post_thumbnail('main-thumb'); 
	} ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php if($source = get_post_meta(get_the_ID(), 'source', true)) { ?>
	<footer class="sources">
		<p>Fuente: <a href="<?php echo $source; ?>"><?php echo $source; ?></a></p>
	</footer>
	<?php } ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
