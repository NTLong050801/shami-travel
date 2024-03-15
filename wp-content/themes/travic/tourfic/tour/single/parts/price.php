<div class="te-price__wrap">
    <?php if(($tf_booking_type == 2 && $tf_hide_price !== '1') || $tf_booking_type == 1 || $tf_booking_type == 3) : ?>
        <div class="tf-single-tour-pricing te-single-tour__pricing">
            <?php if ( $pricing_rule == 'group' ) { ?>
                <h3 class="te-detail__price"><?php echo wp_kses_post( $tour_price->wc_sale_group ) ? wp_kses_post( $tour_price->wc_sale_group ) : wp_kses_post( $tour_price->wc_group ); ?></h3>
            <?php } elseif ( $pricing_rule == 'person' ) { ?>

                <?php if ( ! $disable_adult && ! empty( $tour_price->adult ) ) { ?>

                    <h3 class="te-detail__price">
                        <?php echo wp_kses_post( $tour_price->wc_sale_adult ) ? wp_kses_post( $tour_price->wc_sale_adult ) : wp_kses_post( $tour_price->wc_adult ); ?>
                    </h3>

                <?php }
                if ( ! $disable_child && ! empty( $tour_price->child ) ) { ?>

                    <h3 class="te-detail__price">
                        <?php echo wp_kses_post( $tour_price->wc_sale_child ) ? wp_kses_post( $tour_price->wc_sale_child ) : wp_kses_post( $tour_price->wc_child ); ?>
                    </h3>
                    
            <?php }
            if ( !$disable_adult && (! $disable_infant && ! empty( $tour_price->infant )) ) { ?>

                    <h3 class="te-detail__price">
                        <?php echo wp_kses_post( $tour_price->wc_sale_infant ) ? wp_kses_post( $tour_price->wc_sale_infant ) : wp_kses_post( $tour_price->wc_infant ); ?>
                    </h3>
                    
                <?php } ?>
                <?php
            }
            ?>
            <ul class="tf-price-tab m-0 border-0">
                <?php
                if ( $pricing_rule == 'group' ) {

                    echo '<li id="group" class="active theme-btn btn-one">' . esc_html__( "Group", "travic" ) . '</li>';

                } elseif ( $pricing_rule == 'person' ) {

                if ( ! $disable_adult && ! empty( $tour_price->adult ) ) {
                    echo '<li id="adult" class="active theme-btn btn-one">' . esc_html__( "Adult", "travic" ) . '</li>';
                }
                if ( ! $disable_child && ! empty( $tour_price->child ) ) {
                    echo '<li id="child" class="theme-btn btn-one">' . esc_html__( "Child", "travic" ) . '</li>';
                }
                if ( !$disable_adult && (! $disable_infant && ! empty( $tour_price->infant )) ) {
                    echo '<li id="infant" class="theme-btn btn-one">' . esc_html__( "Infant", "travic" ) . '</li>';
                }

                }
                ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if ($tf_booking_type == 2 && $tf_hide_booking_form == 1):?>
        <a href="<?php echo esc_url($tf_booking_url) ?>" target="_blank" class="tf_button btn-styled" style="margin-left: 16px;"><?php esc_html_e('Book now', 'travic'); ?></a>
    <?php endif; ?>
    
</div>