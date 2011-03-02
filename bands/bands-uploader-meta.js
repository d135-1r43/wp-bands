jQuery(function ($) {
    $('#bands_upload_logo_button').wpmediabox({"callback" : function (html) {
    	jQuery('#bands_upload_logo').val(html);
    }
});

(function (win, doc, $) {	
	$.fn.wpmediabox = function (options) {		
		var		
			$this = $(this),
			
			defaults = {
				"type" : "image",
				"post_id" : 0
			},
			
			opts = {},
			
			send_to_editor = (win.send_to_editor) ? win.send_to_editor : undefined
 		
		;
		
		opts = $.extend(defaults, options);
		
		$this.bind('click', function () {
			
			tb_show('', 'media-upload.php?post_id=' + opts.post_id + '&type=' + opts.type + '&TB_iframe=true');
			
			return false;
			
		});
		
		win.send_to_editor = function (html) {
			
			if (opts.callback) {
				
				opts.callback(html);
				
				tb_remove();
				
			} else {
				
				send_to_editor();
				
			}
			
		};
		
	}
	
}(window, document, jQuery, undefined));