<?php
/**
 * Blog Post Main File.
 *
 * @package TRAVIC
 * @author  Template Path
 * @version 1.0
 */

get_header();
$options = travic_WSH()->option();

$data    = \TRAVIC\Includes\Classes\Common::instance()->data( 'single' )->get();
$layout = $data->get( 'layout' );
$sidebar = $data->get( 'sidebar' );
$layout = ( $layout ) ? $layout : 'full';
$sidebar = ( $sidebar ) ? $sidebar : '';
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
$class = ( !$layout || $layout == 'full' ) ? 'col-lg-12 col-md-12 col-sm-12 content-column' : 'col-lg-8 col-md-12 col-sm-12 content-side';

if ( class_exists( '\Elementor\Plugin' ) && $data->get( 'tpl-type' ) == 'e') {
	
	while(have_posts()) {
	   the_post();
	   the_content();
    }

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
<section class="sidebar-page-container pt_120 pb_120">
    <div class="auto-container">
        <div class="row clearfix">
        	<?php
				if ( $data->get( 'layout' ) == 'left' ) {
					do_action( 'travic_sidebar', $data );
				}
			?>
            <div class="content-side <?php echo esc_attr( $class ); ?>">
            	
				<?php while ( have_posts() ) : the_post(); ?>				
                <div class="blog-details-content">             	
                    <div class="thm-unit-test"> 
                    	
                        <div class="news-block-one">
                            <div class="inner-box mb-0">
                                <?php if(has_post_thumbnail()){ ?>
                                <figure class="image-box"><?php the_post_thumbnail('full'); ?></figure>
                                <?php } ?>
                                
                                <div class="lower-content <?php if( !has_post_thumbnail() ) echo 'pt_0';?>">
                                    
									<?php if(! $options->get('single_post_category') || $options->get('single_post_date')){ ?>
                                    <ul class="post-info mb_35">
                                        <?php if(! $options->get('single_post_category') || has_category()){ ?><li><?php the_category(' '); ?></li><?php } ?>
                                        <?php if(! $options->get('single_post_date')){ ?><li><i class="icon-19"></i><?php echo get_the_date(); ?></li><?php } ?>
                                    </ul>
                                    <?php } ?>
                                    
									<div class="text"><?php the_content(); ?></div>
                                    <div class="clearfix"></div>
                                    <?php wp_link_pages(array('before'=>'<div class="paginate-links mt_30">'.esc_html__('Pages: ', 'travic'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(has_tag() || $options->get( 'show_social_icon' )): ?>
                        <div class="post-share-option pt_45 border-bottom-0">
                            <?php if(has_tag()){ ?>
                            <ul class="post-category">
                                <li><span><?php esc_html_e('Tags:', 'travic'); ?></span></li>
                                <?php the_tags( '<li>', '</li><li>', '</li>' ); ?>
                            </ul>
                            <?php } ?>
                            
                            <?php if( $options->get( 'show_social_icon' ) ):?>
                            <ul class="post-share">
                                <li><span><?php esc_html_e('Share This :', 'travic'); ?></span></li>
                                <?php echo (travic_get_social_icon()); ?>
                            </ul>
                            <?php endif;?>
                        </div>
                        <?php endif;?>
                        
						<?php if( $options->get( 'single_post_author_box' ) ):?>
                        <div class="author-box mb_80">
                            <figure class="thumb-box"><?php echo get_avatar(get_the_author_meta('ID'), 120); ?></figure>
                            <h3><?php the_author(); ?></h3>
                            <span class="designation"><?php esc_html_e('About Author', 'travic'); ?></span>
                            <?php the_author_meta( 'description', get_the_author_meta('ID') ); ?>
                        </div>
                        <?php endif;?>
                          
                        <!--End post-details-->
                        <?php comments_template(); ?>
                        
                	</div>
					<!--End thm-unit-test-->
                </div>
                <!--End blog-content-->
				<?php endwhile; ?>
                
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
