<?php
function the_logo_url () {
	echo get_post_meta($post->ID, 'logo_img', true);
}
?>