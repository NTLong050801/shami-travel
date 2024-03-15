<div class="te-title__box">
    <h2><?php the_title(); ?></h2>
    <div class="d-flex align-items-center review-box">
        <?php if ( ! $disable_review_sec == '1' ) { ?>
            <?php
            if($comments){ ?>
            <a href="#tf-review" class="rating-box p-0">
                <i class="far fa-star"></i>
                <span class="te-cmt__text"><?php echo tf_total_avg_rating( $comments ); ?></span> <span class="te-comt__count">(<?php tf_based_on_text( count( $comments ) ); ?>)</span>
            </a>
            <?php }else{ ?>
                <a href="#tf-review" class="rating-box">
                    <i class="far fa-star"></i>
                    <span class="te-cmt__text"><?php _e( "0.0", "travic" ) ?></span> <span class="te-comt__count">(<?php _e( "0 review", "travic" ) ?>)</span>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
</div>