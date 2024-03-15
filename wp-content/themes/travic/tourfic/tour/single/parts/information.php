<?php if ( $tour_duration || $location || $group_size || $language ) { ?>
<ul class="info-list clearfix">
	<?php if ( $tour_duration ) { ?>
	<li>
		<i class="icon-1"></i> 
		<span><?php esc_html_e( 'Duration', 'travic' );?></span>
		<h4>
			<?php echo esc_html( $tour_duration ); ?> 
            <?php
                if( $tour_duration > 1  ){
                    $dur_string = 's';
                    $duration_time_html = $duration_time . $dur_string;
                }else{
                    $duration_time_html = $duration_time;
                }
                echo " " . esc_html( $duration_time_html );
            ?>
            
            <?php echo esc_html( $night_count ); ?>
            <?php
                if(!empty($night_count)){
                    if( $night_count > 1  ){
                        echo esc_html__( 'Nights', 'travic' );
                    }else{
                        echo esc_html__( 'Night', 'travic'  );
                    }	
                }										
            ?>
        </h4>
		
	</li>
	<?php };?>
	
	<?php if ( $group_size ) { ?>
		<li> 
			<i class="icon-11"></i><span><?php esc_html_e( 'Max People :', 'travic' );?></span> <h4><?php echo esc_html( $group_size ); ?></h4>
		</li>
	<?php } ?>
	
	<?php if ( $language ) { ?>
		<li>
			<i class="far fa-language "></i>
            <span><?php esc_html_e( 'Language', 'travic' );?></span>
			<h4><?php echo esc_html( $language ) ?></h4>
		</li>
	<?php } ?>
	
    <?php if ( $location ) {?>
	<li class="tf-map-link" id="tf-map-location" data-location="<?php echo esc_attr( $location ) ?>">
		<i class="icon-22"></i>
        <span><?php esc_html_e( 'Tour Type', 'travic' );?></span>
        <h4><a href="#tour-map"><?php echo wp_kses( $location, true );?></a></h4>
	</li>
    <?php };?>
</ul>
<?php };?>