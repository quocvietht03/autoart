<div class="bt-car-sidebar">
  <form class="bt-car-filter-form" action="" method="get">
    <div class="bt-car-filter-fields">
      <!--Sort order-->
      <input type="hidden" class="bt-car-sort-order" name="sort_order" value="<?php if (isset($_GET['sort_order'])) echo esc_attr($_GET['sort_order']); ?>">

      <!--View type-->
      <input type="hidden" class="bt-car-view-type" name="view_type" value="<?php if (isset($_GET['view_type'])) echo esc_attr($_GET['view_type']); ?>">

      <!--View current page-->
      <input type="hidden" class="bt-car-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? esc_attr($_GET['current_page']) : ''; ?>">

      <!--Car Dealer-->
      <input type="hidden" class="bt-car-dealer" name="car_dealer" value="<?php if (isset($_GET['car_dealer'])) echo esc_attr($_GET['car_dealer']); ?>">

      <div class="bt-form-field bt-field-type-search">
        <input type="text" name="search_keyword" value="<?php if (isset($_GET['search_keyword'])) echo esc_attr($_GET['search_keyword']); ?>" placeholder="<?php esc_attr_e('Search …', 'autoart'); ?>">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" fill="currentColor">
            <path d="M2.894.511a2.384 2.384 0 0 0-2.38 2.38 2.386 2.386 0 0 0 2.38 2.384c.56 0 1.076-.197 1.484-.523l.991.991a.265.265 0 0 0 .375-.374l-.991-.992a2.37 2.37 0 0 0 .523-1.485C5.276 1.58 4.206.51 2.894.51zm0 .53c1.026 0 1.852.825 1.852 1.85S3.92 4.746 2.894 4.746s-1.851-.827-1.851-1.853.825-1.852 1.851-1.852z"></path>
          </svg>
        </a>
      </div>

      <?php

      $field_title = __('Year', 'autoart');
      $field_value = (isset($_GET['car_year'])) ? $_GET['car_year'] : '';
      autoart_cars_field_select_number_html('car_year', $field_title, $field_value);

      $field_title = __('Price ($)', 'autoart');
      $field_value = (isset($_GET['car_price'])) ? $_GET['car_price'] : '';
      $field_step = 1000;
      autoart_cars_field_select_range_html('car_price', $field_title, $field_value, $field_step);

      $field_title = __('Mileage (km)', 'autoart');
      $field_value = (isset($_GET['car_mileage'])) ? $_GET['car_mileage'] : '';
      $field_step = 10;
      autoart_cars_field_select_range_html('car_mileage', $field_title, $field_value, $field_step);

      $field_name = __('Condition', 'autoart');
      $field_value = (isset($_GET['car_condition'])) ? $_GET['car_condition'] : '';
      autoart_cars_field_select_html('car_condition', $field_name, $field_value);

      $field_title = __('Body', 'autoart');
      $field_value = (isset($_GET['car_body'])) ? $_GET['car_body'] : '';
      autoart_cars_field_multiple_html('car_body', $field_title, $field_value);

      $field_name = __('Make', 'autoart');
      $field_value = (isset($_GET['car_make'])) ? $_GET['car_make'] : '';
      autoart_cars_field_select_html('car_make', $field_name, $field_value);

      $field_name = __('Model', 'autoart');
      $field_value = (isset($_GET['car_model'])) ? $_GET['car_model'] : '';
      autoart_cars_field_select_html('car_model', $field_name, $field_value);

      $field_name = __('Fuel Type', 'autoart');
      $field_value = (isset($_GET['car_fuel_type'])) ? $_GET['car_fuel_type'] : '';
      autoart_cars_field_select_html('car_fuel_type', $field_name, $field_value);

      $field_name = __('Transmission', 'autoart');
      $field_value = (isset($_GET['car_transmission'])) ? $_GET['car_transmission'] : '';
      autoart_cars_field_select_html('car_transmission', $field_name, $field_value);

      $field_name = __('Number of Doors', 'autoart');
      $field_value = (isset($_GET['car_door'])) ? $_GET['car_door'] : '';
      autoart_cars_field_select_html('car_door', $field_name, $field_value);

      $field_name = __('Engine', 'autoart');
      $field_value = (isset($_GET['car_engine'])) ? $_GET['car_engine'] : '';
      autoart_cars_field_select_html('car_engine', $field_name, $field_value);

      $field_name = __('Body Color', 'autoart');
      $field_value = (isset($_GET['car_color'])) ? $_GET['car_color'] : '';
      autoart_cars_field_multiple_html('car_color', $field_name, $field_value);

      $field_title = __('Category', 'autoart');
      $field_value = (isset($_GET['car_categories'])) ? $_GET['car_categories'] : '';
      autoart_cars_field_multiple_html('car_categories', $field_title, $field_value);

      ?>
      <div class="bt-form-action">
        <a href="#" class="bt-reset-btn disable">
          <?php echo esc_html__('Reset All', 'autoart'); ?>
        </a>
      </div>
    </div>
  </form>
</div>

<div class="bt-sidebar-overlay"></div>