<?php 
    $items = $args['data'];
    $thumbnail_size = $args['thumbnail-size'];
?>

<div class="bt-elwg-list-image-text-inner"> 
    <?php foreach ( $items as $index => $item ): ?>
        <?php 
            $attachment = wp_get_attachment_image_src( $item['lit_image']['id'], $thumbnail_size ); 
            $delay      = ($index + 1) * 100;
            $animation  = 'fadeInUp';
        ?>
        <div class="item-image-text"> 
            <div class="item-image-text-inner" data-settings='<?php echo json_encode(["_animation" => $animation, "_animation_delay" => $delay]); ?>'>
                <?php if(!empty($attachment)): ?>
                    <div class="item-image-text--thumbnail"> 
                        <?php echo '<img src=" ' . esc_url( $item['lit_image']['url'] ) . ' " alt="image" />'; ?>
                    </div>
                <?php endif;?>

                <?php if(!empty($item['lit_text'])): ?>
                    <h3> <?php echo $item['lit_text'] ?> </h3>
                <?php endif;?>	
                
                <?php if(!empty($item['lit_link'])): ?>
                    <a href="<?php echo esc_url($item['lit_link']) ?>"> </a>
                <?php endif;?>		
            </div>
        </div>
    <?php endforeach;?>		
</div>	