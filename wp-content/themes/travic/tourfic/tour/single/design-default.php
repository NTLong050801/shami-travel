<?php
$tf_booking_type = '1';
$tf_booking_url = $tf_booking_query_url = $tf_booking_attribute = $tf_hide_booking_form = $tf_hide_price = '';
if ( function_exists( 'is_tf_pro' ) && is_tf_pro() ) {
	$tf_booking_type      = ! empty( $meta['booking-by'] ) ? $meta['booking-by'] : 1;
	$tf_booking_url       = ! empty( $meta['booking-url'] ) ? esc_url( $meta['booking-url'] ) : '';
	$tf_booking_query_url = ! empty( $meta['booking-query'] ) ? $meta['booking-query'] : 'adult={adult}&child={child}&infant={infant}';
	$tf_booking_attribute = ! empty( $meta['booking-attribute'] ) ? $meta['booking-attribute'] : '';
	$tf_hide_booking_form = ! empty( $meta['hide_booking_form'] ) ? $meta['hide_booking_form'] : '';
	$tf_hide_price        = ! empty( $meta['hide_price'] ) ? $meta['hide_price'] : '';
}
if( 2==$tf_booking_type && !empty($tf_booking_url) ){
	$external_search_info = array(
		'{adult}'    => !empty($adults) ? $adults : 1,
		'{child}'    => !empty($children) ? $children : 0,
		'{infant}'     => !empty($infant) ? $infant : 0,
		'{booking_date}' => !empty($tour_date) ? $tour_date : '',
	);
	if(!empty($tf_booking_attribute)){
		$tf_booking_query_url = str_replace(array_keys($external_search_info), array_values($external_search_info), $tf_booking_query_url);
		if( !empty($tf_booking_query_url) ){
			$tf_booking_url = $tf_booking_url.'/?'.$tf_booking_query_url;
		}
	}
}
?>

<div class="tour-details pt_120 pb_120">
	
    <div class="upper-box pb_30 m-0">
        <div class="row clearfix">
            <?php include get_template_directory() . '/tourfic/tour/single/parts/gallery-two.php';?>
        </div>
    </div>
    
	<div class="auto-container">
    
        <div class="tour-details-content">
        
        	<div class="row">
            
            	<div class="col-lg-8 col-md-12 col-sm-12 content-side">
                
                	<div class="content-box">
                    
                    	<div class="title-box mb_35">
                            <div class="d-flex justify-content-between tour-details-content-title__box">
                                <?php include get_template_directory() . '/tourfic/tour/single/parts/hero_title.php';?>
                                <?php include get_template_directory() . '/tourfic/tour/single/parts/price.php';?>
                            </div>
                        </div>
                        
                        <!--Tab Start-->
                        <div class="tabs-box tabs-box-tour__detail">
                            
                            <div class="tab-btn-box p_relative pb_20">
                                <ul class="tab-btns tab-buttons clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1"><?php esc_html_e( 'Overview', 'travic' );?></li>
                                    <li class="tab-btn" data-tab="#tab-2"><?php esc_html_e( 'Tour Plan', 'travic' );?></li>
                                    <li class="tab-btn" data-tab="#tab-3"><?php esc_html_e( 'Faqs', 'travic' );?></li>
                                    <li class="tab-btn" data-tab="#tab-4"><?php esc_html_e( 'Review', 'travic' );?></li>
                                </ul>
                            </div>
                            
                            <div class="tabs-content">
                            
                            	<div class="tab active-tab" id="tab-1">
                                
                                	<div class="overview-inner">
                                    	<?php include get_template_directory() . '/tourfic/tour/single/parts/description.php';?>
										<?php include get_template_directory() . '/tourfic/tour/single/parts/include-exclude.php';?>
                                        <?php include get_template_directory() . '/tourfic/tour/single/parts/highlights.php';?>
                                    </div>
                                
                                </div>
                                
                                <div class="tab" id="tab-2">
                                	<?php include get_template_directory() . '/tourfic/tour/single/parts/itinerary.php';?>
                                    <?php include get_template_directory() . '/tourfic/tour/single/parts/map.php';?>
                                </div>
                                
                                <div class="tab" id="tab-3">
                                	<?php include get_template_directory() . '/tourfic/tour/single/parts/faq.php';?>
                            		<?php include get_template_directory() . '/tourfic/tour/single/parts/trams-condition.php';?>
                                </div>
                                
                                <div class="tab" id="tab-4">
                                	<?php include get_template_directory() . '/tourfic/tour/single/parts/review.php';?>
                                </div>
                            
                            </div>
                            
                    	</div>
                        <!--Tab End-->
                    </div>
                
                </div>
                
                <!--Sidebar Content Start-->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                
                    <div class="tf-column tf-tour-details-right tour-sidebar-two ml_20">
                        <div class="tf-tour-booking-box tf-box">
                            <?php
                            $hide_price = !empty( tfopt( 't-hide-start-price' ) ) ? tfopt( 't-hide-start-price' ) : '';
                            if ( ( $tf_booking_type == 2 && $tf_hide_price !== '1' ) || $tf_booking_type == 1 || $tf_booking_type == 3 ) :
                                if ( isset( $hide_price ) && $hide_price !== '1' ) : ?>
                                    <!-- Tourfic Pricing Head -->
                                    <div class="tf-booking-form-data">
                                        <div class="tf-booking-block">
                                            <div class="tf-booking-price tf-padbtm-12">
                                            <?php
                                            $tour_price = [];
                                            $tf_pricing_rule = ! empty( $meta['pricing'] ) ? $meta['pricing'] : '';
                                            $tour_single_price_settings = !empty(tfopt('tour_archive_price_minimum_settings')) ? tfopt('tour_archive_price_minimum_settings') : 'all';
    
                                            $custom_pricing_by_rule = !empty( $meta['custom_pricing_by'] ) ? $meta['custom_pricing_by'] : '';
                                            if( $tf_pricing_rule  && $tf_pricing_rule == 'group' ){
    
                                                if ( !empty($meta['type'] ) && $meta['type'] === 'continuous' ) {
                                                    $custom_availability = !empty($meta['custom_avail']) ? $meta['custom_avail'] : false;
                                                    if ($custom_availability) {
                                                        if(is_array($meta['cont_custom_date'])) {
                                                            foreach ( $meta['cont_custom_date'] as $repval ) {
    
                                                            if( $custom_pricing_by_rule  && $custom_pricing_by_rule == 'group' ){
                                                                if(! empty( $repval['group_price'] )){
                                                                    $tour_price[] = $repval['group_price'];
                                                                }
                                                            }
                                                            if( $custom_pricing_by_rule  && $custom_pricing_by_rule == 'person' ){
                                                                if($tour_single_price_settings == "all") {
                                                                    if(!empty($repval['adult_price']) && !$disable_adult){
                                                                        $tour_price[] = $repval['adult_price'];
                                                                    }
                                                                    if(!empty($repval['child_price']) && !$disable_child){
                                                                        $tour_price[] = $repval['child_price'];
                                                                    }
                                                                }
                                                                if($tour_single_price_settings == 'adult') {
                                                                    if(!empty($repval['adult_price']) && !$disable_adult){
                                                                        $tour_price[] = $repval['adult_price'];
                                                                    }
                                                                }
                                                                if($tour_single_price_settings == 'child') {
                                                                    if(!empty($repval['child_price']) && !$disable_child){
                                                                        $tour_price[] = $repval['child_price'];
                                                                    }
                                                                }
                                                            }
    
                                                        }
                                                        }
                                                        
                                                    }else{
                                                        if(!empty($meta['group_price'])){
                                                            $tour_price[] = $meta['group_price'];
                                                        }
                                                    }
                                                }
    
                                            }
                                            if( $tf_pricing_rule  && $tf_pricing_rule == 'person' ){
    
                                                if ( !empty($meta['type'] ) && $meta['type'] === 'continuous' ) {
                                                    $custom_availability = !empty($meta['custom_avail']) ? $meta['custom_avail'] : false;
                                                    if ($custom_availability) {
                                                        foreach ( $meta['cont_custom_date'] as $repval ) {
    
                                                            if( $custom_pricing_by_rule  && $custom_pricing_by_rule == 'group' ){
                                                                if(! empty( $repval['group_price'] )){
                                                                    $tour_price[] = $repval['group_price'];
                                                                }
                                                            }
                                                            if( $custom_pricing_by_rule  && $custom_pricing_by_rule == 'person' ){
                                                                if($tour_single_price_settings == "all") {
                                                                    if(!empty($repval['adult_price']) && !$disable_adult){
                                                                        $tour_price[] = $repval['adult_price'];
                                                                    }
                                                                    if(!empty($repval['child_price']) && !$disable_child){
                                                                        $tour_price[] = $repval['child_price'];
                                                                    }
                                                                }
                                                                if($tour_single_price_settings == "adult") {
                                                                    if(!empty($repval['adult_price']) && !$disable_adult){
                                                                        $tour_price[] = $repval['adult_price'];
                                                                    }
                                                                }
                                                                if($tour_single_price_settings == "child") {
                                                                    if(!empty($repval['child_price']) && !$disable_adult){
                                                                        $tour_price[] = $repval['child_price'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        if($tour_single_price_settings == 'all') {
                                                            if(!empty($meta['adult_price']) && !$disable_adult){
                                                                $tour_price[] = $meta['adult_price'];
                                                            }
                                                            if(!empty($meta['child_price']) && !$disable_child){
                                                                $tour_price[] = $meta['child_price'];
                                                            }
                                                        }
                                                        if($tour_single_price_settings == "adult") {
                                                            if(!empty($meta['adult_price']) && !$disable_adult){
                                                                $tour_price[] = $meta['adult_price'];
                                                            }
                                                        }
                                                        if($tour_single_price_settings == "child") {
                                                            if(!empty($meta['child_price']) && !$disable_adult){
                                                                $tour_price[] = $meta['child_price'];
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                                <?php
                                                //get the lowest price from all available room price
                                                $tf_tour_min_price      = !empty($tour_price) ? min( $tour_price ) : 0;
                                                $tf_tour_full_price     = !empty($tour_price) ? min( $tour_price ) : 0;
                                                $tf_tour_discount_type  = ! empty( $meta['discount_type'] ) ? $meta['discount_type'] : '';
                                                $tf_tour_discount_price = ! empty( $meta['discount_price'] ) ? $meta['discount_price'] : '';
                                                if ( ! empty( $tf_tour_discount_type ) && ! empty( $tf_tour_min_price ) && ! empty( $tf_tour_discount_price ) ) {
                                                    if ( $tf_tour_discount_type == "percent" ) {
                                                        $tf_tour_min_discount = ( $tf_tour_min_price * (int) $tf_tour_discount_price ) / 100;
                                                        $tf_tour_min_price    = $tf_tour_min_price - $tf_tour_min_discount;
                                                    }
                                                    if ( $tf_tour_discount_type == "fixed" ) {
                                                        $tf_tour_min_discount = $tf_tour_discount_price;
                                                        $tf_tour_min_price    = $tf_tour_min_price - (int) $tf_tour_discount_price;
                                                    }
                                                }
                                                $lowest_price = strip_tags(wc_price( $tf_tour_min_price ));
                                                
                                                if ( ! empty( $tf_tour_min_discount ) ) {
                                                    echo wp_kses_post( $lowest_price ). " " . "<span><del>" . strip_tags(wc_price( $tf_tour_full_price )) . "</del></span>";
                                                } else {
                                                    echo wp_kses_post( $lowest_price );
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                            endif; ?>
                            <!-- Tourfic Booking form -->
                            <div class="tf-booking-form te-booking__form te-booking__form-default ">
                                <div class="tf-booking-form-inner mt_20 <?php echo esc_attr( $tf_booking_type ) == 2 && esc_attr( $tf_hide_price ) !== '1' ? 'tf-mt-24' : '' ?>">
                                    <h4 class="mb_30"><?php echo ! empty( $meta['booking-section-title'] ) ? esc_html( $meta['booking-section-title'] ) : ''; ?></h4>
                                    <?php
                                    if( ($tf_booking_type == 2 && $tf_hide_booking_form !== '1') || $tf_booking_type == 1 || $tf_booking_type == 3) {
                                        echo tf_single_tour_booking_form( $post->ID );
                                    }
                                    ?>
                                    <?php if ($tf_booking_type == 2 && $tf_hide_booking_form == 1):?>
                                        <a href="<?php echo esc_url($tf_booking_url) ?>" target="_blank" class="btn_primary__v1 !w-full justify-center mt-5" style="margin-top: 10px;"><?php esc_html_e('Book now', 'travic'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ( $email || $phone || $fax || $website ) {
                            ?>
                            <div class="tf-tour-booking-advantages tf-box mt_40">
                                <div class="tf-head-title">
                                    <h4 class="mb_30"><?php echo ! empty( $meta['contact-info-section-title'] ) ? esc_html( $meta['contact-info-section-title'] ) : ''; ?></h4>
                                </div>
                                <div class="tf-booking-advantage-items">
                                    <ul class="tf-list">
                                        <?php
                                        if ( ! empty( $phone ) ) { ?>
                                            <li><i class="fa-solid fa-headphones"></i> <a href="tel:<?php echo esc_html( $phone ) ?>"><?php echo esc_html( $phone ) ?></a></li>
                                        <?php } ?>
                                        <?php
                                        if ( ! empty( $email ) ) { ?>
                                            <li><i class="fa-solid fa-envelope"></i> <a href="mailto:<?php echo esc_html( $email ) ?>"><?php echo esc_html( $email ) ?></a></li>
                                        <?php } ?>
                                        <?php
                                        if ( ! empty( $website ) ) { ?>
                                            <li><i class="fa-solid fa-link"></i> <a target="_blank" href="<?php echo esc_html( $website ) ?>"><?php echo esc_html( $website ) ?></a></li>
                                        <?php } ?>
                                        <?php
                                        if ( ! empty( $fax ) ) { ?>
                                            <li><i class="fa-solid fa-fax"></i> <a href="tel:<?php echo esc_html( $fax ) ?>"><?php echo esc_html( $fax ) ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $tf_enquiry_section_status = ! empty( $meta['t-enquiry-section'] ) ? $meta['t-enquiry-section'] : "";
                        $tf_enquiry_section_icon = ! empty( $meta['t-enquiry-option-icon'] ) ? esc_html( $meta['t-enquiry-option-icon'] ) : '';
                        $tf_enquiry_section_title = ! empty( $meta['t-enquiry-option-title'] ) ? esc_html( $meta['t-enquiry-option-title'] ) : '';
                        $tf_enquiry_section_des = ! empty( $meta['t-enquiry-option-content'] ) ? esc_html( $meta['t-enquiry-option-content'] ) : '';
                        $tf_enquiry_section_button = ! empty( $meta['t-enquiry-option-btn'] ) ? esc_html( $meta['t-enquiry-option-btn'] ) : '';
    
                        if ( ! empty( $tf_enquiry_section_status ) ) {
                            ?>
                            <!-- Enquiry box -->
                            <div class="tf-tour-booking-advantages tf-box mt_40">
                                <div class="tf-ask-enquiry tf-ask-enquiry__sidebar">
                                    <?php 
                                    if(!empty($tf_enquiry_section_icon)) {
                                        ?>
                                        <i class="<?php echo esc_attr( $tf_enquiry_section_icon ); ?>" aria-hidden="true"></i>
                                        <?php
                                    }
                                    if(!empty($tf_enquiry_section_title)) {
                                        ?>
                                        <h4 class="mb_15"><?php echo wp_kses( $tf_enquiry_section_title, true ); ?></h4>
                                        <?php
                                    }
                                    if(!empty($tf_enquiry_section_des)) {
                                        ?>
                                        <p><?php echo wp_kses( $tf_enquiry_section_des, true ); ?></p>
                                        <?php
                                    }
                                    if(!empty($tf_enquiry_section_button)) {
                                        ?>
                                        <div class="tf-btn"><a href="#" id="tf-ask-question-trigger" class="theme-btn btn-one"><span>
                                    <?php echo wp_kses( $tf_enquiry_section_button, true ); ?>
                                    </span></a></div>
                                    <?php 
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                
                </div>
                <!--Sidebar Content End-->
            
            </div>
        
        </div>
    
    </div>

</div>