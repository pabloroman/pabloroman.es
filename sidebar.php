<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
 global $post;
 
 $original_post = $post;
?>

	<div id="secondary" role="complementary">

		<h3>&Uacute;ltimos art&iacute;culos</h3>
		<ul>
		<?php $latest_posts = get_posts( array( 'numberposts' => 8 ) ); ?>
		<?php foreach( $latest_posts as $post ) { 
			setup_postdata( $post );
		?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		<?php } ?>
		</ul>

	</div><!-- #secondary .widget-area -->

<?php
	$post = $original_post;
?>