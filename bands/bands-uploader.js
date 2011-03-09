var target;

jQuery(document).ready(function() {
	audio_url = jQuery('#bands_upload_audio_url').val();
	if (audio_url != ""){
		title = jQuery('#bands_upload_audio_title').val();
		AudioPlayer.embed("bands_audio_track", {soundFile: audio_url, titles: title});  
	}
	
	jQuery('#media-buttons').hide();
	
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
	
	jQuery('#bands_upload_audio_button').click(function() {
		target = jQuery('#bands_upload_audio_url')
		tb_show('', 'media-upload.php?type=audio&amp;TB_iframe=true');
		return false;
	});
});

window.send_to_editor = function(html){
	console.log(html);
	if (jQuery(html).children().first().is('img')) {
		console.log("I am an img");
		fileurl = jQuery('img',html).attr('src');
		target.val(fileurl);
		jQuery('<p><img src="' + fileurl + '" alt="img" /></p>').insertBefore(target);
	} else {
		console.log("I am a mp3");
		fileurl = jQuery(html).attr('href');
		title = jQuery(html).html();
		jQuery('#bands_upload_audio_title').val(title);
		target.val(fileurl);
		AudioPlayer.embed("bands_audio_track", {soundFile: fileurl, titles: title});  
	}
	tb_remove();
};