<?php 
  $icon = get_field('icon'); 
  $desc = get_field('description_service');
?>

<article <?php post_class('bt-post'); ?>>
    <div class="bt-post--inner">
      <?php if(!empty($icon) && isset($icon)): ?>
        <div class="bt-post--icon"> 
          <div class="bt-post--icon-inner"> 
            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['title']); ?>" />
          </div>

          <div class="bt-post--icon-bg"> 
              <?php if($args['layout'] == 'style-1'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120" fill="none">
                  <path d="M60 119C92.5848 119 119 92.5848 119 60C119 27.4152 92.5848 1 60 1C27.4152 1 1 27.4152 1 60C1 92.5848 27.4152 119 60 119Z" fill="white" stroke="#1FBECD" stroke-width="2" stroke-linejoin="round"/>
                </svg>
              <?php endif; ?> 
              
              <?php if($args['layout'] == 'style-2'): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="109" height="90" viewBox="0 0 109 90" fill="none">
                  <path d="M45.4998 89.9924C43.1074 89.9713 40.8003 89.9052 38.5805 89.7853L38.6075 89.286C34.9337 89.0876 31.5064 88.7417 28.3339 88.2094L28.2512 88.7026C23.2245 87.8593 18.8203 86.5496 15.0778 84.6172L15.3072 84.1729C14.2807 83.6428 13.3061 83.0659 12.384 82.4389L12.1029 82.8524C10.1716 81.5392 8.46112 80.0072 6.97903 78.2271L7.36329 77.9072C5.31915 75.4519 3.71292 72.5078 2.56965 68.985L2.09406 69.1394C0.845277 65.2915 0.145423 60.7781 0.0203711 55.4966L0.520231 55.4847C0.506757 54.9157 0.5 54.3375 0.5 53.75C0.5 53.0439 0.513933 52.3411 0.541541 51.6417L0.0419304 51.622C0.155402 48.7476 0.49775 45.9311 1.0515 43.1898L1.5416 43.2888C2.38707 39.1033 3.73007 35.0948 5.50733 31.3254L5.05508 31.1122C7.48693 25.9545 10.724 21.2409 14.6071 17.1284L14.9706 17.4717C15.9342 16.4512 16.9379 15.4681 17.9793 14.5247L17.6436 14.1542C19.739 12.256 21.9856 10.5175 24.3634 8.9583L24.6376 9.37642C28.1323 7.0848 31.9132 5.18397 35.916 3.73718L35.7461 3.26695C40.961 1.38206 46.5493 0.260721 52.3718 0.0402278L52.3907 0.53987C53.0905 0.513371 53.7936 0.5 54.5 0.5C55.2064 0.5 55.9095 0.513371 56.6093 0.53987L56.6282 0.0402278C59.5035 0.149115 62.3218 0.477699 65.0662 1.00944L64.9711 1.50031C69.1716 2.3142 73.1974 3.60838 76.9872 5.32246L77.1933 4.86689C82.4093 7.22602 87.1826 10.3733 91.3564 14.1542L91.0207 14.5247C92.0621 15.4681 93.0658 16.4512 94.0294 17.4717L94.3929 17.1284C96.3384 19.1888 98.1217 21.4001 99.7228 23.7425L99.31 24.0246C101.675 27.484 103.638 31.2317 105.134 35.2029L105.602 35.0266C107.562 40.226 108.728 45.8054 108.958 51.622L108.458 51.6417C108.486 52.3411 108.5 53.0439 108.5 53.75C108.5 54.4184 108.484 55.0694 108.452 55.7034L108.952 55.7284C108.807 58.6079 108.344 61.1531 107.596 63.4136L107.121 63.2566C105.823 67.1818 103.649 70.2237 100.78 72.6647L101.104 73.0455C97.4381 76.1642 92.6706 78.3144 87.1765 80.038L87.0268 79.5609C85.815 79.941 84.5666 80.3007 83.2852 80.6456L83.4152 81.1284C80.9782 81.7844 78.4276 82.3863 75.7913 82.9743L75.6825 82.4864C73.8427 82.8967 71.9608 83.3003 70.0442 83.7114L70.0331 83.7138C68.1132 84.1256 66.1588 84.5448 64.1812 84.9849L64.2898 85.473C59.3238 86.5781 54.2133 87.8148 49.11 89.4021L48.9615 88.9247C48.361 89.1115 47.7605 89.3031 47.1603 89.5C46.6037 89.4998 46.0517 89.4973 45.5043 89.4925L45.4998 89.9924Z" fill="white" stroke="#1FBECD" stroke-dasharray="4 8 12 16"/>
                </svg>
              <?php endif; ?> 
          </div>
        </div>
      <?php endif;?>  

      <?php echo autoart_post_title_render(); ?>
      
      <?php if($args['layout'] != 'style-1'): ?>
        <?php echo autoart_post_content_render() ?>
      <?php endif;?>


      <?php if($args['layout'] == 'style-1' && isset($desc) && !empty($desc)): ?>
          <p class="bt-post--desc"> <?php echo $desc ?> </p>
      <?php endif;?>
    </div>
</article>
