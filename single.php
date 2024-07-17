<?php
/*
 * Single Post
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');

?>

<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<div class="bt-main-post-row">
				<div class="bt-main-post-col">
					<?php
					while (have_posts()) : the_post();
					?>
						<div class="bt-main-post">
							<?php get_template_part('framework/templates/post'); ?>
						</div>
						<div class="bt-infor-tags-share">
							<?php
							echo autoart_tags_render();
							echo autoart_share_render();
							?>
						</div>
					<?php
						echo autoart_author_render();
						// autoart_post_nav();

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) comments_template();
					endwhile;
					?>
				</div>
				<div class="bt-sidebar-col">
					<div class="bt-sidebar">
						<?php if (is_active_sidebar('main-sidebar')) echo get_sidebar('main-sidebar'); ?>
					</div>
				</div>
			</div>
			<?php echo autoart_related_posts(); ?>
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