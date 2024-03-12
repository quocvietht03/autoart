<article <?php post_class('bt-post'); ?>>
	<?php
		echo autoart_post_featured_render('full');
		echo autoart_post_publish_render();
		if(is_single()){
      echo autoart_single_post_title_render();
		}else{
      echo autoart_post_title_render();
		}
		echo autoart_post_meta_render();
		echo autoart_post_content_render();
	?>
</article>
