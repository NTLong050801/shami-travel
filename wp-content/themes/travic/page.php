<?php
/**
 * Default Template Main File.
 *
 * @package TRAVIC
 * @author  TonaTheme
 * @version 1.0
 */

get_header();
$data  = \TRAVIC\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'full';
$sidebar = ( $sidebar ) ? $sidebar : '';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-lg-12 col-md-12 col-sm-12 content-column' : 'col-lg-8 col-md-12 col-sm-12 content-column';
?>

<?php if ( $data->get( 'enable_banner' ) ) : ?>
	<?php do_action( 'travic_banner', $data );?>
<?php else:?>
<!-- page-title -->
<section class="page-title centred">
    <div class="bg-layer" <?php if($data->get( 'banner' )){ ?>style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>);"<?php } ?>></div>
    <div class="auto-container">
        <div class="content-box">
            <h1><?php if ($data->get('title')) { echo wp_kses($data->get('title'), true); } else { the_title(); } ?></h1>

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
<section class="sidebar-page-container pt_120 pb_120 te-page__custom">
    <div class="auto-container">
        <div class="row clearfix">
		
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'travic_sidebar', $data );
				}
            ?>
            <div class="content-side <?php echo esc_attr( $class ); ?> <?php if ( $data->get( 'layout' ) == 'left' ) echo 'pl-0'; elseif ( $data->get( 'layout' ) == 'right' ) echo ''; ?>">
            	<div class="blog-details-content">
                    <div class="thm-unit-test">
                            
                        <?php while ( have_posts() ): the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                        
                        <div class="clearfix"></div>
                        <?php
                        $defaults = array(
                            'before' => '<div class="paginate-links">' . esc_html__( 'Pages:', 'travic' ),
                            'after'  => '</div>',
        
                        );
                        wp_link_pages( $defaults );
                        ?>
                        <?php comments_template() ?>
                     
                     </div>
                 </div>
            </div>
            <?php
				if ( $layout == 'right' ) {
					$data->set('sidebar', 'default-sidebar');
					do_action( 'travic_sidebar', $data );
				}
            ?>
        
        </div>
	</div>
</section><!-- blog section with pagination -->
<?php get_footer(); ?>
