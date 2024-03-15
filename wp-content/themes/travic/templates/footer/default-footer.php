<?php
/**
 * Footer Template  File
 *
 * @package TRAVIC
 * @author  Template Path
 * @version 1.0
 */

$options = travic_WSH()->option();
$allowed_html = wp_kses_allowed_html( 'post' );

$shape_image = $options->get( 'shape_image' );
$shape_image = travic_set( $shape_image, 'url' );

?>
    
    <!-- main-footer -->
    <footer class="main-footer" id="footer">
        <?php if($shape_image){ ?><div class="pattern-layer" style="background-image: url(<?php echo esc_url($shape_image); ?>);"></div><?php } ?>
        
		<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
        <div class="widget-section p_relative pt_100 pb_85">
            <div class="auto-container">
                <div class="d-flex flex-wrap justify-content-between gap-30">
                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
		<?php if($options->get('show_bottom_footer_v1')){ ?>
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="bottom-inner">
                    <?php if($options->get('footer_copyright_text_v1')){ ?><div class="copyright"><p><?php echo wp_kses($options->get('footer_copyright_text_v1'), true); ?></p></div><?php } ?>
                    <?php
						if( $options->get( 'show_footer_social_icon_v1' )):
					?>
                    <ul class="social-links">
                        <?php echo travic_get_social_icon(); ?>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php } ?>
    </footer>
    <!-- main-footer end -->