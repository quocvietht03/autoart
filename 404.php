<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header(); ?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<h2><?php esc_html_e('404 Error', 'autoart'); ?></h2>
			<h3><?php esc_html_e('Sorry! The Page Not Found ;(', 'autoart'); ?></h3>
			<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'autoart'); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>
