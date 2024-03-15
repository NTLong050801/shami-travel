<?php if ( $highlights ) : ?>
<div class="te_heglights mt_40">
    <h3><?php echo !empty($meta['highlights-section-title']) ? esc_html($meta['highlights-section-title']) : 'Top Highlights'; ?></h3>
    <?php echo wp_kses_post( $highlights ); ?>
    <?php if ( ! empty( $meta['hightlights_thumbnail'] ) ): ?>
    <div class="image-box__detail">
        <a href="<?php echo esc_url( $meta['hightlights_thumbnail'] ); ?>" data-fancybox="details">
            <img src="<?php echo esc_url( $meta['hightlights_thumbnail'] ); ?>" alt="details" class="w-full">
        </a>
    </div>
    <?php endif; ?>
</div>
<?php endif;?>