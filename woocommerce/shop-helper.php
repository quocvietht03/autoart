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
            $dealer_id       = get_post_meta( get_the_ID(), '_dealer', true );
            $dealer_values   = !empty($dealer_id) ? get_post( $dealer_id ) : '';
            $newsletter_form = get_post_meta( get_the_ID(), '_newsletter_shortcode', true );
          ?>

          <?php if(!empty($dealer_values)): ?>
            <?php 
              $avtar    = get_field( "avatar", $dealer_id );
              $location = get_field( "location", $dealer_id );  
              $phone    = get_field( "phone", $dealer_id );  
              $message  = get_field( "message_link", $dealer_id );
              $whatsapp = get_field( "whatsapp_link", $dealer_id );
            ?>

            <div class="bt-product-sidebar-dealer"> 
              <div class="bt-product-sidebar-dealer-inner"> 
                <p> <?php esc_html_e( 'Seller Details:', 'autoart' ); ?> </p>

                <div class="bt-product-sidebar-dealer-info"> 
                  <?php if(!empty($avtar)): ?>
                    <div class="bt-product-sidebar-dealer--avatar"> 
                      <img src="<?php echo esc_url($avtar['url']) ?>" alt="<?php echo esc_html($dealer_values->post_title) ?>"/> 
                    </div>

                    <div class="bt-product-sidebar-dealer-meta"> 
                      <h4 class="bt-product-sidebar-dealer--title"> <?php echo esc_html($dealer_values->post_title) ?> </h4>
                   
                      <?php if(!empty($location)): ?>
                        <p class="bt-product-sidebar-dealer--location"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8692 12.2526C16.7613 12.3234 16.6389 12.375 16.5 12.375H4.125C3.7455 12.375 3.4375 12.0677 3.4375 11.6875V6.1875C3.4375 5.808 3.7455 5.5 4.125 5.5H16.5C16.6464 5.5 16.7743 5.55569 16.8857 5.63338L18.5371 8.92651L16.8692 12.2526ZM11.6875 19.25C11.6875 20.009 11.0715 20.625 10.3125 20.625H8.9375C8.1785 20.625 7.5625 20.009 7.5625 19.25V13.75H11.6875V19.25ZM7.5625 2.75C7.5625 1.991 8.1785 1.375 8.9375 1.375H10.3125C11.0715 1.375 11.6875 1.991 11.6875 2.75V4.125H7.5625V2.75ZM19.7429 8.404L17.6942 4.31888C17.5477 4.17245 17.3532 4.11263 17.1614 4.125H13.0625V2.75C13.0625 1.23131 11.8312 0 10.3125 0H8.9375C7.41881 0 6.1875 1.23131 6.1875 2.75V4.125H3.4375C2.6785 4.125 2.0625 4.741 2.0625 5.5V12.375C2.0625 13.134 2.6785 13.75 3.4375 13.75H6.1875V19.25C6.1875 20.7687 7.41881 22 8.9375 22H10.3125C11.8312 22 13.0625 20.7687 13.0625 19.25V13.75H17.1875V13.7335C17.3704 13.7376 17.5546 13.6744 17.6942 13.5355L19.7429 9.44968C19.8976 9.16093 19.9182 9.06676 19.9389 8.92651C19.9485 8.73882 19.8873 8.66525 19.7429 8.404Z" fill="#1FBECD"/>
                          </svg>
                          <span> <?php echo esc_html($location) ?> </span>
                        </p>
                      <?php endif;?>  

                      <?php if(!empty($phone)): ?>
                        <p class="bt-product-sidebar-dealer--phone"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                            <path d="M12.375 1.83331C12.375 1.83331 14.514 2.02777 17.2364 4.75013C19.9587 7.47249 20.1532 9.6115 20.1532 9.6115" stroke="#1FBECD" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12.0234 6.07422C12.0234 6.07422 12.9309 6.3335 14.2921 7.69467C15.6533 9.05586 15.9126 9.96331 15.9126 9.96331" stroke="#1FBECD" stroke-width="2" stroke-linecap="round"/>
                            <path d="M13.3408 15.2486L13.7584 14.809L12.7614 13.8621L12.3439 14.3017L13.3408 15.2486ZM15.1322 14.624L16.8835 15.632L17.5694 14.4404L15.8181 13.4323L15.1322 14.624ZM17.2214 17.7219L15.9192 19.0929L16.9162 20.0398L18.2184 18.6689L17.2214 17.7219ZM15.1357 19.5322C13.8203 19.6621 10.3881 19.5512 6.66259 15.629L5.66564 16.5759C9.72586 20.8506 13.599 21.0656 15.2708 20.9006L15.1357 19.5322ZM6.66259 15.629C3.10948 11.8882 2.51348 8.7328 2.43919 7.34879L1.06617 7.42249C1.15715 9.11761 1.8769 12.5871 5.66564 16.5759L6.66259 15.629ZM7.92332 9.54499L8.18622 9.26819L7.18928 8.32125L6.92637 8.59805L7.92332 9.54499ZM8.39275 5.82198L7.23688 4.18711L6.11415 4.98092L7.27006 6.61577L8.39275 5.82198ZM3.32455 3.83465L1.88575 5.34943L2.8827 6.29638L4.3215 4.7816L3.32455 3.83465ZM7.42484 9.07151C6.92637 8.59805 6.92573 8.59872 6.92509 8.59938C6.92487 8.59962 6.92423 8.6003 6.9238 8.60076C6.92293 8.6017 6.92204 8.60264 6.92114 8.60361C6.91934 8.60555 6.91747 8.60758 6.91554 8.6097C6.9117 8.61392 6.90762 8.6185 6.90333 8.62343C6.89476 8.63329 6.88534 8.64457 6.87526 8.6573C6.85511 8.68277 6.83232 8.71406 6.8084 8.75142C6.76045 8.82637 6.70844 8.92507 6.66439 9.04884C6.57483 9.30052 6.52603 9.63382 6.58702 10.0501C6.70683 10.8678 7.24268 11.9676 8.64272 13.4416L9.63969 12.4946C8.33106 11.1168 8.00868 10.2682 7.94749 9.85072C7.91797 9.64928 7.94796 9.54314 7.95983 9.50981C7.96649 9.49107 7.97085 9.48587 7.96658 9.49254C7.96452 9.49577 7.96039 9.50183 7.95346 9.5106C7.94999 9.51498 7.94582 9.52004 7.94083 9.52578C7.93834 9.52864 7.93563 9.53167 7.93273 9.53488C7.93127 9.53648 7.92976 9.53812 7.92819 9.53981C7.92741 9.54065 7.92661 9.54151 7.9258 9.54237C7.9254 9.5428 7.92477 9.54346 7.92457 9.54367C7.92395 9.54433 7.92332 9.54499 7.42484 9.07151ZM8.64272 13.4416C10.0387 14.9113 11.093 15.489 11.8973 15.6197C12.3101 15.6867 12.6442 15.6331 12.8972 15.5334C13.0209 15.4846 13.1187 15.4273 13.1921 15.3753C13.2288 15.3492 13.2593 15.3246 13.2839 15.303C13.2963 15.2922 13.3071 15.2821 13.3165 15.273C13.3213 15.2685 13.3257 15.2641 13.3297 15.26C13.3317 15.258 13.3337 15.256 13.3355 15.2541C13.3364 15.2532 13.3373 15.2523 13.3383 15.2513C13.3387 15.2509 13.3394 15.2501 13.3395 15.25C13.3402 15.2492 13.3408 15.2486 12.8423 14.7751C12.3439 14.3017 12.3445 14.301 12.3451 14.3004C12.3453 14.3001 12.346 14.2995 12.3463 14.299C12.3472 14.2982 12.348 14.2974 12.3488 14.2965C12.3505 14.2949 12.352 14.2932 12.3535 14.2917C12.3566 14.2887 12.3595 14.2857 12.3623 14.2831C12.3678 14.2777 12.3728 14.2732 12.3772 14.2693C12.3859 14.2616 12.3924 14.2567 12.3967 14.2537C12.4053 14.2476 12.4044 14.2497 12.3927 14.2543C12.375 14.2612 12.2917 14.2907 12.1178 14.2624C11.7488 14.2025 10.9525 13.8768 9.63969 12.4946L8.64272 13.4416ZM7.23688 4.18711C6.30775 2.873 4.44855 2.65129 3.32455 3.83465L4.3215 4.7816C4.80077 4.27702 5.6445 4.31665 6.11415 4.98092L7.23688 4.18711ZM2.43919 7.34879C2.41955 6.98277 2.57893 6.61619 2.8827 6.29638L1.88575 5.34943C1.39456 5.86657 1.02122 6.58496 1.06617 7.42249L2.43919 7.34879ZM15.9192 19.0929C15.6635 19.3622 15.3959 19.5065 15.1357 19.5322L15.2708 20.9006C15.9556 20.8329 16.5098 20.4677 16.9162 20.0398L15.9192 19.0929ZM8.18622 9.26819C9.07319 8.3344 9.13598 6.87308 8.39275 5.82198L7.27006 6.61577C7.65702 7.16309 7.59769 7.89127 7.18928 8.32125L8.18622 9.26819ZM16.8835 15.632C17.6359 16.0652 17.7832 17.1306 17.2214 17.7219L18.2184 18.6689C19.4146 17.4095 19.0662 15.3019 17.5694 14.4404L16.8835 15.632ZM13.7584 14.809C14.1116 14.4371 14.6622 14.3535 15.1322 14.624L15.8181 13.4323C14.8112 12.8527 13.5623 13.0189 12.7614 13.8621L13.7584 14.809Z" fill="#1FBECD"/>
                          </svg>
                          <span> <?php echo esc_html($phone) ?> </span>
                        </p>
                      <?php endif;?>
                    </div>
                  <?php endif;?> 
                </div>

                <?php if(!empty($message)): ?>
                  <div class="bt-product-sidebar-dealer--message"> 
                    <a href="<?php echo esc_url( $message ); ?>"> 
                      <?php esc_html_e( 'Message Seller', 'autoart' ); ?>
                    </a>
                  </div>
                <?php endif;?>  

                <?php if(!empty($whatsapp)): ?>
                  <div class="bt-product-sidebar-dealer--whatsapp"> 
                    <a href="<?php echo esc_url( $whatsapp ); ?>"> 
                      <?php esc_html_e( 'Chat Via Whatsapp', 'autoart' ); ?>
                    </a>
                  </div>
                <?php endif;?>  

                <div class="bt-product-sidebar-dealer--button"> 
                  <a href="<?php echo esc_url( get_permalink($dealer_values->ID) ); ?>"> 
                    <?php esc_html_e( 'View All stock at this dealer', 'autoart' ); ?>
                  </a>
                </div>
              </div> 
            </div>
          <?php endif; ?>   

          <?php if(!empty($newsletter_form) && isset($newsletter_form)): ?>
            <div class="bt-product-sidebar-newsletter"> 
              <div class="bt-product-sidebar-newsletter--header"> 
                <div class="bt-product-sidebar-newsletter--icon"> 
                  <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70" fill="none">
                    <path d="M42.2917 27.7087H27.7083M8.8326 29.1669L29.8218 43.2154C31.6928 44.4628 32.6285 45.0864 33.6397 45.3288C34.533 45.5429 35.4646 45.5429 36.3583 45.3288C37.3695 45.0864 38.3052 44.4628 40.1762 43.2154L61.1654 29.1669M30.0361 11.8677L13.1196 22.4915C11.5244 23.4934 10.7268 23.9942 10.1482 24.6714C9.63623 25.2707 9.25097 25.9676 9.01574 26.7199C8.75 27.57 8.75 28.5118 8.75 30.3954V49.0003C8.75 52.2672 8.75 53.9009 9.3858 55.1486C9.94505 56.2461 10.8374 57.1387 11.9351 57.6978C13.1829 58.3336 14.8164 58.3336 18.0833 58.3336H51.9167C55.1836 58.3336 56.8173 58.3336 58.065 57.6978C59.1625 57.1387 60.055 56.2461 60.6142 55.1486C61.25 53.9009 61.25 52.2672 61.25 49.0003V30.3954C61.25 28.5118 61.25 27.57 60.9843 26.7199C60.7489 25.9676 60.3639 25.2707 59.8517 24.6714C59.2734 23.9942 58.4757 23.4934 56.8805 22.4915L39.9639 11.8676C38.1634 10.7371 37.2633 10.1718 36.2976 9.95142C35.4433 9.75659 34.5567 9.75659 33.7024 9.95142C32.7367 10.1718 31.8366 10.7371 30.0361 11.8677Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>

                <div class="bt-product-sidebar-newsletter-meta"> 
                  <h4 class="bt-product-sidebar-newsletter--heading"> <?php esc_html_e( 'Get In Touch', 'autoart' ); ?> </h4>
                  <p class="bt-product-sidebar-newsletter--desc"> <?php esc_html_e( 'We Deal In All Types Of Cars', 'autoart' ); ?> </p>
                </div>
              </div>

              <div class="bt-product-sidebar-newsletter--form"> 
                <?php echo do_shortcode($newsletter_form); ?>
              </div>
            </div>
          <?php endif; ?> 
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
	global $post;

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
	$supported_ids[''] = __( 'Choose Dealer', 'autoart' );
	$value = get_post_meta( $post->ID, '_dealer', true );
  if( empty( $value ) ) $value = '';

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
			'options' 		=> $supported_ids,
			'value'   => $value,
		)
  );
}

add_action( 'woocommerce_process_product_meta', 'autoart_woocommerce_custom_field_save' );
function autoart_woocommerce_custom_field_save( $post_id ){
    $subtitle = $_POST['_subtitle'];
    if( !empty( $subtitle ) ) {
      update_post_meta( $post_id, '_subtitle', esc_attr( $subtitle ) );
    } else {
			update_post_meta( $post_id, '_subtitle', '' );
		}

		$dealer = $_POST['_dealer'];
		if( !empty( $dealer ) ) {
      update_post_meta( $post_id, '_dealer', esc_attr( $dealer ) );
    } else {
			update_post_meta( $post_id, '_dealer', '' );
		}

		$newsletter_sc = $_POST['_newsletter_shortcode'];
		if( !empty( $newsletter_sc ) ) {
      update_post_meta( $post_id, '_newsletter_shortcode', esc_attr( $newsletter_sc ) );
    } else {
			update_post_meta( $post_id, '_newsletter_shortcode', '' );
		}
}
