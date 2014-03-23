<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
	
	<div id="header">
		<div class="wrapper">
			<h1>Blog</h1>
		</div>
	</div>
	<div id="content">
		<div class="wrapper">
<?php 
	global $query_string;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$post_per_page = 10;
	$args = array(
		'orderby' => 'date',
	  	'order' => 'DESC',
	  	'paged' => $paged,
	  	'posts_per_page' => $post_per_page,
	);
	
	$wp_query = new WP_Query($args); 
	 
	if ( have_posts() ) {
	 	while ( $wp_query->have_posts() ) { 
	 		$wp_query->the_post(); 
?>	
		<div class="row">
		<?php get_template_part( 'loop', get_post_format() ); ?>
		</div>
		<?php
		}
	}  
?>
	
	<?php stijlfabriek_pagination(); ?>

<?php get_footer(); ?>