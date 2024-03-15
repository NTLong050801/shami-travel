<?php
/**
 * Footer Main File.
 *
 * @package TRAVIC
 * @author  Template Path
 * @version 1.0
 */
global $wp_query;
$options = travic_WSH()->option();
$page_id = ( $wp_query->is_posts_page ) ? $wp_query->queried_object->ID : get_the_ID();
?>

	<div class="clearfix"></div>

	<?php travic_template_load( 'templates/footer/footer.php', compact( 'page_id' ) );?>

    <?php if( $options->get( 'show_scroltop' ) ):?>
    <!--Scroll to top-->
    <div class="scroll-to-top">
        <div>
            <div class="scroll-top-inner">
                <div class="scroll-bar">
                    <div class="bar-inner"></div>
                </div>
                <div class="scroll-bar-text"><?php echo wp_kses($options->get('scroltop_text'), true); ?></div>
            </div>
        </div>
    </div>
    <!-- Scroll to top end -->
    <?php endif; ?>
    
</div>

<?php wp_footer(); ?>
</body>
</html>
