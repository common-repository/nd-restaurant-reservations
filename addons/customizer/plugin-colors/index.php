<?php


add_action('customize_register','nd_rst_customizer_plugin_colors');
function nd_rst_customizer_plugin_colors( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_rst_customizer_plugin_colors' , array(
	  'title' => 'Plugin Colors',
	  'priority'    => 10,
	  'panel' => 'nd_rst_customizer_restaurants',
	) );


	//color dark 1
	$wp_customize->add_setting( 'nd_rst_customizer_color_dark_1', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_rst_customizer_color_dark_1', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Dark 1' ),
	      'description' => __('Select color for your dark elements','nd-booking'),
	      'section' => 'nd_rst_customizer_plugin_colors',
	    )
	  )
	);



	//color 1
	$wp_customize->add_setting( 'nd_rst_customizer_color_1', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_rst_customizer_color_1', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Color 1' ),
	      'description' => __('Select color for your color 1 elements','nd-booking'),
	      'section' => 'nd_rst_customizer_plugin_colors',
	    )
	  )
	);



	//color 2
	$wp_customize->add_setting( 'nd_rst_customizer_color_2', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_rst_customizer_color_2', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Color 2' ),
	      'description' => __('Select color for your color 2 elements','nd-booking'),
	      'section' => 'nd_rst_customizer_plugin_colors',
	    )
	  )
	);



}





//css inline
function nd_rst_customizer_add_colors() { 
?>

	<?php

	//get colors
	$nd_rst_customizer_color_dark_1 = get_option( 'nd_rst_customizer_color_dark_1', '#2d2d2d' );
	$nd_rst_customizer_color_1 = get_option( 'nd_rst_customizer_color_1', '#c0a58a' );
	$nd_rst_customizer_color_2 = get_option( 'nd_rst_customizer_color_2', '#b66565' );

	?>

    <style type="text/css">

    	/*color_dark_1*/
		.nd_rst_bg_dark_1 { background-color: <?php echo esc_html($nd_rst_customizer_color_dark_1);  ?>; }

		/*color_1*/
		.nd_rst_bg_color_1 { background-color: <?php echo esc_html($nd_rst_customizer_color_1);  ?>; }

		/*color_2*/
		.nd_rst_bg_color_2 { background-color: <?php echo esc_html($nd_rst_customizer_color_2);  ?>; }
       
    </style>
    

<?php
}
add_action('wp_head', 'nd_rst_customizer_add_colors');
