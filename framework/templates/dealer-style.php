<?php
$dealer = get_the_ID();
$d_title = get_the_title($dealer);
$d_avatar = get_field('avatar', $dealer);
$d_job = get_field('job', $dealer);
$d_phone = get_field('phone', $dealer);
$d_email = get_field('email', $dealer);
?>
<article <?php post_class('bt-post'); ?>>
    <div class="bt-post--inner">
        <div class="bt-post--avatar">
            <div class="bt-cover-image">
                <?php
                if(!empty($d_avatar)) {
                  $image = wp_get_attachment_image_src( $d_avatar['id'], $args['image-size'] );
                    echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr($d_avatar['title']) . '" />';
                }
                ?>
            </div>
        </div>
        <div class="bt-post--content">
            <div class="bt-post--titlejob">
                <?php echo autoart_post_title_render(); ?>
                <?php
                if(!empty($d_job)) {
                    echo '<span>'.$d_job.'</span>';
                }
                ?>
            </div>
            <div class="bt-post--info">
                <?php if(!empty($d_phone)) { ?>
                    <div class="bt-meta-item">

                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"></path>
                        </svg>
                        <?php echo '<span>' . $d_phone . '</span>'; ?>

                    </div>
                <?php } ?>
                <?php if(!empty($d_email)) { ?>
                    <div class="bt-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M255.4 48.2c.2-.1 .4-.2 .6-.2s.4 .1 .6 .2L460.6 194c2.1 1.5 3.4 3.9 3.4 6.5v13.6L291.5 355.7c-20.7 17-50.4 17-71.1 0L48 214.1V200.5c0-2.6 1.2-5 3.4-6.5L255.4 48.2zM48 276.2L190 392.8c38.4 31.5 93.7 31.5 132 0L464 276.2V456c0 4.4-3.6 8-8 8H56c-4.4 0-8-3.6-8-8V276.2zM256 0c-10.2 0-20.2 3.2-28.5 9.1L23.5 154.9C8.7 165.4 0 182.4 0 200.5V456c0 30.9 25.1 56 56 56H456c30.9 0 56-25.1 56-56V200.5c0-18.1-8.7-35.1-23.4-45.6L284.5 9.1C276.2 3.2 266.2 0 256 0z"></path>
                        </svg>
                        <?php echo '<span>' . $d_email . '</span>'; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article>
