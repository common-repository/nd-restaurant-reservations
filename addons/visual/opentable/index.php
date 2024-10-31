<?php


//START
add_shortcode('nd_rst_opentable', 'nd_rst_vc_shortcode_opentable');
function nd_rst_vc_shortcode_opentable($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_rst_class' => '',
    'nd_rst_layout' => '',
    'nd_rst_align' => '',
    'nd_rst_restaurant_id' => '',
    'nd_rst_language' => ''
  ), $atts);

  $str = '';

  //get variables
  $nd_rst_class = sanitize_text_field( $atts['nd_rst_class'] );
  $nd_rst_layout = sanitize_text_field( $atts['nd_rst_layout'] );
  $nd_rst_align = sanitize_text_field( $atts['nd_rst_align'] );
  $nd_rst_restaurant_id = sanitize_text_field( $atts['nd_rst_restaurant_id'] );
  $nd_rst_language = sanitize_text_field( $atts['nd_rst_language'] );

  //default value
  if ($nd_rst_layout == '') { $nd_rst_layout = "standard"; }

  // the layout selected
  $str .= '
  <div class=" nd_rst_section nd_rst_shortcode_opentable nd_rst_shortcode_opentable_'.esc_html($nd_rst_layout).' '.esc_html($nd_rst_class).' '.esc_html($nd_rst_align).' ">
    <script type="text/javascript" src="//www.opentable.com/widget/reservation/loader?rid='.esc_html($nd_rst_restaurant_id).'&type=standard&theme='.esc_html($nd_rst_layout).'&iframe=true&overlay=false&domain=com&lang='.esc_html($nd_rst_language).'"></script>
  </div>
  ';

  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_rst_opentable' );
function nd_rst_opentable() {


   vc_map( array(
      "name" => __( "Open Table", "nd-restaurant-reservations" ),
      "base" => "nd_rst_opentable",
      'description' => __( 'Add Opentable', 'nd-restaurant-reservations' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('search.jpg', __FILE__ )),
      "class" => "",
      "category" => __( "ND Restaurant", "nd-restaurant-reservations"),
      "params" => array(
   

           array(
         'type' => 'dropdown',
          "heading" => __( "Layout", "nd-restaurant-reservations" ),
          'param_name' => 'nd_rst_layout',
          'value' => array( __("Standard", "nd-restaurant-reservations") =>'standard',__("Tall", "nd-restaurant-reservations") =>'tall',__("Wide", "nd-restaurant-reservations") =>'wide'),
          'description' => __( "Choose the layout", "nd-restaurant-reservations" )
         ),
            array(
         'type' => 'dropdown',
          "heading" => __( "Align", "nd-restaurant-reservations" ),
          'param_name' => 'nd_rst_align',
          'value' => array( __("Left", "nd-restaurant-reservations") =>'nd_rst_text_align_left',__("Center", "nd-restaurant-reservations") =>'nd_rst_text_align_center',__("Right", "nd-restaurant-reservations") =>'nd_rst_text_align_right'),
          'description' => __( "Choose the alignment", "nd-restaurant-reservations" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Restaurant ID", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_restaurant_id",
            "description" => __( "Insert here your Open Table Restaurant ID", "nd-restaurant-reservations" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Language", "nd-restaurant-reservations" ),
          'param_name' => 'nd_rst_language',
          'value' => array( __("English-US", "nd-restaurant-reservations") =>'en-US',__("Fr-CA", "nd-restaurant-reservations") =>'fr-CA',__("Deutsch-DE", "nd-restaurant-reservations") =>'de-DE',__("Espanol-MX", "nd-restaurant-reservations") =>'es-MX',__("ja-JP", "nd-restaurant-reservations") =>'ja-JP',__("Nederlands-NL", "nd-restaurant-reservations") =>'nl-NL',__("Italiano-IT", "nd-restaurant-reservations") =>'it-IT'),
          'description' => __( "Set your iframe language", "nd-restaurant-reservations" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_class",
            "description" => __( "Insert custom class", "nd-restaurant-reservations" )
         )

        
      )
   ) );
}
//end shortcode