<?php
/**
* @package OTEvent
*/

namespace Inc\Pages;
use \Inc\Base\BaseController;

Class Admin extends BaseController
{
	public function register(){

		add_action( 'admin_menu', array($this, 'add_admin_pages') );
	}

	public function add_admin_pages(){

		add_menu_page( 'Outside Task Event','Outside Task Event','manage_options','ot_event',array($this,'admin_index'),'dashicons-calendar',10);

		add_submenu_page(
		    'ot_event', // Parent slug
		    'Events', // Page title
		    'Events', // Menu title
		    'manage_options', // Capability
		    'edit.php?post_type=event',  // Slug
		    false // Function
		);

		add_submenu_page(
		    'ot_event', // Parent slug
		    'Event Types', // Page title
		    'Event Types', // Menu title
		    'manage_options', // Capability
		    'edit-tags.php?taxonomy=event_type&post_type=event',  // Slug
		    false // Function
		);

	}

	public function admin_index(){
		require_once $this->plugin_path . 'templates/admin.php';
	}
}