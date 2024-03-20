<?php
// $job = get_field('job');

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php if (has_post_thumbnail()){ ?>
      <div class="bt-post--thumbnail">
        <?php echo autoart_post_cover_featured_render($args['image-size']); ?>
      </div>
    <?php } ?>

    <div class="bt-post--infor">
      <?php echo autoart_post_title_render(); ?>

      <div class="bt-post--btn">
        <a class="bt-car-wishlist-btn <?php if(autoart_is_wishlist(get_the_ID())) echo 'added'; ?>" href="#" data-id="<?php echo get_the_ID(); ?>">W</a>
        <a class="bt-car-compare-btn <?php if(autoart_is_compare(get_the_ID())) echo 'added'; ?>" href="#" data-id="<?php echo get_the_ID(); ?>">C</a>
      </div>
    </div>
  </div>
</article>
