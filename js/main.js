
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
console.log(ns_script_vars.aaa);

// if(ns_script_vars.useCookie){
	
// }



if( jQuery.cookie('pop_up_subs_form_cookie') != 'doNotShow'){
	console.log('cookie is NOT set');
	
	//if came for the very first time
	if( ! jQuery.cookie('pop_up_subs_form_cookie')){
		jQuery.cookie("pop_up_subs_form_cookie", "1", { expires: 300});
		console.log(jQuery.cookie('pop_up_subs_form_cookie'));
	}
	//counter for how many times pop up will be shown if visiter will not subscribe( 5 times )
	
	if(jQuery.cookie('pop_up_subs_form_cookie') < 555){
		var increaseCookie = Number(jQuery.cookie('pop_up_subs_form_cookie')) + 1;
		jQuery.cookie("pop_up_subs_form_cookie", increaseCookie , { expires: 300});
		console.log(jQuery.cookie('pop_up_subs_form_cookie'));
	//after that pop up will stops showing	
	}else{
		//jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
		console.log(jQuery.cookie('pop_up_subs_form_cookie'));
	}
	
	
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
				//if visiter passed subscribtion pop up will stops showing
				//jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
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
	
	
	
}





