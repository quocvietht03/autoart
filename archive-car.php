<?php
get_header();
get_template_part( 'framework/templates/site', 'titlebar');

$limit = 1;
$query_args = autoart_cars_query_args($_GET, $limit);
$wp_query = new \WP_Query($query_args);
$current_page = isset($_GET['current_page']) && $_GET['current_page'] != '' ? $_GET['current_page'] : 1;
$total_page = $wp_query->max_num_pages;

$paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
$prev_posts = ( $paged - 1 ) * $wp_query->query_vars['posts_per_page'];
$from = 1 + $prev_posts;
$to = count( $wp_query->posts ) + $prev_posts;
$of = $wp_query->found_posts;

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<div class="bt-filter-scroll-pos"></div>

			<div class="bt-main-post-row">
				<div class="bt-main-post-col">
					<div class="bt-car-sidebar-toggle">
						<div class="bt-car-sidebar-toggle--inner">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 250.993 250.993" fill="currentColor">
								<path d="M242.697 69.229c-.878 0-1.778.126-2.677.373l-10.171 2.802-10.563-25.729c-2.993-7.289-11.837-13.219-19.717-13.219h-98.851c-7.879 0-16.724 5.93-19.717 13.219L70.454 72.369 60.41 69.602a10.076 10.076 0 0 0-2.677-.373c-4.807 0-8.296 3.672-8.296 8.733v5.996c0 .262.021.518.039.775a60.48 60.48 0 0 0-6.627 5.73c-11.249 11.249-17.444 26.204-17.444 42.112 0 12.896 4.073 25.167 11.608 35.343L2.611 202.322a8.913 8.913 0 0 0 0 12.605 8.881 8.881 0 0 0 6.302 2.611c2.281 0 4.562-.87 6.302-2.611l34.404-34.404c10.177 7.536 22.447 11.609 35.343 11.609 15.908 0 30.864-6.195 42.112-17.444a59.881 59.881 0 0 0 9.262-11.956h73.987v12.765c0 5.906 4.805 10.711 10.711 10.711h13.989c5.906 0 10.711-4.805 10.711-10.711V124.38c0-7.32-2.262-18.786-5.042-25.558l-1.705-4.153h1.292c5.906 0 10.711-4.805 10.711-10.712v-5.996c.003-5.06-3.486-8.732-8.293-8.732zM94.112 49.933c1.79-4.36 7.11-7.927 11.824-7.927h88.418c4.713 0 10.034 3.567 11.824 7.927l15.977 38.919c1.79 4.36-.602 7.927-5.315 7.927h-84.277a60.394 60.394 0 0 0-5.487-6.316c-11.249-11.249-26.204-17.444-42.112-17.444-.111 0-.22.007-.331.008l9.479-23.094zm-9.15 124.372c-11.146 0-21.626-4.341-29.508-12.223-7.882-7.881-12.222-18.36-12.222-29.507s4.341-21.626 12.222-29.508c7.882-7.881 18.361-12.222 29.508-12.222s21.626 4.341 29.508 12.222c7.882 7.882 12.222 18.361 12.222 29.507 0 11.147-4.34 21.626-12.222 29.508-7.882 7.882-18.361 12.223-29.508 12.223zm140.158-36.226a4.297 4.297 0 0 1-4.285 4.285h-30.351a4.298 4.298 0 0 1-4.285-4.285v-14.566a4.298 4.298 0 0 1 4.285-4.285h30.351a4.297 4.297 0 0 1 4.285 4.285v14.566z">
								</path>
							</svg>
						  <span>
								<?php echo esc_html__('Search Options', 'autoart'); ?>
							</span>
						</div>

					</div>

					<?php get_template_part( 'framework/templates/car', 'topbar', array('from' => $from, 'to' => $to, 'of' => $of)); ?>

					<div class="bt-filter-results">
						<?php
	            if ( $wp_query->have_posts() ) {
								?>
								<div class="bt-car-layout <?php echo isset($_GET['view_type']) && $_GET['view_type'] != '' ? 'bt-view-' . $_GET['view_type'] : 'bt-view-grid' ?>" data-limit="<?php echo esc_attr($limit); ?>">
									<?php
			              while ( $wp_query->have_posts() ) { $wp_query->the_post();
			                get_template_part( 'framework/templates/car', 'style', array('image-size' => 'medium_large'));
			              }
									?>
								</div>

								<div class="bt-car-pagination-wrap">
									<?php echo autoart_cars_pagination($current_page, $total_page); ?>
								</div>
								<?php
	            } else {
	              echo '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
	            }

	            wp_reset_postdata();
						?>
					</div>
				</div>

				<div class="bt-sidebar-col">
					<?php get_template_part( 'framework/templates/car', 'sidebar'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'framework/templates/social', 'media-channels'); ?>
</main><!-- #main -->

<?php get_footer(); ?>
