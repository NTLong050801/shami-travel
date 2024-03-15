<?php if ( $inc || $exc ) :?>
<div class="inc-exc__wrap mt_40">
    <h3><?php esc_html_e( 'Included and Excluded', 'travic' );?></h3>
    <div class="list-inner">
        <div class="row clearfix">
            <?php if ( $inc ) { ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 list-column <?php echo esc_attr( $custom_inc_icon ); ?>">
                <ul class="list-one clearfix">
                    <?php foreach ( $inc as $key => $val ) {?>
                    <li><i class="<?php echo esc_attr( $inc_icon );?>"></i> <?php echo wp_kses( $val['inc'], true );?></li>
                    <?php };?>
                </ul>
            </div>
            
            <?php };?>
            
            <?php if ( $exc ) { ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 list-column <?php echo esc_attr( $custom_exc_icon ); ?>">
                <ul class="list-two clearfix">
                    <?php foreach ( $exc as $key => $val ) {?>
                    <li><i class="<?php echo esc_attr( $exc_icon );?>"></i> <?php echo wp_kses( $val['exc'], true );?></li>
                    <?php };?>
                </ul>
            </div>
            
            <?php };?>
        </div>
    </div>
</div>
<?php endif;?>