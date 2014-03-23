<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
get_header(); ?>

	<div id="content">
		<div class="wrapper">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Error &dash; P&aacute;gina no encontrada', 'toolbox' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php sprintf( _e( 'La p&aacute;gina que est&aacute;s buscando no existe, o no est&aacute; disposable temporalmente. Busca desde el formulario, usa las etiquetas abajo para encontrar art&iacute;culos recientes o vuelve a la <a href="%1">p&aacute;gina principal</a>.', 'toolbox' ), home_url('/')); ?></p>
					<?php get_search_form(); ?>
					<br />
					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					

					<?php
					/* translators: %1$s: smilie */
					//$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'toolbox' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>