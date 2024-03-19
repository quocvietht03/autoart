<?php
get_header();
get_template_part( 'framework/templates/site', 'titlebar');

$query_args = autoart_cars_query_args($_GET, $limit = 12);
$wp_query = new \WP_Query($query_args);
$current_page = isset($_GET['current_page']) && $_GET['current_page'] != '' ? $_GET['current_page'] : 1;
$total_page = $wp_query->max_num_pages;

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<?php get_template_part( 'framework/templates/car', 'search-box'); ?>

			<div class="bt-main-post-row">
				<div class="bt-main-post-col">
					<?php get_template_part( 'framework/templates/car', 'topbar'); ?>

					<?php get_template_part( 'framework/templates/car', 'chosen-units'); ?>

					<div class="bt-filter-results <?php echo isset($_GET['view_type']) && $_GET['view_type'] != '' ? 'bt-view-' . $_GET['view_type'] : 'bt-view-grid' ?>">
						<?php
	            if ( $wp_query->have_posts() ) {
	              while ( $wp_query->have_posts() ) { $wp_query->the_post();
	                get_template_part( 'framework/templates/car', 'style', array('image-size' => 'medium_large'));
	              }

	              echo autoart_cars_pagination($current_page, $total_page);
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
