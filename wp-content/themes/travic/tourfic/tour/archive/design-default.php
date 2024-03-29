<div class="tf-main-wrapper" data-fullwidth="true">
	<?php
		do_action( 'tf_before_container' );
	?>
	<div class="container">
		<?php 
		$tf_defult_views = ! empty( tf_data_types(tfopt( 'tf-template' ))['tour_archive_view'] ) ? tf_data_types(tfopt( 'tf-template' ))['tour_archive_view'] : 'list';
		?>
		<div class="search-result-inner">
			<!-- Start Content -->
			<div class="tf-search-left">				
				<div class="tf-action-top">
					<div class="tf-result-counter-info">
						<span class="tf-counter-title"><?php echo esc_html_e( 'Total Results', 'travic' ); ?> </span>
						<span><?php echo '('; ?> </span>
						<div class="tf-total-results">
							<span><?php echo wp_kses( $tf_total_results, true ); ?> </span>
						</div>
						<span><?php echo ')'; ?> </span>
					</div>
		            <div class="tf-list-grid">
		                <a href="#list-view" data-id="list-view" class="change-view <?php echo esc_attr( $tf_defult_views=="list" ) ? esc_attr('active') : ''; ?>" title="<?php esc_attr_e('List View', 'travic'); ?>"><i class="fas fa-list"></i></a>
		                <a href="#grid-view" data-id="grid-view" class="change-view <?php echo esc_attr( $tf_defult_views=="grid" ) ? esc_attr('active') : ''; ?>" title="<?php esc_attr_e('Grid View', 'travic'); ?>"><i class="fas fa-border-all"></i></a>
		            </div>
		        </div>
				<div class="archive_ajax_result <?php echo esc_attr( $tf_defult_views=="grid" ) ? esc_attr('tours-grid') : '' ?>">
					<?php
					if ( $loop->have_posts() ) {          
						while ( $loop->have_posts() ) {
							$loop->the_post();
							tf_tour_archive_single_item();
							$tf_total_results+=1;
						}
					} else {
						echo '<div class="tf-nothing-found" data-post-count="0" >' .__("No Tours Found!", "travic"). '</div>';
					}
					?>
					<span class="tf-posts-count" hidden="hidden">
					<?php echo wp_kses( $tf_total_results, true ); ?>
					</span>
					<div class="tf_posts_navigation">
						<?php tourfic_posts_navigation(); ?>
					</div>
				</div>
				

			</div>
			<!-- End Content -->

			<!-- Start Sidebar -->
			<div class="tf-search-right">
				<?php tf_archive_sidebar_search_form('tf_tours'); ?>
			</div>
			<!-- End Sidebar -->
		</div>
	</div>
	<?php do_action( 'tf_after_container' ); ?>
</div>