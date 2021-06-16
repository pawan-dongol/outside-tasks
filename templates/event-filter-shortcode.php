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

	<table>
		<tr>
		<th>Title</th>
		  <th>Event Type</th>
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
		 
		   $termT = get_the_terms( get_the_ID(), 'event_type');

		   if(isset($termT[0]->slug)){

		   	$type = get_term_by('slug',$termT[0]->slug,'event_type');	

		   }
		   else{
		   	$type = null;
		   }
		   
		  $customfield = get_post_meta(get_the_ID(),'_event_customfield_meta',true);
		  ?>
		  <tr>
		    <td><?php the_title();?></td>
		    <td><?php echo esc_html($type->name ?? '');?></td>
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
	<?php wp_reset_postdata();?>
</div>