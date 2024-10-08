<?php
get_header();
get_template_part('framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container bt-container-search">
			<?php
			if (have_posts()) {
			?>
				<div class="bt-list-post">
					<?php
					while (have_posts()) : the_post();
						get_template_part('framework/templates/post');
					endwhile;
					?>
				</div>
			<?php
				autoart_paging_nav();
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
	</div>

	<?php
	if (function_exists('get_field')) {
		$banner = get_field('banner_sell_buy', 'options');
		if (!empty($banner)) {
			$id_template = $banner->ID;
			echo do_shortcode('[elementor-template id="' . $id_template . '"]');
		}
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>