<?php
/**
* @package OTEvent
*/

namespace Inc\Base;


class TaxonomyEventType
{
	
	public function register(){
		add_action( 'init', array( $this, 'addToxonomyEventType' ) );
	}

	public function addToxonomyEventType(){
		
		$labels = array(
		    'name' => _x( 'Event Types', 'Event Types' ),
		    'singular_name' => _x( 'Subject', 'Event Type' ),
		    'search_items' =>  __( 'Search Event Types' ),
		    'all_items' => __( 'All Event Types' ),
		    'parent_item' => __( 'Parent Event Type' ),
		    'parent_item_colon' => __( 'Parent Event Type:' ),
		    'edit_item' => __( 'Edit Event Type' ), 
		    'update_item' => __( 'Update Event Type' ),
		    'add_new_item' => __( 'Add New Event Type' ),
		    'new_item_name' => __( 'New Event Type Name' ),
		    'menu_name' => __( 'Event Types' ),
		  );    

		register_taxonomy( 'event_type',
				array('event'),
				array(
				'hierarchical' => true,
				'labels' => $labels,
				'public' => true,
				'has_archive' => true,
	            'show_in_nav_menus' => true, // Set to `false`, if users are not allowed to edit/delete existing posts,
	            'show_in_rest' => true,
				'show_in_menu' =>false
				)
				
			);
	}
}