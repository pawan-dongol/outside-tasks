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