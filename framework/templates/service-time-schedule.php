<?php
$time_schedule = get_field('service_time_schedule', 'options');

if(empty($time_schedule)) return;
?>
<div class="bt-time-sc">
  <?php
    if(!empty($time_schedule['text'])) {
      echo '<div class="bt-time-sc--text">' . $time_schedule['text'] . '</div>';
    }

    if(!empty($time_schedule['title'])) {
      echo '<h3 class="bt-time-sc--title">' . $time_schedule['title'] . '</h3>';
    }
  ?>

  <?php if(!empty($time_schedule['list'])) { ?>
    <div class="bt-time-sc--list">
      <?php foreach ($time_schedule['list'] as $item) { ?>
        <div class="bt-time-sc--item">
          <div class="bt-time-sc--day">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 9C0 7.788 0.24 6.624 0.72 5.508C1.2 4.392 1.836 3.432 2.628 2.628C3.42 1.824 4.38 1.188 5.508 0.72C6.636 0.252 7.8 0.012 9 0C10.224 0 11.394 0.24 12.51 0.72C13.626 1.2 14.58 1.836 15.372 2.628C16.164 3.42 16.8 4.38 17.28 5.508C17.76 6.636 18 7.8 18 9C18 10.224 17.76 11.388 17.28 12.492C16.8 13.596 16.164 14.556 15.372 15.372C14.58 16.188 13.62 16.83 12.492 17.298C11.364 17.766 10.2 18 9 18C7.8 18 6.636 17.766 5.508 17.298C4.38 16.83 3.42 16.188 2.628 15.372C1.836 14.556 1.2 13.596 0.72 12.492C0.24 11.388 0 10.224 0 9ZM2.25 9C2.25 10.224 2.55 11.358 3.15 12.402C3.75 13.446 4.572 14.262 5.616 14.85C6.66 15.438 7.788 15.738 9 15.75C10.212 15.762 11.34 15.462 12.384 14.85C13.428 14.238 14.25 13.422 14.85 12.402C15.45 11.382 15.75 10.248 15.75 9C15.75 7.752 15.45 6.624 14.85 5.616C14.25 4.608 13.428 3.792 12.384 3.168C11.34 2.544 10.212 2.238 9 2.25C7.788 2.262 6.66 2.568 5.616 3.168C4.572 3.768 3.75 4.584 3.15 5.616C2.55 6.648 2.25 7.776 2.25 9ZM7.884 9V5.634C7.884 5.322 7.992 5.058 8.208 4.842C8.424 4.626 8.688 4.512 9 4.5C9.312 4.488 9.576 4.602 9.792 4.842C10.008 5.082 10.122 5.346 10.134 5.634V7.884H12.384C12.684 7.884 12.948 7.992 13.176 8.208C13.404 8.424 13.512 8.688 13.5 9C13.488 9.312 13.38 9.582 13.176 9.81C12.972 10.038 12.708 10.146 12.384 10.134H9C8.688 10.134 8.424 10.026 8.208 9.81C7.992 9.594 7.884 9.324 7.884 9Z"/>
            </svg>
            <?php echo '<span>' . $item['day'] . '</span>'; ?>
          </div>
          <div class="bt-time-sc--time">
            <?php echo '<span class="bt-' . $item['status'] . '">' . $item['time'] . '</span>'; ?>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
</div>
