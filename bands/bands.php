<?php
/*
Plugin Name: bands
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: "Bands" will generate a band portfolio for your festival, your agency, your record label or your network.
Version: 0.1
Author: Markus Herhoffer
Author URI: http://d135-1r43.de
License: GPL2
*/

include 'template_tags.php';

//adds the taxonomies and custom page types
add_action('init', 'add_band_types');

//adds the meta boxes for custom fields
add_action('add_meta_boxes', 'add_meta_boxes');

// saves the custom fields
add_action('save_post', 'bands_save_members_meta', 1, 2); 

// add the JS we need in the admin menu
add_action('admin_print_scripts', 'add_admin_scripts');

// add the JS we need for the frontend
add_action('wp_print_scripts', 'add_admin_scripts');


global $bands_db_version;
$bands_db_version = "1.0";

function add_band_types () {
	// category taxonomy
	$labels = array(
	    'name' => _x( 'Event', 'Event' ),
	    'singular_name' => _x( 'Event', 'Event singular name' ),
	    'search_items' =>  __( 'Search Events' ),
	    'all_items' => __( 'All Events' ),
	    'parent_item' => __( 'Parent Event' ),
	    'parent_item_colon' => __( 'Parent Event:' ),
	    'edit_item' => __( 'Edit Event' ), 
	    'update_item' => __( 'Update Event' ),
	    'add_new_item' => __( 'Add New Event' ),
	    'new_item_name' => __( 'New Event Name' ),
	    'menu_name' => __( 'Events' ),
	  );
	
	register_taxonomy('event',array('bands'), array(
    	'hierarchical' => true,
    	'labels' => $labels,
    	'show_ui' => true,
    	'query_var' => true,
    	'rewrite' => array( 'slug' => 'event' ),
  	));

	// genre taxonomy
	$labels = array(
	    'name' => _x( 'Genres', 'taxonomy general name' ),
	    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Genres' ),
	    'all_items' => __( 'All Genres' ),
	    'parent_item' => __( 'Parent Genre' ),
	    'parent_item_colon' => __( 'Parent Genre:' ),
	    'edit_item' => __( 'Edit Genre' ), 
	    'update_item' => __( 'Update Genre' ),
	    'add_new_item' => __( 'Add New Genre' ),
	    'new_item_name' => __( 'New Genre Name' ),
	    'menu_name' => __( 'Genres' ),
	  ); 	

	  register_taxonomy('genre',array('bands'), array(
	    'hierarchical' => false,
	    'labels' => $labels,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'genre' ),
	  ));
	
	// country taxonomy
	$labels = array(
	    'name' => _x( 'Country', 'taxonomy general name' ),
	    'singular_name' => _x( 'Country', 'taxonomy singular name' ),
	    'search_items' =>  __( 'Search Countries' ),
	    'all_items' => __( 'All Countries' ),
	    'parent_item' => __( 'Parent Country' ),
	    'parent_item_colon' => __( 'Parent Country:' ),
	    'edit_item' => __( 'Edit Country' ), 
	    'update_item' => __( 'Update Country' ),
	    'add_new_item' => __( 'Add New Country' ),
	    'new_item_name' => __( 'New Country Name' ),
	    'menu_name' => __( 'Countries' ),
	  ); 	

	  register_taxonomy('country',array('bands'), array(
	    'hierarchical' => false,
	    'labels' => $labels,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'country' ),
	  ));

	// post type for bands
	$args = array(
		'labels' => array(
			'name' => __('Bands'),
	        'singular_name'	=> __('Band'),
	        'add_new'       => __('Add band'),
	        'add_new_item'  => __('Add band'),
	        'new_item'      => __('Add band'),
	        'view_item'     => __('View band'),
	        'search_items'  => __('Search band'),
	        'edit_item'     => __('Edit band'),
	        'all_items'     => __('All bands'),
	        'not_found'		=> __('No bands found'),
	        'not_found_in_trash'    => __('No bands found in Trash'), 
			'menu_name'		=> 'Bands'
	        ),
	 	'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
	 	'show_in_menu' => true,
	 	'menu_position'         => 20,
	 	'supports'=> array('title', 'editor'),
	    'rewrite' => array('slug' => 'bands'), 
		'taxonomies' => array('event'),
	);
	register_post_type('bands', $args);
}

function add_meta_boxes(){
	add_meta_box('bands_social_links', 'Social Links', 'social_links_html', 'bands', 'side');
	add_meta_box('bands_images', 'Images', 'images_html', 'bands', 'advanced');
	add_meta_box('bands_audio', 'Audio', 'audio_html', 'bands', 'advanced');
}

function social_links_html() {
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="bands_membersmeta_noncename" id="bands_membersmeta_noncename" value="' .
            wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

    // Get the location data if its already been entered
	$video_id = get_post_meta($post->ID, 'video_id', true);
    $twitter = get_post_meta($post->ID, 'twitter', true);
    $facebook = get_post_meta($post->ID, 'facebook', true);
    $flickr = get_post_meta($post->ID, 'flickr', true);
    $youtube = get_post_meta($post->ID, 'youtube', true);
    $myspace = get_post_meta($post->ID, 'myspace', true);

    // Echo out the field
	echo '<p>Music Video ID on YouTube</p>';
    echo '<input type="text" name="video_id" value="' . $video_id  . '" class="widefat" />';
    echo '<p>Twitter Username</p>';
    echo '<input type="text" name="twitter" value="' . $twitter  . '" class="widefat" />';
    echo '<p>FaceBook Username</p>';
    echo '<input type="text" name="facebook" value="' . $facebook  . '" class="widefat" />';
    echo '<p>Flickr Username</p>';
    echo '<input type="text" name="flickr" value="' . $flickr  . '" class="widefat" />';
    echo '<p>YouTube Username</p>';
    echo '<input type="text" name="youtube" value="' . $youtube  . '" class="widefat" />';
    echo '<p>MySpace Username</p>';
    echo '<input type="text" name="myspace" value="' . $myspace  . '" class="widefat" />'; 
}

function images_html(){
    global $post;

	$logo_img = get_post_meta($post->ID, 'logo_img', true);
	$pic_img = get_post_meta($post->ID, 'pic_img', true);
	
	echo '<p><label for="bands_upload_logo">Band Logo</label></p>';
	echo '<input id="bands_upload_logo" type="hidden" size="36" name="logo_img" value="' . $logo_img . '" />';
	echo '<button id="bands_upload_logo_button" class="button">Select Logo Image</button>';
	
	echo '<p><label for="bands_upload_pic">Band Picture</label></p>';
	echo '<input id="bands_upload_pic" type="hidden" size="36" name="pic_img" value="' . $pic_img . '" />';
	echo '<button id="bands_upload_pic_button" class="button">Select Logo Pic</button>';
}

function audio_html(){
    global $post;

	$audio_url = get_post_meta($post->ID, 'audio_url', true);
	$audio_title = get_post_meta($post->ID, 'audio_title', true);
	
	echo '<p id="bands_audio_track">No track uploaded</p>';
	echo '<p><label for="bands_upload_audio_title">Audio Track Title</label></p>';
	echo '<input id="bands_upload_audio_url" type="hidden" size="36" name="audio_url" value="' . $audio_url . '" />';
	echo '<input id="bands_upload_audio_title" type="text" size="36" name="audio_title" value="' . $audio_title . '" />';
	echo '<button id="bands_upload_audio_button" class="button">Select Audio Track</button>';
}

function player_html($id, $audio_url){
	echo '<div class="player">';
	echo '<p id="' . $id . '">Please install Flash player to play audio</p>';
	echo '<script type="text/javascript">';
	echo '	AudioPlayer.embed("' . $id . '", {soundFile: "' . $audio_url . '"});';  
	echo '</script>';
	echo '</div>';
}

function bands_save_members_meta($post_id, $post) {
 
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !wp_verify_nonce( $_POST['bands_membersmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
        }
 
        // Is the user allowed to edit the post or page?
        if ( !current_user_can( 'edit_post', $post->ID ))
                return $post->ID;
 
        // OK, we're authenticated: we need to find and save the data
        // We'll put it into an array to make it easier to loop though.
 
        $members_meta['video_id'] = $_POST['video_id'];
		$members_meta['twitter'] = $_POST['twitter'];
        $members_meta['facebook'] = $_POST['facebook'];
        $members_meta['flickr'] = $_POST['flickr'];
        $members_meta['youtube'] = $_POST['youtube'];
        $members_meta['myspace'] = $_POST['myspace'];
        $members_meta['pic_img'] = $_POST['pic_img'];
        $members_meta['logo_img'] = $_POST['logo_img'];
        $members_meta['audio_url'] = $_POST['audio_url'];
        $members_meta['audio_title'] = $_POST['audio_title'];
   
        // Add values of $members_meta as custom fields
 
        foreach ($members_meta as $key => $value) { // Cycle through the $members_meta array!
                if( $post->post_type == 'revision' ) return; // Don't store custom data twice
                $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
                if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                        update_post_meta($post->ID, $key, $value);
                } else { // If the custom field doesn't have a value
                        add_post_meta($post->ID, $key, $value);
                }
                if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
        } 
}

function add_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	
	wp_register_script('audio-player', WP_PLUGIN_URL.'/bands/player/audio-player.js', array('jquery'));
	wp_enqueue_script('audio-player');
	
	wp_register_script('audio-setup', WP_PLUGIN_URL.'/bands/audio-setup.js', array('audio-player'));
	wp_enqueue_script('audio-setup');
	
	wp_register_script('bands-uploader', WP_PLUGIN_URL.'/bands/bands-uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('bands-uploader');
}

function add_admin_styles() {
	wp_enqueue_style('thickbox');
}
?>