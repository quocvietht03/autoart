<?php
namespace AutoArtElementorWidgets\Widgets\CarsQuickCompare;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_CarsQuickCompare extends Widget_Base {

	public function get_name() {
		return 'bt-cars-quick-compare';
	}

	public function get_title() {
		return __( 'Cars Quick Compare', 'autoart' );
	}

  public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	public function get_script_depends()
	{
			return ['elementor-widgets'];
	}

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
									'post_type' => 'car',
									'post_status' => 'publish'
								) );

		if ( $wp_query->have_posts() ) {
	    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $supported_ids[get_the_ID()] = get_the_title();
	    }
		}

		return $supported_ids;
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'autoart' ),
			]
		);

		$this->add_control(
			'first_car',
			[
				'label' => __( 'First Car', 'autoart' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
			]
		);

		$this->add_control(
			'second_car',
			[
				'label' => __( 'Second Car', 'autoart' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}


	protected function register_style_section_controls() {
    $this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {

		$this->register_layout_section_controls();
		$this->register_style_section_controls();

	}

	public function post_render($post_id) {
		if(empty($post_id)) {
			echo '<h3 class="bt-not-found">' . __('Please, Add car to compare!', 'autoart') . '</h3>';

			return;
		}

		$mileage = get_field('car_mileage', $post_id);
		$price = get_field('car_price', $post_id);
		$body = get_the_terms( $post_id, 'car_body' );
		$fuel_type = get_the_terms( $post_id, 'car_fuel_type' );

		?>
			<div class="bt-post">
				<div class="bt-post--featured">
					<a href="<?php the_permalink($post_id); ?>">
						<div class="bt-cover-image">
							<?php the_post_thumbnail($post_id, 'medium'); ?>
						</div>
					</a>
				</div>
				<?php if(!empty($body)) { ?>
					<div class="bt-post--body">
						<?php
							$term = array_pop($body);
							echo '<span class="bt-value">' . $term->name . '</span>';
						?>
					</div>
					<h3 class="bt-post--title">
						<a href="<?php the_permalink($post_id); ?>">
							<?php echo get_the_title($post_id); ?>
						</a>
					</h3>
					<div class="bt-post--price">
						<?php
							if(!empty($price)) {
								echo '$' . number_format($price, 0);
							} else {
								echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
							}
						?>
					</div>
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
						</div>
					</div>
				<?php } ?>
			</div>
		<?php
	}

	public function post_social_share() {

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
		?>
			<div class="bt-post-share">
				<?php
					if(!empty($social_item)){
						echo '<span>'.esc_html__('Share: ', 'autoart').'</span><ul>'.implode(' ', $social_item).'</ul>';
					}
				?>
			</div>
		<?php
		return ob_get_clean();
	}

	public function popup_render($car_ids) {
		if(empty($car_ids)) {
			echo '<h3 class="bt-not-found">' . __('Please, Add cars to compare!', 'autoart') . '</h3>';

			return;
		}

		$ex_items = count($car_ids) < 2 ? 2 - count($car_ids) : 0;

		?>
			<div class="bt-cars-quick-compare--popup">
				<a class="bt-close-popup" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" fill="currentColor">
						<path d="M5 17.586a1 1 0 1 0 1.415 1.415L12 13.414 17.586 19A1 1 0 0 0 19 17.586L13.414 12 19 6.414A1 1 0 0 0 17.585 5L12 10.586 6.414 5A1 1 0 0 0 5 6.414L10.586 12z"></path>
					</svg>
				</a>

				<div class="bt-cars-quick-compare--wrap">
					<div class="bt-table">
						<div class="bt-table--body">
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Information', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<div class="bt-car-infor">
											<div class="bt-car-thumb">
												<a href="<?php echo get_the_permalink($id); ?>">
													<div class="bt-cover-image">
														<?php echo get_the_post_thumbnail($id, 'medium'); ?>
													</div>
												</a>
											</div>
											<h3 class="bt-car-title">
												<a href="<?php echo get_the_permalink($id); ?>">
													<?php echo get_the_title($id); ?>
												</a>
											</h3>
											<div class="bt-car-price">
												<?php
													$price = get_field('car_price', $id);

													if(!empty($price)) {
														echo '<span>$' . number_format($price, 0) . '</span>';
													} else {
														echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
													}
												?>
											</div>
										</div>
									</div>
								<?php } ?>

							<?php
								if($ex_items > 0) {
									for ($i=0; $i < $ex_items; $i++) {
										?>
											<div class="bt-table--col bt-car-add-compare">
												<div class="bt-car-thumb">
													<a href="/cars/">
														<div class="bt-cover-image">
															<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
																<path d="M256 512a25 25 0 0 1-25-25V25a25 25 0 0 1 50 0v462a25 25 0 0 1-25 25z"></path>
																<path d="M487 281H25a25 25 0 0 1 0-50h462a25 25 0 0 1 0 50z"></path>
															</svg>
														</div>
													</a>
												</div>
												<h3 class="bt-car-title">
													<a href="/cars/">
														<?php echo __('Add Car To Compare', 'autoart'); ?>
													</a>
												</h3>
											</div>
										<?php
									}
								}
							?>

							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Body', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$body = get_the_terms( $id, 'car_body' );

											if(!empty($body)) {
												$term = array_pop($body);
					              echo '<span class="bt-value">' . $term->name . '</span>';
					            } else {
					              echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
					            }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Condition', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$condition = get_the_terms( $id, 'car_condition' );

											if(!empty($condition)) {
												$term = array_pop($condition);
					              echo '<span class="bt-value">' . $term->name . '</span>';
					            } else {
					              echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
					            }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Mileage', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$mileage = get_field('car_mileage', $id);

											if(!empty($mileage)) {
				                echo '<span class="bt-value">' . number_format($mileage, 0) . esc_html__(' km', 'autoart') . '</span>';
				              } else {
				                echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
				              }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Engine Size', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$engine = get_the_terms( $id, 'car_engine' );

											if(!empty($engine)) {
												$term = array_pop($engine);
												echo '<span class="bt-value">' . $term->name . '</span>';
											} else {
												echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
											}
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Fuel Type', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$fuel_type = get_the_terms( $id, 'car_fuel_type' );

											if(!empty($fuel_type)) {
				                $term = array_pop($fuel_type);
				                echo '<span class="bt-value">' . $term->name . '</span>';
				              } else {
				                echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
				              }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Door', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$door = get_the_terms( $id, 'car_door' );

											if(!empty($door)) {
				                $term = array_pop($door);
				                echo '<span class="bt-value">' . $term->name . '</span>';
				              } else {
				                echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
				              }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Year', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$year = get_field('car_year', $id);

											if(!empty($year)) {
					              echo '<span class="bt-value">' . $year . '</span>';
					            } else {
					              echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
					            }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Cylinder', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$cylinder = get_the_terms( $id, 'car_cylinder' );

											if(!empty($cylinder)) {
				                $term = array_pop($cylinder);
				                echo '<span class="bt-value">' . $term->name . '</span>';
				              } else {
				                echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
				              }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Transmission', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
											$transmission = get_the_terms( $id, 'car_transmission' );

											if(!empty($transmission)) {
				                $term = array_pop($transmission);
				                echo '<span class="bt-value">' . $term->name . '</span>';
				              } else {
				                echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
				              }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Color', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php
										$color_term = get_the_terms( $id, 'car_color' );
										$color_arr = array();
										if(!empty($color_term)) {
											foreach ($color_term as $color) {
												$color_arr[] = $color->name;
											}
										}

											if(!empty($color_arr)) {
					              echo '<span class="bt-value">' . implode(', ', $color_arr) . '</span>';
					            } else {
					              echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
					            }
										?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
							<div class="bt-table--row">
								<div class="bt-table--col">
									<?php echo '<span class="bt-label">' . __('Features', 'autoart') . '</span>'; ?>
								</div>

								<?php foreach ($car_ids as $key => $id) { ?>
									<div class="bt-table--col">
										<?php $features = get_field('car_features', $id); ?>

										<?php if(!empty($features)) { ?>
											<div class="bt-feature-list">
												<?php foreach($features as $feature) { ?>
							            <div class="bt-feature-item">
							              <svg width="26" height="26" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536215C14.3234 0.190003 13.6681 0.00695801 13 0.00695801C12.3319 0.00695801 11.6766 0.190003 11.1053 0.536215L2.574 5.70696C2.03639 6.03272 1.59185 6.49158 1.28329 7.03924C0.974733 7.5869 0.812585 8.20486 0.8125 8.83346V17.1665C0.812585 17.7951 0.974733 18.413 1.28329 18.9607C1.59185 19.5084 2.03639 19.9672 2.574 20.293L11.1053 25.4637C11.6766 25.8099 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.8099 14.8948 25.4637L23.426 20.293C23.9636 19.9672 24.4082 19.5084 24.7167 18.9607C25.0253 18.413 25.1874 17.7951 25.1875 17.1665V8.83346C25.1874 8.20486 25.0253 7.5869 24.7167 7.03924C24.4082 6.49158 23.9636 6.03272 23.426 5.70696L14.8948 0.536215ZM16.6075 9.29496C16.7191 9.17522 16.8536 9.07918 17.0031 9.01257C17.1526 8.94596 17.314 8.91014 17.4777 8.90725C17.6413 8.90437 17.8038 8.93447 17.9556 8.99577C18.1074 9.05706 18.2452 9.1483 18.3609 9.26403C18.4767 9.37976 18.5679 9.51761 18.6292 9.66937C18.6905 9.82112 18.7206 9.98367 18.7177 10.1473C18.7148 10.311 18.679 10.4723 18.6124 10.6218C18.5458 10.7713 18.4497 10.9059 18.33 11.0175L11.83 17.5175C11.6015 17.7457 11.2917 17.8739 10.9688 17.8739C10.6458 17.8739 10.336 17.7457 10.1075 17.5175L6.8575 14.2675C6.64222 14.0364 6.52502 13.7309 6.53059 13.4151C6.53616 13.0994 6.66407 12.7981 6.88736 12.5748C7.11066 12.3515 7.41191 12.2236 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9337L16.6075 9.29496Z"/>
							              </svg>
							              <?php echo '<span>' . $feature['label'] . '</span>'; ?>
							            </div>
							          <?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>

								<?php
									if($ex_items > 0) {
										for ($i=0; $i < $ex_items; $i++) {
											?>
												<div class="bt-table--col"></div>
											<?php
										}
									}
								?>
							</div>
						</div>

						<div class="bt-table--foot">
							<div class="bt-table--row">
								<div class="bt-table--col bt-social-share">
									<?php echo $this->post_social_share(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$post_ids = array();

		if(!empty($settings['first_car'])) {
			$post_ids[] = $settings['first_car'];
		}

		if(!empty($settings['second_car'])) {
			$post_ids[] = $settings['second_car'];
		}

    ?>
			<div class="bt-elwg-cars-quick-compare--default">
				<div class="bt-cars-quick-compare">
					<div class="bt-cars-quick-compare--inner">
						<div class="bt-cars">
							<div class="bt-cars--item">
								<?php $this->post_render($settings['first_car']); ?>
							</div>

							<div class="bt-cars--divider">
								<?php echo '<span>' . __('vs', 'autoart') . '</span>'; ?>
							</div>

							<div class="bt-cars--item">
								<?php $this->post_render($settings['second_car']); ?>
							</div>
						</div>
						<div class="bt-cars--compare">
							<a class="bt-quick-compare-btn" href="#">
								<span><?php echo __('Compare Now', 'autoart'); ?></span>
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								  <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
						</div>
					</div>

					<?php $this->popup_render($post_ids); ?>
				</div>
			</div>
    <?php
	}

	protected function content_template() {

	}

}
