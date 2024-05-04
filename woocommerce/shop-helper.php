<?php
// WooCommerce custom hooks
add_action('autoart_woocommerce_template_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10);
add_action('autoart_woocommerce_template_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 5);
add_action('autoart_woocommerce_show_product_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('autoart_woocommerce_template_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('autoart_woocommerce_template_loop_product_title', 'woocommerce_template_loop_product_title', 10);
add_action('autoart_woocommerce_template_loop_rating', 'woocommerce_template_loop_rating', 5);
add_action('autoart_woocommerce_template_loop_price', 'woocommerce_template_loop_price', 10);
add_action('autoart_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10);

add_action('autoart_woocommerce_template_single_title', 'woocommerce_template_single_title', 5);
add_action('autoart_woocommerce_template_single_rating', 'woocommerce_template_single_rating', 10);
add_action('autoart_woocommerce_template_single_price', 'woocommerce_template_single_price', 10);
add_action('autoart_woocommerce_template_single_excerpt', 'woocommerce_template_single_excerpt', 20);
add_action('autoart_woocommerce_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
add_action('autoart_woocommerce_template_single_meta', 'woocommerce_template_single_meta', 40);
add_action('autoart_woocommerce_template_single_sharing', 'woocommerce_template_single_sharing', 50);

add_action( 'woocommerce_after_single_product_summary', 'autoart_sidebar_product', 19 );
function autoart_sidebar_product() {?>
    <div class="bt-product-sidebar"> 
      <div class="bt-product-sidebar-inner"> 
          <?php  
           $dealer_id = get_post_meta( get_the_ID(), '_dealer', true );

          //  echo "<pre>";
          //  echo print_r($dealer_id);
          //  echo "</pre>";
          ?>
      </div>
    </div>
<?php }

add_action('autoart_woocommerce_shop_loop_item_subtitle', 'autoart_woocommerce_template_loop_subtitle', 10, 2);
function autoart_woocommerce_template_loop_subtitle() {
	$subtitle = get_post_meta( get_the_ID(), '_subtitle', true );

  if(!empty($subtitle)) {
    echo '<span class="woocommerce-loop-product__subtitle">' . $subtitle . '</span>';
  }

	return;
}

add_action( 'woocommerce_single_product_summary', 'autoart_woocommerce_template_single_subtitle', 3 );
function autoart_woocommerce_template_single_subtitle() {
	$subtitle = get_post_meta( get_the_ID(), '_subtitle', true );

  if(!empty($subtitle)) {
    echo '<span class="woocommerce-product-subtitle">' . $subtitle . '</span>';
  }

	return;
}

// WooCommerce percentage flash
add_filter( 'woocommerce_sale_flash', 'autoart_woocommerce_percentage_sale', 10, 3 );
function autoart_woocommerce_percentage_sale( $html, $post, $product ) {
  if( $product->is_type('variable')){
    $percentages = array();

    // Get all variation prices
    $prices = $product->get_variation_prices();

    // Loop through variation prices
    foreach( $prices['price'] as $key => $price ){
      // Only on sale variations
      if( $prices['regular_price'][$key] !== $price ){
        // Calculate and set in the array the percentage for each variation on sale
        $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
      }
    }
    // We keep the highest value
    $percentage = max($percentages) . '%';
  } elseif( $product->is_type('grouped') ){
	   $percentages = array();

    foreach ($product->get_children() as $child_id ) {
      $child = wc_get_product( $child_id );
  		if(!empty($child->get_sale_price())){
  			$regular_price = $child->get_regular_price();
  			$sale_price = $child->get_sale_price();
  			$percentages[] = round(100 - ($sale_price / $regular_price * 100));
  		}
    }

    $percentage = max($percentages) . '%';
  } else {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();

    $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
  }

  return '<span class="onsale">' . $percentage . '</span>';
}

add_filter( 'woocommerce_pagination_args', 'autoart_woocommerce_pagination_args');
function autoart_woocommerce_pagination_args() {
  $total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
  $current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
  $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
  $format  = isset( $format ) ? $format : '';

  if ( $total <= 1 ) {
    return;
  }

  return array(
    'base'     => $base,
    'format'   => $format,
    'total'    => $total,
    'current'  => $current,
    'mid_size' => 1,
    'add_args' => false,
    'prev_text' => '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"/>
                    </svg> ' . esc_html__('Prev', 'autoart'),
    'next_text' => esc_html__('Next', 'autoart') . '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"/>
                  </svg>',
  );
}

// WooCommerce availability
add_filter( 'woocommerce_get_availability', 'autoart_woocommerce_show_in_stock', 10, 2 );
function autoart_woocommerce_show_in_stock( $availability, $product ) {
  if ( ! $product->managing_stock() && $product->is_in_stock() ) {
    $availability['availability'] = __( 'In Stock', 'autoart' );
  }

  $availability['availability'] = __( 'Availability: ', 'autoart' ) . '<span>' . $availability['availability'] . '</span>';

  return $availability;
}

// WooCommerce ralated params
add_filter( 'woocommerce_output_related_products_args', 'autoart_woocommerce_related_products_args', 20 );
function autoart_woocommerce_related_products_args( $args ) {
	if(function_exists('get_field')){
		$related_posts = get_field('product_related_posts', 'options');
		$args['posts_per_page'] = !empty($related_posts['number_posts']) ? $related_posts['number_posts'] : 4;
	} else {
		$args['posts_per_page'] = 4;
	}

	$args['columns'] = 4;

	return $args;
}

// WooCommerce custom field
add_action( 'woocommerce_product_options_general_product_data', 'autoart_woocommerce_custom_field' );
function autoart_woocommerce_custom_field() {
  woocommerce_wp_text_input(
    array(
      'id'          => '_subtitle',
      'label'       => __( 'Subtitle', 'autoart' ),
      'description' => ''
    )
  );

	woocommerce_wp_textarea_input(
		array(
      'id'          => '_newsletter_shortcode',
      'label'       => __( 'Newsletter Shortcode', 'autoart' ),
      'description' => ''
    )
  );

	$supported_ids = [];
	$supported_ids[] = __( 'Choose Dealer', 'autoart' );
	
	$wp_query = new \WP_Query( array(
								'post_type' => 'dealer',
								'post_status' => 'publish'
							) );

	if ( $wp_query->have_posts() ) {
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$supported_ids[get_the_ID()] = get_the_title();
		}
	}

	woocommerce_wp_select(
		array(
      'id'          => '_dealer',
      'label'       => __( 'Dealer', 'autoart' ),
      'description' => '',
			'options' 		=> $supported_ids
		)
  );
}

add_action( 'woocommerce_process_product_meta', 'autoart_woocommerce_custom_field_save' );
function autoart_woocommerce_custom_field_save( $post_id ){
    $subtitle = $_POST['_subtitle'];
    if( !empty( $subtitle ) ) {
      update_post_meta( $post_id, '_subtitle', esc_attr( $subtitle ) );
    }

    $_newsletter_shortcode = $_POST['_newsletter_shortcode'];
    if( !empty( $_newsletter_shortcode ) ) {
      update_post_meta( $post_id, '_newsletter_shortcode', esc_attr( $_newsletter_shortcode ) );
    }
}
