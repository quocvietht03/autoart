<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo autoart_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <div class="bt-post--auto-detailing"> 
        <a href="<?php echo esc_url(get_permalink()) ?>"> <?php esc_html_e( 'Auto Detailing', 'autoart' ); ?> </a>
      </div>

      <?php echo autoart_post_title_render(); ?>

      <div class="bt-post--info"> 
        <?php 
          echo autoart_post_publish_render();
          echo autoart_author_icon_render();
        ?>
      </div>

      <?php echo autoart_post_button_render('View Details') ?>
    </div>
  </div>
</article>
