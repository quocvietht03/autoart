<?php

namespace AutoArtElementorWidgets\Widgets\ListFaq;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;


class Widget_ListFaq extends Widget_Base
{

    public function get_name()
    {
        return 'bt-list-faq';
    }

    public function get_title()
    {
        return __('List Faq', 'autoart');
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
            'lit_text', [
                'label' => __('Text', 'autoart'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Faq title',
            ]
        );

        $repeater->add_control(
            'lit_content', [
                'label' => __('Content', 'autoart'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Faq content',
            ]
        );

        $this->add_control(
            'list', [
                'label' => __('List Faq', 'autoart'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'lit_text' => __('Faq title 01', 'autoart'),
                        'lit_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                    [
                        'lit_text' => __('Faq title 02', 'autoart'),
                        'lit_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                    [
                        'lit_text' => __('Faq title 03', 'autoart'),
                        'lit_content' => 'Quisque imperdiet dignissim enim dictum finibus. Sed consectetutr convallis enim eget laoreet. Aenean vitae nisl mollis, porta risus vel, dapibus lectus. Etiam ac suscipit eros, eget maximus.'
                    ],
                ],
                'title_field' => '{{{ lit_text }}}',
            ]
        );


        $this->end_controls_section();


    }

    protected function register_style_section_controls()
    {
        $this->start_controls_section(
            'section_style_item', [
                'label' => esc_html__('General', 'autoart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'lit_border', [
                'label' => __('Border Width', 'autoart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
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
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-list-faq--default .item-faq-inner' => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
                ],
            ]
        );
        $this->add_control(
            'lit_border_color', [
                'label' => __('Border Color', 'autoart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-elwg-list-faq--default .item-faq-inner' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'lit_gap', [
                'label' => __('Space Between', 'autoart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .bt-elwg-list-faq--default .item-faq-inner' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_content', [
                'label' => esc_html__('Content', 'autoart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_style', [
                'label' => esc_html__('Title', 'autoart'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'lit_title_color', [
                'label' => __('Color', 'autoart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'lit_title_hover_color', [
                'label' => __('Color Hover', 'autoart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-title:hover h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bt-item-title.active h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'lit_title_typography',
                'label' => __('Typography', 'autoart'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-title h3 ',
            ]
        );
        $this->add_control(
            'content_style', [
                'label' => esc_html__('content', 'autoart'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'lit_content_color', [
                'label' => __('Color', 'autoart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bt-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'lit_content_typography',
                'label' => __('Typography', 'autoart'),
                'default' => '',
                'selector' => '{{WRAPPER}} .bt-item-content',
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

        if (empty($settings['list'])) {
            return;
        }

        ?>
        <div class="bt-elwg-list-faq--default">
            <div class="bt-elwg-list-faq-inner">
                <?php foreach ($settings['list'] as $index => $item): ?>
                    <div class="item-faq">
                        <div class="item-faq-inner">
                            <div class="bt-item-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                     fill="none">
                                    <g clip-path="url(#clip0_72_383)">
                                        <path d="M13.7734 14.1671L16.9978 19.8111L20.2221 14.1671H13.7734Z"
                                              fill="#1FBECD"/>
                                        <path d="M17 0C7.6259 0 0 7.6259 0 17C0 26.3741 7.6259 34 17 34C26.3741 34 34 26.3741 34 17C34 7.6259 26.3741 0 17 0ZM23.8964 13.4526L18.2297 23.3693C17.9776 23.8113 17.5072 24.0833 17.0001 24.0833C16.4915 24.0833 16.0212 23.8113 15.7704 23.3693L10.1038 13.4526C9.85303 13.0135 9.85442 12.4751 10.108 12.0388C10.3616 11.6024 10.8277 11.3333 11.3334 11.3333H22.6668C23.1711 11.3333 23.6372 11.6024 23.8922 12.0388C24.1456 12.4751 24.1471 13.0135 23.8964 13.4526Z"
                                              fill="#1FBECD"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_72_383">
                                            <rect width="34" height="34" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <?php if (!empty($item['lit_text'])): ?>
                                    <h3> <?php echo $item['lit_text'] ?> </h3>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($item['lit_content'])): ?>
                                <div class="bt-item-content">
                                    <?php echo esc_attr($item['lit_content']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php }

    protected function content_template()
    {

    }
}
