<?php
$car_by_dealer = get_field('car_by_dealer', 'options');

$post_id = get_the_ID();
$cat_ids = array();
$categories = get_the_category( $post_id );

if(!empty($categories) && !is_wp_error($categories)) {
  foreach ($categories as $category) {
    array_push($cat_ids, $category->term_id);
  }
}

$current_post_type = get_post_type($post_id);

$query_args = array(
    'post_type'      => 'car',
    'posts_per_page'  => !empty($car_by_dealer['number_posts']) ? $car_by_dealer['number_posts'] : 4,
    'meta_query' => array(
      'state_clause' => array(
          'key' => 'car_dealer',
          'value' => get_the_ID(),
      )
    ),
 );

$list_posts = new WP_Query( $query_args );

if($list_posts->have_posts()) {
?>
  <div class="bt-car-by-dealer-ss">
    <?php
      if(!empty($car_by_dealer['heading'])) {
        echo '<h2 class="bt-car-by-dealer-ss--heading"><span>' . $car_by_dealer['heading'] . '</span></h2>';
        
      }
    ?>
    <div class="bt-car-by-dealer-ss--list">
      <?php
        while($list_posts->have_posts()): $list_posts->the_post();
          get_template_part( 'framework/templates/car', 'style', array('image-size' => 'medium_large'));
        endwhile; wp_reset_postdata();
      ?>
    </div>
  </div>
<?php
}
