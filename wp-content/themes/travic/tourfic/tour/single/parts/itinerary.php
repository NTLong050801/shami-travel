<!-- Travel Itinerary section Start -->
<?php
if ( function_exists('is_tf_pro') && is_tf_pro() ) {
	do_action( 'after_itinerary_builder', $itineraries, $itinerary_map );
} else {
	?>
	<!-- Travel Itinerary section Start -->
	<?php if ( $itineraries ) { ?>
		
		<div class="tour-plans pb_60 mb_55 border-bottom">
            <h3><?php echo !empty($meta['itinerary-section-title']) ? esc_html($meta['itinerary-section-title']) : ''; ?></h3>
            <div class="te_desc"><?php the_excerpt();?></div>
            
            <ul class="accordion-box mt_35 te-detail__accordian">
                <?php $i = 1; foreach ( $itineraries as $key => $itinerary ) {?>
                <li class="accordion block active-block">
                    <div class="acc-btn <?php if( $i == 1 ) echo 'active';?>">
                        <div class="icon-box"></div>
                        <span><?php echo esc_html( $itinerary['time'] ) ?></span>
                        <h4><?php echo esc_html( $itinerary['title'] ); ?></h4>
                    </div>
                    <div class="acc-content <?php if( $i == 1 ) echo 'current';?>">
                        <div class="text">
                            <p><?php wp_kses( $itinerary['desc'], true ); ?></p>
                        </div>
                        <?php if ( $itinerary['image'] ) {?>
                        <div class="acc-img__box">
                            <a href="<?php echo esc_url( $itinerary['image'] ); ?>" data-fancybox="details">
                                <img src="<?php echo esc_url( $itinerary['image'] ); ?>" alt="details" class="w-full">
                            </a>
                        </div>
                        <?php };?>
                    </div>
                </li>
                <?php $i++; } ?>
            </ul>
        </div>
			
		<?php if ( $location && $itinerary_map != 1 ): ?>
            <div id="tour-map" class="tour-map pb_60 mb_55 border-bottom">
                <div class="tf-container__none">
                    <h3 class="tf-title tf-section-title"><?php echo !empty($meta['map-section-title']) ? esc_html($meta['map-section-title']) : ''; ?></h3>
                    <div class="tf-row map-inner">
                        <?php if ( $tf_openstreet_map=="default" && !empty($location_latitude) && !empty($location_longitude) && empty($tf_google_map_key) ) {  ?>
                            <div id="tour-location" style="height: 500px;"></div>
                            <script>
                            const map = L.map('tour-location').setView([<?php echo esc_attr( $location_latitude ); ?>, <?php echo esc_attr( $location_longitude ); ?>], <?php echo esc_attr( $location_zoom ); ?>);

                            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 20,
                                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            const marker = L.marker([<?php echo esc_attr( $location_latitude ); ?>, <?php echo esc_attr( $location_longitude ); ?>], {alt: '<?php echo esc_attr( $location ); ?>'}).addTo(map)
                                .bindPopup('<?php echo esc_attr( $location ); ?>');
                            </script>
                        <?php } ?>
                        <?php if ( $tf_openstreet_map=="default" && (empty($location_latitude) || empty($location_longitude)) && empty($tf_google_map_key) ) {  ?>
                            <iframe src="https://maps.google.com/maps?q=<?php echo esc_attr( str_replace( "#", "", $location ) ); ?>&output=embed" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <?php } ?>
                        <?php if( $tf_openstreet_map!="default" && !empty($tf_google_map_key) ){ ?>
                        <iframe src="https://maps.google.com/maps?q=<?php echo esc_attr( str_replace( "#", "", $location ) ); ?>&output=embed" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	<?php
	}
} 
?>
<!-- Travel Itinerary section End -->