<?php
namespace AutoArtElementorWidgets\Widgets\CarsSearch;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Widget_CarsSearch extends Widget_Base {

	public function get_name() {
		return 'bt-cars-search';
	}

	public function get_title() {
		return __( 'Cars Search', 'autoart' );
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

	public function get_style_depends() {
		return [ 'select2-min', 'bt-main'];
	}
	
	protected function register_content_section_controls() {
		$this->start_controls_section(
			'ss_cars_search_content',[
				'label' => __( 'Content', 'autoart' ),
			]
		);

			$this->add_control(
				'top_search_heading',[
					'label' => __( 'Top Search', 'autoart' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'top_search_title', [
					'label'       => __( 'Title', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'Top Seach:',
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'top_search_text', [
					'label'       => esc_html__( 'Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is text',
				]
			);

			$repeater->add_control(
				'top_search_link', [
					'label' => esc_html__( 'Link', 'autoart' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => '',
				]
			);

			$this->add_control(
				'cars_top_search',[
					'label' => esc_html__( 'List Items', 'autoart' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'top_search_text'  => __( 'This is text 01', 'autoart' ),
							'top_search_link'  => '#'
						],
						[
							'top_search_text'  => __( 'This is text 02', 'autoart' ),
							'top_search_link'  => '#'
						],
						[
							'top_search_text'  => __( 'This is text 03', 'autoart' ),
							'top_search_link'  => '#'
						],
					],
					'title_field' => '{{{ top_search_text }}}',
				]
			);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {
		$this->start_controls_section(
			'ss_cars_search_general',[
				'label' => esc_html__( 'General', 'autoart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'ss_cars_search_general_bcl',[
					'label' => esc_html__( 'Background Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'ss_cars_search_general_pd',[
					'label' => esc_html__( 'Padding', 'autoart' ),
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
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'ss_cars_search_general_bri',[
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

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_search',[
				'label' => esc_html__( 'Form', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'ss_style_form_search_pd',[
					'label' => esc_html__( 'Padding', 'autoart' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'top'    => 30,
						'right'  => 30,
						'bottom' => 27,
						'left'   => 30,
						'unit'   => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'ss_style_form_search_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner .bt-field-type-select .select2-container .select2-selection--single .select2-selection__rendered',
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_top_search',[
				'label' => esc_html__( 'Top Search', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'top_search_heading_title',[
					'label' => esc_html__( 'Title', 'autoart' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'top_search_title_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form-top-search p',
				]
			);

			$this->add_control(
				'top_search_title_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form-top-search p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'top_search_heading_content',[
					'label' => esc_html__( 'Content', 'autoart' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'top_search_content_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form-top-search a',
				]
			);

			$this->add_control(
				'top_search_content_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form-top-search a' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_bg',[
				'label' => esc_html__( 'Background', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),[
					'name'     => 'elwg_cars_search_bg',
					'label'    => esc_html__( 'Color', 'autoart' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_bg_overlay',[
				'label' => esc_html__( 'Background Overlay', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),[
					'name'     => 'elwg_cars_search_bg_overlay',
					'label'    => esc_html__( 'Color', 'autoart' ),
					'types'    => ['classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form::before',
				]
			);

			$this->add_responsive_control(
				'elwg_cars_search_bg_overlay_opacity',[
					'label' => esc_html__( 'Opacity', 'autoart' ),
					'type'  => Controls_Manager::SLIDER,
					'default'  => [
						'size' => .5,
					],
					'range' => [
						'px' => [
							'max' => 1,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form::before' => 'opacity: {{SIZE}};',
					],
					'condition' => [
						'elwg_cars_search_bg_overlay_background' => [ 'classic', 'gradient' ],
					],
				]
			);

			$this->add_control(
				'elwg_cars_search_bg_overlay_blend_mode',[
					'label'   => esc_html__( 'Blend Mode', 'autoart' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						''            => esc_html__( 'Normal', 'autoart' ),
						'multiply'    => esc_html__( 'Multiply', 'autoart' ),
						'screen'      => esc_html__( 'Screen', 'autoart' ),
						'overlay'     => esc_html__( 'Overlay', 'autoart' ),
						'darken'      => esc_html__( 'Darken', 'autoart' ),
						'lighten'     => esc_html__( 'Lighten', 'autoart' ),
						'color-dodge' => esc_html__( 'Color Dodge', 'autoart' ),
						'saturation'  => esc_html__( 'Saturation', 'autoart' ),
						'color'       => esc_html__( 'Color', 'autoart' ),
						'luminosity'  => esc_html__( 'Luminosity', 'autoart' ),
						'difference'  => esc_html__( 'Difference', 'autoart' ),
						'exclusion'   => esc_html__( 'Exclusion', 'autoart' ),
						'hue'         => esc_html__( 'Hue', 'autoart' ),
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form::before' => 'mix-blend-mode: {{VALUE}}',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name'     => 'elwg_cars_search_bg_overlay_image[url]',
								'operator' => '!==',
								'value'    => '',
							],
							[
								'name'     => 'elwg_cars_search_bg_overlay_color',
								'operator' => '!==',
								'value'    => '',
							],
						],
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
		$top_search = $settings['cars_top_search'];
		?>
			<div class="bt-elwg-cars-search--default">
				<div class="bt-elwg-cars-search-inner"> 
					<div class="bt-elwg-cars-search--form"> 
						<form class="bt-car-search-form" action="<?php echo esc_url( home_url( '/cars' ) ); ?>" method="get">
							<?php 
								$field_name  = __('Any Makes', 'autoart');
								$field_value = (isset($_GET['car_make'])) ? $_GET['car_make'] : '';
								autoart_cars_field_select_html('car_make', $field_name, $field_value);

								$field_name  = __('Any Models', 'autoart');
								$field_value = (isset($_GET['car_model'])) ? $_GET['car_model'] : '';
								autoart_cars_field_select_html('car_model', $field_name, $field_value);

								$field_title = __('All Price', 'autoart');
								$field_value = (isset($_GET['car_price'])) ? $_GET['car_price'] : '';
								$field_step  = 1000;
								autoart_cars_field_select_range_html('car_price', $field_title, $field_value, $field_step);
							?> 

							<div class="bt-form-field bt-field-submit"> 
								<input type="submit"  class="btn btn-primary" value="Search Now">
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
									<path d="M14.4792 14.4935L19.25 19.25M16.5 9.625C16.5 13.4219 13.4219 16.5 9.625 16.5C5.82804 16.5 2.75 13.4219 2.75 9.625C2.75 5.82804 5.82804 2.75 9.625 2.75C13.4219 2.75 16.5 5.82804 16.5 9.625Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>
						</form>

						<?php if(!empty($top_search) && isset($top_search)): ?>
							<div class="bt-elwg-cars-search--form-top-search">  
								<?php if(!empty($settings['top_search_title']) && isset($settings['top_search_title'])): ?>
									<p> <?php echo $settings['top_search_title']  ?> </p>
								<?php endif; ?>	

								<div class="bt-elwg-cars-search--form-top-search-inner">
									<?php foreach ( $top_search as $index => $item ): ?>			
										<?php if(!empty($item['top_search_text']) && !empty($item['top_search_link'])): ?>
											<div class="item-top-search"> 
												<a href="<?php echo esc_url($item['top_search_link']) ?>"> 
													<?php echo esc_html_e($item['top_search_text']) ?>
												</a>
											</div>
										<?php endif;?>	
									<?php endforeach; ?>	
								</div>	
							</div>
						<?php endif;?>	
					</div>	
				</div>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
