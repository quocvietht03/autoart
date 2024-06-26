<?php
/* Count post view. */
if ( ! function_exists( 'autoart_set_count_view' ) ) {
  function autoart_set_count_view(){
    $post_id = get_the_ID();

  	if(is_single() && !empty($post_id) && !isset($_COOKIE['autoart_post_view_'. $post_id])){
      $views = get_post_meta($post_id , '_post_count_views', true);
      $views = $views ? $views : 0 ;
      $views++;

      update_post_meta($post_id, '_post_count_views' , $views);

      /* set cookie. */
      setcookie('autoart_post_view_'. $post_id, $post_id, time() * 20, '/');
    }
  }
}
add_action( 'wp', 'autoart_set_count_view' );

/* Post count view */
if ( ! function_exists( 'autoart_get_count_view' ) ) {
  function autoart_get_count_view() {
  	$post_id = get_the_ID();
      $views = get_post_meta($post_id , '_post_count_views', true);

      $views = $views ? $views : 0 ;
      $label = $views > 1 ? esc_html__('Views', 'autoart') : esc_html__('View', 'autoart') ;
      return $views . ' ' . $label;
  }
}

/* Post Reading */
if ( ! function_exists( 'autoart_reading_time_render' ) ) {
  function autoart_reading_time_render() {
    $content = get_the_content();
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);

    return '<div class="bt-reading-time">' . $readingtime . ' min read' . '</div>';
  }
}

/* Single Post Title */
if ( ! function_exists( 'autoart_single_post_title_render' ) ) {
	function autoart_single_post_title_render() {
		ob_start();
    ?>
      <h3 class="bt-post--title">
        <?php the_title(); ?>
      </h3>
    <?php

		return ob_get_clean();
	}
}

/* Post Title */
if ( ! function_exists( 'autoart_post_title_render' ) ) {
	function autoart_post_title_render() {
		ob_start();
    ?>
      <h3 class="bt-post--title">
        <a href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
        </a>
      </h3>
    <?php

		return ob_get_clean();
	}
}

/* Post Featured */
if ( ! function_exists( 'autoart_post_featured_render' ) ) {
	function autoart_post_featured_render($image_size = 'full') {
		ob_start();

    if(is_single()){
      if (has_post_thumbnail()){
        ?>
        <div class="bt-post--featured">
          <?php the_post_thumbnail($image_size); ?>
        </div>
        <?php
      }
		}else{
      if (has_post_thumbnail()){
        ?>
        <div class="bt-post--featured">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail($image_size); ?>
          </a>
        </div>
        <?php
      }
		}

		return ob_get_clean();
	}
}

/* Post Cover Featured */
if ( ! function_exists( 'autoart_post_cover_featured_render' ) ) {
	function autoart_post_cover_featured_render($image_size = 'full') {
		ob_start();
    ?>
    <div class="bt-post--featured">
      <a href="<?php the_permalink(); ?>">
        <div class="bt-cover-image">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail($image_size);
            }
          ?>
        </div>
      </a>
    </div>
    <?php

		return ob_get_clean();
	}
}

/* Post Publish */
if ( ! function_exists( 'autoart_post_publish_render' ) ) {
	function autoart_post_publish_render() {
		ob_start();

		?>
			<div class="bt-post--publish">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
          <g clip-path="url(#clip0_374_2405)">
            <path d="M23.8333 2.43787H20.3125V0.812867C20.2973 0.3752 19.9398 0.0263672 19.5 0.0263672C19.0602 0.0263672 18.7027 0.375201 18.6875 0.811784V2.43787H13.8125V0.812867C13.7973 0.3752 13.4398 0.0263672 13 0.0263672C12.5602 0.0263672 12.2027 0.375201 12.1875 0.811784V2.43787H7.3125V0.812867C7.29733 0.3752 6.93983 0.0263672 6.5 0.0263672C6.06017 0.0263672 5.70267 0.375201 5.6875 0.811784V2.43787H2.16667C0.970667 2.43787 0 3.40745 0 4.60345V23.8326C0 25.0297 0.969583 25.9993 2.16667 25.9993H23.8333C25.0304 25.9993 26 25.0297 26 23.8326V4.60345C26 3.40745 25.0293 2.43787 23.8333 2.43787ZM24.375 23.8337C24.375 24.1327 24.1323 24.3743 23.8344 24.3754H2.16667C1.86767 24.3754 1.625 24.1327 1.625 23.8337V4.60453C1.62608 4.30553 1.86767 4.06395 2.16667 4.06395H5.6875V5.68895C5.70267 6.12662 6.06017 6.47545 6.5 6.47545C6.93983 6.47545 7.29733 6.12662 7.3125 5.69003V4.06395H12.1875V5.68895C12.2027 6.12662 12.5602 6.47545 13 6.47545C13.4398 6.47545 13.7973 6.12662 13.8125 5.69003V4.06395H18.6875V5.68895C18.7027 6.12662 19.0602 6.47545 19.5 6.47545C19.9398 6.47545 20.2973 6.12662 20.3125 5.69003V4.06395H23.8333C24.1323 4.06395 24.3739 4.30662 24.3739 4.60453L24.375 23.8337Z" fill="#1FBECD"/>
            <path d="M5.6875 9.75H8.9375V12.1875H5.6875V9.75Z" fill="#1FBECD"/>
            <path d="M5.6875 13.8125H8.9375V16.25H5.6875V13.8125Z" fill="#1FBECD"/>
            <path d="M5.6875 17.875H8.9375V20.3125H5.6875V17.875Z" fill="#1FBECD"/>
            <path d="M11.375 17.875H14.625V20.3125H11.375V17.875Z" fill="#1FBECD"/>
            <path d="M11.375 13.8125H14.625V16.25H11.375V13.8125Z" fill="#1FBECD"/>
            <path d="M11.375 9.75H14.625V12.1875H11.375V9.75Z" fill="#1FBECD"/>
            <path d="M17.0625 17.875H20.3125V20.3125H17.0625V17.875Z" fill="#1FBECD"/>
            <path d="M17.0625 13.8125H20.3125V16.25H17.0625V13.8125Z" fill="#1FBECD"/>
            <path d="M17.0625 9.75H20.3125V12.1875H17.0625V9.75Z" fill="#1FBECD"/>
          </g>
          <defs>
            <clipPath id="clip0_374_2405">
              <rect width="26" height="26" fill="white"/>
            </clipPath>
          </defs>
        </svg>
        <span> <?php echo get_the_date(get_option('date_format')); ?> </span>
			</div>
		<?php

		return ob_get_clean();
	}
}

if ( ! function_exists( 'autoart_post_categories_render' ) ) {
	function autoart_post_categories_render() {
    ob_start();
    ?>
      <div class="bt-post--categories"> 
        <?php the_terms( get_the_ID(), 'category', '<div class="bt-post-cat">', ', ', '</div>' ); ?>
      </div>
    <?php
    return ob_get_clean();
  }
}

/* Post Short Meta */
if ( ! function_exists( 'autoart_post_short_meta_render' ) ) {
	function autoart_post_short_meta_render() {
    ob_start();
		?>
      <div class="bt-post--meta">
        <?php
          the_terms( get_the_ID(), 'category', '<div class="bt-post-cat">', ', ', '</div>' );
          echo autoart_reading_time_render();
        ?>
      </div>
		<?php
		return ob_get_clean();
	}
}

/* Post Meta */
if ( ! function_exists( 'autoart_post_meta_render' ) ) {
	function autoart_post_meta_render() {
		ob_start();

		?>
			<ul class="bt-post--meta">
        <li class="bt-meta bt-meta--category">
          <?php
            the_terms( get_the_ID(), 'category', '<div class="bt-post-cat">', ', ', '</div>' );
            echo autoart_reading_time_render();
          ?>
        </li>
        <li class="bt-meta bt-meta--view">
          <a href="<?php echo get_the_permalink(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
              <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
            </svg>
            <?php echo autoart_get_count_view(); ?>
          </a>
        </li>
        <li class="bt-meta bt-meta--author">
          <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
              <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
            </svg>
            <?php echo get_the_author(); ?>
          </a>
        </li>
				<li class="bt-meta bt-meta--comment">
          <a href="<?php comments_link(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
              <path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/>
            </svg>
            <?php comments_number( esc_html__('0 Comments', 'autoart'), esc_html__('1 Comment', 'autoart'), esc_html__('% Comments', 'autoart') ); ?>
          </a>
        </li>
			</ul>
		<?php

		return ob_get_clean();
	}
}

/* Post Content */
if ( ! function_exists( 'autoart_post_content_render' ) ) {
	function autoart_post_content_render() {

		ob_start();

		if(is_single()){
      ?>
        <div class="bt-post--content">
          <?php
            the_content();
            wp_link_pages(array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'autoart'),
              'after' => '</div>',
            ));
          ?>
        </div>
      <?php
		}else{
      ?>
        <div class="bt-post--excerpt">
          <?php echo get_the_excerpt(); ?>
        </div>
      <?php
		}

		return ob_get_clean();
	}
}

/* Post tag */
if ( ! function_exists( 'autoart_tags_render' ) ) {
	function autoart_tags_render() {
		ob_start();
		if(has_tag()){
			?>
        <div class="bt-post-tags">
        <?php
          if(has_tag()){
            the_tags( '<span>'.esc_html__('Tags: ', 'autoart').'</span>', '', '' );
          }
        ?>
      </div>
			<?php
		}
		return ob_get_clean();
	}
}

/* Post share */
if ( ! function_exists( 'autoart_share_render' ) ) {
	function autoart_share_render() {

		$social_item = array();
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="'.esc_attr__('Facebook', 'autoart').'" href="https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink().'">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-twitter" data-toggle="tooltip" title="'.esc_attr__('Twitter', 'autoart').'" href="https://twitter.com/share?url='.get_the_permalink().'">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-google-plus" data-toggle="tooltip" title="'.esc_attr__('Google Plus', 'autoart').'" href="https://plus.google.com/share?url='.get_the_permalink().'">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
                            <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="'.esc_attr__('Linkedin', 'autoart').'" href="https://www.linkedin.com/shareArticle?url='.get_the_permalink().'">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                          </svg>
                        </a>
                      </li>';
		$social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-pinterest" data-toggle="tooltip" title="'.esc_attr__('Pinterest', 'autoart').'" href="https://pinterest.com/pin/create/button/?url='.get_the_permalink().'">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512">
                            <path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/>
                          </svg>
                        </a>
                      </li>';

		ob_start();
    if ( is_singular( 'post' ) && has_tag() ) { ?>
      <div class="bt-post-share">
        <?php if ( !empty( $social_item ) ) {
              echo '<span>' . esc_html__( 'Share: ', 'autoart' ) . '</span><ul>' . implode( ' ', $social_item ) . '</ul>';
        } ?>
      </div>
      
    <?php } elseif ( !empty( $social_item ) ) { ?>

      <div class="bt-post-share">
        <span><?php echo esc_html__( 'Share: ', 'autoart' ); ?></span>
        <ul><?php echo implode( ' ', $social_item ); ?></ul>
      </div>
    <?php }

		return ob_get_clean();
	}
}

/* Post Button */
if ( ! function_exists( 'autoart_post_button_render' ) ) {
	function autoart_post_button_render($text) {?>
    <div class="bt-post--button">  
      <a href="<?php echo esc_url(get_permalink()) ?>"> 
        <span> <?php echo esc_html($text) ?> </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#1FBECD" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </a>
    </div>
  <?php }
}

/* Author Icon */
if ( ! function_exists( 'autoart_author_icon_render' ) ) {
	function autoart_author_icon_render() { ?>
    <div class="bt-post-author"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
        <path d="M8.66634 7.58333C8.66634 9.97657 10.6065 11.9167 12.9997 11.9167C15.3929 11.9167 17.333 9.97657 17.333 7.58333C17.333 5.1901 15.3929 3.25 12.9997 3.25C10.6065 3.25 8.66634 5.1901 8.66634 7.58333Z" stroke="#1FBECD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12.9997 15.167C17.1878 15.167 20.583 18.5622 20.583 22.7503H5.41634C5.41634 18.5622 8.81151 15.167 12.9997 15.167Z" stroke="#1FBECD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <h4 class="bt-post-author--name"> By <?php the_author(); ?>  </h4>
    </div>
  <?php }
}

/* Author Icon */
if ( ! function_exists( 'autoart_author_w_avatar' ) ) {
	function autoart_author_w_avatar() {
    $author_id = get_the_author_meta( 'ID' );  
  ?>
    <div class="bt-post-author-w-avatar"> 
      <div class="bt-post-author-w-avatar--thumbnail">
        <?php
          if(!empty($avatar)) {
            echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
          } else {
            echo get_avatar( $author_id, 150 );
          }
        ?>
      </div>

      <h4 class="bt-post-author-w-avatar--name"> By <?php the_author(); ?> </h4>
    </div>
  <?php }
}

/* Author */
if ( ! function_exists( 'autoart_author_render' ) ) {
	function autoart_author_render() {
    $author_id = get_the_author_meta( 'ID' );
    $desc = get_the_author_meta('description');

    if(function_exists('get_field')){
      $avatar = get_field('avatar', 'user_'. $author_id);
      $job = get_field('job', 'user_'. $author_id);
      $socials = get_field('socials', 'user_'. $author_id);
    } else {
      $avatar = array();
      $job = '';
      $socials = array();
    }

		ob_start();
		?>
		<div class="bt-post-author">
			<div class="bt-post-author--avatar">
        <?php
          if(!empty($avatar)) {
            echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
          } else {
            echo get_avatar( $author_id, 150 );
          }
        ?>
      </div>
			<div class="bt-post-author--info">
				<h4 class="bt-post-author--name">
          <span class="bt-name">
            <?php the_author(); ?>
          </span>
          <?php
            if(!empty($job)) {
              echo '<span class="bt-label">' . $job . '</span>';
            }
          ?>
        </h4>
        <?php
        if(!empty($desc)) {
          echo '<div class="bt-post-author--desc">' . $desc . '</div>';
        }

        if(!empty($socials)) {
        ?>
        <div class="bt-post-author--socials">
          <?php
            foreach ($socials as $item) {
              if($item['social'] == 'facebook') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                          <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                        </svg>
                      </a>';
              }

              if($item['social'] == 'linkedin') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                          <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                      </a>';
              }

              if($item['social'] == 'twitter') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                      </a>';
              }

              if($item['social'] == 'google') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                          <path d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"/>
                        </svg>
                      </a>';
              }
            }
          ?>
        </div>
        <?php
        }
        ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}


/* Related posts */
if ( ! function_exists( 'autoart_related_posts' ) ) {
	function autoart_related_posts() {
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
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => 2,
     );

    $list_posts = new WP_Query( $query_args );

		ob_start();

    if($list_posts->have_posts()) {
		?>
		<div class="bt-related-posts">
			<h2 class="bt-related-posts--heading">
        <?php esc_html_e('Related Posts', 'autoart'); ?>
      </h2>
      <div class="bt-related-posts--list bt-image-effect">
        <?php
        while($list_posts->have_posts()): $list_posts->the_post();
          get_template_part( 'framework/templates/post', 'related');
        endwhile; wp_reset_postdata();
      ?>
      </div>
		</div>
		<?php
    }
		return ob_get_clean();
	}
}

//Comment Field Order
function autoart_comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $cookies_field = $fields['cookies'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    // done ordering, now return the fields:
    return $fields;
}
add_filter( 'comment_form_fields', 'autoart_comment_fields_custom_order' );

/* Custom comment list */
if ( ! function_exists( 'autoart_custom_comment' ) ) {
  function autoart_custom_comment($comment, $args, $depth) {
  	$GLOBALS['comment'] = $comment;
  	extract($args, EXTR_SKIP);

  	if ( 'div' == $args['style'] ) {
  		$tag = 'div';
  		$add_below = 'comment';
  	} else {
  		$tag = 'li';
  		$add_below = 'div-comment';
  	}
  ?>
  	<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'bt-comment-item clearfix' : 'bt-comment-item parent clearfix' ) ?> id="comment-<?php comment_ID() ?>">
  	<div class="bt-comment">
  		<div class="bt-avatar">
  			<?php
        if(function_exists('get_field')){
        	$avatar = get_field('avatar', 'user_'. $comment->user_id);
        } else {
          $avatar = array();
        }
      	if(!empty($avatar)) {
      		echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
      	} else {
          if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );
        }


        ?>
  		</div>
  		<div class="bt-content">
  			<h5 class="bt-name">
          <?php echo get_comment_author( get_comment_ID() ); ?>
        </h5>
  			<div class="bt-date">
          <?php echo get_comment_date(); ?>
        </div>
  			<?php if ( $comment->comment_approved == '0' ) : ?>
  				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'autoart' ); ?></em>
  			<?php endif; ?>
        <div class="bt-text">
    			<?php comment_text(); ?>
        </div>
  			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
  		</div>
  	</div>
  <?php
  }
}
