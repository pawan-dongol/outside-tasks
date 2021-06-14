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

		// $asset_file = include( $this->plugin_path . 'build/index.asset.php');

		wp_register_script(
		'event-block-slider-js', 
		$this->plugin_url . 'build/index.js', 
		array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data')
		);
		wp_register_style(
			'event-block-slider-style', 
			$this->plugin_url. 'assets/css/editor-block-slider.css', 
			['wp-edit-blocks']
		);
	 
		register_block_type('event/slick-slider', array(
			'editor_script' => 'event-block-slider-js',
			'style' => 'event-block-slider-style',
			'render_callback' => array($this, 'event_gutenberg_slider_render'),
		));
	}

	function event_gutenberg_slider_render($attributes, $content) {?>
		    <div class="slider-container">
		    	<?php echo  $content;?>
		    </div>
		<?php 
	}
}