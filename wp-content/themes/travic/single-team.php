<?php get_header();
$data = \TRAVIC\Includes\Classes\Common::instance()->data('single-team')->get(); ?>

<!-- page-title -->
<section class="page-title centred">
    <div class="bg-layer" style="background-image: url(<?php echo esc_url( $data->get( 'banner' ) ); ?>);"></div>
    <div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-20.png);"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1><?php if( $data->get( 'title' ) ) echo wp_kses( $data->get( 'title' ), true ); else( the_title( ) ); ?></h1>
            <ul class="bread-crumb clearfix">
                <?php echo travic_the_breadcrumb(); ?>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->

<?php while (have_posts()) : the_post(); ?>

<!--
=====================================================
    Team Details
=====================================================
-->

<!--Start Team Details Style1-->
<section class="team-details-style1">
    <div class="container">
        <div class="row">

            <div class="col-xl-5">
                <div class="team-details-style1__img">
                    <?php if(has_post_thumbnail()):?>
                    <div class="img-box">
                        <?php the_post_thumbnail('travic_470x589'); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="team-details-style1__content">
                    <div class="inner-title">
                        <h2><?php the_title(); ?></h2>
                        <p>
                            <?php echo (get_post_meta( get_the_id(), 'designation', true ));?>
                            <span class="border-right"></span>
                        </p>
                    </div>
                    <?php the_content();?>
                    <div class="team-details-style1__img">
                        <div class="contact-info">
                            <ul>
                                
                                <?php if(get_post_meta( get_the_id(), 'team_phone', true )) : ?>
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <i class="flaticon-incoming-call"></i>
                                        </div>
                                        <a href="tel:<?php echo (get_post_meta( get_the_id(), 'team_phone', true ));?>"><?php echo (get_post_meta( get_the_id(), 'team_phone', true ));?></a>
                                    </div>
                                </li>
                                <?php endif; ?>
    
                                <?php if(get_post_meta( get_the_id(), 'team_email', true )) : ?>
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <i class="flaticon-mail"></i>
                                        </div>
                                        <a href="mailto:<?php echo (get_post_meta( get_the_id(), 'team_email', true ));?>"><?php echo (get_post_meta( get_the_id(), 'team_email', true ));?></a>
                                    </div>
                                </li>
                                <?php endif; ?>
    
                                <?php
                                    $icons = get_post_meta(get_the_id(), 'social_media_tabs', true); if ($icons) : 
                                ?>
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <i class="flaticon-share"></i>
                                        </div>
                                        <div class="social-links">
                                            <?php
                                                for ( $i=0; $i < count( $icons['select_social_media'] ); $i++ ) {
                                                $social_icon = ( isset( $icons['select_social_media'][$i] ) && !empty( $icons['select_social_media'][$i] ) ) ? $icons['select_social_media'][$i] : '';
                                                $social_link = ( isset( $icons['link_social_media'][$i] ) && !empty( $icons['link_social_media'][$i] ) ) ? $icons['link_social_media'][$i] : '';
                                            ?>
                                            <a href="<?php echo esc_url($social_link); ?>"><i class="<?php echo esc_attr(str_replace("icon ", " ", $social_icon)); ?>"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                                <?php endif; ?>
    
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Team Details Style1-->


<?php endwhile; ?>

<?php get_footer(); ?>