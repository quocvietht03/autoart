<div class="bt-car-sidebar">
  <div class="bt-car-filter-block bt-filter-options">
    <div class="bt-car-filter-header">
      <h3 class="bt-car-filter-title">
        <?php esc_html_e('Search Options', 'autoart'); ?>
      </h3>
    </div>
    <form class="bt-car-filter-form" action="" method="get">
      <div class="bt-car-filter-fields">
        <!--Search key-->
        <input type="hidden" class="bt-car-search-key" name="search_keyword" value="<?php if(isset($_GET['search_keyword'])) echo $_GET['search_keyword']; ?>">

        <!--Sort order-->
        <input type="hidden" class="bt-car-sort-order" name="sort_order" value="<?php if(isset($_GET['sort_order'])) echo $_GET['sort_order']; ?>">

        <!--View type-->
        <input type="hidden" class="bt-car-view-type" name="view_type" value="<?php if(isset($_GET['view_type'])) echo $_GET['view_type']; ?>">

        <!--View current page-->
        <input type="hidden" class="bt-car-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? $_GET['current_page'] : 1; ?>">

        <!--Categories-->
        <input type="hidden" class="bt-car-categories" name="categories" value="<?php if(isset($_GET['categories'])) echo $_GET['categories']; ?>">

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

          $field_name = __('Body', 'autoart');
          $field_value = (isset($_GET['body'])) ? $_GET['body'] : '';
          autoart_cars_field_select_html('car_body', $field_name, $field_value);

          $field_name = __('Condition', 'autoart');
          $field_value = (isset($_GET['condition'])) ? $_GET['condition'] : '';
          autoart_cars_field_select_html('car_condition', $field_name, $field_value);

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

          $field_name = __('Drive', 'autoart');
          $field_value = (isset($_GET['drive'])) ? $_GET['drive'] : '';
          autoart_cars_field_select_html('car_drive', $field_name, $field_value);

          $field_name = __('Engine', 'autoart');
          $field_value = (isset($_GET['engine'])) ? $_GET['engine'] : '';
          autoart_cars_field_select_html('car_engine', $field_name, $field_value);

          $field_name = __('Exterior Color', 'autoart');
          $field_value = (isset($_GET['ex_color'])) ? $_GET['ex_color'] : '';
          autoart_cars_field_select_html('car_ex_color', $field_name, $field_value);

          $field_name = __('Interior Color', 'autoart');
          $field_value = (isset($_GET['in_color'])) ? $_GET['in_color'] : '';
          autoart_cars_field_select_html('car_in_color', $field_name, $field_value);

        ?>

        <div class="bt-form-action">
          <a href="#" class="bt-reset-btn disable">
            <?php echo esc_html__('Reset All', 'autoart'); ?>
          </a>
        </div>
      </div>
    </form>
  </div>

  <div class="bt-car-filter-block bt-filter-multi">
    <?php
      $field_title = __('Categories', 'autoart');
      $field_value = (isset($_GET['categories'])) ? $_GET['categories'] : '';
      autoart_cars_field_multiple_html('car_categories', $field_title, $field_value);
    ?>
  </div>
</div>
