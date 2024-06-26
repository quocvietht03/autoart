<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo autoart_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
        <?php 
            echo autoart_post_publish_render();  
            echo autoart_post_categories_render();
            echo autoart_post_title_render();  
            echo autoart_post_content_render();  
        ?>

        <div class="bt-post-meta"> 
            <?php 
                echo autoart_author_w_avatar(); 
                echo autoart_post_button_render('Read Now')     
            ?>
        </div>
    </div>
  </div>
</article>
