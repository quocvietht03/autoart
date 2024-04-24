<?php 
    $data = $args['data'];
    // echo "<pre>";
    // echo print_r($data['car_form_search_icon']);
    // echo "</pre>";
?>

<div class="bt-elwg-cars-search-inner">
    <div class="bt-elwg-cars-search--header"> 
        <?php if($args['layout'] == 'style-1'): ?>
            <?php if( isset($data['car_form_search_icon']) && !empty($data['car_form_search_icon'])): ?>
                <?php 
                    $icon      = $data['car_form_search_icon'];
                    $path_info = pathinfo($icon['url']);    

                    if (strtolower($path_info['extension']) === 'svg') {
                        echo file_get_contents( $icon['url'] );
                    } else {
                        echo '<img src=" ' . esc_url( $icon['url'] ) . ' " alt="image">';
                    }
                ?>
            <?php endif; ?>   

            <?php if( isset($data['car_form_search_heading']) && !empty($data['car_form_search_heading'])): ?>
                <h3> <?php echo esc_attr($data['car_form_search_heading']) ?> </h3>
            <?php endif; ?>    

            <?php if( isset($data['car_form_search_sub_heading']) && !empty($data['car_form_search_sub_heading'])): ?>
                <p> <?php echo esc_attr($data['car_form_search_sub_heading']) ?> </p>
            <?php endif; ?>    
        <?php endif;?>    
    </div>
    
    <div class="bt-elwg-cars-search--form"> 
        <form class="bt-car-search-form" action="<?php echo esc_url( home_url( '/cars' ) ); ?>" method="get">
            <?php 
                $field_name  = __('Choose Makes', 'autoart');
                $field_value = (isset($_GET['car_make'])) ? $_GET['car_make'] : '';
                autoart_cars_field_select_html('car_make', $field_name, $field_value);

                $field_name  = __('Choose Models', 'autoart');
                $field_value = (isset($_GET['car_model'])) ? $_GET['car_model'] : '';
                autoart_cars_field_select_html('car_model', $field_name, $field_value);

                $field_title = __('All Price', 'autoart');
                $field_value = (isset($_GET['car_price'])) ? $_GET['car_price'] : '';
                $field_step  = 1000;
                autoart_cars_field_select_range_html('car_price', $field_title, $field_value, $field_step);
            ?> 

            <div class="bt-form-field bt-field-submit"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path d="M14.4792 14.4935L19.25 19.25M16.5 9.625C16.5 13.4219 13.4219 16.5 9.625 16.5C5.82804 16.5 2.75 13.4219 2.75 9.625C2.75 5.82804 5.82804 2.75 9.625 2.75C13.4219 2.75 16.5 5.82804 16.5 9.625Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="submit"  class="btn btn-primary" value="Search Now">
            </div>
        </form>

        <?php if(!empty($data['cars_top_search']) && isset($data['cars_top_search'])): ?>
            <div class="bt-elwg-cars-search--form-top-search">  
                <?php if(!empty($data['top_search_title']) && isset($data['top_search_title'])): ?>
                    <p> <?php echo $data['top_search_title']  ?> </p>
                <?php endif; ?>	

                <div class="bt-elwg-cars-search--form-top-search-inner">
                    <?php foreach ( $data['cars_top_search'] as $index => $item ): ?>			
                        <?php if(!empty($item['top_search_text']) && !empty($item['top_search_link'])): ?>
                            <div class="item-top-search"> 
                                <a href="<?php echo esc_url($item['top_search_link']) ?>"> 
                                    <?php echo esc_html_e($item['top_search_text']) ?>
                                </a>
                            </div>
                        <?php endif;?>	
                    <?php endforeach; ?>	
                </div>	
            </div>
        <?php endif;?>	
    </div>	

    <?php if($args['layout'] == 'style-1'): ?>
        <div class="bt-elwg-cars-search--cta"> 
            <?php if(!empty($data['car_form_search_cta_link']) && isset($data['car_form_search_cta_link']) && !empty($data['car_form_search_cta_text']) && isset($data['car_form_search_cta_text'])): ?>
                <a href="<?php echo esc_url($data['car_form_search_cta_link']) ?>"> 
                    <span> <?php echo esc_attr($data['car_form_search_cta_text']) ?> </span>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M2.258 1.315a.265.265 0 0 0-.174.469L3.703 3.17l-1.62 1.386a.265.265 0 1 0 .345.4L4.28 3.373a.265.265 0 0 0 0-.403L2.428 1.382a.265.265 0 0 0-.17-.067z" fill="#000000" opacity="1" data-original="#000000"></path></g></svg>
                </a>
            <?php endif;?>     
        </div>
    <?php endif;?>    
</div>