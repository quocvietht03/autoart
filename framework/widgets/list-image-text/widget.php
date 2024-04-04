<?php
namespace AutoArtElementorWidgets\Widgets\ListImageText;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_ListImageText extends Widget_Base {

	public function get_name() {
		return 'bt-list-image-text';
	}

	public function get_title() {
		return __( 'List Image Text', 'autoart' );
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
			'section_content',
			[
				'label' => __( 'Content', 'autoart' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'lit_image', [
				'label' => __( 'Image', 'autoart' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'lit_text', [
				'label' => __( 'Text', 'autoart' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$repeater->add_control(
			'lit_link', [
				'label' => __( 'Button Link', 'autoart' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'list',[
				'label' => __( 'List Image Text', 'autoart' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text' => __( 'This is text 01', 'autoart' ),
						'lit_link' => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text' => __( 'This is text 02', 'autoart' ),
						'lit_link' => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text' => __( 'This is text 03', 'autoart' ),
						'lit_link' => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text' => __( 'This is text 04', 'autoart' ),
						'lit_link' => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text' => __( 'This is text 05', 'autoart' ),
						'lit_link' => '#'
					],
				],
				'title_field' => '{{{ lit_text }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label' => __( 'Image Size', 'autoart' ),
				'show_label' => true,
				'default' => 'medium_large',
				'exclude' => [ 'custom' ],
			]
		);

		$this->add_responsive_control(
			'image_ratio',
			[
				'label' => __( 'Image Ratio', 'autoart' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.58,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-step-item--image .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);

		$this->add_control(
			'show_more_button',
			[
				'label' => __( 'Show More Button', 'autoart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'autoart' ),
				'label_off' => __( 'Hide', 'autoart' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_more_button_text',
			[
				'label' => __( 'Show More Text', 'autoart' ),
				'type' => Controls_Manager::TEXT,
				'show_label' => true,
				'default' => __( 'More Steps', 'autoart' ),
				'condition' => [
					'show_more_button!' => '',
				],
			]
		);

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
				'button_border_width',
				[
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
						'{{WRAPPER}} .bt-step-item--button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
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
				'button_padding',
				[
					'label' => __( 'Padding', 'autoart' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
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


			$this->start_controls_tabs( 'tabs_box_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => __( 'Normal', 'autoart' ),
					]
				);
	
					$this->add_control(
						'box_bg_color',[
							'label' => __( 'Background Color', 'autoart' ),
							'type' => Controls_Manager::COLOR,
							'default' => '#fff',
							'selectors' => [
								'{{WRAPPER}} .item-image-text-inner' => 'background-color: {{VALUE}};',
							],
						]
					);
	
					$this->add_control(
						'box_border_color',[
							'label' => __( 'Border Color', 'autoart' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .item-image-text-inner' => 'border-color: {{VALUE}};',
							],
						]
					);
	
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'bx_box_shadow',
							'selector' => '{{WRAPPER}} .item-image-text-inner',
						]
					);
	
				$this->end_controls_tab();
	
				$this->start_controls_tab(
					'tab_button_hover',[
						'label' => __( 'Hover', 'autoart' ),
					]
				); 
	
					$this->add_control(
						'box_bg_color_hover',[
							'label' => __( 'Background Color', 'autoart' ),
							'type' => Controls_Manager::COLOR,
							'default' => '#fff',
							'selectors' => [
								'{{WRAPPER}} .item-image-text-inner:hover' => 'background-color: {{VALUE}};',
							],
						]
					);
	
					$this->add_control(
						'box_border_color_hover',
						[
							'label' => __( 'Border Color', 'autoart' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .item-image-text-inner:hover' => 'border-color: {{VALUE}};',
							],
						]
					);
	
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'bx_box_shadow_hover',
							'selector' => '{{WRAPPER}} .item-image-text-inner:hover',
						]
					);
	
				$this->end_controls_tab();
	
			$this->end_controls_tabs();

		

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'autoart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-step-item--image .bt-cover-image' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'autoart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bt-step-item--image .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-step-item--image .bt-cover-image',
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bt-step-item--image .bt-cover-image' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'thumbnail_tab_normal',
			[
				'label' => __( 'Normal', 'autoart' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .bt-step-item--image img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'thumbnail_tab_hover',
			[
				'label' => __( 'Hover', 'autoart' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .bt-step-item:hover .bt-step-item--image img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'text_color',[
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
					'name' => 'text_typography',
					'label' => __( 'Typography', 'autoart' ),
					'default' => '',
					'selector' => '{{WRAPPER}} .item-image-text h3 ',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_show_more_btn',
			[
				'label' => esc_html__( 'Show More Button', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_more_button!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'show_more_btn_typography',
				'label' => __( 'Typography', 'autoart' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-step-show-more--button',
			]
		);

		$this->add_control(
			'show_more_btn_border_width',
			[
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
					'{{WRAPPER}} .bt-step-show-more--button' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'show_more_btn_border_radius',
			[
				'label' => __( 'Border Radius', 'autoart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'show_more_btn_padding',
			[
				'label' => __( 'Padding', 'autoart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

    $this->start_controls_tabs( 'tabs_show_more_btn_style' );

		$this->start_controls_tab(
			'tab_show_more_btn_normal',
			[
				'label' => __( 'Normal', 'autoart' ),
			]
		);

    $this->add_control(
			'show_more_btn_text_color',
			[
				'label' => __( 'Text Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_icon_color',
			[
				'label' => __( 'Icon Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_bg_color',
			[
				'label' => __( 'Background Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_border_color',
			[
				'label' => __( 'Border Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'show_more_btn_box_shadow',
				'selector' => '{{WRAPPER}} .bt-step-show-more--button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_show_more_btn_hover',
			[
				'label' => __( 'Hover', 'autoart' ),
			]
		);

		$this->add_control(
			'show_more_btn_text_color_hover',
			[
				'label' => __( 'Text Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_icon_color_hover',
			[
				'label' => __( 'Icon Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_bg_color_hover',
			[
				'label' => __( 'Background Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_more_btn_border_color_hover',
			[
				'label' => __( 'Border Color', 'autoart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bt-step-show-more--button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'show_more_btn_box_shadow_hover',
				'selector' => '{{WRAPPER}} .bt-step-show-more--button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list'] ) ) {
			return;
		}

		?>
			<div class="bt-elwg-list-image-text--default">
				<div class="bt-elwg-list-image-text-inner"> 
					<?php foreach ( $settings['list'] as $index => $item ): ?>
						<?php $attachment = wp_get_attachment_image_src( $item['lit_image']['id'], $settings['thumbnail_size'] ); ?>
						<div class="item-image-text"> 
							<div class="item-image-text-inner"> 
								<?php if(!empty($attachment)): ?>
									<div class="item-image-text--thumbnail"> 
										<?php echo '<img src=" ' . esc_url( $item['lit_image']['url'] ) . ' " alt="image">'; ?>
									</div>
								<?php endif;?>

								<?php if(!empty($item['lit_text'])): ?>
									<h3> <?php echo $item['lit_text'] ?> </h3>
							    <?php endif;?>	
								
								<?php if(!empty($item['lit_link'])): ?>
									<a href="<?php echo esc_url($item['lit_link']) ?>"> </a>
								<?php endif;?>		

							</div>
						</div>
				    <?php endforeach;?>		
				</div>		
	    	</div>
		<?php
	}

	protected function content_template() {

	}
}
