<!-- Tour Gallery Section -->
<div class="tf-hero-gallery tf-mb-30 tf-template-section">
	<?php
		$tour_video = ! empty( $meta['tour_video'] ) ? $meta['tour_video'] : '';
		if ( !empty($tour_video) ) { ?>
		<div class="featured-column tf-video-box te-design__default">
			<a class="tf-tour-video" id="featured-video" data-fancybox="tour-video" href="<?php echo esc_url($tour_video); ?>">
				<i class="fa-solid fa-video"></i> <?php echo esc_html_e( "Video","travic" ); ?>
			</a>
		</div>
	<?php } ?>
    <?php if ( ! empty( $gallery_ids ) ) :?>
	<div class="te-gallery__carousel-two owl-carousel owl-theme owl-dots-none nav-style-one">
    
    	<?php 
			$gallery_count = 1;
			if ( ! empty( $gallery_ids ) ) {
			foreach ( $gallery_ids as $key => $gallery_item_id ) {
			$image_url = wp_get_attachment_url( $gallery_item_id, 'travic_315x400' );
		?>
		
		<div class="slide-item">
		
			<div class="gallery-img__holder">
				<a href="<?php echo esc_url($image_url); ?>" id="tour-gallery-<?php echo esc_attr( $key );?>" data-fancybox="tour-gallery">
                	<img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr_e( 'Awesome Image', 'travic' );?>">
                </a>
			</div>
		
		</div>
		
		<?php $gallery_count++; } } ?>
        
        
    
    </div>
    
    <?php else:?>
    
    <img src="<?php echo !empty(wp_get_attachment_url( get_post_thumbnail_id(), 'tf_gallery_thumb' )) ? esc_url( wp_get_attachment_url( get_post_thumbnail_id(), 'tf_gallery_thumb' ) ) : TF_ASSETS_APP_URL.'/images/feature-default.jpg'; ?>" alt="<?php esc_attr_e( 'Tour Image', 'travic' ); ?>">
    
    <?php endif;?>

</div>