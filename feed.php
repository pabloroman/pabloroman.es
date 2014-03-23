<?php

/**
 * This file contains feed specific functions
 *
 * @author Andreas Creten (code review & cleanup)
 * 
 */
 
function rss_add_post_thumbnail($content = '') {
	global $post;
	
	if ( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail($post->ID, 'main_thumb', array('class' => ''));		
		$content = $image . '<br />' . $content;
	}
	return $content;
}

//add_filter('the_excerpt_rss', 'rss_add_post_thumbnail');
//add_filter('the_content',     'rss_add_post_thumbnail');



function rss_add_enclosure() {
    global $post;
    
    if( has_post_thumbnail() ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'main_thumb' );
		$url = $thumb['0']; 
		echo "<enclosure url=\"$url\" type=\"image/jpeg\" length=\"0\" />\n";   
    }
}
add_action('rss_item', 	'rss_add_enclosure');
add_action('rss2_item', 'rss_add_enclosure');