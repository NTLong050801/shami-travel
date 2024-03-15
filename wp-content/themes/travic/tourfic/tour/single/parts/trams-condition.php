<?php
if($terms_and_conditions){ ?>
<!-- Tourfic tour Terms and conditions -->
<div class="tf-toc-wrapper tf-template-section pt-8">
    <h3 class="tf-title tf-section-title"><?php echo !empty($meta['tc-section-title']) ? esc_html($meta['tc-section-title']) : ''; ?></h3>
    <?php echo wpautop( $terms_and_conditions ); ?>
</div>
<?php } ?>