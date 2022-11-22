/*Upload button single click*/	
	
function wpdevart_initial_upload(self){		
	event.preventDefault();		
	var image = wp.media({ 
		title: 'Upload Image',
		button: {
			text: 'Set Image'
		},			
		multiple: false,			
	}).open()
	.on('select', function(e){
		var uploaded_image = image.state().get('selection').first();
		var image_url = uploaded_image.toJSON().url;
		// Let's assign the url value to the input field
		jQuery(self).parent().find('.wpdevart_upload_input').val(image_url);
		jQuery(self).parent().find('.cont_button_uploaded_img').remove();
		jQuery(self).parent().append('<img src="'+image_url+'" class="cont_button_uploaded_img">');
	});	
}

