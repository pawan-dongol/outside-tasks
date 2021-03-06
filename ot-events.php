<?php
/**
* @package OTEvent
*/

/**
 * Plugin Name: Outside Task Event
 * Plugin URI: http://pawandongol.com.np/
 * Description: Outside Task For Event Manager
 * Version: 1.0.0
 * Author: Pawan Dongol
 * Author URI: http://pawandongol.com.np/
 License: GPLv2 or later
 Text Domain: ot-event
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ){
	require_once dirname(__FILE__). '/vendor/autoload.php';
}

/**
* The code that runs during plugin actication
*/
function activate_ot_event_plugin(){
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_ot_event_plugin' );

/**
* The code that runs during plugin deactication
*/
function deactivate_ot_event_plugin(){
	Inc\Base\Deactivate::deactivate();	
}
register_deactivation_hook( __FILE__, 'deactivate_ot_event_plugin' );


/**
 * Initialize all the core classes of the plugin
 */
if( class_exists( 'Inc\\Init' ) ){
	Inc\Init::register_services();
}

add_action('wp_ajax_eventfilter', 'event_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_eventfilter', 'event_filter_function');

function event_filter_function(){
	$path = plugin_dir_path( __FILE__ );
	require_once( "$path/templates/ajaxfilter.php" );
	die();
}