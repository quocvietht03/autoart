<?php
/*
 * Single Car
 */

get_header();
get_template_part( 'framework/templates/site', 'titlebar');

$layout = get_field('car_layout');
$layout = !empty($layout) ? $layout : 'style1';

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss <?php echo 'bt-layout-' . $layout; ?>">
    <div class="bt-container">
	    <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'framework/templates/car-single', $layout);
        endwhile;
      ?>
    </div>
	</div>

	<?php get_template_part( 'framework/templates/car', 'related-posts'); ?>
</main><!-- #main -->

<?php get_footer(); ?>
