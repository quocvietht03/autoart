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

      <!--Min-Max Year-->
      <input type="hidden" class="bt-car-min-year" name="min_year" value="<?php if(isset($_GET['min_year'])) echo $_GET['min_year']; ?>">
      <input type="hidden" class="bt-car-max-year" name="max_year" value="<?php if(isset($_GET['max_year'])) echo $_GET['max_year']; ?>">
      <?php autoart_cars_field_slider_html(); ?>

      <!--Min-Max Price-->
      <input type="hidden" class="bt-car-min-price" name="min_price" value="<?php if(isset($_GET['min_price'])) echo $_GET['min_price']; ?>">
      <input type="hidden" class="bt-car-max-price" name="max_price" value="<?php if(isset($_GET['max_price'])) echo $_GET['max_price']; ?>">

      <!--Min-Max Mileage-->
      <input type="hidden" class="bt-car-min-mileage" name="min_mileage" value="<?php if(isset($_GET['min_mileage'])) echo $_GET['min_mileage']; ?>">
      <input type="hidden" class="bt-car-max-mileage" name="max_mileage" value="<?php if(isset($_GET['max_mileage'])) echo $_GET['max_mileage']; ?>">

      <div class="bt-car-action-units">
        <a href="#" class="bt-reset-btn disable">
          <?php esc_html_e('Reset All', 'autoart'); ?>
        </a>
      </div>
    </div>
  </form>
</div>
