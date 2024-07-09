<?php
namespace AutoArtElementorWidgets\Widgets\PageBreadcrumb;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PageBreadcrumb extends Widget_Base {

	public function get_name() {
		return 'bt-page-breadcrumb';
	}

	public function get_title() {
		return __( 'Page Breadcrumb', 'autoart' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	protected function register_content_section_controls() {

	}

	protected function register_style_content_section_controls() {

		$this->start_controls_section(
			'section_style_content',[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',[
				'label'     => esc_html__( 'Color', 'autoart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',[
				'label'     => esc_html__( 'Color Hover', 'autoart' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name'      => 'text_typography',
				'label'     => esc_html__( 'Typography', 'autoart' ),
				'default'   => '',
				'selector'  => '{{WRAPPER}} .bt-page-breadcrumb',
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
		?>
			<div class="bt-elwg-page-breadcrumb">
				<div class="bt-page-breadcrumb">
					<?php
						$home_text = esc_html__('Home', 'autoart');
						$delimiter = '|';
						echo autoart_page_breadcrumb($home_text, $delimiter);
					?>
				</div>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
