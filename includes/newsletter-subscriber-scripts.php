<?
	
//Add Scripts
function ns_add_scripts(){
		wp_enqueue_style('ns-main-style', plugins_url().'/newsletter-subscriber/css/style.css');
		wp_enqueue_script('ns-main-script', plugins_url().'/newsletter-subscriber/js/main.js');
	
}
	
add_action('wp_enqueue_scripts','ns_add_scripts');	
	
	
	
	