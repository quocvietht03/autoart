<?php $icon = get_field('icon'); ?>

<article <?php post_class('bt-post'); ?>>
    <div class="bt-post--inner">
      <?php if(!empty($icon) && isset($icon)): ?>
        <div class="bt-post--icon"> 
          <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['title']); ?>" />
        </div>
      <?php endif;?>  

      <h3 class="bt-post--title">
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </h3>

      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
  </div>
</article>
