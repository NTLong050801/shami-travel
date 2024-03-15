<?php
$options = travic_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Mian Logo Settings
$main_logo = $options->get( 'main_color_logo' );
$main_logo_dimension = $options->get( 'main_color_logo_dimension' );

$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>

<div class="boxed_wrapper ltr">
        
	<?php if( $options->get( 'theme_preloader' ) ):?>
    <!-- preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close"><?php esc_html_e('close', 'travic'); ?></div>
            <div id="handle-preloader" class="handle-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <?php echo wp_kses($options->get('preloader_text'), true); ?>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <!-- preloader end -->
    <?php endif; ?>
    	       
    <!-- main header -->
    <header class="main-header">
        <?php if($options->get('show_header_topbar_v3')){ ?>
        <!-- header-top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner">
                    <?php if($options->get('opening_hours_v3')){ ?><p><i class="icon-1"></i><?php echo wp_kses($options->get('opening_hours_v3'), true); ?></p><?php } ?>
                    <?php
                        if( $options->get( 'social_icons_show3' )):
                    ?>
                    <ul class="social-links">
                        <li><span><?php esc_html_e('On Social:', 'travic'); ?></span></li>
                        <?php echo travic_get_social_icon(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- header-uper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="upper-inner">
                    <figure class="logo-box"><?php echo travic_logo( $logo_type, $main_logo, $main_logo_dimension, $logo_text, $logo_typography ); ?></figure>
                    <div class="right-column">
                        <ul class="info-list mr_50">
                            <?php if($options->get('phone_no_v3')){ ?><li><i class="icon-5"></i><a href="tel:<?php echo esc_attr($options->get('phone_no_v3'), true); ?>"><?php echo wp_kses($options->get('phone_no_v3'), true); ?></a></li><?php } ?>
                            <?php if($options->get('email_v3')){ ?><li><i class="icon-6"></i><a href="mailto:<?php echo esc_attr($options->get('email_v3'), true); ?>"><?php echo wp_kses($options->get('email_v3'), true); ?></a></li><?php } ?>
                        </ul>
                        <?php if($options->get('show_seach_form_v3')){ ?>
                        <div class="search-inner">
                            <?php get_template_part('searchform1')?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-lower -->
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="menu-area">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light clearfix">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation scroll-nav clearfix">
                                    <?php wp_nav_menu( array( 'theme_location' => 'one_page_menu', 'container_id' => 'navbar-collapse-1',
                                        'container_class'=>'navbar-collapse collapse navbar-right',
                                        'menu_class'=>'nav navbar-nav',
                                        'fallback_cb'=>false,
                                        'items_wrap' => '%3$s',
                                        'container'=>false,
                                        'depth'=>'3',
                                        'walker'=> new Bootstrap_walker()
                                    )); ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <?php if($options->get('btn_title_v3')){ ?>
                    <div class="menu-right-content">
                        <div class="login-box"><a href="<?php echo esc_url($options->get('btn_link_v3')); ?>"><i class="icon-7"></i><?php echo wp_kses($options->get('btn_title_v3'), true); ?></a></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><?php echo travic_logo( $logo_type, $main_logo, $main_logo_dimension, $logo_text, $logo_typography ); ?></figure>
                    </div>
                    <div class="menu-area">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <?php if($options->get('btn_title_v3')){ ?>
                    <div class="menu-right-content">
                        <div class="login-box"><a href="<?php echo esc_url($options->get('btn_link_v3')); ?>"><i class="icon-7"></i><?php echo wp_kses($options->get('btn_title_v3'), true); ?></a></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->
    
    <!-- Header Mobile Settings -->
    <?php get_template_part('templates/header/mobile_settings'); ?>
