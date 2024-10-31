<?php

//START ELEMENT bookingform
class nd_rst_bookingform_element extends \Elementor\Widget_Base {

	public function get_name() { return 'bookingform'; }
	public function get_title() { return __( 'Booking Form', 'nd-restaurant-reservations' ); }
	public function get_icon() { return 'fa fa-calendar-alt'; }
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
	      'bookingform_layout',
	      [
	        'label' => __( 'Layout', 'nd-restaurant-reservations' ),
	        'type' => \Elementor\Controls_Manager::SELECT,
	        'default' => 'layout-1',
	        'options' => [
	          'layout-1' => __( 'Layout 1', 'nd-restaurant-reservations' ),
	        ],
	      ]
	    );

	    $this->add_control(
			'bookingform_action',
			[
				'label' => __( 'Action Url', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'nd-restaurant-reservations' ),
				'show_external' => false,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'bookingform_icon',
			[
				'label' => __( 'Icon', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();




		$this->start_controls_section(
			'style_section_text',
			[
				'label' => __( 'Text', 'nd-restaurant-reservations' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'bookingform_text_color',
			[
				'label' => __( 'Color', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component #nd_rst_date_number_from_front' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_guests_number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nd_rst_bookingform_component p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .nd_rst_bookingform_component h6' => 'color: {{VALUE}}',
				],
			]
		);



		$this->end_controls_section();



		$this->start_controls_section(
			'style_section_button',
			[
				'label' => __( 'Button', 'nd-restaurant-reservations' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'bookingform_button_typo',
				'label' => __( 'Typography', 'nd-restaurant-reservations' ),
				'selector' => '{{WRAPPER}} 
					.nd_rst_bookingform_component .nd_rst_padding_10_30_important',
			]
		);

		$this->add_control(
			'bookingform_button_bgcolor',
			[
				'label' => __( 'Background Color', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_padding_10_30_important' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bookingform_button_padding',
			[
				'label' => __( 'Padding', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 5,
					'right' => 10,
					'bottom' => 5,
					'left' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_padding_10_30_important' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'bookingform_button_margin_top',
			[
				'label' => __( 'Margin Top', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_padding_10_30_important' => 'margin-top: {{SIZE}}px;',
				],
			]
		);


		$this->add_control(
			'bookingform_button_border_width',
			[
				'label' => __( 'Border Width', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_padding_10_30_important' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; border-style:solid;',
				],
			]
		);


		$this->add_control(
			'bookingform_button_border_color',
			[
				'label' => __( 'Border Color', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component .nd_rst_padding_10_30_important' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'style_section_content',
			[
				'label' => __( 'Content', 'nd-restaurant-reservations' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bookingform_content_bgcolor',
			[
				'label' => __( 'Background Color', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bookingform_content_padding',
			[
				'label' => __( 'Padding', 'nd-restaurant-reservations' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 20,
					'right' => 20,
					'bottom' => 20,
					'left' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .nd_rst_bookingform_component' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}


 
	/*START RENDER*/
	protected function render() {

		$nd_rst_settings = $this->get_settings_for_display();
		
		//options 
		$bookingform_layout = $nd_rst_settings['bookingform_layout'];
		$bookingform_action = $nd_rst_settings['bookingform_action']['url'];
		$bookingform_icon = $nd_rst_settings['bookingform_icon']['url'];

		//default
		if ($bookingform_layout == '') { $bookingform_layout = "layout-1"; }
		if ( $bookingform_icon == '' ){
			$nd_rst_image = esc_url(plugins_url('layout/icon-down-grey.png', __FILE__ ));
		}else{
			$nd_rst_image = $bookingform_icon;	
		}

		//get variables
		$nd_rst_max_guests = get_option('nd_rst_max_guests',2);
		

		//date options
		$nd_rst_date_number_from_front = date('d');
		$nd_rst_date_month_from_front = date('M');
		$nd_rst_date_month_from_front = date_i18n('M');

		//script for calendar
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-datepicker-'.$bookingform_layout.'-css', esc_url(plugins_url('css/datepicker-', __FILE__ )).''.$bookingform_layout.'.css' );


		$nd_rst_result = '';

		//check with realpath
  		$nd_rst_layout_selected = dirname( __FILE__ ).'/layout/'.$bookingform_layout.'.php';
  		include realpath($nd_rst_layout_selected);

  		$nd_rst_allowed_html = [
		    'div'      => [ 
			  'class' => [],
			  'id' => [],
			],  
			'form'      => [ 
			  'action' => [],
			  'method' => [],
			],
			'p'      => [
			  'class' => [],
			],
			'h1'      => [
			  'id' => [],
			  'class' => [],
			  'style' => [],
			],
			'h4'      => [
			  'id' => [],
			  'class' => [],
			  'style' => [],
			],
			'h6'      => [
			  'id' => [],
			  'class' => [],
			  'style' => [],
			],
			'span'      => [
			  'id' => [],
			  'class' => [],
			],
			'img'      => [
			  'style' => [],
			  'class' => [],
			  'alt' => [],
			  'width' => [],
			  'src' => [],
			],
			'input'      => [
			  'type' => [],
			  'id' => [],
			  'class' => [],
			  'value' => [],
			  'name' => [],
			  'min' => [],
			  'style' => [],
			],
		];

		echo wp_kses( $nd_rst_result, $nd_rst_allowed_html );
		//END

	}




}