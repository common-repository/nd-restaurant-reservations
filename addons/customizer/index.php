<?php



add_action('customize_register','nd_rst_customizer_nd_restaurant');
function nd_rst_customizer_nd_restaurant( $wp_customize ) {
  

	//ADD panel
	$wp_customize->add_panel( 'nd_rst_customizer_restaurants', array(
	  'title' => __( 'ND Restaurant' ),
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '',
	  'description' => __( 'Plugin Settings' ), // html tags such as <p>.
	  'priority' => 320, // Mixed with top-level-section hierarchy.
	) );


}



// all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once realpath($file);
}
