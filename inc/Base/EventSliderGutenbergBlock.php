<?php
/**
* @package OTEvent
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class EventSliderGutenbergBlock extends BaseController
{
	
	public function register(){
		add_action( 'init', array( $this, 'event_slider_block' ) );
	}

	public function event_slider_block(){

		wp_register_script(
		'event-block-slider-js', 
		$this->plugin_url . 'assets/js/block-slider.js', 
		['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data']
		);
		wp_register_style(
			'event-block-slider-style', 
			$this->plugin_url. 'assets/css/editor-block-slider.css', 
			['wp-edit-blocks']
		);
	 
		register_block_type('event/slider', [
			'editor_script' => 'event-block-slider-js',
			'style' => 'event-block-slider-style',
			'render_callback' => array($this, 'event_gutenberg_slider_render'),
		]);
	}

	function event_gutenberg_slider_render($attributes, $content) {
		return 'Slider render comes here.';
	}
}