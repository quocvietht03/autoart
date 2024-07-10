<?php
/**
 * Block Name: Widget - Contact Info
**/

$heading = get_field('heading');
$desc    = get_field('description');
$form    = get_field('shortcode_form');

?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-contact-information">
  <div class="bt-contact-information">
    <div class="bt-contact-information-header"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
        <path d="M30.2083 19.7919H19.7917M6.309 20.8335L21.3012 30.8681C22.6377 31.7592 23.306 32.2046 24.0283 32.3777C24.6665 32.5306 25.3319 32.5306 25.9702 32.3777C26.6925 32.2046 27.3608 31.7592 28.6973 30.8681L43.6896 20.8335M21.4544 8.47691L9.37112 16.0654C8.23169 16.781 7.66198 17.1387 7.24875 17.6224C6.88302 18.0505 6.60783 18.5483 6.43981 19.0857C6.25 19.6928 6.25 20.3656 6.25 21.711V35.0002C6.25 37.3337 6.25 38.5006 6.70415 39.3919C7.1036 40.1758 7.74102 40.8133 8.52504 41.2127C9.41633 41.6669 10.5831 41.6669 12.9167 41.6669H37.0833C39.4169 41.6669 40.5838 41.6669 41.475 41.2127C42.259 40.8133 42.8965 40.1758 43.2958 39.3919C43.75 38.5006 43.75 37.3337 43.75 35.0002V21.711C43.75 20.3656 43.75 19.6928 43.5602 19.0857C43.3921 18.5483 43.1171 18.0505 42.7512 17.6224C42.3381 17.1387 41.7683 16.781 40.629 16.0654L28.5456 8.47689C27.2596 7.66935 26.6167 7.26555 25.9269 7.10816C25.3167 6.96899 24.6833 6.96899 24.0731 7.10816C23.3833 7.26555 22.7404 7.66935 21.4544 8.47691Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>

      <div class="bt-contact-information-header-inner">
        <?php 
          if(!empty($heading)) {
            echo '<h3 class="bt-contact-information--heading">' . $heading . '</h3>';
          }
          
          if(!empty($desc)) {
            echo '<div class="bt-contact-information--desc">' . $desc . '</div>';
          }
        ?>
      </div>
    </div>

    <div class="bt-contact-information--form">  
      <?php 
          if(!empty($form)) {
            echo do_shortcode($form);
          }
      ?>
    </div>
  </div>
</div>
