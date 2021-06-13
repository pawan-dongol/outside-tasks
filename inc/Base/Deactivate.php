<?php
/**
* @package OTEvent
*/
namespace Inc\Base;

Class Deactivate
{
	public static function deactivate(){
		flush_rewrite_rules();
	}
}