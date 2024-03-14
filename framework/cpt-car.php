<?php
/*
 * Car CPT
 */

function autoart_car_register() {

	$cpt_slug = get_theme_mod('autoart_car_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'car';
	}

	$labels = array(
		'name'               => esc_html__( 'Cars', 'autoart' ),
		'singular_name'      => esc_html__( 'Car', 'autoart' ),
		'add_new'            => esc_html__( 'Add New', 'autoart' ),
		'add_new_item'       => esc_html__( 'Add New Car', 'autoart' ),
		'all_items'          => esc_html__( 'All Cars', 'autoart' ),
		'edit_item'          => esc_html__( 'Edit Car', 'autoart' ),
		'new_item'           => esc_html__( 'Add New Car', 'autoart' ),
		'view_item'          => esc_html__( 'View Item', 'autoart' ),
		'search_items'       => esc_html__( 'Search Cars', 'autoart' ),
		'not_found'          => esc_html__( 'No car(s) found', 'autoart' ),
		'not_found_in_trash' => esc_html__( 'No car(s) found in trash', 'autoart' )
	);

  $args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'supports'        => array('title', 'editor')
  );

  add_filter( 'enter_title_here',  'autoart_car_change_default_title');

  register_post_type( 'car' , $args );
}
add_action('init', 'autoart_car_register', 1);


function autoart_car_taxonomy() {
  register_taxonomy(
		"car_body",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Body', 'autoart' ),
			"singular_label" => __( 'Body', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_condition",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Condition', 'autoart' ),
			"singular_label" => __( 'Condition', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_make",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Make', 'autoart' ),
			"singular_label" => __( 'Make', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_model",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Model', 'autoart' ),
			"singular_label" => __( 'Model', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_fuel_type",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Fuel Type', 'autoart' ),
			"singular_label" => __( 'Fuel Type', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_trans",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Transmission', 'autoart' ),
			"singular_label" => __( 'Transmission', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_drive",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Drive', 'autoart' ),
			"singular_label" => __( 'Drive', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_engine",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Engine', 'autoart' ),
			"singular_label" => __( 'Engine', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_ex_color",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Exterior Color', 'autoart' ),
			"singular_label" => __( 'Exterior Color', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_in_color",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __( 'Interior Color', 'autoart' ),
			"singular_label" => __( 'Interior Color', 'autoart' ),
			"rewrite"        => true
		)
	);

  register_taxonomy(
		"car_categories",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
      'car_tag',
      'car',
      array(
          'hierarchical'  => false,
          'label'         => __( 'Tags', 'autoart' ),
          'singular_name' => __( 'Tag', 'autoart' ),
          'rewrite'       => true,
          'query_var'     => true
      )
  );

}
add_action('init', 'autoart_car_taxonomy', 1);


function autoart_car_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'car' == $screen->post_type )
		$title = esc_html__( "Enter the car's name here", 'autoart' );

	return $title;
}


function autoart_car_edit_columns( $car_columns ) {
	$car_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'autoart'),
		"thumbnail"              => esc_html__('Thumbnail', 'autoart'),
		"car_categories" 			 => esc_html__('Categories', 'autoart'),
		"date"                   => esc_html__('Date', 'autoart'),
	);
	return $car_columns;
}
add_filter( 'manage_edit-car_columns', 'autoart_car_edit_columns' );

function autoart_car_column_display( $car_columns, $post_id ) {

	switch ( $car_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb; // No need to escape
			} else {
				echo esc_html__('None', 'autoart');
			}
			break;

		// Display the car tags in the column view
		case "car_categories":
  		if ( $category_list = get_the_term_list( $post_id, 'car_categories', '', ', ', '' ) ) {
  			echo $category_list; // No need to escape
  		} else {
  			echo esc_html__('None', 'autoart');
  		}
		break;
	}
}
add_action( 'manage_car_posts_custom_column', 'autoart_car_column_display', 10, 2 );
