<?php
namespace AutoArtElementorWidgets\Widgets\ListIconText;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_ListIconText extends Widget_Base {

	public function get_name() {
		return 'bt-list-icon-text';
	}

	public function get_title() {
		return __( 'List Icon Text', 'autoart' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	public function get_script_depends() {
		return [ 'elementor-widgets' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_content',[
				'label'=> esc_html__( 'Content', 'autoart' ),
			]
		);

		$this->add_control(
			'lict_title', [
				'label'       => esc_html__( 'Title', 'autoart' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'This is Title',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'lict_icon', [
				'label'       => esc_html__( 'Icon', 'autoart' ),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => [ 'svg'],
				'default'     => [
					'url'     => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'lict_text', [
				'label'       => esc_html__( 'Text', 'autoart' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'This is text',
			]
		);

		$repeater->add_control(
			'lict_link', [
				'label' => __( 'Button Link', 'autoart' ),
				'label'       => esc_html__( 'Text', 'autoart' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'lict_items',[
				'label'   => esc_html__( 'List Icon Text', 'autoart' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 01', 'autoart' ),
						'lict_link'  => '#'
					],
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 02', 'autoart' ),
						'lict_link'  => '#'
					],
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 03', 'autoart' ),
						'lict_link'  => '#'
					],
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 04', 'autoart' ),
						'lict_link'  => '#'
					],
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 05', 'autoart' ),
						'lict_link'  => '#'
					],
					[
						'lict_icon'  => Utils::get_placeholder_image_src(),
						'lict_text'  => esc_html__( 'Text 06', 'autoart' ),
						'lict_link'  => '#'
					],
				],
				'title_field' => '{{{ lict_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',[
				'label' => esc_html__( 'Layout', 'autoart' ),
			]
		);

			$this->add_responsive_control(
				'lict_columns',[
					'label'          => esc_html__( 'Columns', 'autoart' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '6',
					'tablet_default' => '3',
					'mobile_default' => '2',
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-icon-text--items' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
					],
				]
			);

			// $this->add_responsive_control(
			// 	'lict_gap_col',[
			// 		'label'      => esc_html__( 'Gap between columns', 'autoart' ),
			// 		'type'       => Controls_Manager::SLIDER,
			// 		'size_units' => [ 'px', '%'],
			// 		'range' => [
			// 			'px' => [
			// 				'min' => 0,
			// 				'max' => 200,
			// 				'step' => 1,
			// 			],
			// 			'%' => [
			// 				'min' => 0,
			// 				'max' => 100,
			// 			],
			// 		],
			// 		'default' => [
			// 			'unit' => 'px',
			// 			'size' => 80,
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .bt-elwg-list-icon-text--items' => 'column-gap: {{SIZE}}{{UNIT}}',
			// 			'{{WRAPPER}} .item-icon-text:not(:first-child)::before' => 'left: calc(({{SIZE}}{{UNIT}} / 2)* -1)',
			// 		],
			// 	]
			// );

			// $this->add_responsive_control(
			// 	'lict_gap_row',[
			// 		'label'      => esc_html__( 'Gap between rows', 'autoart' ),
			// 		'type'       => Controls_Manager::SLIDER,
			// 		'size_units' => [ 'px', '%'],
			// 		'range'      => [
			// 			'px' => [
			// 				'min'  => 0,
			// 				'max'  => 200,
			// 				'step' => 1,
			// 			],
			// 			'%' => [
			// 				'min' => 0,
			// 				'max' => 100,
			// 			], 
			// 		],
			// 		'default' => [
			// 			'unit' => 'px',
			// 			'size' => 0,
			// 		],
			// 		'selectors' => [
			// 			'{{WRAPPER}} .bt-elwg-list-icon-text--items' => 'row-gap: {{SIZE}}{{UNIT}}',
			// 		],
			// 	]
			// );

		$this->end_controls_section();
	}

	protected function register_style_section_controls() {

		$this->start_controls_section(
			'section_style_item',[
				'label' => esc_html__( 'General', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'lict_bg_color',[
					'label' => __( 'Background Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'lict_border_color',[
					'label' => __( 'Border Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'lict_border_width',[
					'label' => __( 'Border Width', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'box_border_radius',[
					'label' => __( 'Border Radius', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ], 
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'lict_padding',[
					'label' => __( 'Padding', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),[
					'name' => 'lict_box_shadow',
					'selector' => '{{WRAPPER}} .item-image-text-inner',
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_image',[
				'label' => esc_html__( 'Image', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'lict_icon_width',[
					'label' => __( 'Width', 'autoart' ),
					'type'  => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .item-image-text--thumbnail img' => 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .item-image-text--thumbnail svg' => 'max-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'lict_icon_box_shadow',
					'selector' => '{{WRAPPER}} .item-image-text--thumbnail img',
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'lict_thumbnail_filters',
					'selector' => '{{WRAPPER}} .item-image-text--thumbnail img',
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
				'lict_text_color',[
					'label' => __( 'Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .item-image-text h3' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name' => 'lict_text_typography',
					'label' => __( 'Typography', 'autoart' ),
					'default' => '',
					'selector' => '{{WRAPPER}} .item-image-text h3 ',
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
		
		if ( empty( $settings['lict_items'] ) && !isset($settings['lict_items']) ) {
			return;
		}

	?>
		<div class="bt-elwg-list-icon-text">
			<div class="bt-elwg-list-icon-text-inner"> 
				<?php if(!empty($settings['lict_title']) && isset($settings['lict_title'])): ?>
					<div class="bt-elwg-list-icon-text--title"> 
						<h3> <?php echo esc_html($settings['lict_title']) ?> </h3>
					</div>
				<?php endif; ?>	

				<div class="bt-elwg-list-icon-text--items">
					<?php foreach ( $settings['lict_items'] as $index => $item ): ?>
						<?php
							// echo "<pre>";
							// echo print_r($item);
							// echo "</pre>";	
							$path_info = pathinfo($item['lict_icon']['url']);
						?>
						<div class="item-icon-text"> 
							<div class="item-icon-text-inner"> 
								<div class="item-icon-text--icon"> 
									<?php if (strtolower($path_info['extension']) === 'svg'): ?>
										<?php echo file_get_contents( $item['lict_icon']['url'] ); ?>
									<?php else: ?>
										<?php echo '<img src=" ' . esc_url( $item['lict_icon']['url'] ) . ' " alt="image">'; ?>
								    <?php endif;?>			
								</div>

								<?php if(!empty($item['lict_text']) && isset($item['lict_text'])): ?>
									<h4 class="item-icon-text--heading"> <?php echo esc_html($item['lict_text']) ?> </h4>
								<?php endif;?>	

								<?php if(!empty($item['lict_link'])): ?>
									<a href="<?php echo esc_url($item['lict_link']) ?>"> </a>
								<?php endif;?>	
							</div>
						</div>
					<?php endforeach;?>		
				</div>
			</div>	
	    </div>
	<?php }

	protected function content_template() {

	}
}
