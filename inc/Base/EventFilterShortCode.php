<?php
/**
* @package OTEvent
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class EventFilterShortCode extends BaseController
{
	
	public function register(){
		add_shortcode( 'event-filter', array( $this, 'shortcode_event_filter' ) );
	}

	public function shortcode_event_filter($atts){

		ob_start();

		require_once( "$this->plugin_path/templates/event-filter-shortcode.php" );

		return ob_get_clean();
	}
}