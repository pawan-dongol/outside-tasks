<?php
/**
* @package OTEvent
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class EventTypeWebinarLimit10ShortCode extends BaseController
{
	
	public function register(){
		add_shortcode( 'event', array( $this, 'shortcode_event_type' ) );
	}

	public function shortcode_event_type($atts){

		ob_start();

		require_once( "$this->plugin_path/templates/event-shortcode.php" );

		return ob_get_clean();
	}
}