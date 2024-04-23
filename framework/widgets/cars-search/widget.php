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

	protected function register_content_section_controls() {
		$this->start_controls_section(
			'ss_cars_search_content',[
				'label' => __( 'Content', 'autoart' ),
			]
		);

			$this->add_control(
				'top_search_heading',
				[
					'label' => __( 'Top Search', 'autoart' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'top_search_title', [
					'label'       => __( 'Title', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'Top Seach',
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'top_search_text', [
					'label'       => __( 'Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is text',
				]
			);

			$repeater->add_control(
				'top_search_link', [
					'label' => __( 'Link', 'autoart' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => '',
				]
			);

			$this->add_control(
				'cars_top_search',[
					'label' => __( 'List Items', 'autoart' ),
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

		$this->start_controls_section(
			'section_layout',[
				'label' => __( 'Layout', 'autoart' ),
			]
		);

			$this->add_responsive_control(
				'text_align',[
					'label' => esc_html__( 'Alignment', 'autoart' ),
					'type'  => Controls_Manager::CHOOSE,
					'options' => [
						'start' => [
							'title' => esc_html__( 'Left', 'autoart' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'autoart' ),
							'icon'  => 'eicon-text-align-center',
						],
						'end' => [
							'title' => esc_html__( 'Right', 'autoart' ),
							'icon'  => 'eicon-text-align-right',
						],
					],
					'default' => 'start',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul' => 'justify-content: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'account_login_space',[
					'label' => __( 'Space Between', 'autoart' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 20,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul' => 'gap: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul li:before' => 'left: calc( -{{SIZE}}{{UNIT}} / 2 )',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {
		$this->start_controls_section(
			'ss_style_form_bg',[
				'label' => esc_html__( 'Background', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),[
					'name'     => 'elwg_cars_search_bg',
					'label'    => __( 'Color', 'autoart' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner',
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
					'label'    => __( 'Color', 'autoart' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner:before',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'account_login_color',
				[
					'label' => __( 'Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul li a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul li span' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-cars-search-inner ul li:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'account_login_typography',
					'label' => __( 'Typography', 'autoart' ),
					'default' => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner ul li a, {{WRAPPER}} .bt-elwg-cars-search-inner ul li span',
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
					</div>

					<?php if(!empty($top_search) && isset($top_search)): ?>
						<div class="bt-elwg-cars-search--top-search">  
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
					<?php endif;?>		
				</div>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
