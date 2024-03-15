<?php get_header();
    $data    = \TRAVIC\Includes\Classes\Common::instance()->data('single-project')->get();

    $layout = $data->get('layout');
    $sidebar = $data->get('sidebar');
    $layout = ($layout) ? $layout : 'right';
    $sidebar = ($sidebar) ? $sidebar : 'default-sidebar';
    if (is_active_sidebar($sidebar)) {
        $layout = 'right';
    } else {
        $layout = 'full';
    }
    $class = (!$layout || $layout == 'full') ? 'col-lg-12 col-md-12 col-sm-12 content-side' : 'col-lg-8 col-md-12 col-sm-12 content-side';
    $options = travic_WSH()->option();

    do_action('travic_banner', $data);
    $allowed_tags = wp_kses_allowed_html('post');
?>

<?php 
	while (have_posts()) : the_post(); 				
?>
<!-- project-details -->
<section class="project-details">
    <div class="auto-container">
        <div class="upper-text">
            <h2><?php the_title(); ?></h2>
        </div>
        <?php the_content(); ?>
        <?php
			$icons = get_post_meta(get_the_id(), 'features_tabs', true); if ($icons) : 
		?>
        <div class="project-info-box">
            <ul class="info-list clearfix">
                <?php
					for ( $i=0; $i < count( $icons['feature_title'] ); $i++ ) {
					$feature_title = ( isset( $icons['feature_title'][$i] ) && !empty( $icons['feature_title'][$i] ) ) ? $icons['feature_title'][$i] : '';
					$feature_text = ( isset( $icons['feature_text'][$i] ) && !empty( $icons['feature_text'][$i] ) ) ? $icons['feature_text'][$i] : '';
				?>
                <li>
                    <span><?php $i = sprintf('%02d', $i); echo wp_kses_post( $i ); ?>.</span>
                    <h5><?php echo wp_kses($feature_title, true); ?></h5>
                    <p><?php echo wp_kses($feature_text, true); ?></p>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="project-image">
            <?php $project_image = get_post_meta( get_the_id(), 'project_image', true );
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			 ?>
            <figure class="image"><a href="<?php echo wp_get_attachment_url($project_image['id']);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo wp_get_attachment_url($project_image['id']);?>" alt="<?php esc_attr_e('Awesome Image', 'travic');?>"></a></figure>
            <?php $project_image2 = get_post_meta( get_the_id(), 'project_image2', true );
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			 ?>
            <figure class="image"><a href="<?php echo wp_get_attachment_url($project_image2['id']);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo wp_get_attachment_url($project_image2['id']);?>" alt="<?php esc_attr_e('Awesome Image', 'travic');?>"></a></figure>
        </div>
    </div>
</section>
<!-- project-details end -->
<?php endwhile; ?>


<?php get_footer(); ?>
