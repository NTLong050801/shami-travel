<?php if ( ! $disable_review_sec == 1 ) { ?>

<div class="tf-review-wrapper tf-template-section" id="tf-review">
    <!-- Tourfic review features ratting -->
    <div class="tf-average-review">
        <div class="tf-section-head">
            <h3><?php echo !empty($meta['review-section-title']) ? esc_html($meta['review-section-title']) : ''; ?></h3>
        </div>
    </div>
    
    <?php comments_template(); ?>
    
</div>
<?php } ?>