
jQuery.fn.centerIt = function () {
	this.css("position","fixed");
	this.css("top", ((jQuery(window).height() - this.outerHeight()) / 2) + jQuery(window).scrollTop() + "px");
	this.css("left", ((jQuery(window).width() - this.outerWidth()) / 2) + jQuery(window).scrollLeft() + "px");
	return this;
}

function pop_up_subs_form_hide_order() {
	jQuery('#pop_up_subs_form_overlay').hide();
	jQuery('#pop_up_subs_form').hide();
}
// console.log(object_name);
setTimeout(function() {
	jQuery('#pop_up_subs_form_overlay').show();
	jQuery('#pop_up_subs_form').centerIt().show();
}, 2000);


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