<?php
$options = travic_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Mian Logo Settings
$mobile_logo = $options->get( 'mobile_logo' );
$mobile_logo_dimension = $options->get( 'mobile_logo_dimension' );

$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>

	<!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fa fa-times"></i></div>
        
        <nav class="menu-box">
            <div class="nav-logo">
            	<?php if( $options->get( 'normal_logo_show3' ) ):?>
					<?php echo travic_logo( $logo_type, $mobile_logo, $mobile_logo_dimension, $logo_text, $logo_typography ); ?>
                <?php else:?>
                	<a href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/images/logo-2.png" alt="<?php echo esc_attr_e( 'Logo Image', 'travic' )?>"></a>
                <?php endif;?>
            </div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <?php if( $options->get( 'show_mobile_info_v1' )){ ?>
            <div class="contact-info">
                <h4><?php echo wp_kses($options->get('mobile_info_title_v1'), true); ?></h4>
                <ul>
                    <li><?php echo wp_kses($options->get('mobile_address_v1'), true); ?></li>
                    <li><a href="tel:<?php echo esc_attr($options->get('mobile_phone_no_v1')); ?>"><?php echo wp_kses($options->get('mobile_phone_no_v1'), true); ?></a></li>
                    <li><a href="mailto:<?php echo esc_attr($options->get('mobile_email_address_v1')); ?>"><?php echo wp_kses($options->get('mobile_email_address_v1'), true); ?></a></li>
                </ul>
            </div>
            <?php
				if( $options->get( 'show_mob_social_icon' )):
			?>
            <div class="social-links">
                <ul class="clearfix">
                    <?php echo wp_kses(travic_get_social_icon(), true); ?>
                </ul>
            </div>
            <?php endif;?>
            <?php } ?>
        </nav>
    </div><!-- End Mobile Menu -->
    
    
