<?php
/**
* @package OTEvent
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

Class SettingLinks extends BaseController
{
	public function register()
	{
		add_filter ("plugin_action_links_$this->plugin", array( $this, 'setting_link' ) );
	}

	public function setting_link($links)
	{	
		$settings_link = '<a href="admin.php?page=ot_event">Settings</a>';
		array_push($links, $settings_link);
		return $links;
	}
}