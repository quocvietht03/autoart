<?php
namespace AutoArtElementorWidgets\Widgets\CarsSearchStyle1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Widget_CarsSearchStyle1 extends Widget_Base {

	public function get_name() {
		return 'bt-cars-search-style-1';
	}

	public function get_title() {
		return __( 'Cars Search Style 1', 'autoart' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	public function get_script_depends() {
		return ['select2-min', 'elementor-widgets' ];
	}
	
	protected function register_content_section_controls() {
		$this->start_controls_section(
			'car_form_search_ss_content',[
				'label' => __( 'Content', 'autoart' ),
			]
		);
			$this->add_control(
				'car_form_search_icon', [
					'label'   => __( 'Icon', 'autoart' ),
					'type'    => Controls_Manager::MEDIA,
					'media_types' => [ 'svg', 'image' ],
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'car_form_search_heading', [
					'label'       => __( 'Heading', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is heading',
				]
			);

			$this->add_control(
				'car_form_search_sub_heading', [
					'label'       => __( 'Sub Heading', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is sub heading',
				]
			);

			$this->add_control(
				'car_form_search_heading_cta',[
					'label' => __( 'Form CTA', 'autoart' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'car_form_search_cta_text', [
					'label'       => __( 'CTA Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'Andvance Search',
				]
			);

			$this->add_control(
				'car_form_search_cta_link', [
					'label'       => __( 'CTA Link', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '/cars',
				]
			);
		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {
		$this->start_controls_section(
			'car_form_search_ss_general',[
				'label' => esc_html__( 'General', 'autoart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'car_form_search_general_bg',[
					'label' => esc_html__( 'Background Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'car_form_search_general_pd',[
					'label' => esc_html__( 'Padding', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'car_form_search_generals_bri',[
					'label' => esc_html__( 'Border Radius', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'top'    => 10,
						'right'  => 10,
						'bottom' => 10,
						'left'   => 10,
						'unit'   => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
						'{{WRAPPER}} .bt-elwg-cars-search--form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),[
					'name' => 'ss_cars_search_general_box_shadow',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Css_Filter::get_type(),[
					'name' => 'ss_cars_search_general_css_filters',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner',
				]
			);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'car_form_search_ss_style_icon',[
				'label' => esc_html__( 'Icon', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'car_form_search_width_icon',[
					'label' => esc_html__( 'Icon (px)', 'autoart' ),
					'type'  => Controls_Manager::SLIDER,
					'size_units' => [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 96,
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--header img' => 'max-width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .bt-elwg-cars-search--header svg' => 'max-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'car_form_search_ss_style_content',[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'car_form_search_style_heading',[
					'label' => esc_html__( 'Heading', 'autoart' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'car_form_search_hd_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--header h3',
				]
			);

			$this->add_control(
				'car_form_search_hd_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--header h3' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'car_form_search_style_sub_heading',[
					'label' => esc_html__( 'Sub Heading', 'autoart' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'car_form_search_sub_hd_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--header p',
				]
			);

			$this->add_control(
				'car_form_search_sub_hd_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--header p' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		?>
			<div class="bt-elwg-cars-search--style-1">
				<?php get_template_part( 'framework/templates/car-search', 'style', array('layout' => 'style-1', 'data' => $settings)); ?>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
