<?php
/**
* @package OTEvent
*/

namespace Inc\Base;


class EventCPT
{
	
	public function register(){
		add_action( 'init', array( $this, 'registerCustomPostTypes' ) );
	}

	public function registerCustomPostTypes(){
	
		register_post_type( 'event',
			array(
				'labels' => array(
					'name' => 'Events',
					'singular_name' => 'Event'
				),
				'public' => true,
				'has_archive' => true,
				'supports' => array(
                  'title','editor','thumbnail'
	              ),
	           
	             'show_in_nav_menus' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
				'show_in_menu' =>false
			)
		);

	}
}