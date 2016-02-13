
jQuery.fn.centerIt = function () {
	var w = jQuery(window);
    this.css("position","fixed");
    this.css("top",(w.height()-this.height())/2 + "px");
    this.css("left",(w.width()-this.width())/2 + "px");
    return this;
}

function pop_up_subs_form_hide_order() {
	jQuery('#pop_up_subs_form_overlay').hide();
	jQuery('#pop_up_subs_form_wrapper').hide();
}

if( jQuery.cookie('pop_up_subs_form_cookie') != 'doNotShow'){
	
	//if came for the very first time
	if( ! jQuery.cookie('pop_up_subs_form_cookie')){
		jQuery.cookie("pop_up_subs_form_cookie", "1", { expires: 300});
	}
	//counter for how many times pop up will be shown if visiter will not subscribe( 5 times )
	if(Number(jQuery.cookie('pop_up_subs_form_cookie')) < Number(ns_script_vars.ns_counter)){
		var increaseCookie = Number(jQuery.cookie('pop_up_subs_form_cookie')) + 1;
		jQuery.cookie("pop_up_subs_form_cookie", increaseCookie , { expires: 300});
	//after that pop up will stops showing	
	}else{
		jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
	}
	
	
	setTimeout(function() {
		jQuery('#pop_up_subs_form_overlay').show();
		jQuery('#pop_up_subs_form_wrapper').centerIt().show();
	}, 3000);
	
	jQuery(document).ready(function(){
		
		jQuery('#ns-close').click(function(){
			pop_up_subs_form_hide_order();
		});
			
		// JS ajax submiting the form
		jQuery('#subscriber-form').submit(function(e){
			e.preventDefault();
				
			var nsre = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
			var nsemail = jQuery('#ns-email').val();
			if (nsre.test(nsemail)) {
		
			jQuery('.ns-email-error').hide();
			//serialize form
			var subscriberData = jQuery('#subscriber-form').serialize();
			
			//Submit Form
			jQuery.ajax({
				type: 'post',
				url: jQuery('#subscriber-form').attr('action'),
				data: subscriberData,
				beforeSend:function () { 
					jQuery('#ns-submit').attr('disabled','disabled');
				}
			}).done(function(response){
				//If Success
				jQuery('#form-msg').removeClass('ns-error');
				jQuery('#form-msg').addClass('ns-success');
				//Set Message Text
				jQuery('#subscriber-form').replaceWith('<span class="ns-success">'+response+'</span>');
				
				//clear fields
				jQuery('#name').val('');
				jQuery('#email').val('');
				//if visiter passed subscribtion pop up will stops showing
				jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
				jQuery('#ns-submit').removeAttr('disabled');
			}).fail(function(data){
				//If Error
				jQuery('#form-msg').removeClass('ns-success');
				jQuery('#form-msg').addClass('ns-error');
				if(data.responseText !== ''){
					//Set Message Text
					jQuery('#form-msg').text(data.responseText);
				}else{
					jQuery('#form-msg').text(ns_script_vars.ns_sending_error);
				}
			});
			
			} else {
				jQuery('.ns-email-error').show();
			}
			
		});
	});
}
