<?php
/**
 * Block Name: Widget - Recent Posts
**/

$number_posts = get_field('number_posts');

$recent_posts = wp_get_recent_posts(array(
	'numberposts' => $number_posts,
	'post_status' => 'publish'
));

?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-recent-posts">
  <?php foreach( $recent_posts as $post_item ) { ?>
		<div class="bt-post">
			<a href="<?php echo get_permalink($post_item['ID']) ?>">
        <div class="bt-post--thumbnail">
          <div class="bt-cover-image">
    				<?php echo get_the_post_thumbnail($post_item['ID'], 'thumbnail'); ?>
          </div>
        </div>
        <div class="bt-post--infor">
          <div class="bt-post--date">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					    <path d="M18.3333 1.87499H15.625V0.624989C15.6133 0.288322 15.3383 0.019989 15 0.019989C14.6617 0.019989 14.3867 0.288322 14.375 0.624156V1.87499H10.625V0.624989C10.6133 0.288322 10.3383 0.019989 10 0.019989C9.66167 0.019989 9.38667 0.288322 9.375 0.624156V1.87499H5.625V0.624989C5.61333 0.288322 5.33833 0.019989 5 0.019989C4.66167 0.019989 4.38667 0.288322 4.375 0.624156V1.87499H1.66667C0.746667 1.87499 0 2.62082 0 3.54082V18.3325C0 19.2533 0.745833 19.9992 1.66667 19.9992H18.3333C19.2542 19.9992 20 19.2533 20 18.3325V3.54082C20 2.62082 19.2533 1.87499 18.3333 1.87499ZM18.75 18.3333C18.75 18.5633 18.5633 18.7492 18.3342 18.75H1.66667C1.43667 18.75 1.25 18.5633 1.25 18.3333V3.54166C1.25083 3.31166 1.43667 3.12582 1.66667 3.12582H4.375V4.37582C4.38667 4.71249 4.66167 4.98082 5 4.98082C5.33833 4.98082 5.61333 4.71249 5.625 4.37666V3.12582H9.375V4.37582C9.38667 4.71249 9.66167 4.98082 10 4.98082C10.3383 4.98082 10.6133 4.71249 10.625 4.37666V3.12582H14.375V4.37582C14.3867 4.71249 14.6617 4.98082 15 4.98082C15.3383 4.98082 15.6133 4.71249 15.625 4.37666V3.12582H18.3333C18.5633 3.12582 18.7492 3.31249 18.7492 3.54166L18.75 18.3333Z"/>
					    <path d="M4.375 7.5H6.875V9.375H4.375V7.5Z"/>
					    <path d="M4.375 10.625H6.875V12.5H4.375V10.625Z"/>
					    <path d="M4.375 13.75H6.875V15.625H4.375V13.75Z"/>
					    <path d="M8.75 13.75H11.25V15.625H8.75V13.75Z"/>
					    <path d="M8.75 10.625H11.25V12.5H8.75V10.625Z"/>
					    <path d="M8.75 7.5H11.25V9.375H8.75V7.5Z"/>
					    <path d="M13.125 13.75H15.625V15.625H13.125V13.75Z"/>
					    <path d="M13.125 10.625H15.625V12.5H13.125V10.625Z"/>
					    <path d="M13.125 7.5H15.625V9.375H13.125V7.5Z"/>
						</svg>
            <?php echo get_the_date( get_option( 'date_format' ), $post_item['ID'] ); ?>
          </div>
  				<?php echo '<h3 class="bt-post--title">' . $post_item['post_title'] . '</h3>'; ?>
          <div class="bt-post--author">
            <?php echo esc_html__('By ', 'autoart') . get_the_author_meta( 'display_name', $post_item['post_author'] ); ?>
          </div>
        </div>
			</a>
		</div>
	<?php } ?>
</div>
