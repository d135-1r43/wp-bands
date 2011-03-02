var target;

jQuery(document).ready(function() {
	//jQuery('#media-buttons').hide();
	
	jQuery('#bands_upload_logo_button').click(function() {
		target = jQuery('#bands_upload_logo')
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	
	jQuery('#bands_upload_pic_button').click(function() {
		target = jQuery('#bands_upload_pic')
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html){
		fileurl = jQuery('img',html).attr('src');
		target.val(fileurl);
		jQuery('<p><img src="' + fileurl + '" alt="img" /></p>').insertBefore(target);
		tb_remove();
	};
});