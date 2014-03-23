<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>
		</div><!-- .wrapper --> 
	</div><!-- #content -->

	<footer id="colophon" class="clearfix">
		<div class="wrapper">
		
			<div class="clearfix">
			<section class="column half latest-posts">	
				<h3>Lo último en el blog</h3>
				<ul class="latest-posts">
				<?php $latest_posts = get_posts( array( 'numberposts' => 6 ) ); ?>
				<?php foreach( $latest_posts as $post ) { 
					setup_postdata( $post );
				?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php } ?>
				</ul>
			</section>
			
			<section class="column fourth footer-contact">
				<h3>Contacto</h3>
				<a href="http://twitter.com/pabloroman" rel="external"><i class="icon-twitter"></i>@pabloroman</a>
				<a href="mailto:hola@pabloroman.es" rel="external"><i class="icon-mail"></i>hola@pabloroman.es</a>
				<a href="http://www.linkedin.com/in/pabloroman85" rel="external"><i class="icon-linkedin"></i>pabloroman85</a>
				<a href="http://pabloroman.es/feed/" rel="external"><i class="icon-rss"></i>Feed RSS</a>
			</section>
			
			<section class="column fourth last footer-colophon">
				<h3>Colofón</h3>
				<p>Diseñado a mano en Almería y Amsterdam durante diciembre de 2012.</p>
				<p>Fuentes: <a href="http://www.google.com/fonts/specimen/Source+Sans+Pro" rel="external">Source Sans Pro</a> y <a href="https://www.google.com/fonts/specimen/Lora" rel="external">Lora</a></p>
				<p>Hospedado en <a href="http://www.linode.com/?r=abd423a4cf3567bb1a522be8dcdb4bf8f54eb6e1">Linode VPS</a>
			</section>
			
			</div>
			
			<p class="footer-license">El texto e imágenes creados por mí están publicados bajo licencia de Creative Commons <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.es_ES">Reconocimiento-NoComercial 3.0 Unported</a>.</p>	
		</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		$(".popup-link").click(function(e) {
			openPopup($(this).attr("href"));
			e.preventDefault();
			return false;
		});
	});
	
	var openPopup = function(url) {
		var width = 640;
		var height = 420; 
		var popupName = 'popup_' + width + 'x' + height;
		
		var left = (screen.width-width)/2;
		var top = ((screen.height-height)/2)+25;
		var params = 'width=' + width + ',height=' + height + ',location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,left=' + left + ',top=' + top;
		
		window[popupName] = window.open(url, popupName, params);
		
		if(window.focus) {
			window[popupName].focus();
		}
	}
	</script>
</body>
</html>