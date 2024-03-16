<?php
/*
 * Car CPT
 */

function autoart_car_register() {
	$cpt_slug = get_theme_mod('autoart_car_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'cars';
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
    'has_archive'     => true,
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

/* Cars filter on archive page */
function autoart_cars_field_slider_html($slug = '', $title = '', $params = array()) {
    if(empty($slug)) {
      return;
    }

    $terms = get_terms( array(
      'taxonomy' => $slug,
      'hide_empty' => false
    ) );

    if(!empty($terms)) {
      $min_value = $max_value = $count = 0;

        foreach ($terms as $term) {
          if($count == 0) {
            $min_value = $max_value = intval(trim($term->name));
          } else {
            if($min_value > intval(trim($term->name))) {
              $min_value = intval(trim($term->name));
            }

            if($max_value < intval(trim($term->name))) {
              $max_value = intval(trim($term->name));
            }
          }
          $count++;
        }
    }

    $start_min_value = !empty($params['min_value']) ? intval(trim($params['min_value'])) : $min_value;
    $start_max_value = !empty($params['max_value']) ? intval(trim($params["max_value"])) : $max_value;
    
    ?>
    <div class="bt-field-slider <?php echo 'bt-field-' . $slug; ?>" data-range-min="<?php echo $min_value; ?>" data-range-max="<?php echo $max_value; ?>"  data-start-min="<?php echo $start_min_value; ?>" data-start-max="<?php echo $start_max_value; ?>">
      <?php
        if(!empty($title)) {
          echo '<h3 class="bt-field-title">' . $title . '</h3>';
        }
      ?>
      <div class="bt-field-slider"></div>
      <div class="bt-labels-slide">
        <span class="bt-min-value"></span>
        <span class="bt-max-value"></span>
      </div>
    </div>
  <?php
}

function autoart_cars_pagination($current_page, $total_page) {
  if(1 >= $total_page) {
    return;
  }

  ob_start();
  ?>
    <nav class="bt-pagination" role="navigation">
      <?php if(1 != $current_page){ ?>
        <a class="prev page-numbers" href="#" data-page="<?php echo $current_page - 1; ?>"><svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"></path></svg> <?php echo esc_html__('Prev', 'autoart'); ?></a>
      <?php } ?>

      <?php
        for($i = 1; $i <= $total_page; $i++){
          if(7 > $total_page){
            if($i == $current_page){
              ?>
                <span class="page-numbers current">
                  <?php echo $i; ?>
                </span>
              <?php
            } else {
              ?>
                <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              <?php
            }
          } else {
            if($i == $current_page){
              ?>
                <span class="page-numbers current">
                  <?php echo $i; ?>
                </span>
              <?php
            }

            if(5 > $current_page){
              if($i != $current_page && $i < $current_page + 3){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }

              if($i == $current_page + 3){
                ?>
                  <span class="page-numbers dots">...</span>
                <?php
              }

              if($i == $total_page ){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }
            }

            if($total_page - 4 < $current_page){
              if($i != $current_page && $i > $current_page - 3){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }

              if($i == $current_page - 3){
                ?>
                  <span class="page-numbers dots">...</span>
                <?php
              }

              if($i == 1 ){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }
            }

            if($total_page - 4 >= $current_page && 5 <= $current_page ){
              if($i != $current_page && $i > $current_page - 3 && $i < $current_page + 3){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }

              if($i == $current_page - 3 || $i == $current_page + 3){
                ?>
                  <span class="page-numbers dots">...</span>
                <?php
              }

              if($i == 1 ){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }

              if($i == $total_page ){
                ?>
                  <a class="page-numbers" href="#" data-page="<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                <?php
              }
            }
          }
        }
      ?>

      <?php if($total_page != $current_page){ ?>
        <a class="next page-numbers" href="#" data-page="<?php echo $current_page + 1; ?>"><?php echo esc_html__('Next', 'autoart'); ?> <svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"></path></svg></a>
      <?php } ?>
    </nav>
  <?php
  return ob_get_clean();
}

function autoart_cars_query_args($params = array(), $limit = 12) {
  $query_args = array(
    'post_type' => 'car',
    'post_status' => 'publish',
    'posts_per_page' => $limit,
    'orderby' => 'date',
    'order' => 'DESC',
  );

  if(isset($params['current_page']) && $params['current_page'] != '') {
    $query_args['paged'] = absint($params['current_page']);
  }

  if(isset($params['search_keyword']) && $params['search_keyword'] != '') {
    $query_args['s'] = $params['search_keyword'];
  }

  if(isset($params['sort']) && $params['sort'] == 'date_low') {
    $query_args['orderby'] = 'date';
    $query_args['order'] = 'ASC';
  }

  if(isset($params['sort']) && ($params['sort'] == 'mileage_high' || $params['sort'] == 'mileage_low')) {
    $query_args['meta_key'] = 'car_mileage';
    $query_args['orderby'] = 'meta_value_num';

    if($params['sort'] == 'mileage_high') {
      $query_args['order'] = 'DESC';
    } else {
      $query_args['order'] = 'ASC';
    }
  }

  if(isset($params['sort']) && ($params['sort'] == 'price_high' || $params['sort'] == 'price_low')) {
    $query_args['meta_key'] = 'car_price';
    $query_args['orderby'] = 'meta_value_num';

    if($params['sort'] == 'price_high') {
      $query_args['order'] = 'DESC';
    } else {
      $query_args['order'] = 'ASC';
    }
  }

  $query_tax = array();

  if(isset($params['body']) && !empty($params['body'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_body',
      'field' => 'slug',
      'terms' => $params['body']
    );
  }

  if(isset($params['condition']) && !empty($params['condition'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_condition',
      'field' => 'slug',
      'terms' => $params['condition']
    );
  }

  if(isset($params['make']) && !empty($params['make'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_make',
      'field' => 'slug',
      'terms' => $params['make']
    );
  }

  if(isset($params['model']) && !empty($params['model'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_model',
      'field' => 'slug',
      'terms' => $params['model']
    );
  }

  if(isset($params['fuel_type']) && !empty($params['fuel_type'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_fuel_type',
      'field' => 'slug',
      'terms' => $params['fuel_type']
    );
  }

  if(isset($params['transmission']) && !empty($params['transmission'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_trans',
      'field' => 'slug',
      'terms' => $params['transmission']
    );
  }

  if(isset($params['drive']) && !empty($params['drive'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_drive',
      'field' => 'slug',
      'terms' => $params['drive']
    );
  }

  if(isset($params['engine']) && !empty($params['engine'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_engine',
      'field' => 'slug',
      'terms' => $params['engine']
    );
  }

  if(isset($params['ex_color']) && !empty($params['ex_color'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_ex_color',
      'field' => 'slug',
      'terms' => $params['ex_color']
    );
  }

  if(isset($params['in_color']) && !empty($params['in_color'])) {
    $query_tax[] = array(
      'taxonomy' => 'car_in_color',
      'field' => 'slug',
      'terms' => $params['in_color']
    );
  }

  if(!empty($query_tax)) {
    $query_args['tax_query'] = $query_tax;
  }

  $query_meta = array();

  if(isset($params['mileage_min']) && isset($params['mileage_max'])) {
    $query_meta['mileage_clause'] = array(
      'relation' => 'AND',
  		array(
  			'key'     => 'car_mileage',
  			'value'   => absint($params['mileage_min']),
  			'compare' => '>=',
        'type'    => 'numeric'
  		),
  		array(
  			'key'     => 'car_mileage',
  			'value'   => absint($params['mileage_max']),
  			'compare' => '<=',
        'type'    => 'numeric'
  		)
    );
  }

  if(isset($params['price_min']) && isset($params['price_max'])) {
    $query_meta['price_clause'] = array(
      'relation' => 'AND',
  		array(
  			'key'     => 'car_price',
  			'value'   => absint($params['price_min']),
  			'compare' => '>=',
        'type'    => 'numeric'
  		),
  		array(
  			'key'     => 'car_price',
  			'value'   => absint($params['price_max']),
  			'compare' => '<=',
        'type'    => 'numeric'
  		)
    );
  }

  if(isset($params['year_min']) && isset($params['year_max'])) {
    $query_meta['year_clause'] = array(
      'relation' => 'AND',
  		array(
  			'key'     => 'car_year',
  			'value'   => absint($params['year_min']),
  			'compare' => '>=',
        'type'    => 'numeric'
  		),
  		array(
  			'key'     => 'car_year',
  			'value'   => absint($params['year_max']),
  			'compare' => '<=',
        'type'    => 'numeric'
  		)
    );
  }

  if(!empty($query_meta)) {
    $query_args['meta_query'] = $query_meta;
    $query_args['relation'] = 'AND';
  }

  return $query_args;
}

function autoart_cars_filter($params = array(), $limit) {
  $query_args = autoart_cars_query_args($params, $limit);
  $wp_query = new \WP_Query($query_args);
  $current_page = isset($params['current_page']) ? absint($params['current_page']) : 1;
  $total_page = $wp_query->max_num_pages;

  // $output['remaining'] = autoart_listing_form_fields_ajax($filter_taxs, $params_get);

  if ( $wp_query->have_posts() ) {
    ob_start();
      while ( $wp_query->have_posts() ) { $wp_query->the_post();
        get_template_part( 'framework/templates/car', 'style', array('image-size' => 'medium_large'));
      }

      $output['items'] = ob_get_clean();
      $output['pagination'] = autoart_cars_pagination($current_page, $total_page);
  } else {
    $output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
    $output['pagination'] = '';
  }

  wp_reset_postdata();

  wp_send_json_success($output);

  die();
}
add_action( 'wp_ajax_autoart_cars_filter', 'autoart_cars_filter' );
add_action( 'wp_ajax_nopriv_autoart_cars_filter', 'autoart_cars_filter' );
