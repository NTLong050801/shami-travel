<?php
/**
 * Banner Template
 *
 * @package    WordPress
 * @subpackage Template Path
 * @author     Template Path
 * @version    1.0
 */

if ( $data->get( 'enable_banner' ) AND $data->get( 'banner_type' ) == 'e' AND ! empty( $data->get( 'banner_elementor' ) ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'banner_elementor' ) );

	return false;
}

?>
<?php if ( $data->get( 'enable_banner' ) ) : ?>
	
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" <?php if($data->get( 'banner' )){ ?>style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>);"<?php } ?>></div>
        <div class="auto-container">
            <div class="content-box">
                <h1><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else( the_title() ); ?></h1>
                
				<?php if(travic_the_breadcrumb()){ ?>
                <ul class="breadcrumb-menu">
                    <?php echo travic_the_breadcrumb(); ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- page-title end -->   
        
<?php endif; ?>