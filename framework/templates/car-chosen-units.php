<?php
  $active_units = '';
  if(isset($_GET['body']) && $_GET['body'] != '' ||
    isset($_GET['condition']) && $_GET['condition'] != '' ||
    isset($_GET['make']) && $_GET['make'] != '' ||
    isset($_GET['model']) && $_GET['model'] != '' ||
    isset($_GET['fuel_type']) && $_GET['fuel_type'] != '' ||
    isset($_GET['drive']) && $_GET['drive'] != '' ||
    isset($_GET['engine']) && $_GET['engine'] != '' ||
    isset($_GET['ex_color']) && $_GET['ex_color'] != '' ||
    isset($_GET['in_color']) && $_GET['in_color'] != ''){
    $active_units = 'active';
  }
?>
<div class="bt-car-chosen-units <?php echo $active_units; ?>">
  <ul class="bt-car-chosen-units-list">
    <?php
      if(isset($_GET['body']) && $_GET['body'] != '') {
        $term = get_term_by('slug', $_GET['body'], 'car_body');
        if(!empty($term)) {
          ?>
            <li class="bt-body-unit" data-name="body">
              <span class="t-label">
                <?php echo esc_html__('Body: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['condition']) && $_GET['condition'] != '') {
        $term = get_term_by('slug', $_GET['condition'], 'car_condition');
        if(!empty($term)) {
          ?>
            <li class="bt-condition-unit" data-name="condition">
              <span class="t-label">
                <?php echo esc_html__('Condition: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['make']) && $_GET['make'] != '') {
        $term = get_term_by('slug', $_GET['make'], 'car_make');
        if(!empty($term)) {
          ?>
            <li class="bt-make-unit" data-name="make">
              <span class="t-label">
                <?php echo esc_html__('Make: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['model']) && $_GET['model'] != '') {
        $term = get_term_by('slug', $_GET['model'], 'car_model');
        if(!empty($term)) {
          ?>
            <li class="bt-model-unit" data-name="model">
              <span class="t-label">
                <?php echo esc_html__('Model: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['fuel_type']) && $_GET['fuel_type'] != '') {
        $term = get_term_by('slug', $_GET['fuel_type'], 'car_fuel_type');
        if(!empty($term)) {
          ?>
            <li class="bt-fuel_type-unit" data-name="fuel_type">
              <span class="t-label">
                <?php echo esc_html__('Fuel Type: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['drive']) && $_GET['drive'] != '') {
        $term = get_term_by('slug', $_GET['drive'], 'car_drive');
        if(!empty($term)) {
          ?>
            <li class="bt-drive-unit" data-name="drive">
              <span class="t-label">
                <?php echo esc_html__('Drive: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['engine']) && $_GET['engine'] != '') {
        $term = get_term_by('slug', $_GET['engine'], 'car_engine');
        if(!empty($term)) {
          ?>
            <li class="bt-engine-unit" data-name="engine">
              <span class="t-label">
                <?php echo esc_html__('Engine: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['ex_color']) && $_GET['ex_color'] != '') {
        $term = get_term_by('slug', $_GET['ex_color'], 'car_ex_color');
        if(!empty($term)) {
          ?>
            <li class="bt-ex-color-unit" data-name="ex_color">
              <span class="t-label">
                <?php echo esc_html__('Exterior Color: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }

      if(isset($_GET['in_color']) && $_GET['in_color'] != '') {
        $term = get_term_by('slug', $_GET['in_color'], 'car_in_color');
        if(!empty($term)) {
          ?>
            <li class="bt-in-color-unit" data-name="in_color">
              <span class="t-label">
                <?php echo esc_html__('Interior Color: ', 'autoart'); ?>
              </span>
              <span class="t-text">
                <?php echo esc_html($term->name); ?>
              </span>
              <a href="#" class="bt-clear-unit">x</a>
            </li>
          <?php
        }
      }
    ?>
  </ul>
</div>
