<?php
$options = travic_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

//Mian Logo Settings
$main_logo2 = $options->get( 'main_color_logo2' );
$main_logo_dimension2 = $options->get( 'main_color_logo_dimension2' );

$logo_type = '';
$logo_text = '';
$logo_typography = ''; ?>


<div class="boxed_wrapper ltr home-2">
        
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
        
	<?php if($options->get('show_seach_form_v2')){ ?>
    <!--Search Popup-->
    <div id="search-popup" class="search-popup">
        <div class="popup-inner">
            <div class="upper-box clearfix">
                <figure class="logo-box pull-left"><?php echo travic_logo( $logo_type, $main_logo2, $main_logo_dimension2, $logo_text, $logo_typography ); ?></figure>
                <div class="close-search pull-right"><span class="fa fa-times"></span></div>
            </div>
            <div class="overlay-layer"></div>
            <div class="auto-container">
                <div class="search-form">
                    <?php get_template_part('searchform2')?>
                </div>
            </div>
        </div>
    </div>   
    <?php } ?>


    <!-- main header -->
    <header class="main-header header-style-two">
        <!-- header-lower -->
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box">
                    <figure class="logo-box"><?php echo travic_logo( $logo_type, $main_logo2, $main_logo_dimension2, $logo_text, $logo_typography ); ?></figure>
                    <div class="menu-area">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light clearfix">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
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
                    <?php if($options->get('btn_title_v2')){ ?>
                    <div class="menu-right-content">
                        <div class="search-box-outer search-toggler mr_25">
                            <i class="icon-27"></i>
                        </div>
                        <div class="btn-box"><a href="<?php echo esc_url($options->get('btn_link_v2')); ?>" class="theme-btn btn-one"><?php echo wp_kses($options->get('btn_title_v2'), true); ?></a></div>
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
                        <figure class="logo"><?php echo travic_logo( $logo_type, $main_logo2, $main_logo_dimension2, $logo_text, $logo_typography ); ?></figure>
                    </div>
                    <div class="menu-area">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <?php if($options->get('btn_title_v2')){ ?>
                    <div class="menu-right-content">
                        <div class="search-box-outer search-toggler mr_25">
                            <i class="icon-27"></i>
                        </div>
                        <div class="btn-box"><a href="<?php echo esc_url($options->get('btn_link_v2')); ?>" class="theme-btn btn-one"><?php echo wp_kses($options->get('btn_title_v2'), true); ?></a></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->
    
    <!-- Header Mobile Settings -->
    <?php get_template_part('templates/header/mobile_settings'); ?>
