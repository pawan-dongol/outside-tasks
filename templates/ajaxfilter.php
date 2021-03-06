<?php

global $wp_query,

$post;

if(isset($_POST['type'])){
  $loop = new WP_Query( array(
    'posts_per_page'    => 10,
    'post_type'         => 'event',
    'order'             => 'DESC',
    'orderBy'     => 'date',
    'tax_query'         => array( array(
        'taxonomy'  => 'event_type',
        'field'     => 'slug',
        'terms'     => array( sanitize_title( $_POST['type'] ) )
    ) )
  ) );
}
elseif (isset($_POST['type']) && isset($_POST['date'])) {
  $loop = new WP_Query( array(
    'posts_per_page'    => 10,
    'post_type'         => 'event',
    'order'             => $_POST['date'],
    'orderBy'           => 'date',
    'tax_query'         => array( array(
        'taxonomy'  => 'event_type',
        'field'     => 'slug',
        'terms'     => array( sanitize_title( $_POST['type'] ) )
    ) )
  ) );
}
else{
   $loop = new WP_Query( array(
    'posts_per_page'    => 10,
    'post_type'         => 'event',
    'order'             => 'DESC',
    'orderBy'           => 'date',
   
  ) );
}


if( ! $loop->have_posts() ) {
    return false;
}
?>
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
        if(isset($_POST['type'])){
          $type = get_term_by('slug',$_POST['type'],'event_type');  
        }
        else{
          $termT = get_the_terms( get_the_ID(), 'event_type');
          $type = get_term_by('slug',$termT[0]->slug,'event_type');
        }
        
        $customfield = get_post_meta(get_the_ID(),'_event_customfield_meta',true);
        ?>
        <tr>
          <td><?php the_title();?></td>
          <td><?php echo esc_html($type->name);?></td>
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