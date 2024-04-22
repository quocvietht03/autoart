<?php
namespace AutoArtElementorWidgets\Widgets\CarsWishlist;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_CarsWishlist extends Widget_Base {

	public function get_name() {
		return 'bt-cars-wishlist';
	}

	public function get_title() {
		return __( 'Cars Wishlist', 'autoart' );
	}

  public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'autoart' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'autoart' ),
			]
		);

		$this->end_controls_section();
	}


	protected function register_style_section_controls() {
    $this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'autoart' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

    ?>
      <div class="bt-elwg-cars-wishlist--default">
        Cars Wishlist
      </div>
    <?php
	}

	protected function content_template() {

	}

}
