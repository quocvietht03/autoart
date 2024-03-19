<div class="bt-car-sidebar">
  <div class="bt-car-filter-block bt-filter-options">
    <div class="bt-car-filter-header">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 250.993 250.993" fill="currentColor">
        <path d="M242.697 69.229c-.878 0-1.778.126-2.677.373l-10.171 2.802-10.563-25.729c-2.993-7.289-11.837-13.219-19.717-13.219h-98.851c-7.879 0-16.724 5.93-19.717 13.219L70.454 72.369 60.41 69.602a10.076 10.076 0 0 0-2.677-.373c-4.807 0-8.296 3.672-8.296 8.733v5.996c0 .262.021.518.039.775a60.48 60.48 0 0 0-6.627 5.73c-11.249 11.249-17.444 26.204-17.444 42.112 0 12.896 4.073 25.167 11.608 35.343L2.611 202.322a8.913 8.913 0 0 0 0 12.605 8.881 8.881 0 0 0 6.302 2.611c2.281 0 4.562-.87 6.302-2.611l34.404-34.404c10.177 7.536 22.447 11.609 35.343 11.609 15.908 0 30.864-6.195 42.112-17.444a59.881 59.881 0 0 0 9.262-11.956h73.987v12.765c0 5.906 4.805 10.711 10.711 10.711h13.989c5.906 0 10.711-4.805 10.711-10.711V124.38c0-7.32-2.262-18.786-5.042-25.558l-1.705-4.153h1.292c5.906 0 10.711-4.805 10.711-10.712v-5.996c.003-5.06-3.486-8.732-8.293-8.732zM94.112 49.933c1.79-4.36 7.11-7.927 11.824-7.927h88.418c4.713 0 10.034 3.567 11.824 7.927l15.977 38.919c1.79 4.36-.602 7.927-5.315 7.927h-84.277a60.394 60.394 0 0 0-5.487-6.316c-11.249-11.249-26.204-17.444-42.112-17.444-.111 0-.22.007-.331.008l9.479-23.094zm-9.15 124.372c-11.146 0-21.626-4.341-29.508-12.223-7.882-7.881-12.222-18.36-12.222-29.507s4.341-21.626 12.222-29.508c7.882-7.881 18.361-12.222 29.508-12.222s21.626 4.341 29.508 12.222c7.882 7.882 12.222 18.361 12.222 29.507 0 11.147-4.34 21.626-12.222 29.508-7.882 7.882-18.361 12.223-29.508 12.223zm140.158-36.226a4.297 4.297 0 0 1-4.285 4.285h-30.351a4.298 4.298 0 0 1-4.285-4.285v-14.566a4.298 4.298 0 0 1 4.285-4.285h30.351a4.297 4.297 0 0 1 4.285 4.285v14.566z"></path>
      </svg>
      
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
