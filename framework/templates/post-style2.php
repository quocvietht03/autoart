<article <?php post_class('bt-post'); ?>>
    <div class="bt-post--inner">
        <div class="bt-post--inner-left"> 
            <?php 
                echo autoart_post_cover_featured_render($args['image-size']); 
                echo autoart_post_categories_render();
            ?>
        </div>

        <div class="bt-post--inner-right"> 
            <?php 
                echo autoart_post_publish_render(); 
                echo autoart_post_title_render();  
                echo autoart_post_content_render();  
            ?>

            <div class="bt-post-meta"> 
                <?php 
                    echo autoart_author_w_avatar();
                    echo autoart_reading_time_render();
                ?>
            </div>
        </div>
    </div>
</article>
