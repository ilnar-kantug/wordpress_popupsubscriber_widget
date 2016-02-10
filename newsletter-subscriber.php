<?
/**
 * Plugin Name: My Pop Up Subscriber Form
 * Description: Just My Pop Up Subscriber Form
 * Version: 0.1
 * License: GPL2
 */ 
 
 //EXIT if Accessed Directly
if(!defined('ABSPATH')){
	exit;
}
 
//Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/newsletter-subscriber-scripts.php');
 
 //Load Class
 require_once(plugin_dir_path(__FILE__).'/includes/newsletter-subscriber-class.php');
 
 //Register Widget
 function register_newsletter_subscriber(){
	 register_widget('Newsletter_Subscriber_Widget');
}
 
add_action( 'widgets_init', 'register_newsletter_subscriber');
 