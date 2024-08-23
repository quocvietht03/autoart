<?php
/*
 * Dealer CPT
 */

function autoart_dealer_register()
{

	$cpt_slug = get_theme_mod('autoart_dealer_slug');

	if (isset($cpt_slug) && $cpt_slug != '') {
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'dealer';
	}

	$labels = array(
		'name'               => esc_html__('Dealers', 'autoart'),
		'singular_name'      => esc_html__('Dealer', 'autoart'),
		'add_new'            => esc_html__('Add New', 'autoart'),
		'add_new_item'       => esc_html__('Add New Dealer', 'autoart'),
		'all_items'          => esc_html__('All Dealers', 'autoart'),
		'edit_item'          => esc_html__('Edit Dealer', 'autoart'),
		'new_item'           => esc_html__('Add New Dealer', 'autoart'),
		'view_item'          => esc_html__('View Item', 'autoart'),
		'search_items'       => esc_html__('Search Dealers', 'autoart'),
		'not_found'          => esc_html__('No dealer(s) found', 'autoart'),
		'not_found_in_trash' => esc_html__('No dealer(s) found in trash', 'autoart')
	);

	$args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive' => true,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'show_in_rest' 		=> true,
		'supports'        => array('title', 'editor', 'thumbnail', 'comments')
	);

	add_filter('enter_title_here',  'autoart_dealer_change_default_title');

	register_post_type('dealer', $args);
}
add_action('init', 'autoart_dealer_register', 1);


function autoart_dealer_taxonomy()
{

	register_taxonomy(
		"dealer_categories",
		array("dealer"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
		'dealer_tag',
		'dealer',
		array(
			'hierarchical'  => false,
			'label'         => __('Tags', 'autoart'),
			'singular_name' => __('Tag', 'autoart'),
			'rewrite'       => true,
			'query_var'     => true
		)
	);
}
add_action('init', 'autoart_dealer_taxonomy', 1);


function autoart_dealer_change_default_title($title)
{
	$screen = get_current_screen();

	if ('dealer' == $screen->post_type)
		$title = esc_html__("Enter the dealer's name here", 'autoart');

	return $title;
}


function autoart_dealer_edit_columns($dealer_columns)
{
	$dealer_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'autoart'),
		"thumbnail"              => esc_html__('Thumbnail', 'autoart'),
		"dealer_categories" 			 => esc_html__('Categories', 'autoart'),
		"date"                   => esc_html__('Date', 'autoart'),
	);
	return $dealer_columns;
}
add_filter('manage_edit-dealer_columns', 'autoart_dealer_edit_columns');

function autoart_dealer_column_display($dealer_columns, $post_id)
{

	switch ($dealer_columns) {

			// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);

			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
			}
			if (isset($thumb)) {
				echo wp_kses_post($thumb);
			} else {
				echo esc_html__('None', 'autoart');
			}
			break;

			// Display the dealer tags in the column view
		case "dealer_categories":

			if ($category_list = get_the_term_list($post_id, 'dealer_categories', '', ', ', '')) {
				echo wp_kses_post($category_list);
			} else {
				echo esc_html__('None', 'autoart');
			}
			break;
	}
}
add_action('manage_dealer_posts_custom_column', 'autoart_dealer_column_display', 10, 2);
