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
		// add_action( 'admin_enqueue_scripts', array ($this, 'enqueue') );
	}

	public function enqueue(){
		// enqueue all scripts
		wp_enqueue_style( 'slick', $this->plugin_url.'assets/slick.css' );
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-1.12.4.js');
		wp_enqueue_script( 'slick', $this->plugin_url.'assets/slick.js',array(), '20181214', true);
		wp_enqueue_script( 'custom', $this->plugin_url.'assets/custom.js',array(), '20181214', true);
	}
}