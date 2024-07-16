<?php
/**
 * Site Titlebar
 *
 */

if(function_exists('get_field')){
  $distance = get_field('top_distance', 'options');
  $bg_image = get_field('background_image', 'options');
  $ovl_color = get_field('overlay_color', 'options');
  $ovl_opacity = get_field('overlay_opacity', 'options');
} else {
  $distance = false;
  $bg_image = '';
  $ovl_color = '';
  $ovl_opacity = '';
}

?>
<section class="bt-site-titlebar<?php if($distance) { echo ' bt-has-distance'; } ?>" style="<?php if(!empty($bg_image)) { echo 'background-image: url(' . $bg_image . ')'; } ?>">
  <?php
    if(!empty($ovl_color)) {
      echo '<div class="bt-site-titlebar--overlay" style="background: ' . $ovl_color . '; opacity: ' . $ovl_opacity . '%;"></div>';
    }
  ?>

  <div class="bt-container">
    <h1 class="bt-page-title">
      <?php echo autoart_page_title(); ?>
    </h1>

    <div class="bt-page-breadcrumb">
      <?php
        $home_text = esc_html__('Home', 'autoart');
        $delimiter = '|';
        echo autoart_page_breadcrumb($home_text, $delimiter);
      ?>
    </div>
  </div>
</section>
