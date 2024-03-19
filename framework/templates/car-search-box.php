<div class="bt-car-search-box">
  <h3 class="bt-car-search-title">
    <?php echo esc_html__('Search by keywords', 'autoart') ?>
  </h3>
  <div class="bt-car-search-fields">
    <input type="text" class="bt-car-search-field" name="search_key" value="<?php if(isset($_GET['search_keyword'])) echo $_GET['search_keyword']; ?>" placeholder="<?php esc_html_e('Search …', 'autoart'); ?>">
    <a href="#" class="bt-car-search-button">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" fill="currentColor">
        <path d="M2.894.511a2.384 2.384 0 0 0-2.38 2.38 2.386 2.386 0 0 0 2.38 2.384c.56 0 1.076-.197 1.484-.523l.991.991a.265.265 0 0 0 .375-.374l-.991-.992a2.37 2.37 0 0 0 .523-1.485C5.276 1.58 4.206.51 2.894.51zm0 .53c1.026 0 1.852.825 1.852 1.85S3.92 4.746 2.894 4.746s-1.851-.827-1.851-1.853.825-1.852 1.851-1.852z"></path>
      </svg>
    </a>
  </div>
</div>
