<?php
/**
 * Toolbox functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

// Remove all unnecesary functions
//remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'noindex', 1);

// remove WordPress version from RSS feeds
function no_generator() { return ''; }
add_filter('the_generator', 'no_generator');


add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video', 'quote' ) );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size('main_thumb', 638, 225, true);
	add_image_size('small_thumb', 120, 60, true);
}


if (!is_admin()) {
  wp_deregister_script('l10n');
  wp_deregister_style('style');
}

add_action('atom_head',  'init_feeds');
add_action('rdf_header', 'init_feeds');
add_action('rss_head',   'init_feeds');
add_action('rss2_head',  'init_feeds');
    
function init_feeds() {
    include 'feed.php';
}

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'toolbox' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'toolbox_widgets_init' );


add_filter( 'the_content', 'insert_featured_image', 20 );
function insert_featured_image( $content ) {
	global $post;
	$content = preg_replace( "/<\/p>/", "</p>" . get_the_post_thumbnail($post->ID, 'main_thumb'), $content, 1 );
    return $content;
}


/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Toolbox 1.2
 */
function toolbox_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav class="pagination clearfix" id="<?php echo $nav_id; ?>">
		
	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'toolbox' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'toolbox' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Artículos anteriores', 'toolbox' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Artículos posteriores <span class="meta-nav">&raquo;</span>', 'toolbox' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
// toolbox_content_nav


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own toolbox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Toolbox 0.4
 */
function toolbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'toolbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toolbox' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 42 ); ?>
					
					<div class="comment-meta">
						<h4 class="fn"><?php echo get_comment_author_link(); ?></h4>
						<span class="date"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php printf( __( '%1$s a las %2$s', 'toolbox' ), get_comment_date(), get_comment_time() ); ?></time></span>
						&nbsp;|&nbsp;
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">#</a>
						&nbsp;|&nbsp;
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'toolbox' ); ?></em>
					<br />
				<?php endif; ?>

			<div class="comment-content"><?php comment_text(); ?></div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}


/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own toolbox_posted_on to override in a child theme
 *
 * @since Toolbox 1.2
 */
function toolbox_posted_on() {

	printf( __( '<time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'toolbox' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', __( ' ', 'toolbox' ) );
	if ( $tags_list ) {
?>
		<span class="sep"> | </span>
		<span class="tag-links"><?php printf( __( '%1$s', 'toolbox' ), $tags_list ); ?></span>
<?php 
	}; // End if $tags_list
}



function toolbox_share_box() {

	global $post;
	
/*
	if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) { ?>
		<span class="comments-link"><span class="sep"> | </span><?php comments_popup_link( __( 'Deja un comentario', 'toolbox' ), __( '1 comentario', 'toolbox' ), __( '% comentarios', 'toolbox' ) ); ?></span>
	<?php }
*/
	
	//$tw_sc = get_post_meta($post->ID, 'tnwsc_twitter', true) ? get_post_meta($post->ID, 'tnwsc_twitter', true) : 0;
	$tw_link = "https://twitter.com/intent/tweet?text=".the_title_attribute( 'echo=0' )."&url=".get_permalink()."&via=pabloroman";
	//$fb_sc = get_post_meta($post->ID, 'tnwsc_facebook', true) ? get_post_meta($post->ID, 'tnwsc_facebook', true) : 0;
	$fb_link = "https://www.facebook.com/sharer/sharer.php?u=".get_permalink();
	//$li_sc = get_post_meta($post->ID, 'tnwsc_linkedin', true) ? get_post_meta($post->ID, 'tnwsc_linkedin', true) : 0;
	$li_link = "http://www.linkedin.com/shareArticle?mini=true&url=".get_permalink();
	//$go_sc = get_post_meta($post->ID, 'tnwsc_google', true) ? get_post_meta($post->ID, 'tnwsc_google', true) : 0;
	$go_link = "https://plus.google.com/share?url=".get_permalink();
?>
	<ul class="social-shares">
		<li><span>Comparte:&nbsp;</span></li>
		<li><a class="popup-link" href="<?php echo $go_link; ?>"><i class="icon-googleplus"></i></a></li>
		<li><a class="popup-link" href="<?php echo $tw_link; ?>"><i class="icon-twitter"></i></a></li>
		<li><a class="popup-link" href="<?php echo $li_link; ?>"><i class="icon-linkedin"></i></a></li>
		<li><a class="popup-link" href="<?php echo $fb_link; ?>"><i class="icon-facebook"></i></a></li>
	</ul>
<?php
}


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function toolbox_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'toolbox_enhanced_image_navigation' );


function stijlfabriek_pagination($pages = '', $range = 4) {

	global $paged;
	$showitems = ($range * 2)+1;
	if(empty($paged)) $paged = 1;
	
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	
	if(1 != $pages) {
		echo '<div class="loop-pagination clearfix">';
		echo '<span class="small">Archivo de art&iacute;culos:</span>';
		//if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>I</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&laquo; Hacia el principio</a>";
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>Hacia el final &raquo;</a>";
		echo "</div>";
	}
}   
/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */