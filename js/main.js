
jQuery.fn.centerIt = function () {
	this.css("position","fixed");
	this.css("top", ((jQuery(window).height() - this.outerHeight()) / 2) + jQuery(window).scrollTop() + "px");
	this.css("left", ((jQuery(window).width() - this.outerWidth()) / 2) + jQuery(window).scrollLeft() + "px");
	return this;
}

function pop_up_subs_form_hide_order() {
	jQuery('#pop_up_subs_form_overlay').hide();
	jQuery('#pop_up_subs_form_wrapper').hide();
}
//console.log(ns_script_vars);



if( jQuery.cookie('pop_up_subs_form_cookie') != 'doNotShow'){
	
	//if came for the very first time
	if( ! jQuery.cookie('pop_up_subs_form_cookie')){
		jQuery.cookie("pop_up_subs_form_cookie", "1", { expires: 300});
		console.log(jQuery.cookie('pop_up_subs_form_cookie'));
	}
	//counter for how many times pop up will be shown if visiter will not subscribe( 5 times )
	if(Number(jQuery.cookie('pop_up_subs_form_cookie')) < Number(ns_script_vars.ns_counter)){
		console.log(jQuery.cookie('pop_up_subs_form_cookie') +' < '+ns_script_vars.ns_counter);
		var increaseCookie = Number(jQuery.cookie('pop_up_subs_form_cookie')) + 1;
		jQuery.cookie("pop_up_subs_form_cookie", increaseCookie , { expires: 300});
	//after that pop up will stops showing	
	}else{
		jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
		console.log('doNotShow!!!!!!!!');
	}
	
	
	setTimeout(function() {
		jQuery('#pop_up_subs_form_overlay').show();
		jQuery('#pop_up_subs_form_wrapper').centerIt().show();
	}, 1000);


	
	
	jQuery(document).ready(function(){
	
		// --start-- JS validation Email input --start-- 
		var nsre = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
		jQuery('#ns-email').blur(function () {
			var nsemail = jQuery(this).val();
			if (nsre.test(nsemail)) {
				jQuery('.ns-email-error').hide();
				jQuery('#ns-submit').removeAttr('disabled');
			} else {
				jQuery('.ns-email-error').show();
				jQuery('#ns-submit').attr('disabled','disabled');
				
			}

		});
		jQuery('#ns-email').keypress(function () {
			var nsemail = jQuery(this).val();
			if (nsre.test(nsemail) && jQuery('#ns-submit').attr('disabled') == 'disabled') {
				jQuery('.ns-email-error').hide();
				jQuery('#ns-submit').removeAttr('disabled');
			}
		});
		// --end-- JS validation Email input --end-- 
		
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
				jQuery('#form-msg').removeClass('ns-error');
				jQuery('#form-msg').addClass('ns-success');
				//Set Message Text
				jQuery('#form-msg').text(response);
				
				//clear fields
				jQuery('#name').val('');
				jQuery('#email').val('');
				//if visiter passed subscribtion pop up will stops showing
				jQuery.cookie("pop_up_subs_form_cookie", "doNotShow", { expires: 300});
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
		});
		
	});
	
	
	
}





