<?php

global $wp_query,

$post;

$atts = shortcode_atts( array(
    'type' => '',
    'limit' => ''
), $atts );

$loop = new WP_Query( array(
    'posts_per_page'    => absint($atts['limit']),
    'post_type'         => 'event',
    'order'             => 'DESC',
    'orderBy'			=> 'date',
    'tax_query'         => array( array(
        'taxonomy'  => 'event_type',
        'field'     => 'slug',
        'terms'     => array( sanitize_title( $atts['type'] ) )
    ) )
) );

if( ! $loop->have_posts() ) {
    return false;
}
include('event-table.php');
?>
<?php

wp_reset_postdata();