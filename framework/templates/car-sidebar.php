<div class="bt-car-filter-block">
  <form class="bt-car-filter-form" action="" method="get">
    <div class="bt-car-filter-header">
      <i class="fa fa-car"></i>
      <span class="h4">
        <?php esc_html_e('Search Options', 'autoart'); ?>
      </span>
    </div>
    <div class="bt-car-filter-fields">
      <!--Search key-->
      <input type="hidden" class="bt-car-search-key" name="search_key" value="<?php if(isset($_GET['search_key'])) echo $_GET['search_key']; ?>">

      <!--Sort order-->
      <input type="hidden" class="bt-car-sort-order" name="sort_order" value="<?php if(isset($_GET['sort_order'])) echo $_GET['sort_order']; ?>">

      <!--View type-->
      <input type="hidden" class="bt-car-view-type" name="view_type" value="<?php if(isset($_GET['view_type'])) echo $_GET['view_type']; ?>">

      <!--View current page-->
      <input type="hidden" class="bt-car-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? $_GET['current_page'] : 1; ?>">

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

        $field_name = __('Model', 'autoart');
        $field_value = (isset($_GET['model'])) ? $_GET['model'] : '';
        autoart_cars_field_select_html('car_model', $field_name, $field_value);
      ?>

      <div class="bt-car-action-units">
        <a href="#" class="bt-reset-btn disable">
          <?php esc_html_e('Reset All', 'autoart'); ?>
        </a>
      </div>
    </div>
  </form>
</div>
