<?php
namespace AutoArtElementorWidgets\Widgets\MiniCompare;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_MiniCompare extends Widget_Base {

	public function get_name() {
		return 'bt-mini-compare';
	}

	public function get_title() {
		return __( 'Mini Compare', 'autoart' );
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

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$carcompare = '';
		$car_ids = array();

		if(isset($_COOKIE['carcomparecookie']) && !empty($_COOKIE['carcomparecookie'])) {
			$carcompare = $_COOKIE['carcomparecookie'];
			$car_ids = explode(',', $carcompare);
		}

		?>
		<div class="bt-elwg-mini-compare">
			<div class="bt-mini-compare">
				<a href="/cars-compare/" class="bt-mini-compare--icon">
					<svg width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.75 10.9375L17.3125 12.5L22.6875 7.10938L17.1875 1.5625L15.625 3.125L18.4375 5.9375H3.125V8.125H18.4688L15.75 10.9375ZM9.15625 14.0625L7.59375 12.5L2.21875 17.9688L7.67187 23.4375L9.23437 21.875L6.40625 19.0625H21.875V16.875H6.40625L9.15625 14.0625Z"></path>
					</svg>
					<span class="bt-mini-compare--count">
						<?php echo count($car_ids); ?>
					</span>
				</a>
			</div>
		</div>
		<?php
	}

	protected function content_template() {

	}
}
