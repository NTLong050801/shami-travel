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

$shape_image2 = $options->get( 'shape_image2' );
$shape_image2 = travic_set( $shape_image2, 'url', TRAVIC_URI );
?>
    
    
    <!-- main-footer -->
    <footer class="main-footer light-footer">
        <?php if($shape_image2){ ?><div class="pattern-layer" style="background-image: url(<?php echo esc_url($shape_image2); ?>);"></div><?php } ?>
        
		<?php if ( is_active_sidebar( 'footer-sidebar2' ) ) { ?>
        <div class="widget-section p_relative pt_100 pb_85">
            <div class="auto-container">
                <div class="row clearfix">
                    <?php dynamic_sidebar( 'footer-sidebar2' ); ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
		<?php if($options->get('show_bottom_footer_v2')){ ?>
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="bottom-inner">
                    <?php if($options->get('footer_copyright_text_v2')){ ?><div class="copyright"><p><?php echo wp_kses($options->get('footer_copyright_text_v2'), true); ?></p></div><?php } ?>
                    <?php
						if( $options->get( 'show_footer_social_icon_v2' )):
					?>
                    <ul class="social-links">
                        <?php echo wp_kses(travic_get_social_icon(), true); ?>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php } ?>
    </footer>
    <!-- main-footer end -->
    
    
    