<?php
/**
 * Blog Main File.
 *
 * @package TRAVIC
 * @author  TonaTheme
 * @version 1.0
 */

get_header();
global $wp_query;
$data  = \TRAVIC\Includes\Classes\Common::instance()->data( 'blog' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'right';
$sidebar = ( $sidebar ) ? $sidebar : 'default-sidebar';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-lg-12 col-md-12 col-sm-12 content-column' : 'col-lg-8 col-md-12 col-sm-12 content-column';
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>
	
    <?php if ( $data->get( 'enable_banner' ) ) : ?>
		<?php do_action( 'travic_banner', $data );?>
    <?php else:?>
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" <?php if($data->get( 'banner' )){ ?>style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>);"<?php } ?>></div>
        <div class="auto-container">
            <div class="content-box">
               <h1>
    		   <?php if ($data->get('title')) { echo wp_kses($data->get('title'), true); } else { echo esc_html(get_bloginfo('name')); } ?> </h1>
                
				<?php if(travic_the_breadcrumb()){ ?>
                <ul class="breadcrumb-menu">
                    <?php echo travic_the_breadcrumb(); ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- page-title end --> 
    
    <?php endif;?>
    
    <!-- sidebar-page-container -->
    <section class="sidebar-page-container pt_120 pb_120">
        <div class="auto-container">
            <div class="row clearfix">
                <?php
                    if ( $data->get( 'layout' ) == 'left' ) {
                        do_action( 'travic_sidebar', $data );
                    }
                ?>
                <div class="content-side <?php echo esc_attr( $class ); ?> <?php if ( $data->get( 'layout' ) == 'left' ) echo 'pl-0'; elseif ( $data->get( 'layout' ) == 'right' ) echo ''; ?>">
                    <div class="blog-standard-content">
                        <div class="thm-unit-test">
                            
                            <?php
                                while ( have_posts() ) :
                                    the_post();
                                    travic_template_load( 'templates/blog/blog.php', compact( 'data' ) );
                                endwhile;
                                wp_reset_postdata();
                            ?>
                                
                        </div>
                        
                        <!--Pagination-->
                    	<div class="pagination-wrapper centred">
                        	<?php travic_the_pagination( $wp_query->max_num_pages );?>
                        </div>
                    </div>
                </div>
                <?php
                    if ( $data->get( 'layout' ) == 'right' ) {
                        do_action( 'travic_sidebar', $data );
                    }
                ?>
            </div>
        </div>
    </section> 
    <!--End blog area--> 
	<?php
}
get_footer();
