<?
/**
 * Plugin Name: My Pop Up Subscriber Form
 * Description: Just My Pop Up Subscriber Form
 * Version: 0.1
 * License: GPL2
 * Text Domain: ns_domain
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

//function for activate localization////MUST BE WRITTEN AFTER add_action( 'widgets_init', 'register_newsletter_subscriber');
load_plugin_textdomain('ns_domain',false, basename(dirname(__FILE__)) . '/lang/');
 