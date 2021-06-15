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


function template_call() {
	 $path = plugin_dir_path( dirname( __FILE__) );
    require_once( "$path/templates/ajaxfilter.php" );
    die();
}

add_action('wp_ajax_nopriv_template_call', 'template_call');
add_action('wp_ajax_template_call', 'template_call');

add_filter( 'render_block', 'wrap_table_block', 10, 2 );
function wrap_table_block( $block_content, $block ) {
  if ( 'event/slick-slider' === $block['blockName'] ) {
    $block_content = '<div class="example">' . $block_content . '</div>';
  }
  return $block_content;
}