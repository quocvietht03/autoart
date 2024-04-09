<?php
namespace AutoArtElementorWidgets\Widgets\SiteInformationStyle1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteInformationStyle1 extends Widget_Base {

	public function get_name() {
		return 'bt-site-information-style-1';
	}

	public function get_title() {
		return __( 'Site Information Style 1', 'autoart' );
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

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Show Elements', 'autoart' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'phone'  => esc_html__( 'Phone', 'autoart' ),
					'email' => esc_html__( 'Email', 'autoart' ),
					'address' => esc_html__( 'Address', 'autoart' ),
				],
				'default' => [ 'phone', 'email' ],
			]
		);

		$this->end_controls_section();
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'autoart' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Layout Style', 'autoart' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Block', 'autoart' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'row' => [
						'title' => esc_html__( 'Inline', 'autoart' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'flex-direction: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __( 'Space Between', 'autoart' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'style' => 'row',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Space Between', 'autoart' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'row-gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style' => 'column',
				],
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
			'icon_color',
			[
				'label' => __( 'Icon Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Color Hover', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', 'autoart' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_layout_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(empty($settings['list'])) {
			return;
		}
	?>
			<div class="bt-elwg-site-infor bt-elwg-site-infor--style-1">  
				<?php get_template_part( 'framework/templates/site-information', 'style', array('layout' => 'style-1', 'data' => $settings['list'])); ?>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
