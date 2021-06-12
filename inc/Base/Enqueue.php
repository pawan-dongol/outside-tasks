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
		add_action( 'admin_enqueue_scripts', array ($this, 'enqueue') );
	}

	public function enqueue(){
		// enqueue all scripts
		wp_enqueue_style( 'oteventstyle', $this->plugin_url.'assets/mystyle.css' );
		wp_enqueue_script( 'oteventscript', $this->plugin_url.'assets/myscripts.js');
	}
}