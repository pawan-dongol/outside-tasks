<?php
/**
* @package OTEvent
*/

namespace Inc\Base;
use \Inc\Base\BaseController;

class EventCustomApi extends BaseController
{
	
	public function register(){
		add_action( 'rest_api_init', array( $this, 'custom_api_display_latest_event' ) );
	}

	public function custom_api_display_latest_event() {
	    register_rest_route( 'event/api/v1', '/latest-event', array(
	        'methods' =>'GET',
	        'callback' => array($this,'custom_api_display_latest_event_callback'),
	        'args'	=> array(),
	         'permission_callback' => function () {
			      return true;
			    }
	    ));
	}

	public function custom_api_display_latest_event_callback($request){


		// Initialize the array that will receive the posts' data. 
	    $posts_data = array();
	    // Receive and set the page parameter from the $request for pagination purposes
	    $paged = $request->get_param( 'page' );
	    $paged = ( isset( $paged ) || ! ( empty( $paged ) ) ) ? $paged : 1; 
	    // Get the posts using the 'post' and 'news' post types
	    $posts = get_posts( array(
	            'paged' => $paged,
	            'post__not_in' => get_option( 'sticky_posts' ),
	            'posts_per_page' => 10,            
	            'post_type' => array( 'event' ) // This is the line that allows to fetch multiple post types. 
	        )
	    ); 
	    // Loop through the posts and push the desired data to the array we've initialized earlier in the form of an object
	    foreach( $posts as $post ) {
	        $id = $post->ID; 
	        $post_thumbnail = ( has_post_thumbnail( $id ) ) ? get_the_post_thumbnail_url( $id ) : null;

	        $posts_data[] = (object) array( 
	            'id' => $id, 
	            'slug' => $post->post_name, 
	            'type' => $post->post_type,
	            'title' => $post->post_title,
	            'featured_img_src' => $post_thumbnail
	        );
	    }                  
	    return $posts_data;                 

	}

}