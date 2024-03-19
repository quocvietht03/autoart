<?php

/* Add Theme Options Page */
function autoart_add_theme_options_page() {
    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page(array(
            'page_title'    => esc_html__('Theme Options', 'autoart'),
            'menu_title'    => esc_html__('Theme Options', 'autoart'),
            'menu_slug'     => 'theme-options-page',
            'capability'    => 'edit_posts',
            'redirect'      => false
      ));
    }
}
add_action('acf/init', 'autoart_add_theme_options_page');

add_filter( 'acf/settings/save_json', 'autoart_acf_json_save_point' );
function autoart_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/framework/acf-options';

	// return
	return $path;
}

add_filter( 'acf/settings/load_json', 'autoart_acf_json_load_point' );
function autoart_acf_json_load_point( $paths ) {
	// reautoartve original path (optional)
	unset( $paths[0] );
	// append path
	$paths[] = get_stylesheet_directory() . '/framework/acf-options';

	// return
	return $paths;
}