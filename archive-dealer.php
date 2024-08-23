<?php
get_header();
get_template_part('framework/templates/site', 'titlebar');
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<?php
			if (have_posts()) {
			?>
				<div class="bt-list-dealer">
					<?php
					while (have_posts()) {
						the_post();
						get_template_part('framework/templates/dealer', 'style', array('image-size' => 'large'));
					}
					?>
				</div>


			<?php
				autoart_paging_nav();
			} else {
				echo '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
			}

			wp_reset_postdata();
			?>
		</div>
	</div>

	<?php
	if (function_exists('get_field')) {
		$banner = get_field('dealer_banner_contact', 'options');
		if (!empty($banner)) {
			$id_template = $banner->ID;
			echo do_shortcode('[elementor-template id="' . $id_template . '"]');
		}
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>