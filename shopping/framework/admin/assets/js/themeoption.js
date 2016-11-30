;(function ($) {
	var $container = $('.wpo-themeoption-action');
	var $import = $container.find('.button-import');
	var $upload = $container.find('.upload');
	var $btupload = $upload.find('.button-upload');
	var $text = $upload.find('#import_option');


	$(document).ready(function() {

		$import.toggle(function() {
			$upload.show();
		}, function() {
			$upload.hide();
		});

		$btupload.click(function(){
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {
					action: 'wpo_themeoption_import',
					json: $text.val()
				},
				beforeSend: function(){
					$btupload.prop('disabled',true);
					$text.prop('disabled',true);
				},
				success: function(response){
					if(response){
						location.reload();
					}else{
						alert('This is not a valid JSON object');
					}
				}
			});
			return false;
		});


	});

})(jQuery)