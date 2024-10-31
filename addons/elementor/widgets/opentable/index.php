<?php

//START ELEMENT opentable
class nd_rst_opentable_element extends \Elementor\Widget_Base {

	public function get_name() { return 'opentable'; }
	public function get_title() { return __( 'OpenTable', 'nd-restaurant-reservations' ); }
	public function get_icon() { return 'fa fa-utensils'; }
	public function get_categories() { return [ 'nd-restaurant-reservations' ]; }

	
	/*START CONTROLS*/
	protected function _register_controls() {

		
		/*Create Tab*/
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Options', 'nd-restaurant-reservations' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'opentable_layout',
			[
				'label' => __( 'Layout', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => [
					'standard'  => __( 'Standard', 'nd-restaurant-reservations' ),
					'tall' => __( 'Tall', 'nd-restaurant-reservations' ),
					'wide' => __( 'Wide', 'nd-restaurant-reservations' ),
				],
			]
		);


		$this->add_control(
			'opentable_restaurant_id',
			[
				'label' => __( 'Restaurant ID', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your Restaurant ID', 'nd-restaurant-reservations' ),
			]
		);

		$this->add_control(
			'nopentable_language',
			[
				'label' => __( 'Language', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'en-US',
				'options' => [
					'en-US'  => __( 'English-US', 'nd-restaurant-reservations' ),
					'fr-CA' => __( 'Fr-CA', 'nd-restaurant-reservations' ),
					'de-DE' => __( 'Deutsch-DE', 'nd-restaurant-reservations' ),
					'es-MX'  => __( 'Espanol-MX', 'nd-restaurant-reservations' ),
					'ja-JP' => __( 'ja-JP', 'nd-restaurant-reservations' ),
					'nl-NL' => __( 'Nederlands-NL', 'nd-restaurant-reservations' ),
					'it-IT' => __( 'Italiano-IT', 'nd-restaurant-reservations' ),
				],
			]
		);

		$this->end_controls_section();

	}


 
	/*START RENDER*/
	protected function render() {

		$nd_rst_settings = $this->get_settings_for_display();
		
		//options 
		$opentable_layout = $nd_rst_settings['opentable_layout'];
		$opentable_restaurant_id = $nd_rst_settings['opentable_restaurant_id'];
		$nopentable_language = $nd_rst_settings['nopentable_language'];

		$nd_rst_result = '
		<div class=" nd_rst_section nd_rst_shortcode_opentable nd_rst_shortcode_opentable_'.$opentable_layout.'">
			<script type="text/javascript" src="//www.opentable.com/widget/reservation/loader?rid='.$opentable_restaurant_id.'&type=standard&theme='.$opentable_layout.'&iframe=true&overlay=false&domain=com&lang='.$nopentable_language.'"></script>
		</div>
		';

		$nd_rst_allowed_html = [
		    'div'      => [ 
			  'class' => [],
			  'id' => [],
			],
			'script'      => [ 
			  'type' => [],
			  'src' => [],
			],
		];

		echo wp_kses( $nd_rst_result, $nd_rst_allowed_html );
		//END

	}




}