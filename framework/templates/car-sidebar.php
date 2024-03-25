<div class="bt-car-sidebar">
  <div class="bt-car-filter-block bt-filter-options">
    <form class="bt-car-filter-form" action="" method="get">
      <div class="bt-car-filter-fields">
        <!--Sort order-->
        <input type="hidden" class="bt-car-sort-order" name="sort_order" value="<?php if(isset($_GET['sort_order'])) echo $_GET['sort_order']; ?>">

        <!--View type-->
        <input type="hidden" class="bt-car-view-type" name="view_type" value="<?php if(isset($_GET['view_type'])) echo $_GET['view_type']; ?>">

        <!--View current page-->
        <input type="hidden" class="bt-car-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? $_GET['current_page'] : 1; ?>">

        <div class="bt-form-field bt-field-type-search">
          <input type="text" name="search_keyword" value="<?php if(isset($_GET['search_keyword'])) echo $_GET['search_keyword']; ?>" placeholder="<?php esc_html_e('Search …', 'autoart'); ?>">
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" fill="currentColor">
              <path d="M2.894.511a2.384 2.384 0 0 0-2.38 2.38 2.386 2.386 0 0 0 2.38 2.384c.56 0 1.076-.197 1.484-.523l.991.991a.265.265 0 0 0 .375-.374l-.991-.992a2.37 2.37 0 0 0 .523-1.485C5.276 1.58 4.206.51 2.894.51zm0 .53c1.026 0 1.852.825 1.852 1.85S3.92 4.746 2.894 4.746s-1.851-.827-1.851-1.853.825-1.852 1.851-1.852z"></path>
            </svg>
          </a>
        </div>

        <?php
          $field_title = __('Filter by Year', 'autoart');
          $field_min_value = (isset($_GET['year_min'])) ? $_GET['year_min'] : '';
          $field_max_value = (isset($_GET['year_max'])) ? $_GET['year_max'] : '';
          autoart_cars_field_slider_html('car_year', $field_title, $field_min_value, $field_max_value);

          $field_title = __('Filter by Price', 'autoart');
          $field_min_value = (isset($_GET['price_min'])) ? $_GET['price_min'] : '';
          $field_max_value = (isset($_GET['price_max'])) ? $_GET['price_max'] : '';
          autoart_cars_field_slider_html('car_price', $field_title, $field_min_value, $field_max_value);

          $field_title = __('Filter by Mileage', 'autoart');
          $field_min_value = (isset($_GET['mileage_min'])) ? $_GET['mileage_min'] : '';
          $field_max_value = (isset($_GET['mileage_max'])) ? $_GET['price_max'] : '';
          autoart_cars_field_slider_html('car_mileage', $field_title, $field_min_value, $field_max_value);

          $field_name = __('Condition', 'autoart');
          $field_value = (isset($_GET['condition'])) ? $_GET['condition'] : '';
          autoart_cars_field_select_html('car_condition', $field_name, $field_value);

          $field_title = __('Body', 'autoart');
          $field_value = (isset($_GET['body'])) ? $_GET['body'] : '';
          autoart_cars_field_multiple_html('car_body', $field_title, $field_value);

          $field_name = __('Make', 'autoart');
          $field_value = (isset($_GET['make'])) ? $_GET['make'] : '';
          autoart_cars_field_select_html('car_make', $field_name, $field_value);

          $field_name = __('Model', 'autoart');
          $field_value = (isset($_GET['model'])) ? $_GET['model'] : '';
          autoart_cars_field_select_html('car_model', $field_name, $field_value);

          $field_name = __('Fuel Type', 'autoart');
          $field_value = (isset($_GET['fuel_type'])) ? $_GET['fuel_type'] : '';
          autoart_cars_field_select_html('car_fuel_type', $field_name, $field_value);

          $field_name = __('Transmission', 'autoart');
          $field_value = (isset($_GET['transmission'])) ? $_GET['transmission'] : '';
          autoart_cars_field_select_html('car_transmission', $field_name, $field_value);

          $field_name = __('Number of Doors', 'autoart');
          $field_value = (isset($_GET['door'])) ? $_GET['door'] : '';
          autoart_cars_field_select_html('car_door', $field_name, $field_value);

          $field_name = __('Engine', 'autoart');
          $field_value = (isset($_GET['engine'])) ? $_GET['engine'] : '';
          autoart_cars_field_select_html('car_engine', $field_name, $field_value);

          $field_name = __('Body Color', 'autoart');
          $field_value = (isset($_GET['color'])) ? $_GET['color'] : '';
          autoart_cars_field_multiple_html('car_color', $field_name, $field_value);

          $field_title = __('Category', 'autoart');
          $field_value = (isset($_GET['categories'])) ? $_GET['categories'] : '';
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
</div>
