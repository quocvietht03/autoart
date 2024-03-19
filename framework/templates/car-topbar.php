<div class="bt-car-topbar">
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
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 48 48" fill="currentColor">
        <path fill-rule="nonzero" d="M39 25c1.598 0 2.995 1.3 3 3v11c0 1.598-1.284 3-3 3H28a3.014 3.014 0 0 1-3-3V28c0-1.598 1.288-3 3-3zm-19 0c1.598 0 2.995 1.3 3 3v11c0 1.598-1.284 3-3 3H9a3.014 3.014 0 0 1-3-3V28c0-1.598 1.288-3 3-3zm19 2H28c-.513 0-1 .416-1 1v11c0 .513.403 1 1 1h11c.513 0 1-.403 1-1V28a.99.99 0 0 0-1-1zm-19 0H9c-.513 0-1 .416-1 1v11c0 .513.403 1 1 1h11c.513 0 1-.403 1-1V28a.99.99 0 0 0-1-1zM39 6c1.598 0 2.995 1.3 3 3v11c0 1.598-1.284 3-3 3H28a3.014 3.014 0 0 1-3-3V9c0-1.598 1.288-3 3-3zM20 6c1.598 0 2.995 1.3 3 3v11c0 1.598-1.284 3-3 3H9a3.014 3.014 0 0 1-3-3V9c0-1.598 1.288-3 3-3zm19 2H28c-.513 0-1 .416-1 1v11c0 .513.403 1 1 1h11c.513 0 1-.403 1-1V9a.99.99 0 0 0-1-1zM20 8H9c-.513 0-1 .416-1 1v11c0 .513.403 1 1 1h11c.513 0 1-.403 1-1V9a.99.99 0 0 0-1-1z" opacity="1" data-original="#000000" class=""></path>
      </svg>
    </a>
    <a href="#" class="bt-view-type bt-view-list <?php if('list' == $type_active) echo 'active'; ?>" data-view="list">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 48 48" fill="currentColor">
        <path d="M14.3 16.2H11c-1.1 0-1.9-.9-1.9-1.9v-3.4C9 9.9 9.8 9 10.9 9h3.3c1.1 0 1.9.9 1.9 1.9v3.4c.1 1-.8 1.9-1.8 1.9zm-.1-5.3-3.3.1.1 3.3 3.2-.1zm.1 3.3c-.1 0-.1 0 0 0zM39 12.9c0-.6-.4-1-1-1H20c-.6 0-1 .4-1 1s.4 1 1 1h18c.6 0 1-.5 1-1zM14.3 27.6H11c-1.1 0-1.9-.9-1.9-1.9v-3.3c0-1.1.9-1.9 1.9-1.9h3.3c1.1 0 1.9.9 1.9 1.9v3.3c0 1-.9 1.9-1.9 1.9zm-.1-5.3-3.3.1.1 3.3 3.2-.1zm.1 3.3c-.1 0-.1 0 0 0zM39 24.3c0-.6-.4-1-1-1H20c-.6 0-1 .4-1 1s.4 1 1 1h18c.6 0 1-.5 1-1zM14.3 39H11c-1.2 0-2-.9-2-1.9v-3.4c0-1.1.9-1.9 1.9-1.9h3.3c1.1 0 1.9.9 1.9 1.9v3.4c.1 1-.8 1.9-1.8 1.9zm-.1-5.3-3.3.1.1 3.3 3.2-.1zm.1 3.3c-.1 0-.1 0 0 0zM39 35.7c0-.6-.4-1-1-1H20c-.6 0-1 .4-1 1s.4 1 1 1h18c.6 0 1-.5 1-1z"></path>
      </svg>
    </a>
  </div>
</div>
