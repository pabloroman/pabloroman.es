<article id="post-<?php the_ID(); ?>" class="loop-post">
	
	<?php
	printf( __( '<time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'toolbox' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	?>
	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<div class="excerpt"><?php echo the_excerpt(); ?></div>
		
</article>