<?php
namespace AutoArtElementorWidgets\Widgets\CarsWishlist;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_CarsWishlist extends Widget_Base {

	public function get_name() {
		return 'bt-cars-wishlist';
	}

	public function get_title() {
		return __( 'Cars Wishlist', 'autoart' );
	}

  public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'autoart' ),
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

	protected function render() {
    $settings = $this->get_settings_for_display();
		$carwishlist = '';
		$car_ids = array();

		if(isset($_COOKIE['carwishlistcookie']) && !empty($_COOKIE['carwishlistcookie'])) {
			$carwishlist = $_COOKIE['carwishlistcookie'];
			$car_ids = explode(',', $carwishlist);
		}

		?>
      <div class="bt-elwg-cars-wishlist--default">
				<form class="bt-cars-wishlist-form" action="" method="post">
					<input type="hidden" class="bt-carwishlistcookie" name="carwishlistcookie" value="<?php echo esc_attr($carwishlist); ?>">

					<div class="bt-table">
						<div class="bt-table--head">
							<div class="bt-table--row">
								<div class="bt-table--col bt-car-remove">
									<?php echo '<span>' . __('Remove', 'autoart') . '</span>'; ?>
								</div>
								<div class="bt-table--col bt-car-thumb">
									<?php echo '<span>' . __('Thumbnail', 'autoart') . '</span>'; ?>
								</div>
								<div class="bt-table--col bt-car-title">
									<?php echo '<span>' . __('Car Name', 'autoart') . '</span>'; ?>
								</div>
								<div class="bt-table--col bt-car-price">
									<?php echo '<span>' . __('Price', 'autoart') . '</span>'; ?>
								</div>
								<div class="bt-table--col bt-car-stock">
									<?php echo '<span>' . __('Status', 'autoart') . '</span>'; ?>
								</div>
								<div class="bt-table--col bt-car-seller">
									<?php echo '<span>' . __('Seller', 'autoart') . '</span>'; ?>
								</div>
							</div>
						</div>

						<div class="bt-table--body">
							<?php
								if(!empty($car_ids)) {
									foreach ($car_ids as $key => $id) {
										?>
										<div class="bt-table--row bt-car-item">
											<div class="bt-table--col bt-car-remove">
												<a href="#" data-id="<?php echo esc_attr($id); ?>" class="bt-remove">
													<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
														<path d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"></path>
														<path d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM336 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM176 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"></path>
													</svg>
												</a>
											</div>
											<div class="bt-table--col bt-car-thumb">
												<a href="<?php echo get_the_permalink($id); ?>" class="bt-thumb">
													<div class="bt-cover-image">
														<?php echo get_the_post_thumbnail($id, 'medium'); ?>
													</div>
												</a>
											</div>
											<div class="bt-table--col bt-car-title">
												<h3 class="bt-title">
													<a href="<?php echo get_the_permalink($id); ?>">
														<?php echo get_the_title($id); ?>
													</a>
												</h3>
											</div>
											<div class="bt-table--col bt-car-price">
												<?php
													$price = get_field('car_price', $id);

													if(!empty($price)) {
						                echo '<span>$' . number_format($price, 0) . '</span>';
						              } else {
						                echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
						              }
												?>
											</div>
											<div class="bt-table--col bt-car-stock">
												<?php
													$stock = get_field('car_stock_status', $id);
													echo '<span>' . str_replace('_', ' ', $stock) . '</span>';
												?>
											</div>
											<div class="bt-table--col bt-car-seller">
												<?php
													$dealer = get_field('car_dealer', $id);
													if(!empty($dealer)) {
														echo '<a href="' . get_the_permalink($dealer) . '" class="bt-seller-btn">' . __('Contact', 'autoart') . '</a>';
													} else {
														echo '<a href="/contact-us/" class="bt-seller-btn">' . __('Contact', 'autoart') . '</a>';
													}
												?>
											</div>
										</div>
									<?php
									}
								} else {
									echo 'Post not found!';
								}
							?>
						</div>

						<div class="bt-table--foot">
							<div class="bt-table--row">
								<div class="bt-table--col bt-social-share">
									Social Share
								</div>
							</div>
						</div>
					</div>
				</form>
      </div>
    <?php
	}

	protected function content_template() {

	}

}
