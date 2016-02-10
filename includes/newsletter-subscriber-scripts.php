<?
	
//Add Scripts
//wp_localize_script( 'ns-main-script', 'object_name', $instance['title'] );
add_action('wp_print_styles',wp_enqueue_style('ns-main-style', plugins_url().'/subscriber_pop_up_form_wp/css/style.css'));	
add_action('wp_enqueue_scripts',wp_enqueue_script('ns-main-script', plugins_url().'/subscriber_pop_up_form_wp/js/main.js', array('jquery')));	
	
	
	
	