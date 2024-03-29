<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */


get_header('tourfic');
$data    = \TRAVIC\Includes\Classes\Common::instance()->data( 'archive' )->get();
do_action( 'travic_banner', $data );

$meta = get_post_meta( get_the_ID(),'tf_tours_opt',true );
$pricing_rule = !empty($meta['pricing']) ? $meta['pricing'] : null;
$tour_type = !empty($meta['type']) ? $meta['type'] : null;
if( $pricing_rule == 'group'){
	$price = !empty($meta['group_price']) ? $meta['group_price'] : null;
}else{
	$price = !empty($meta['adult_price']) ? $meta['adult_price'] : null;
}
$discount_type = !empty($meta['discount_type']) ? $meta['discount_type'] : null;
$discounted_price = !empty($meta['discount_price']) ? $meta['discount_price'] : NULL;
if( $discount_type == 'percent' ){
	$sale_price = number_format( $price - (( $price / 100 ) * $discounted_price) ,1 ); 
}elseif( $discount_type == 'fixed'){
	$sale_price = number_format( ( $price - $discounted_price ),1 );
}


$tf_expired_tour_showing = ! empty( tfopt( 't-show-expire-tour' ) ) ? tfopt( 't-show-expire-tour' ) : '';
if(!empty($tf_expired_tour_showing )){
	$tf_tour_posts_status = array('publish','expired');
}else{
	$tf_tour_posts_status = array('publish');
}

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$args = array(
    'post_type' => "tf_tours",
    'orderby'   => 'date',
    'order'     => 'DESC',
    'post_status'    => $tf_tour_posts_status,
	'paged'          => $paged,
);
$loop = new WP_Query( $args );
$total_posts = $loop->found_posts;
$tf_total_results = 0;

$tf_plugin_installed = get_option('tourfic_template_installed'); 
if (!empty($tf_plugin_installed)) {
	$tf_tour_arc_selected_template = ! empty( tf_data_types(tfopt( 'tf-template' ))['tour-archive'] ) ?  tf_data_types(tfopt( 'tf-template' ))['tour-archive'] : 'design-1';
}else{
	$tf_tour_arc_selected_template = ! empty( tf_data_types(tfopt( 'tf-template' ))['tour-archive'] ) ?  tf_data_types(tfopt( 'tf-template' ))['tour-archive'] : 'default';
}

if( $tf_tour_arc_selected_template=="design-1"){
	include get_template_directory() . '/tourfic/tour/archive/design-1.php';
}else{
	include get_template_directory() . '/tourfic/tour/archive/design-default.php';
}

?>

<?php
get_footer('tourfic');