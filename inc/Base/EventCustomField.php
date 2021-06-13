<?php
/**
* @package OTEvent
*/

namespace Inc\Base;


class EventCustomField
{
	
	public function register(){

		add_action( 'add_meta_boxes', array($this, '_event_customfield_meta_create_metabox' ) );

		add_action( 'save_post', array($this,'_event_customfield_meta_save_metabox'), 1, 2 );

		add_action( 'save_post', array($this, '_event_customfield_meta_save_revisions' ) );

		add_action( 'wp_restore_post_revision', array( $this, '_event_customfield_meta_restore_revisions'), 10, 2 );

		add_filter( '_wp_post_revision_fields', array( $this, '_event_customfield_meta_get_revisions_fields' ) );

		add_filter( '_wp_post_revision_field_my_meta', array( $this,'_event_customfield_meta_display_revisions_fields') , 10, 2 );
	}

	public function _event_customfield_meta_create_metabox() {
	    add_meta_box(
	        '_event_customfield_meta_metabox', // Metabox ID
	        'Event Custom Field', // Title to display
	        array($this,'_event_customfield_meta_render_metabox'), // Function to call that contains the metabox content
	        'event', // Post type to display metabox on
	        'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
	        'high'// Priority relative to other metaboxes
	    );
	}


	/**
	 * Create the metabox default values
	 * This allows us to save multiple values in an array, reducing the size of our database.
	 * Setting defaults helps avoid "array key doesn't exit" issues.
	 * @todo
	 */
	function _event_customfield_meta_metabox_defaults() {
	    return array(
	        'event_location'=>'',
	        'event_time'=>'',
	        'event_start_date' => '',
	        'event_end_date' => '',
	        'event_price' => '',
	    );
	}

	/**
	 * Render the metabox markup
	 * This is the function called in `_event_customfield_meta_create_metabox()`
	*/

	function _event_customfield_meta_render_metabox($post) {
	    $saved = get_post_meta( $post->ID, '_event_customfield_meta', true ); // Get the saved values
	    $defaults = $this->_event_customfield_meta_metabox_defaults(); // Get the default values
	    $details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
    ?>

    <table class="table">

        <tr>
            <td>Event Location</td>
            <td>
                <input type="text" class="large-text" name="_event_customfield_meta_custom_metabox[event_location]" id="_event_location" value="<?php echo esc_attr( $details['event_location'] ); ?>">
            </td>
        </tr>

        <tr>
            <td>Event Time</td>
            <td>
                <input type="text" class="large-text" name="_event_customfield_meta_custom_metabox[event_time]" id="_event_time" value="<?php echo esc_attr( $details['event_time'] ); ?>" placeholder="10:10 AM">
            </td>
        </tr>

        <tr>
            <td>Event Start Date</td>
            <td>
                <input type="text" class="large-text" name="_event_customfield_meta_custom_metabox[event_start_date]" id="_event_start_date" value="<?php echo esc_attr( $details['event_start_date'] ); ?>" placeholder="dd/mm/yyyy">
            </td>
        </tr>

        <tr>
            <td>Event End Date</td>
            <td>
                <input type="text" class="large-text" name="_event_customfield_meta_custom_metabox[event_end_date]" id="_event_end_date" value="<?php echo esc_attr( $details['event_end_date'] ); ?>" placeholder="dd/mm/yyyy">
            </td>
        </tr>

        <tr>
            <td>Event Price</td>
            <td>
                <input type="text" class="large-text" name="_event_customfield_meta_custom_metabox[event_price]" id="_event_price" value="<?php echo esc_attr( $details['event_price'] ); ?>">
            </td>
        </tr>

       
    </table>
    <?php

    wp_nonce_field( '_event_customfield_meta_form_metabox_nonce', '_event_customfield_meta_form_metabox_process' );
	}

	//
	// Save our data
	//
	/**
	 * Save the metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function _event_customfield_meta_save_metabox( $post_id, $post ) {
	    // Verify that our security field exists. If not, bail.
	    if ( !isset( $_POST['_event_customfield_meta_form_metabox_process'] ) ) return;
	    // Verify data came from edit/dashboard screen
	    if ( !wp_verify_nonce( $_POST['_event_customfield_meta_form_metabox_process'], '_event_customfield_meta_form_metabox_nonce' ) ) {
	        return $post->ID;
	    }
	    // Verify user has permission to edit post
	    if ( !current_user_can( 'edit_post', $post->ID )) {
	        return $post->ID;
	    }
	    // Check that our custom fields are being passed along
	    // This is the `name` value array. We can grab all
	    // of the fields and their values at once.
	    if ( !isset( $_POST['_event_customfield_meta_custom_metabox'] ) ) {
	        return $post->ID;
	    }
	    /**
	     * Sanitize all data
	     * This keeps malicious code out of our database.
	     */
	    // Set up an empty array
	    $sanitized = array();
	    // Loop through each of our fields
	    foreach ( $_POST['_event_customfield_meta_custom_metabox'] as $key => $detail ) {
	        // Sanitize the data and push it to our new array
	        // `wp_filter_post_kses` strips our dangerous server values
	        // and allows through anything you can include a post.
	        $sanitized[$key] = wp_filter_post_kses( $detail );
	    }
	    // Save our submissions to the database
	    update_post_meta( $post->ID, '_event_customfield_meta', $sanitized );
	}

	//
	// Save a copy to our revision history
	// This is optional, and potentially undesireable for certain data types.
	// Restoring a a post to an old version will also update the metabox.
	/**
	 * Save additional_infos data to revisions
	 * @param  Number $post_id The post ID
	 */
	function _event_customfield_meta_save_revisions( $post_id ) {
	    // Check if it's a revision
	    $parent_id = wp_is_post_revision( $post_id );
	    // If is revision
	    if ( $parent_id ) {
	        // Get the saved data
	        $parent = get_post( $parent_id );
	        $details = get_post_meta( $parent->ID, '_event_customfield_meta', true );
	        // If data exists and is an array, add to revision
	        if ( !empty( $details ) && is_array( $details ) ) {
	            // Get the defaults
	            $defaults = _event_customfield_meta_metabox_defaults();
	            // For each default item
	            foreach ( $defaults as $key => $value ) {
	                // If there's a saved value for the field, save it to the version history
	                if ( array_key_exists( $key, $details ) ) {
	                    add_metadata( 'post', $post_id, '_event_customfield_meta_' . $key, $details[$key] );
	                }
	            }
	        }
	    }
	}

	/**
	 * Restore additional_infos data with post revisions
	 * @param  Number $post_id     The post ID
	 * @param  Number $revision_id The revision ID
	 */
	function _event_customfield_meta_restore_revisions( $post_id, $revision_id ) {
	    // Variables
	    $post = get_post( $post_id ); // The post
	    $revision = get_post( $revision_id ); // The revision
	    $defaults = _event_customfield_meta_metabox_defaults(); // The default values
	    $details = array(); // An empty array for our new metadata values
	    // Update content
	    // For each field
	    foreach ( $defaults as $key => $value ) {
	        // Get the revision history version
	        $detail_revision = get_metadata( 'post', $revision->ID, '_event_customfield_meta_' . $key, true );
	        // If a historic version exists, add it to our new data
	        if ( isset( $detail_revision ) ) {
	            $details[$key] = $detail_revision;
	        }
	    }
	    // Replace our saved data with the old version
	    update_post_meta( $post_id, '_event_customfield_meta', $details );
	}

	/**
	 * Get the data to display on the revisions page
	 * @param  Array $fields The fields
	 * @return Array The fields
	 */
	function _event_customfield_meta_get_revisions_fields( $fields ) {
	    // Get our default values
	    $defaults = _event_customfield_meta_metabox_defaults();
	    // For each field, use the key as the title
	    foreach ( $defaults as $key => $value ) {
	        $fields['_event_customfield_meta_' . $key] = ucfirst( $key );
	    }
	    return $fields;
	}

	/**
	 * Display the data on the revisions page
	 * @param  String|Array $value The field value
	 * @param  Array        $field The field
	 */
	function _event_customfield_meta_display_revisions_fields( $value, $field ) {
	    global $revision;
	    return get_metadata( 'post', $revision->ID, $field, true );
	}
}