<?php

global $wp_query,

$post;

$atts = shortcode_atts( array(
    'slug' => '',
), $atts );

$loop = new WP_Query( array(
    'posts_per_page'    => 10,
    'post_type'         => 'event',
    'order'             => 'DESC',
    'orderBy'			=> 'date',
) );

if( ! $loop->have_posts() ) {
    return false;
}
?>
   <style>
	table, th, td {
	  border: 1px solid black;
	  padding: 10px;
	 width:100%;
	}
	</style>
	<?php $terms = get_terms(
		    array(
		        'taxonomy'   => 'event_type',
		        'hide_empty' => true,
		    )
		);?>

		<form id="eventform" method="get">

    		<label>Filter by Event type</label>
			<select name="type">
				<?php 
				if ( ! empty( $terms ) && is_array( $terms ) ) {
			    // add links for each category
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
				<option value="asc">Latest</option>
				<option value="asc">Oldest</option>
			</select>
			
    	</form>
    <table>
    	

    	<tr>
    		<th>Title</th>
        	
        	<th>Description</th>
        	<th>Location</th>
        	<th>Time</th>
        	<th>Start Date</th>
        	<th>End Date</th>
        	<th>Price</th>
    	</tr>
	   <?php
	    while( $loop->have_posts() ) {
	        $loop->the_post();
	      
	        $customfield = get_post_meta(get_the_ID(),'_event_customfield_meta',true);
	        ?>
	       	<tr>
	       		<td><?php the_title();?></td>
	       	
	       		<td><?php the_excerpt();?></td>

	       		<!-- Event Location -->
	       		<?php if(isset($customfield['event_location'])):?>
	       		<td><?php echo esc_html($customfield['event_location']);?></td>
	       		<?php else:?>
	       		<td></td>
	       		<?php endif;?>

	       		<!-- Event Time -->
	       		<?php if(isset($customfield['event_time'])):?>
	       		<td><?php echo esc_html($customfield['event_time']);?></td>
	       		<?php else:?>
	       		<td></td>
	       		<?php endif;?>

	       		<!-- Event Start Date -->
	       		<?php if(isset($customfield['event_start_date'])):?>
	       		<td><?php echo esc_html($customfield['event_start_date']);?></td>
	       		<?php else:?>
	       		<td></td>
	       		<?php endif;?>

	       		<!-- Event End Date -->
	       		<?php if(isset($customfield['event_end_date'])):?>
	       		<td><?php echo esc_html($customfield['event_end_date']);?></td>
	       		<?php else:?>
	       		<td></td>
	       		<?php endif;?>

	       		<!-- Price -->
	       		<?php if(isset($customfield['event_price'])):?>
	       		<td><?php echo esc_html($customfield['event_price']);?></td>
	       		<?php else:?>
	       		<td></td>
	       		<?php endif;?>
	       	</tr>      	
	       <?php
	    }?>
	</table>
<?php

wp_reset_postdata();