<div class="bt-car-topbar">
  <div class="bt-car-col-left">
    <div class="bt-car-results-block">
      <?php
        if($args['of'] > 0) {
          printf(esc_html__('Showing %s - %s of %s results', 'autoart'), $args['from'], $args['to'], $args['of'] );
        } else {
          echo esc_html__('No results', 'autoart');
        }
      ?>
    </div>
  </div>

  <div class="bt-car-col-right">
    <div class="bt-car-sort-block">
      <span class="bt-sort-title">
        <?php echo esc_html__('Sort by:', 'autoart'); ?>
      </span>
      <div class="bt-sort-field">
        <?php
          $sort_options = array(
            'date_high' => esc_html__('Date: newest first', 'autoart'),
            'date_low' => esc_html__('Date: oldest first', 'autoart'),
            'mileage_high' => esc_html__('Mileage: highest first', 'autoart'),
            'mileage_low' => esc_html__('Mileage: lowest first', 'autoart'),
            'price_high' => esc_html__('Price: highest first', 'autoart'),
            'price_low' => esc_html__('Price: lower first', 'autoart')
          );
        ?>
        <select name="sort_order">
          <?php foreach ($sort_options as $key => $value) { ?>
            <?php if(isset($_GET['sort_order']) && $key == $_GET['sort_order']){ ?>
              <?php if($key == $_GET['sort_order']){ ?>
                <option value="<?php echo $key; ?>" selected="selected">
                  <?php echo $value; ?>
                </option>
              <?php } else { ?>
                <option value="<?php echo $key; ?>">
                  <?php echo $value; ?>
                </option>
              <?php } ?>
            <?php } else { ?>
              <?php if($key == 'date_high'){ ?>
                <option value="<?php echo $key; ?>" selected="selected">
                  <?php echo $value; ?>
                </option>
              <?php } else { ?>
                <option value="<?php echo $key; ?>">
                  <?php echo $value; ?>
                </option>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="bt-car-view-block">
      <?php
        $type_active = 'grid';
        if(isset($_GET['view_type']) && 'list' == $_GET['view_type']) {
          $type_active = 'list';
        }
      ?>
      <a href="#" class="bt-view-type bt-view-grid <?php if('grid' == $type_active) echo 'active'; ?>" data-view="grid">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.334 6.53333C16.334 5.87994 16.334 5.55324 16.4612 5.30368C16.573 5.08416 16.7514 4.90568 16.971 4.79382C17.2205 4.66667 17.5472 4.66667 18.2007 4.66667H21.4673C22.1208 4.66667 22.4474 4.66667 22.697 4.79382C22.9166 4.90568 23.0949 5.08416 23.2068 5.30368C23.334 5.55324 23.334 5.87994 23.334 6.53333V9.8C23.334 10.4534 23.334 10.7801 23.2068 11.0297C23.0949 11.2492 22.9166 11.4277 22.697 11.5395C22.4474 11.6667 22.1208 11.6667 21.4673 11.6667H18.2007C17.5472 11.6667 17.2205 11.6667 16.971 11.5395C16.7514 11.4277 16.573 11.2492 16.4612 11.0297C16.334 10.7801 16.334 10.4534 16.334 9.8V6.53333Z" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.66602 6.53333C4.66602 5.87994 4.66602 5.55324 4.79317 5.30368C4.90503 5.08416 5.08351 4.90568 5.30303 4.79382C5.55259 4.66667 5.87929 4.66667 6.53268 4.66667H9.79935C10.4527 4.66667 10.7794 4.66667 11.029 4.79382C11.2485 4.90568 11.427 5.08416 11.5389 5.30368C11.666 5.55324 11.666 5.87994 11.666 6.53333V9.8C11.666 10.4534 11.666 10.7801 11.5389 11.0297C11.427 11.2492 11.2485 11.4277 11.029 11.5395C10.7794 11.6667 10.4527 11.6667 9.79935 11.6667H6.53268C5.87929 11.6667 5.55259 11.6667 5.30303 11.5395C5.08351 11.4277 4.90503 11.2492 4.79317 11.0297C4.66602 10.7801 4.66602 10.4534 4.66602 9.8V6.53333Z" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.66602 18.2C4.66602 17.5465 4.66602 17.2199 4.79317 16.9703C4.90503 16.7508 5.08351 16.5724 5.30303 16.4605C5.55259 16.3333 5.87929 16.3333 6.53268 16.3333H9.79935C10.4527 16.3333 10.7794 16.3333 11.029 16.4605C11.2485 16.5724 11.427 16.7508 11.5389 16.9703C11.666 17.2199 11.666 17.5465 11.666 18.2V21.4667C11.666 22.1201 11.666 22.4468 11.5389 22.6963C11.427 22.9159 11.2485 23.0943 11.029 23.2062C10.7794 23.3333 10.4527 23.3333 9.79935 23.3333H6.53268C5.87929 23.3333 5.55259 23.3333 5.30303 23.2062C5.08351 23.0943 4.90503 22.9159 4.79317 22.6963C4.66602 22.4468 4.66602 22.1201 4.66602 21.4667V18.2Z" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16.334 18.2C16.334 17.5465 16.334 17.2199 16.4612 16.9703C16.573 16.7508 16.7514 16.5724 16.971 16.4605C17.2205 16.3333 17.5472 16.3333 18.2007 16.3333H21.4673C22.1208 16.3333 22.4474 16.3333 22.697 16.4605C22.9166 16.5724 23.0949 16.7508 23.2068 16.9703C23.334 17.2199 23.334 17.5465 23.334 18.2V21.4667C23.334 22.1201 23.334 22.4468 23.2068 22.6963C23.0949 22.9159 22.9166 23.0943 22.697 23.2062C22.4474 23.3333 22.1208 23.3333 21.4673 23.3333H18.2007C17.5472 23.3333 17.2205 23.3333 16.971 23.2062C16.7514 23.0943 16.573 22.9159 16.4612 22.6963C16.334 22.4468 16.334 22.1201 16.334 21.4667V18.2Z" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
      <a href="#" class="bt-view-type bt-view-list <?php if('list' == $type_active) echo 'active'; ?>" data-view="list">
        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9.33333 7L24.5 7.00091M9.33333 14L24.5 14.0009M9.33333 21L24.5 21.0008M3.5 7.58333H4.66667V6.41667H3.5V7.58333ZM3.5 14.5833H4.66667V13.4167H3.5V14.5833ZM3.5 21.5833H4.66667V20.4167H3.5V21.5833Z" stroke="#555555" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  </div>
</div>
