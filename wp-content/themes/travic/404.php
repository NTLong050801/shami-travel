<?php
/**
 * 404 page file
 *
 * @package    WordPress
 * @subpackage Travic
 * @author     Template Path <admin@template_path.com>
 * @version    1.0
 */

$allowed_html = wp_kses_allowed_html( 'post' );

$bg_img   = $options->get( 'bg_image' );
$bg_img   = travic_set( $bg_img, 'url', TRAVIC_URI . '/assets/images/icons/error-1.png' );

?>
<?php get_header();
$data = \TRAVIC\Includes\Classes\Common::instance()->data( '404' )->get();
$options = travic_WSH()->option();
if ( class_exists( '\Elementor\Plugin' ) AND $data->get( 'tpl-type' ) == 'e' AND $data->get( 'tpl-elementor' ) ) {
	echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $data->get( 'tpl-elementor' ) );
} else {
?>

<?php if ( $data->get( 'enable_banner' ) ) : ?>
	<?php do_action( 'travic_banner', $data );?>
<?php else:?>

<?php endif;?>    

<!-- error-section -->
<section class="error-section pt_90 pb_160 centred">
    <div class="auto-container">
        <div class="inner-box">
            <figure class="image-box"><img src="<?php echo esc_url($bg_img); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure>
            <h2>
				<?php if( $options->get( '404_page_title' ) ):?>
                       <?php echo wp_kses( $options->get( '404_page_title' ), true );?>
                <?php else:?>
                        <span><?php esc_html_e( 'Oops...', 'travic' );?></span>
                        <?php esc_html_e( 'That Page Can Not be Found.', 'travic' );?>
				<?php endif;?>
            </h2>
            <div class="btn-box">
                
                <?php if ( $options->get( 'back_home_btn', true ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="theme-btn btn-one home-btn"><i class="fa fa-long-arrow-left"></i>
					<?php 
                        if( $options->get( 'back_home_btn_label' ) ){
                            echo wp_kses( $options->get( 'back_home_btn_label' ), true );
                        }else{
                            esc_html_e( 'Back to Home', 'travic' );
                        }
                    ?>
                </a>
                <?php endif; ?>
                
                <?php if ( $options->get( 'back_home_btn2' ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="theme-btn btn-one">
					<?php 
                        if( $options->get( 'back_home_btn_label2' ) ){
                            echo wp_kses( $options->get( 'back_home_btn_label2' ), true );
                        }else{
                            esc_html_e( 'Back to Home', 'travic' );
                        }
                    ?>
                </a>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>
<!-- error-section end -->
         
<?php }
get_footer('coming-soon'); ?>
