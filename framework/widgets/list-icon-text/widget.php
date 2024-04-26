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
	}

	protected function register_style_section_controls() {
		$this->start_controls_section(
			'lict_icon_style_section',[
				'label' => esc_html__( 'Icon', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'lict_icon_width',[
					'label'      => esc_html__( 'Width', 'autoart' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
							'step'=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .item-icon-text--icon svg' => 'min-width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .item-icon-text--icon svg' => 'max-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'lict_icon_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .item-icon-text--icon svg > g path' => 'stroke: {{VALUE}} !important;',
						'{{WRAPPER}} .item-icon-text--icon svg path' => 'fill: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'lict_title_style_section',[
				'label' => esc_html__( 'Title', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'lict_title_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-icon-text--title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'lict_title_bg',[
					'label'     => esc_html__( 'Background Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-icon-text--title > h3' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'lict_title_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-list-icon-text--title > h3',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'lict_content_style_section',[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'lict_text_color',[
					'label'     => esc_html__( 'Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .item-icon-text-inner h4' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'lict_text_bg',[
					'label'     => esc_html__( 'Background Color', 'autoart' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-list-icon-text--items' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'lict_text_typography',
					'label'    => esc_html__( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .item-icon-text-inner h4 ',
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
