<?php
/* Register Sidebar */
if (!function_exists('autoart_register_sidebar')) {
	function autoart_register_sidebar()
	{
		register_sidebar(array(
			'name' => esc_html__('Main Sidebar', 'autoart'),
			'id' => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
	}
	add_action('widgets_init', 'autoart_register_sidebar');
}

/* Add Support Upload Image Type SVG */
function autoart_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'autoart_mime_types');

/* Register Default Fonts */
if (!function_exists('autoart_fonts_url')) {
	function autoart_fonts_url()
	{
		global $autoart_options;
		$base_font = 'Muli';
		$head_font = 'Montserrat';

		$font_url = '';
		if ('off' !== _x('on', 'Google font: on or off', 'autoart')) {
			$font_url = add_query_arg('family', urlencode($base_font . ':400,400i,600,700|' . $head_font . ':400,400i,500,600,700'), "//fonts.googleapis.com/css");
		}
		return $font_url;
	}
}
/* Enqueue Script */
if (!function_exists('autoart_enqueue_scripts')) {
	function autoart_enqueue_scripts()
	{
		global $autoart_options;

		if (is_singular('car') || is_singular('product')) {
			wp_enqueue_script('slick-slider', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), '', true);
			wp_enqueue_style('slick-slider', get_template_directory_uri() . '/assets/libs/slick/slick.css', array(), false);

			wp_enqueue_script('zoom-master', get_template_directory_uri() . '/assets/libs/zoom-master/jquery.zoom.min.js', array('jquery'), '', true);
		}
		if (is_post_type_archive('car')) {
			wp_enqueue_script('nouislider', get_template_directory_uri() . '/assets/libs/nouislider/nouislider.min.js', array('jquery'), '', true);
			wp_enqueue_style('nouislider', get_template_directory_uri() . '/assets/libs/nouislider/nouislider.min.css', array(), false);
		}
		wp_enqueue_script('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.js', array('jquery'), '', true);
		wp_enqueue_style('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.css', array(), false);

		/* Style */
		wp_enqueue_style('autoart-fonts', autoart_fonts_url(), false);
		wp_enqueue_style('autoart-main', get_template_directory_uri() . '/assets/css/main.css',  array(), rand(9, 999999));
		wp_enqueue_style('autoart-style', get_template_directory_uri() . '/style.css',  array(), false);
		wp_enqueue_script('autoart-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), rand(9, 999999), true);

		if (function_exists('get_field')) {
			$dev_mode = get_field('dev_mode', 'options');
			/* Load custom style */
			$custom_style = '';

			$custom_style = get_field('custom_css_code', 'options');
			if ($dev_mode && !empty($custom_style)) {
				wp_add_inline_style('autoart-style', $custom_style);
			}

			/* Custom script */
			$custom_script = '';
			$custom_script = get_field('custom_js_code', 'options');
			if ($dev_mode && !empty($custom_script)) {
				wp_add_inline_script('autoart-main', $custom_script);
			}
		}
		/* Options to script */
		$js_options = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'user_info' => wp_get_current_user(),
		);
		wp_localize_script('autoart-main', 'AJ_Options', $js_options);
		wp_enqueue_script('autoart-main');
	}
	add_action('wp_enqueue_scripts', 'autoart_enqueue_scripts');
}

/* Add Stylesheet And Script Backend */
if (!function_exists('autoart_enqueue_admin_scripts')) {
	function autoart_enqueue_admin_scripts()
	{
		wp_enqueue_script('autoart-admin-main', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery'), '', true);
		wp_enqueue_style('autoart-admin-main', get_template_directory_uri() . '/assets/css/admin-main.css', array(), false);
	}
	add_action('admin_enqueue_scripts', 'autoart_enqueue_admin_scripts');
}

/**
 * Theme install
 */
require_once get_template_directory() . '/install/plugin-required.php';
require_once get_template_directory() . '/install/import-pack/import-functions.php';

/* CPT Load */
require_once get_template_directory() . '/framework/cpt-car.php';
require_once get_template_directory() . '/framework/cpt-dealer.php';

/* ACF Options */
require_once get_template_directory() . '/framework/acf-options.php';

/* Add Comment Rating */
require_once get_template_directory() . '/framework/comment-rating.php';

/* Template functions */
require_once get_template_directory() . '/framework/template-helper.php';

/* Post Functions */
require_once get_template_directory() . '/framework/templates/post-helper.php';

/* Block Load */
require_once get_template_directory() . '/framework/block-load.php';

/* Widgets Load */
require_once get_template_directory() . '/framework/widget-load.php';

/* Woocommerce functions */
if (class_exists('Woocommerce')) {
	require_once get_template_directory() . '/woocommerce/shop-helper.php';
}

if (function_exists('get_field')) {
	/* Orbit circle effect */
	function autoart_body_class($classes)
	{
		$orbit_circle = get_field('effect_orbit_circle', 'options');
		$bg_pattern = get_field('effect_bg_pattern', 'options');
		$bg_buble = get_field('effect_bg_buble', 'options');
		$bg_scroll = get_field('effect_bg_scroll', 'options');
		$img_zoom = get_field('effect_img_zoom', 'options');

		if ($orbit_circle) {
			$classes[] = 'bt-orbit-enable';
		}

		if ($bg_pattern) {
			$classes[] = 'bt-bg-pattern-enable';
		}

		if ($bg_buble) {
			$classes[] = 'bt-bg-buble-enable';
		}

		if ($bg_scroll) {
			$classes[] = 'bt-bg-scroll-enable';
		}

		if ($img_zoom) {
			$classes[] = 'bt-img-zoom-enable';
		}

		return $classes;
	}
	add_filter('body_class', 'autoart_body_class');
}

// Custom js Gravity
add_action('gform_register_init_scripts', 'bt_custom_gform_init_script', 10, 2);
function bt_custom_gform_init_script($form, $field_values)
{
	$script = "
	function LoadJsCustom() {
		if (jQuery('select.gfield_select').length > 0) {
			jQuery('select.gfield_select').select2();
		}
		var dropdownIcon = '<svg width=\"14\" height=\"8\" viewBox=\"0 0 14 8\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">' +
						   '<path d=\"M1.23061 0.901437C0.872656 1.2594 0.872656 1.83984 1.23061 2.1978L5.71522 6.67791C6.43123 7.39328 7.59155 7.393 8.30728 6.67736L12.7901 2.1945C13.1481 1.83654 13.1481 1.2561 12.7901 0.898128C12.4321 0.540142 11.8517 0.540142 11.4937 0.898128L7.65691 4.73495C7.29895 5.093 6.71851 5.093 6.36056 4.73495L2.52696 0.901437C2.16901 0.543451 1.58867 0.543451 1.23061 0.901437Z\"/>' +
						   '</svg>';
		jQuery('.select2-selection__arrow').html(dropdownIcon);
	}
	LoadJsCustom(); 
    ";
	// Add the initialization script to Gravity Form
	GFFormDisplay::add_init_script($form['id'], 'bt_custom_gform', GFFormDisplay::ON_PAGE_RENDER, $script);

	// add an AJAX complete
	$complete_script = "
        jQuery(document).ajaxComplete(function(event, xhr, settings) {
            if (settings.url === '" . admin_url('admin-ajax.php') . "') {
                LoadJsCustom(); 
            }
        });
    ";
	GFFormDisplay::add_init_script($form['id'], 'bt_custom_gform_ajax', GFFormDisplay::ON_PAGE_RENDER, $complete_script);
}
