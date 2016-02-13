<?
	
//Add Styles
add_action('wp_print_styles',wp_enqueue_style('ns-main-style', plugins_url().'/subscriber_pop_up_form_wp/css/style.css'));	
	
//Getting NS Widget Data from Database for adding it to the JS script	
$ns_widget_datas=get_option('widget_newsletter_subscriber_widget');	

//Getting NS Widget Field without knowing widgets Id in Database
foreach($ns_widget_datas as $ns_widget_data){
	if(is_array($ns_widget_data)){
		foreach($ns_widget_data as $key=>$ns_data){
			if($key == 'counter'){
				$ns_counter = $ns_data;
			}
		}
	}
}	
//Add Scripts
function ns_load_scripts() {
	global $ns_counter;
	wp_enqueue_script('ns-main-script', plugins_url().'/subscriber_pop_up_form_wp/js/main.js', array('jquery','ns-cookie-script'));
	//add jQuery cookie script
	wp_enqueue_script('ns-cookie-script', plugins_url().'/subscriber_pop_up_form_wp/js/jquery.cookie.js', array('jquery'));
	//in main.js we will have variable ns_script_vars.aaa and it will be equal to $ns_recipient
	wp_localize_script('ns-main-script', 'ns_script_vars', array(
			'ns_counter' => $ns_counter,
			'ns_sending_error' => __( 'Message Was Not Sent','ns_domain')
		) 
	);
 
}
add_action('wp_enqueue_scripts', 'ns_load_scripts');	

	