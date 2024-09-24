<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');
get_template_part('framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content">
		<div class="bt-main-products-ss">
			<div class="bt-container">
				<?php
				if (woocommerce_product_loop()) {


					woocommerce_product_loop_start();

					if (wc_get_loop_prop('total')) {
						while (have_posts()) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action('woocommerce_shop_loop');

							wc_get_template_part('content', 'product');
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action('woocommerce_after_shop_loop');
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action('woocommerce_no_products_found');
				}

				?>
			</div>
		</div>

		<?php
		if (function_exists('get_field')) {
			$banner = get_field('what_we_offer', 'options');
			if (!empty($banner)) {
				$id_template = $banner->ID;
				echo do_shortcode('[elementor-template id="' . $id_template . '"]');
			}
		}
		?>
	</div>
</main>
<?php
get_footer('shop');
