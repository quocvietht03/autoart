<?php
namespace AutoArtElementorWidgets\Widgets\HighlightedHeading;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_HighlightedHeading extends Widget_Base {

	public function get_name() {
		return 'bt-highlighted-heading';
	}

	public function get_title() {
		return __( 'Highlighted Heading', 'autoart' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	protected function register_content_section_controls() {
		$this->start_controls_section(
			'section_heading',[
				'label' => __( 'Heading', 'autoart' ),
			]
		);

			$this->add_control(
				'before_text',[
					'label'       => esc_html__( 'Before Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is the heading',
				]
			);

			$this->add_control(
				'highlighted_text',[
					'label'       => esc_html__( 'Highlighted Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'Highlighted',
				]
			);

			$this->add_control(
				'after_text',[
					'label'       => esc_html__( 'After Text', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '',
				]
			);

			$this->add_control(
				'highlighted_image', [
					'label'   => esc_html__( 'Highlighted Image', 'autoart' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => get_template_directory_uri() . '/assets/images/text-highlighted-bg.svg',
					],
				]
			);

			$this->add_control(
				'link_heading',[
					'label'       => esc_html__( 'Link', 'autoart' ),
					'type'        => Controls_Manager::TEXT,
					'input_type'  => 'url',
					'default'     => '',
				]
			);

			$this->add_control(
				'html_tag',[
					'label' => __( 'HTML Tag', 'autoart' ),
					'type'  => Controls_Manager::SELECT,
					'default' => 'h3',
					'options' => [
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					],
				]
			);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {

		$this->start_controls_section(
			'section_style_heading',[
				'label' => esc_html__( 'Heading', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
						'{{WRAPPER}} .bt-elwg-highlighted-heading' => 'justify-content: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_color',[
					'label' => __( 'Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#222',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-highlighted-heading h1' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-highlighted-heading h2' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-highlighted-heading h3' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-highlighted-heading h4' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-highlighted-heading h5' => 'color: {{VALUE}};',
						'{{WRAPPER}} .bt-elwg-highlighted-heading h6' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'text_typography',
					'label'    => __( 'Typography', 'autoart' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-highlighted-heading h1, {{WRAPPER}} .bt-elwg-highlighted-heading h2, {{WRAPPER}} .bt-elwg-highlighted-heading h3, {{WRAPPER}} .bt-elwg-highlighted-heading h4, {{WRAPPER}} .bt-elwg-highlighted-heading h5, {{WRAPPER}} .bt-elwg-highlighted-heading h6',
				]
			);

			$this->add_control(
				'highlighted_text_style',[
					'label' => __( 'Highlighted Text', 'autoart' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'highlighted_text_color',[
					'label' => __( 'Color', 'autoart' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#1FBECD',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-highlighted-heading .__text-highlighted' => 'color: {{VALUE}};'
					],
				]
			);

			$this->add_responsive_control(
				'highlighted_image_width',[
					'label' => __( 'Width Highlighted Image', 'autoart' ),
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
						'unit' => '%',
						'size' => 70,
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-highlighted-heading .__text-highlighted img' => 'min-width: calc( 100% + {{SIZE}}{{UNIT}} )',
					],
				]
			);

			$this->add_control(
				'show_animation',[
					'label'    => __( 'Animation', 'autoart' ),
					'type'     => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'autoart' ),
					'label_off'=> __( 'Hide', 'autoart' ),
					'default'  => '',
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
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : '';
		$link     = isset($settings['link_heading']) ? $settings['link_heading'] : '';
		$before_text = isset($settings['before_text']) ? $settings['before_text'] : '';
		$after_text  = isset($settings['after_text']) ? $settings['after_text'] : '';
		$hl_text     = isset($settings['highlighted_text']) ? $settings['highlighted_text'] : '';
		$hl_image    = (isset($settings['highlighted_image']) && !empty($settings['highlighted_image'])) ? $settings['highlighted_image']['url'] : '';
		$animation   = (isset($settings['show_animation'] ) && $settings['show_animation'] == 'yes') ? 'animationed' : '';
	?>

		<div class="bt-elwg-highlighted-heading <?php echo $animation ?>">
			<?php echo "<$html_tag>"; ?>

			<?php if (!empty($link)): ?>
				<a href="<?php echo esc_url($link); ?>">
					<?php echo !empty($before_text) ? $before_text : ''; ?>

					<?php if (!empty($hl_text)): ?>
						<span class="__text-highlighted">
							<?php echo $hl_text; ?>
							<img src='<?php echo esc_url($hl_image)?>' alt="img" />
						</span>
					<?php endif; ?>

					<?php echo !empty($after_text) ? $after_text : ''; ?>
				</a>
			<?php else: ?>
				<?php echo !empty($before_text) ? $before_text : ''; ?>

				<?php if (!empty($hl_text)): ?>
					<span class="__text-highlighted">
						<?php echo $hl_text; ?>
						<img src='<?php echo esc_url($hl_image)?>' alt="img" />
					</span>
				<?php endif; ?>

				<?php echo !empty($after_text) ? $after_text : ''; ?>
			<?php endif; ?>

			<?php echo "</$html_tag>"; ?>
		</div>
	<?php
	}

	protected function content_template() {

	}
}
