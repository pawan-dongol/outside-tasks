<?php

	global $wp_query;

	$loop = new WP_Query( array(
		'posts_per_page'    => 10,
		'post_type'         => 'event',
		'order'             => 'DESC',
		'orderBy'           => 'date',
	) );

	if( ! $loop->have_posts() ) {
	    return false;
	}
?>
<?php $terms = get_terms(
	array(
	    'taxonomy'   => 'event_type',
	    'hide_empty' => true,
	));
?>

<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

	<label>Filter by Event type</label>
	<select name="type">
		<option value="">Select Event Type</option>
		<?php 
		if ( ! empty( $terms ) && is_array( $terms ) ) {
			foreach ( $terms as $term ) { ?>
			    	<option value="<?php echo esc_attr($term->slug);?>">
			            <?php echo esc_html($term->name); ?>
			         </option>
			        <?php
			    }
			}
		?>
	</select>
	<label>Filter by Date</label>
	<select name="date">
		<option value="">Select Filter</option>
		<option value="DESC">Latest</option>
		<option value="ASC">Oldest</option>
	</select>
	<input type="hidden" name="action" value="eventfilter">
</form>
<div id="response">
	<?php
		include('filter-table.php'); 
		wp_reset_postdata();
	?>
</div>