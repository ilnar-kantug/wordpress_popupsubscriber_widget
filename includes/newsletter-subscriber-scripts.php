<?
	
//Add Scripts
function ns_add_scripts(){
		wp_enqueue_style('ns-main-style', plugins_url().'/subscriber_pop_up_form_wp/css/style.css');
		wp_enqueue_script('ns-main-script', plugins_url().'/subscriber_pop_up_form_wp/js/main.js');
	
}
	
add_action('wp_enqueue_scripts','ns_add_scripts');	
	
	
	
	