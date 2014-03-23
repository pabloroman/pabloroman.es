<?php
/**
 * @package Stijlfabriek
 */
?>

		
<article id="post-<?php the_ID(); ?>" class="post">
	

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php if( $source = get_post_meta( get_the_ID(), 'source', true ) ) { ?>
	<footer class="sources">
		<p>Visto en: <a href="<?php echo $source; ?>"><?php echo $source; ?></a></p>
	</footer>
	<?php } ?>
	
	
	<?php 
		$next_post = get_adjacent_post();
		if( is_object( $next_post ) ) {
		?>
			<h4 class="next-post">Lee ahora: <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?> &raquo;</a></h4> 
	<?php
		}

?>

		<div class="entry-meta clearfix">
			<div class="posted-on"><?php toolbox_posted_on(); ?></div>
			<div class="share-box"><?php toolbox_share_box(); ?></div>
		</div><!-- .entry-meta -->
		
</article><!-- #post-<?php the_ID(); ?> -->
