<?php
/**
* @package OTEvent
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * 
 */
class Enqueue extends BaseController 
{
	
	public function register(){
		add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );
	}

	public function enqueue(){
		// enqueue all scripts
		wp_enqueue_style( 'slick', $this->plugin_url.'assets/slick.css' );
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-1.12.4.js');
		wp_enqueue_script( 'slick', $this->plugin_url.'assets/slick.js',array(), '20181214', true);
		wp_enqueue_script( 'custom', $this->plugin_url.'assets/custom.js',array(), '20181214', true);
		wp_enqueue_script( 'ajax-stuff', $this->plugin_url . 'assets/ajaxfilter.js', array( 'jquery' ), true,true );
		wp_localize_script( 'ajax-stuff', 'ajaxStuff', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_style( 'ot-events-style', $this->plugin_url.'assets/css/my-style.css' );
	}
}