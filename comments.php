<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to toolbox_comment() which is
 * located in the functions.php file.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'toolbox' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php
		// If comments are closed and there are no comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'toolbox' ); ?></p>
	<?php endif; ?>

	<?php comment_form('comment_notes_after='); ?>
	
	
	<?php if ( have_comments() ) : ?>
		<h3 id="comments-title">
			<?php
				printf( _n( 'Un comentario', '%1$s comentarios', get_comments_number(), 'toolbox' ), number_format_i18n( get_comments_number() ) );
			?>
		</h3>


		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use toolbox_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define toolbox_comment() and that will be used instead.
				 * See toolbox_comment() in toolbox/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'toolbox_comment' ) );
			?>
		</ol>

	<?php endif; // have_comments() ?>

</div><!-- #comments -->
