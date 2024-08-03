<?php

namespace autoartElementorWidgets\Widgets\ServiceHours;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Widget_ServiceHours extends Widget_Base
{

	public function get_name()
	{
		return 'bt-service-hours';
	}

	public function get_title()
	{
		return __('Service Hours', 'autoart');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['autoart'];
	}

	public function get_script_depends()
	{
		return ['elementor-widgets'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'autoart'),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'service_title',
			[
				'label' => __('Title', 'autoart'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Monday', 'autoart'),
			]
		);

		$repeater->add_control(
			'service_hours',
			[
				'label' => __('Hours', 'autoart'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('12:00 pm - 08:00 pm', 'autoart'),
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __('Service Hours', 'autoart'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'service_title' => __('Sunday', 'autoart'),
						'service_hours' => __('CLOSED', 'autoart'),
					],
					[
						'service_title' => __('Monday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
					[
						'service_title' => __('Tuesday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
					[
						'service_title' => __('Wednesday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
					[
						'service_title' => __('Thursday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
					[
						'service_title' => __('Friday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
					[
						'service_title' => __('Saturday', 'autoart'),
						'service_hours' => __('9:00 AM - 9.00 PM', 'autoart'),
					],
				],
				'title_field' => '{{{ service_title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'autoart'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'service_title_style',
			[
				'label' => __('Title', 'autoart'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'service_title_color',
			[
				'label' => __('Color', 'autoart'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-service--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'service_title_typography',
				'label' => __('Typography', 'autoart'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-service--title',
			]
		);

		$this->add_control(
			'service_hours_style',
			[
				'label' => __('Hours', 'autoart'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'service_hours_color',
			[
				'label' => __('Color', 'autoart'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-service--hours' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'service_hours_typography',
				'label' => __('Typography', 'autoart'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-service--hours',
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$site_information = get_field('site_information', 'options');
		if (empty($settings['list'])) {
			return;
		}
?>
		<div class="bt-elwg-service-hours--default">
			<ul class="bt-service-hours">
				<?php foreach ($settings['list'] as $index => $item) {
				?>
					<li class="bt-service--item">
						<div class="bt-service--title">
							<?php echo esc_html($item['service_title']); ?>
						</div>
						<div class="bt-service--hours">
							<?php echo esc_html($item['service_hours']); ?>
						</div>
					</li>
				<?php }
				?>
			</ul>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
