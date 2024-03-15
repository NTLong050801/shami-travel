<?php

/**
 * Blog Content Template
 *
 * @package    WordPress
 * @subpackage TRAVIC
 * @author     Template Path
 * @version    1.0
 */

$options = travic_WSH()->option();
$allowed_tags = wp_kses_allowed_html('post');

?>

<div <?php post_class(); ?>>
	
    <div class="news-block-one">
        <div class="inner-box">
            <?php if( has_post_thumbnail() ){?>
            <figure class="image-box"><a href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('full'); ?></a></figure>
            <?php } ?>
            <div class="lower-content <?php if( !has_post_thumbnail() ) echo 'pt_0';?>">
                
				<?php if(! $options->get('blog_post_category') || $options->get('blog_post_date')){ ?>
                <ul class="post-info mb_15">
                    <?php if(! $options->get('blog_post_category') && has_category()){ ?><li><?php the_category(' '); ?></li><?php } ?>
                    <?php if(! $options->get('blog_post_date')){ ?><li><i class="icon-19"></i><?php echo get_the_date(); ?></li><?php } ?>
                </ul>
                <?php } ?>
                
                <h2><a href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h2>
                
				<?php the_excerpt(); ?>
            </div>
        </div>
    </div>
        
</div>