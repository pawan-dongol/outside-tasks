<?php
/**
* @package OTEvent
*/

namespace Inc;

final class Init
{
	
	/**
	* Store all the classes inside an array
	* @return array Full list of classes
	*/

	public static function get_services(){
		return [
			Pages\Admin::class,
			Base\Enqueue::class,
			 Base\SettingLinks::class,
			Base\EventCPT::class,
			 Base\TaxonomyEventType::class,
			Base\EventCustomField::class,
			Base\EventTypeWebinarLimit10ShortCode::class,
			Base\EventCustomApi::class,
			Base\EventSliderGutenbergBlock::class,
			Base\EventFilterShortCode::class,
		];
	}

	/**
	* Loop through the classes, initialize them,
	* and call the register() method if it exists
	* @return
	*/
	public static function register_services()
	{
		foreach ( self::get_services() as $class) {
			$service = self::instantiate ( $class );
			if( method_exists($service, 'register' ) ){
				$service->register();
			}
		}
	}

	/**
	* Initialize the class
	* @param class $class class from the services array
	* @return class instance new instance of the class
	*/

	private static function instantiate($class){
		
		$service = new $class();

		return $service;

	}
}