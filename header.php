<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title(''); ?></title>
	
	<link href='http://fonts.googleapis.com/css?family=Lora|PT+Sans:400,700|Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="all" />
<?php if(is_page('cv')) { ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(). '/resume.css'.'?' . filemtime( get_stylesheet_directory() . '/resume.css'); ?>" type="text/css" media="all" />
<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'blogname' ); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->

<?php wp_head(); ?>

	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-8049835-8']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
<?php 
/*	<script src="<?php echo get_template_directory_uri(). '/assets/js/nice.js'. '?' . filemtime( get_template_directory() . '/assets/js/nice.js' ); ?>"></script>*/ 
?>
</head>

<body <?php body_class(); ?>>

	<header class="site-header">
		<div class="wrapper clearfix">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><strong>Pablo Rom&aacute;n</strong>&nbsp;&nbsp;|&nbsp;&nbsp;Dise&ntilde;o y desarrollo web</a>
			<nav>
				<ul>
					<li><a href="/blog/">Blog</a></li>
					<li><a href="/cv/">CV</a></li>
				</ul>
			</nav>
		</div>
	</header>
		
