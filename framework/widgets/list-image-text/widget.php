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
						'lit_text'  => __( 'This is text 01', 'autoart' ),
						'lit_link'  => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text'  => __( 'This is text 02', 'autoart' ),
						'lit_link'  => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text'  => __( 'This is text 03', 'autoart' ),
						'lit_link'  => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text'  => __( 'This is text 04', 'autoart' ),
						'lit_link'  => '#'
					],
					[
						'lit_image' => Utils::get_placeholder_image_src(),
						'lit_text'  => __( 'This is text 05', 'autoart' ),
						'lit_link'  => '#'
					],
				],
				'title_field' => '{{{ lit_text }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),[
				'name'       => 'thumbnail',
				'label'      => __( 'Image Size', 'autoart' ),
				'show_label' => true,
				'default'    => 'medium_large',
				'exclude'    => [ 'custom' ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',[
				'label' => __( 'Layout', 'autoart' ),
			]
		);

			$this->add_control(
				'lit_layout_style',[
					'label' => __( 'Layout Style', 'autoart' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => 'Default',
						'style-1' => 'Style 1',
						'style-2' => 'Style 2',
					],
				]
			);

			$this->add_responsive_control(
				'lit_columns',[
					'label' => __( 'Columns', 'autoart' ),
					'type' => Controls_Manager::SELECT,
					'default' => '5',
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
						'{{WRAPPER}} .bt-elwg-list-image-text-inner' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
					],
				]
			);

			$this->add_responsive_control(
				'lit_gap_col',[
					'label' => __( 'Gap between columns', 'autoart' ),
					'type'  => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-image-text-inner' => 'column-gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'lit_gap_row',[
					'label' => __( 'Gap between rows', 'autoart' ),
					'type'  => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-image-text-inner' => 'row-gap: {{SIZE}}{{UNIT}}',
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
				'lit_bg_color',[
					'label' => __( 'Background Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'lit_border_color',[
					'label' => __( 'Border Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .item-image-text-inner' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'lit_border_width',[
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
				'lit_padding',[
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
					'name' => 'lit_box_shadow',
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
				'lit_image_width',[
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
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'lit_image_box_shadow',
					'selector' => '{{WRAPPER}} .item-image-text--thumbnail img',
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'lit_thumbnail_filters',
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
				'lit_text_color',[
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
					'name' => 'lit_text_typography',
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

		if ( empty( $settings['list'] ) ) {
			return;
		}

	?>
		<div class="bt-elwg-list-image-text--<?php echo $settings['lit_layout_style'] ?>">
			<div class="bt-elwg-list-image-text-inner"> 
				<?php foreach ( $settings['list'] as $index => $item ): ?>
					<?php 
						$attachment = wp_get_attachment_image_src( $item['lit_image']['id'], $settings['thumbnail_size'] ); 
						$delay      = ($index + 1) * 100;
						$animation  = 'fadeInUp';
					?>
					<div class="item-image-text"> 
						<div class="item-image-text-inner" data-settings='<?php echo json_encode(["_animation" => $animation, "_animation_delay" => $delay]); ?>'>
							<div class="item-image-text--thumbnail">
								<?php if( !empty( $attachment ) ) {
										echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
									} else {
										echo '<img src=" ' . esc_url( $item['lit_image']['url'] ) . ' " alt="">';
								} ?>
							</div>

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
	<?php }

	protected function content_template() {

	}
}
