var destination;

jQuery(document).ready(function() {
	destination = "default";
	window.original_send_to_editor = window.send_to_editor;
	
	jQuery('#bands_upload_logo_button').click(function() {
		destination = "logo"
	 	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 	return false;
	});
	
	jQuery('#bands_upload_pic_button').click(function() {
		destination = "pic"
	 	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 	return false;
	});

	window.send_to_editor = function(html) {
		if (destination == "logo") {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#bands_upload_logo').val(imgurl);
 			tb_remove();
			destination == "default"
		} else if (destination == "pic") {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#bands_upload_pic').val(imgurl);
 			tb_remove();
			destination == "default"	
		} else {
			window.original_send_to_editor(html);
		}
	}	
});