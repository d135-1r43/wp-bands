<?php

$social_icon_size = "48";

function get_icon ($media) {
	global $social_icon_size;
	$plugin_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	return $plugin_path . 'assets/social.me/'. $social_icon_size . '/' . $media . '.png';
}

function the_logo_url () {
	global $post;
	echo get_post_meta($post->ID, 'logo_img', true);
}

function the_genres () {
	global $post;
	echo the_terms($post->ID, 'genre', '', ', ', ' ' );
}

function the_country () {
	global $post;
	echo the_terms($post->ID, 'country', '', ', ', ' ' );
}

function the_band_image_url () {
	global $post;
	echo get_post_meta($post->ID, 'pic_img', true);
}

function the_myspace_link () {
	global $post;
	if (get_post_meta($post->ID, 'myspace', true)){
		$myspace_url = "http://myspace.com/" . get_post_meta($post->ID, 'myspace', true);
		echo '<a href="' . $myspace_url . '">';
		echo '	<img src="'.get_icon("myspace").'" alt="MySpace" />';
		echo '</a>';
	}
}

function the_facebook_link () {
	global $post;
	if (get_post_meta($post->ID, 'facebook', true)){
		$myspace_url = "http://facebook.com/" . get_post_meta($post->ID, 'facebook', true);
		echo '<a href="' . $myspace_url . '">';
		echo '	<img src="'.get_icon("facebook").'" alt="Facebook" />';
		echo '</a>';
	}
}

function the_audio_player () {
	global $post;
	if (get_post_meta($post->ID, 'audio_url', true)) {
		$audio_url = get_post_meta($post->ID, 'audio_url', true);
		$audio_title = get_post_meta($post->ID, 'audio_title', true);
		echo '<div class="player">';
		echo '	<p id="audio-sample">Please install Flash player to play audio</p>';
		echo '	<script type="text/javascript">';
		echo '		AudioPlayer.embed("audio-sample", {soundFile: "' . $audio_url . '", titles:"' . $audio_title . '"});';  
		echo '	</script>';
		echo '</div>';
	}
}

function the_audio_title () {
	global $post;
	echo get_post_meta($post->ID, 'audio_title', true);
}
?>