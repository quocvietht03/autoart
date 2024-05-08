<?php
namespace AutoArtElementorWidgets\Widgets\MiniWishlist;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_MiniWishlist extends Widget_Base {

	public function get_name() {
		return 'bt-mini-wishlist';
	}

	public function get_title() {
		return __( 'Mini Wishlist', 'autoart' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	protected function register_content_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'autoart' ),
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Heading Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-contact-information--head' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __( 'Heading Typography', 'autoart' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-contact-information--head',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();

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
		<div class="bt-elwg-mini-wishlist">
			<div class="bt-mini-wishlist">
				<div class="bt-mini-wishlist--icon">
					<svg width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.9916 18.8679C14.3066 19.4224 13.4266 19.7282 12.5129 19.7282C11.6004 19.7282 10.7179 19.4236 10.0054 18.8512C5.51289 15.2466 2.65289 13.3342 2.50414 9.41186C2.34789 5.26103 7.12289 3.74375 10.0504 7.15438C10.6429 7.84341 11.5329 8.2385 12.4929 8.2385C13.4616 8.2385 14.3579 7.83864 14.9516 7.14128C17.8154 3.78539 22.7179 5.21462 22.4941 9.53324C22.2941 13.3747 19.3241 15.3585 14.9916 18.8679ZM12.9841 5.72634C12.8616 5.87033 12.6766 5.94292 12.4929 5.94292C12.3129 5.94292 12.1341 5.87271 12.0141 5.73348C7.58539 0.574693 -0.234601 3.14396 0.0053982 9.49159C0.196648 14.5433 3.95664 17.0471 8.38414 20.5994C9.56788 21.549 11.0404 22.0238 12.5129 22.0238C13.9891 22.0238 15.4641 21.5466 16.6454 20.5898C21.0241 17.0424 24.7366 14.5552 24.9904 9.64154C25.3279 3.1523 17.4016 0.546134 12.9841 5.72634Z"></path>
					</svg>
					<span class="bt-items-count">
						<?php echo count($car_ids); ?>
					</span>
				</div>
				<div class="bt-mini-wishlist--content">
					<h3 class="bt-mini-wishlist--head">
						<?php echo __('My Wishlist', 'autoart'); ?>
					</h3>
					<?php if(!empty($car_ids)) { ?>
						<div class="bt-mini-wishlist--list">
							<?php foreach ($car_ids as $key => $id) { ?>
								<div class="bt-mini-wishlist--item">
									<a href="#" data-id="<?php echo esc_attr($id); ?>" class="bt-car-remove">
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
											<path d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"></path>
											<path d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM336 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM176 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"></path>
										</svg>
									</a>
									<div class="bt-car-thumb">
										<a href="<?php echo get_the_permalink($id); ?>" class="bt-thumb">
											<div class="bt-cover-image">
												<?php echo get_the_post_thumbnail($id, 'medium'); ?>
											</div>
										</a>
									</div>
									<div class="bt-car-infor">
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
						</div>
						<div class="bt-mini-wishlist--link">
							<?php echo '<a href="/cars-wishlist/">' . esc_html__('View Your Wishlist', 'autoart') . '</a>'; ?>
						</div>
					<?php } else { ?>
						<div class="bt-no-results">
							<?php echo __('Please, add your first item to the wishlist.', 'autoart'); ?>
						</div>
					<?php } ?>
				</div>
		  </div>
		</div>
		<?php
	}

	protected function content_template() {

	}
}
