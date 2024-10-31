<?php


//START
add_shortcode('nd_rst_search', 'nd_rst_vc_shortcode_search');
function nd_rst_vc_shortcode_search($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_rst_class' => '',
    'nd_rst_layout' => '',
    'nd_rst_submit_padding' => '',
    'nd_rst_submit_margin_top' => '',
    'nd_rst_submit_bg' => '',
    'nd_rst_text_color_1' => '',
    'nd_rst_text_color_2' => '',
    'nd_rst_action' => '',
    'nd_rst_arrow' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_rst_class = $atts['nd_rst_class'];
  $nd_rst_action = $atts['nd_rst_action'];
  $nd_rst_layout = $atts['nd_rst_layout'];
  $nd_rst_submit_padding = $atts['nd_rst_submit_padding'];
  $nd_rst_submit_margin_top = $atts['nd_rst_submit_margin_top'];
  $nd_rst_submit_bg = $atts['nd_rst_submit_bg'];
  $nd_rst_text_color = $atts['nd_rst_text_color_1'];
  $nd_rst_number_color = $atts['nd_rst_text_color_2'];
  $nd_rst_arrow = wp_get_attachment_image_src($atts['nd_rst_arrow'],'large');

  $nd_rst_max_guests = get_option('nd_rst_max_guests'); if ( $nd_rst_max_guests == '' ) { $nd_rst_max_guests = 10; }

  //date options
  $nd_rst_date_number_from_front = date('d');
  $nd_rst_date_month_from_front = date('M');
  $nd_rst_date_month_from_front = date_i18n('M');

  //default value
  if ($nd_rst_layout == '') { $nd_rst_layout = "layout-1"; }

  // script for calendar
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_style('jquery-ui-datepicker-'.$nd_rst_layout.'-css', esc_url(plugins_url('css/datepicker-', __FILE__ )).''.$nd_rst_layout.'.css' );

  //check with realpath
  $nd_rst_layout_selected = dirname( __FILE__ ).'/layout/'.$nd_rst_layout.'.php';
  
  //check layout for v 2.0
  $nd_rst_layout_count = strlen($nd_rst_layout);
  if ( str_contains( $nd_rst_layout, 'layout-') AND $nd_rst_layout_count == 8 ) { include realpath($nd_rst_layout_selected); }


  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_rst_search' );
function nd_rst_search() {


  //START get all layout
  $nd_rst_layouts = array();

  //php function to descover all name files in directory
  $nd_rst_directory = plugin_dir_path( __FILE__ ) .'layout/';
  $nd_rst_layouts = scandir($nd_rst_directory);


  //cicle for delete hidden file that not are php files
  $i = 0;
  foreach ($nd_rst_layouts as $value) {
    
    //remove all files that aren't php
    if ( strpos( $nd_rst_layouts[$i] , ".php" ) != true ){
      unset($nd_rst_layouts[$i]);
    }else{
      $nd_rst_layout_name = str_replace(".php","",$nd_rst_layouts[$i]);
      $nd_rst_layouts[$i] = $nd_rst_layout_name;
    } 
    $i++; 

  }
  //END get all layout


   vc_map( array(
      "name" => __( "Search", "nd-restaurant-reservations" ),
      "base" => "nd_rst_search",
      'description' => __( 'Add search', 'nd-restaurant-reservations' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('search.jpg', __FILE__ )),
      "class" => "",
      "category" => __( "ND Restaurant", "nd-restaurant-reservations"),
      "params" => array(
   

          array(
           'type' => 'dropdown',
            'heading' => __( 'Layout', 'nd-restaurant-reservations' ),
            'param_name' => 'nd_rst_layout',
            'value' => $nd_rst_layouts,
            'description' => __( "Choose the layout", "nd-restaurant-reservations" )
         ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Submit Bg Color", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_submit_bg",
            "description" => __( "Choose submit bg color", "nd-restaurant-reservations" )
         ),
           array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Text Color", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_text_color_1",
            "description" => __( "Choose color for your text", "nd-restaurant-reservations" ),
            'dependency' => array( 'element' => 'nd_rst_layout', 'value' => array( 'layout-1' ) )
         ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Number Color", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_text_color_2",
            "description" => __( "Choose color for the numbers", "nd-restaurant-reservations" ),
            'dependency' => array( 'element' => 'nd_rst_layout', 'value' => array( 'layout-1' ) )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Submit Padding", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_submit_padding",
            "description" => __( "Insert the submit padding in px ( eg : '20px' or '20px 15px' for top/bottom and left/right )", "nd-restaurant-reservations" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Submit Margin Top", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_submit_margin_top",
            "description" => __( "Insert the margin top in px ( eg : '15' ONLY NUMBER )", "nd-restaurant-reservations" )
         ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Arrow Down', 'nd-restaurant-reservations' ),
            'param_name' => 'nd_rst_arrow',
            'description' => __( 'Set the icon if you want to change the default one ( Up Arrow will be generated automatically ).', 'nd-restaurant-reservations' ),
            'dependency' => array( 'element' => 'nd_rst_layout', 'value' => array( 'layout-1' ) )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Action Page URL", "nd-restaurant-reservations" ),
            "param_name" => "nd_rst_action",
            "description" => __( "Action Page URL ( mandatory ), insert the page url where you have inserted the shortcode [nd_rst_reservation_form]", "nd-restaurant-reservations" )
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