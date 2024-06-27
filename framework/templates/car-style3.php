<?php
$mileage = get_field('car_mileage');
$price = get_field('car_price');
$body = get_the_terms( get_the_ID(), 'car_body' );
$fuel_type = get_the_terms( get_the_ID(), 'car_fuel_type' );
$transmission = get_the_terms( get_the_ID(), 'car_transmission' );

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--thumbnail">
      <?php echo autoart_post_cover_featured_render($args['image-size']); ?>
    </div>
    <div class="bt-post--infor">
      <div class="bt-post--icon-btn">
        <a class="bt-icon-btn bt-car-wishlist-btn <?php if(autoart_is_wishlist(get_the_ID())) echo 'added'; ?>" href="#" data-id="<?php echo get_the_ID(); ?>">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.9916 18.8679C14.3066 19.4224 13.4266 19.7282 12.5129 19.7282C11.6004 19.7282 10.7179 19.4236 10.0054 18.8512C5.51289 15.2466 2.65289 13.3342 2.50414 9.41186C2.34789 5.26103 7.12289 3.74375 10.0504 7.15438C10.6429 7.84341 11.5329 8.2385 12.4929 8.2385C13.4616 8.2385 14.3579 7.83864 14.9516 7.14128C17.8154 3.78539 22.7179 5.21462 22.4941 9.53324C22.2941 13.3747 19.3241 15.3585 14.9916 18.8679ZM12.9841 5.72634C12.8616 5.87033 12.6766 5.94292 12.4929 5.94292C12.3129 5.94292 12.1341 5.87271 12.0141 5.73348C7.58539 0.574693 -0.234601 3.14396 0.0053982 9.49159C0.196648 14.5433 3.95664 17.0471 8.38414 20.5994C9.56788 21.549 11.0404 22.0238 12.5129 22.0238C13.9891 22.0238 15.4641 21.5466 16.6454 20.5898C21.0241 17.0424 24.7366 14.5552 24.9904 9.64154C25.3279 3.1523 17.4016 0.546134 12.9841 5.72634Z"/>
          </svg>
        </a>
        <a class="bt-icon-btn bt-car-compare-btn <?php if(autoart_is_compare(get_the_ID())) echo 'added'; ?>" href="#" data-id="<?php echo get_the_ID(); ?>">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.75 10.9375L17.3125 12.5L22.6875 7.10938L17.1875 1.5625L15.625 3.125L18.4375 5.9375H3.125V8.125H18.4688L15.75 10.9375ZM9.15625 14.0625L7.59375 12.5L2.21875 17.9688L7.67187 23.4375L9.23437 21.875L6.40625 19.0625H21.875V16.875H6.40625L9.15625 14.0625Z"/>
          </svg>
        </a>
      </div>

      <div class="bt-post--infor-inner">
        <?php if(!empty($body)) { ?>
          <div class="bt-post--body">
            <?php
              $term = array_pop($body);
              echo '<span class="bt-value">' . $term->name . '</span>';
            ?>
          </div>
        <?php } ?>

        <div class="bt-post--price">
          <?php
            if(!empty($price)) {
              echo '$' . number_format($price, 0);
            } else {
              echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
            }
          ?>
        </div>

        <?php echo autoart_post_title_render(); ?>

        <div class="bt-post--meta">
          <div class="bt-post--meta-row">
            <div class="bt-post--meta-col">
              <div class="bt-post--meta-item bt-post--fuel-type">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5305 24.5555H4.26046C3.98853 24.5642 3.71762 24.5182 3.46385 24.4201C3.21007 24.322 2.97861 24.1739 2.78322 23.9846C2.58783 23.7952 2.4325 23.5686 2.32647 23.318C2.22044 23.0674 2.16588 22.7981 2.16602 22.5261V3.50995C2.18671 2.95563 2.42646 2.43216 2.83266 2.0544C3.23885 1.67663 3.77832 1.47544 4.33268 1.49495H14.6027C14.8686 1.48899 15.1329 1.5371 15.3797 1.63634C15.6265 1.73559 15.8505 1.88392 16.0382 2.07233C16.226 2.26074 16.3735 2.48531 16.4719 2.73243C16.5702 2.97955 16.6174 3.24406 16.6105 3.50995V22.5261C16.6096 22.7966 16.5548 23.0642 16.4493 23.3134C16.3438 23.5625 16.1898 23.7881 15.9961 23.977C15.8025 24.166 15.5731 24.3144 15.3215 24.4138C15.0698 24.5131 14.8009 24.5613 14.5305 24.5555ZM4.26046 2.88884C4.17675 2.88595 4.0933 2.89982 4.01502 2.92965C3.93675 2.95947 3.86523 3.00465 3.80467 3.06252C3.74411 3.12039 3.69573 3.18978 3.66238 3.26662C3.62902 3.34346 3.61137 3.42619 3.61046 3.50995V22.5261C3.61046 22.6927 3.67666 22.8525 3.79449 22.9704C3.91233 23.0882 4.07215 23.1544 4.23879 23.1544H14.5305C14.7033 23.1567 14.8706 23.093 14.9981 22.9762C15.1256 22.8595 15.2037 22.6985 15.2166 22.5261V3.50995C15.202 3.33884 15.1231 3.17962 14.9958 3.06436C14.8684 2.94911 14.7022 2.88639 14.5305 2.88884H4.26046Z" fill="currentColor"/>
                  <path d="M21.327 24.5555C20.9932 24.5584 20.6622 24.4951 20.353 24.3694C20.0438 24.2436 19.7626 24.0579 19.5256 23.8229C19.2886 23.5879 19.1004 23.3082 18.972 23.0001C18.8437 22.692 18.7776 22.3615 18.7776 22.0278V16.6111C18.7776 16.228 18.6254 15.8606 18.3545 15.5897C18.0836 15.3188 17.7162 15.1667 17.3331 15.1667H16.3003C16.1088 15.1667 15.9251 15.0906 15.7897 14.9551C15.6542 14.8197 15.5781 14.636 15.5781 14.4444C15.5781 14.2529 15.6542 14.0692 15.7897 13.9337C15.9251 13.7983 16.1088 13.7222 16.3003 13.7222H17.3331C18.0993 13.7222 18.8341 14.0266 19.3759 14.5683C19.9176 15.1101 20.222 15.8449 20.222 16.6111V22.0278C20.222 22.3151 20.3362 22.5906 20.5393 22.7938C20.7425 22.997 21.018 23.1111 21.3053 23.1111C21.5927 23.1111 21.8682 22.997 22.0714 22.7938C22.2745 22.5906 22.3887 22.3151 22.3887 22.0278V12.4944L20.1281 7.43888C19.9931 7.15715 19.781 6.91944 19.5164 6.75328C19.2518 6.58712 18.9456 6.4993 18.6331 6.49999H18.1059C17.9144 6.49999 17.7307 6.4239 17.5952 6.28845C17.4598 6.15301 17.3837 5.96931 17.3837 5.77776C17.3837 5.58622 17.4598 5.40252 17.5952 5.26708C17.7307 5.13163 17.9144 5.05554 18.1059 5.05554H18.6331C19.2336 5.05523 19.8214 5.22904 20.3251 5.5559C20.8289 5.88277 21.2271 6.34868 21.4715 6.89721L23.7898 12.0683C23.8322 12.1613 23.8543 12.2622 23.8548 12.3644V22.0278C23.8548 22.6982 23.5885 23.3411 23.1144 23.8152C22.6404 24.2892 21.9974 24.5555 21.327 24.5555Z" fill="currentColor"/>
                  <path d="M12.9991 6.49999H5.77691C5.58536 6.49999 5.40166 6.4239 5.26622 6.28845C5.13078 6.15301 5.05469 5.96931 5.05469 5.77776C5.05469 5.58622 5.13078 5.40252 5.26622 5.26708C5.40166 5.13163 5.58536 5.05554 5.77691 5.05554H12.9991C13.1907 5.05554 13.3744 5.13163 13.5098 5.26708C13.6453 5.40252 13.7214 5.58622 13.7214 5.77776C13.7214 5.96931 13.6453 6.15301 13.5098 6.28845C13.3744 6.4239 13.1907 6.49999 12.9991 6.49999Z" fill="currentColor"/>
                  <path d="M12.9991 9.3889H5.77691C5.58536 9.3889 5.40166 9.31281 5.26622 9.17737C5.13078 9.04193 5.05469 8.85823 5.05469 8.66668C5.05469 8.47513 5.13078 8.29144 5.26622 8.15599C5.40166 8.02055 5.58536 7.94446 5.77691 7.94446H12.9991C13.1907 7.94446 13.3744 8.02055 13.5098 8.15599C13.6453 8.29144 13.7214 8.47513 13.7214 8.66668C13.7214 8.85823 13.6453 9.04193 13.5098 9.17737C13.3744 9.31281 13.1907 9.3889 12.9991 9.3889Z" fill="currentColor"/>
                  <path d="M18.0562 8.72443C17.8647 8.72443 17.681 8.64834 17.5455 8.5129C17.4101 8.37746 17.334 8.19376 17.334 8.00221V3.66888C17.334 3.47733 17.4101 3.29363 17.5455 3.15819C17.681 3.02275 17.8647 2.94666 18.0562 2.94666C18.2478 2.94666 18.4315 3.02275 18.5669 3.15819C18.7023 3.29363 18.7784 3.47733 18.7784 3.66888V8.00221C18.7784 8.19376 18.7023 8.37746 18.5669 8.5129C18.4315 8.64834 18.2478 8.72443 18.0562 8.72443Z" fill="currentColor"/>
                </svg>

                <?php
                  echo '<span class="bt-label">' . esc_html__('Fuel Type', 'autoart') . '</span>';

                  if(!empty($fuel_type)) {
                    $term = array_pop($fuel_type);
                    echo '<span class="bt-value">' . $term->name . '</span>';
                  } else {
                    echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
                  }
                ?>
              </div>
            </div>
            <div class="bt-post--meta-col">
              <div class="bt-post--meta-item bt-post--mileage">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.9998 3.80554C5.83162 3.80554 0 9.63751 0 16.8057C0 17.8033 0.11375 18.798 0.338559 19.7626C0.364406 19.8733 0.394062 19.976 0.427172 20.071C0.818898 21.3239 1.99875 22.1945 3.31485 22.1945H22.681C23.905 22.1945 25.0092 21.4437 25.474 20.3319C25.5302 20.2212 25.577 20.0984 25.6128 19.9614C25.6265 19.9093 25.6478 19.8223 25.6797 19.6807C25.8919 18.7424 26 17.7744 26 16.8056C26 9.63752 20.168 3.80554 12.9998 3.80554ZM24.1598 19.3381C24.1077 19.569 24.091 19.6245 24.0872 19.6245L24.0906 19.5777C23.9088 20.2049 23.3341 20.6366 22.681 20.6366H3.31485C2.66327 20.6366 2.09005 20.2072 1.90673 19.5819L1.9174 19.6538C1.91511 19.6538 1.90064 19.6017 1.85575 19.4092C1.661 18.5728 1.55792 17.7014 1.55792 16.8057C1.55792 10.4861 6.68058 5.36346 12.9998 5.36346C19.319 5.36346 24.442 10.4861 24.442 16.8057C24.4421 17.676 24.3443 18.5234 24.1598 19.3381Z" fill="currentColor"/>
                  <path d="M13.5872 15.0926C13.4027 15.0294 13.2053 14.9933 12.9995 14.9933C11.9988 14.9933 11.1875 15.8046 11.1875 16.8057C11.1875 17.8064 11.9988 18.6176 12.9995 18.6176C13.9154 18.6176 14.6708 17.9376 14.7925 17.0552C14.8039 16.973 14.8115 16.8905 14.8115 16.8057C14.8115 16.0107 14.2992 15.3367 13.5872 15.0926Z" fill="currentColor"/>
                  <path d="M20.2971 9.89159C20.1378 9.71934 19.8498 9.71548 19.6239 9.88245L13.3477 14.5037C13.4846 14.5247 13.6208 14.557 13.7546 14.603C14.5655 14.8815 15.1463 15.5771 15.292 16.3998L20.2579 10.5644C20.4409 10.3499 20.4576 10.062 20.2971 9.89159Z" fill="currentColor"/>
                  <path d="M17.287 9.28835C17.5685 9.45156 17.9282 9.35452 18.091 9.07309C18.2539 8.7912 18.1572 8.43142 17.8758 8.26826C17.5943 8.10626 17.2337 8.20285 17.071 8.48392C16.9089 8.76611 17.0047 9.12631 17.287 9.28835Z" fill="currentColor"/>
                  <path d="M13.1649 8.18456C13.4905 8.18456 13.7537 7.9202 13.7537 7.59576C13.7537 7.2702 13.4905 7.00659 13.1649 7.00659C12.8401 7.00659 12.5762 7.2702 12.5762 7.59576C12.5762 7.9202 12.8401 8.18456 13.1649 8.18456Z" fill="currentColor"/>
                  <path d="M3.86804 16.2957C3.52648 16.2957 3.24805 16.5733 3.24805 16.9156C3.24805 17.258 3.52643 17.5349 3.86804 17.5349C4.21035 17.5349 4.48726 17.258 4.48726 16.9156C4.48726 16.5733 4.21035 16.2957 3.86804 16.2957Z" fill="currentColor"/>
                  <path d="M5.81114 11.5005C5.52971 11.3377 5.16911 11.4351 5.00631 11.7166C4.84432 11.998 4.9409 12.3578 5.22157 12.521C5.50381 12.6838 5.86436 12.5868 6.02716 12.3053C6.18921 12.0238 6.09262 11.6634 5.81114 11.5005Z" fill="currentColor"/>
                  <path d="M8.4547 8.26829C8.17245 8.43145 8.07663 8.79123 8.23943 9.07312C8.40148 9.35455 8.76202 9.45159 9.0435 9.28838C9.32498 9.12639 9.42157 8.76539 9.25953 8.48396C9.09677 8.20283 8.73618 8.10625 8.4547 8.26829Z" fill="currentColor"/>
                  <path d="M20.517 11.5005C20.2356 11.6634 20.139 12.0239 20.3018 12.3054C20.4646 12.5876 20.8244 12.6839 21.1066 12.521C21.388 12.3579 21.4847 11.9981 21.3218 11.7166C21.1598 11.4351 20.7992 11.3377 20.517 11.5005Z" fill="currentColor"/>
                  <path d="M21.995 17.0149C22.3206 17.0149 22.5838 16.7516 22.5838 16.4265C22.5838 16.1009 22.3206 15.8369 21.995 15.8369C21.6695 15.8369 21.4062 16.1009 21.4062 16.4265C21.4062 16.7516 21.6695 17.0149 21.995 17.0149Z" fill="currentColor"/>
                </svg>

                <?php
                  echo '<span class="bt-label">' . esc_html__('Mileage', 'autoart') . '</span>';

                  if(!empty($mileage)) {
                    echo '<span class="bt-value">' . number_format($mileage, 0) . esc_html__(' km', 'autoart') . '</span>';
                  } else {
                    echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
                  }
                ?>
              </div>
            </div>
            <div class="bt-post--meta-col">
              <div class="bt-post--meta-item bt-post--transmission">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.49935 4.33329C6.49935 5.52991 5.5293 6.49996 4.33268 6.49996C3.13606 6.49996 2.16602 5.52991 2.16602 4.33329C2.16602 3.13668 3.13606 2.16663 4.33268 2.16663C5.5293 2.16663 6.49935 3.13668 6.49935 4.33329Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M6.49935 21.6667C6.49935 22.8633 5.5293 23.8333 4.33268 23.8333C3.13606 23.8333 2.16602 22.8633 2.16602 21.6667C2.16602 20.47 3.13606 19.5 4.33268 19.5C5.5293 19.5 6.49935 20.47 6.49935 21.6667Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M15.1673 21.6667C15.1673 22.8633 14.1973 23.8333 13.0007 23.8333C11.804 23.8333 10.834 22.8633 10.834 21.6667C10.834 20.47 11.804 19.5 13.0007 19.5C14.1973 19.5 15.1673 20.47 15.1673 21.6667Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M15.1673 4.33329C15.1673 5.52991 14.1973 6.49996 13.0007 6.49996C11.804 6.49996 10.834 5.52991 10.834 4.33329C10.834 3.13668 11.804 2.16663 13.0007 2.16663C14.1973 2.16663 15.1673 3.13668 15.1673 4.33329Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M23.8333 4.33329C23.8333 5.52991 22.8633 6.49996 21.6667 6.49996C20.47 6.49996 19.5 5.52991 19.5 4.33329C19.5 3.13668 20.47 2.16663 21.6667 2.16663C22.8633 2.16663 23.8333 3.13668 23.8333 4.33329Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M13 6.5V14.0833M13 19.5V17.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M4.33398 19.5V11.9167M4.33398 6.5V8.66667" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M21.6673 6.5V8.66667C21.6673 10.7094 21.6673 11.7308 21.0327 12.3654C20.3981 13 19.3767 13 17.334 13H10.834M4.33398 13H6.50065" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M19.5 16.25V15.4375C19.0513 15.4375 18.6875 15.8013 18.6875 16.25H19.5ZM18.6875 23.8333C18.6875 24.282 19.0513 24.6458 19.5 24.6458C19.9487 24.6458 20.3125 24.282 20.3125 23.8333H18.6875ZM23.1404 24.2576C23.3746 24.6403 23.8749 24.7606 24.2576 24.5262C24.6403 24.292 24.7606 23.7917 24.5262 23.4091L23.1404 24.2576ZM19.5 17.0625H21.9762V15.4375H19.5V17.0625ZM20.3125 20.0417V16.25H18.6875V20.0417H20.3125ZM23.0208 18.1458C23.0208 18.76 22.5375 19.2292 21.9762 19.2292V20.8542C23.4663 20.8542 24.6458 19.6258 24.6458 18.1458H23.0208ZM21.9762 17.0625C22.5375 17.0625 23.0208 17.5317 23.0208 18.1458H24.6458C24.6458 16.6659 23.4663 15.4375 21.9762 15.4375V17.0625ZM21.9762 19.2292H21.5119V20.8542H21.9762V19.2292ZM21.5119 19.2292H19.5V20.8542H21.5119V19.2292ZM20.819 20.4659L23.1404 24.2576L24.5262 23.4091L22.2049 19.6174L20.819 20.4659ZM18.6875 20.0417V23.8333H20.3125V20.0417H18.6875Z" fill="currentColor"/>
                </svg>

                <?php
                  echo '<span class="bt-label">' . esc_html__('Transmission', 'autoart') . '</span>';

                  if(!empty($transmission)) {
                    $term = array_pop($transmission);
                    echo '<span class="bt-value">' . $term->name . '</span>';
                  } else {
                    echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>