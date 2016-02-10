jQuery(document).ready(function(){
	jQuery('#subscriber-form').submit(function(e){
		e.preventDefault();
		
		//serialize form
		var subscriberData = jQuery('#subscriber-form').serialize();
		
		//Submit Form
		jQuery.ajax({
			type: 'post',
			url: jQuery('#subscriber-form').attr('action'),
			data: subscriberData
		}).done(function(response){
			//If Success
			jQuery('#form-msg').removeClass('error');
			jQuery('#form-msg').addClass('success');
			//Set Message Text
			jQuery('#form-msg').text(response);
			
			//clear fields
			jQuery('#name').val('');
			jQuery('#email').val('');
		}).fail(function(data){
			//If Error
			jQuery('#form-msg').removeClass('success');
			jQuery('#form-msg').addClass('error');
			if(data.responseText !== ''){
				//Set Message Text
				jQuery('#form-msg').text(data.responseText);
			}else{
				jQuery('#form-msg').text('Message Was Not Sent');
			}
		});
	});
	
});