<article id="post-<?php the_ID(); ?>" class="loop-post">
	<header class="entry-header">
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta clearfix">
			<div class="toolbar-postmeta">
			<?php toolbox_posted_on(); ?>
			</div>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->
	
	<div class="excerpt"><?php echo the_excerpt(); ?></div>
</article>