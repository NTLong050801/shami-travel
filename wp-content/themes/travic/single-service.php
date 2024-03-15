<?php get_header();
    $data    = \TRAVIC\Includes\Classes\Common::instance()->data('single-service')->get();

    $layout = $data->get('layout');
    $sidebar = $data->get('sidebar');
    $layout = ($layout) ? $layout : 'right';
    $sidebar = ($sidebar) ? $sidebar : 'default-sidebar';
    if (is_active_sidebar($sidebar)) {
        $layout = 'right';
    } else {
        $layout = 'full';
    }
    $class = (!$layout || $layout == 'full') ? 'col-lg-12 col-md-12 col-sm-12 content-side' : 'col-lg-8 col-md-12 col-sm-12 content-side';
    $options = travic_WSH()->option();

    do_action('travic_banner', $data);
    $allowed_tags = wp_kses_allowed_html('post');
?>

<!-- service-details -->
<section class="service-details">
    <div class="auto-container">
        <div class="row clearfix">
            
			<?php if( $data->get( 'layout' ) == 'left' ): ?>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="service-sidebar">
                    <?php dynamic_sidebar( $sidebar ); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php 
				while (have_posts()) : the_post(); 				
			?>
            <div class="<?php echo esc_attr( $class ); ?> content-side">
                <div class="service-details-content <?php if ( $data->get( 'layout' ) == 'left' ) echo 'pl-0'; elseif ( $data->get( 'layout' ) == 'right' ) echo ''; ?>">
                    <div class="content-one">
                        <figure class="image-box"><?php the_post_thumbnail('travic_1170x490'); ?></figure>
                        <div class="text-box">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php
						$icons = get_post_meta(get_the_id(), 'features_tabs', true); if ($icons) : 
					?>
                    <div class="content-two">
                        <div class="row clearfix">
                            <?php
								for ( $i=0; $i < count( $icons['feature_title'] ); $i++ ) {
								$feature_title = ( isset( $icons['feature_title'][$i] ) && !empty( $icons['feature_title'][$i] ) ) ? $icons['feature_title'][$i] : '';
								$feature_text = ( isset( $icons['feature_text'][$i] ) && !empty( $icons['feature_text'][$i] ) ) ? $icons['feature_text'][$i] : '';
								$feature_btn_title = ( isset( $icons['feature_btn_title'][$i] ) && !empty( $icons['feature_btn_title'][$i] ) ) ? $icons['feature_btn_title'][$i] : '';
								$feature_btn_link = ( isset( $icons['feature_btn_link'][$i] ) && !empty( $icons['feature_btn_link'][$i] ) ) ? $icons['feature_btn_link'][$i] : '';
							?>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <div class="icon-box">
                                        <div class="shape" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-38.png);"></div>
                                        <div class="icon"><i class="flaticon-double-check"></i></div>
                                        <div class="overlay-icon"><i class="flaticon-double-check-1"></i></div>
                                    </div>
                                    <div class="inner-box">
                                        <h3><?php echo wp_kses($feature_title, true); ?></h3>
                                        <p><?php echo wp_kses($feature_text, true); ?></p>
                                    </div>
                                    <div class="link-box">
                                        <h6><a href="<?php echo esc_url($feature_btn_link); ?>"><i class="flaticon-arrow-right"></i><?php echo wp_kses($feature_btn_title, true); ?></a></h6>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php echo (get_post_meta( get_the_id(), 'carousal_content', true ));?>
					<?php
						$icons = get_post_meta(get_the_id(), 'faqs_tabs', true); if ($icons) : 
					?>
                    <div class="content-four">
                        <div class="text-box">
                            <h2><?php echo (get_post_meta( get_the_id(), 'faqs_title', true ));?></h2>
                            <p><?php echo (get_post_meta( get_the_id(), 'faqs_text', true ));?></p>
                        </div>
                        <ul class="accordion-box">
                            <?php
								for ( $i=0; $i < count( $icons['faq_title'] ); $i++ ) {
								$faq_title = ( isset( $icons['faq_title'][$i] ) && !empty( $icons['faq_title'][$i] ) ) ? $icons['faq_title'][$i] : '';
								$faq_text = ( isset( $icons['faq_text'][$i] ) && !empty( $icons['faq_text'][$i] ) ) ? $icons['faq_text'][$i] : '';
							?>
                            <li class="accordion block <?php if($i == 1) echo 'active-block' ?>">
                                <div class="acc-btn <?php if($i == 1) echo 'active' ?>">
                                    <div class="icon-box"></div>
                                    <h5><?php echo wp_kses($faq_title, true); ?></h5>
                                </div>
                                <div class="acc-content <?php if($i == 1) echo 'current' ?>">
                                    <p><?php echo wp_kses($faq_text, true); ?></p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
            
            <?php if( $data->get( 'layout' ) == 'right' ): ?>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="service-sidebar">
                    <?php dynamic_sidebar( $sidebar ); ?>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>
<!-- service-details end -->


<?php get_footer(); ?>
