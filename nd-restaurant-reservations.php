<?php
/*
Plugin Name:       Restaurant Reservations
Description:       The plugin is used to manage your restaurant reservations. To get started: 1) Click the "Activate" link to the left of this description. 2) Follow the documentation for installation for use the plugin in the better way.
Version:           2.0
Plugin URI:        https://nicdark.com
Author:            Nicdark
Author URI:        https://nicdark.com
License:           GPLv2 or later
*/



//translation
function nd_rst_load_textdomain()
{
  load_plugin_textdomain("nd-restaurant-reservations", false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'nd_rst_load_textdomain');



///////////////////////////////////////////////////DB///////////////////////////////////////////////////////////////
register_activation_hook( __FILE__, 'nd_rst_create_booking_db' );
function nd_rst_create_booking_db()
{
    global $wpdb;

    $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

    $nd_rst_sql = "CREATE TABLE $nd_rst_table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      nd_rst_restaurant int(11) NOT NULL,
      nd_rst_guests int(11) NOT NULL,
      nd_rst_date varchar(255) NOT NULL,
      nd_rst_time_start time NOT NULL,
      nd_rst_time_end time NOT NULL,
      nd_rst_occasion varchar(255) NOT NULL,
      nd_rst_booking_form_name varchar(255) NOT NULL,
      nd_rst_booking_form_surname varchar(255) NOT NULL,
      nd_rst_booking_form_email varchar(255) NOT NULL,
      nd_rst_booking_form_phone varchar(255) NOT NULL,
      nd_rst_booking_form_requests varchar(255) NOT NULL,
      nd_rst_order_type varchar(255) NOT NULL,
      nd_rst_order_status varchar(255) NOT NULL,
      nd_rst_deposit int(11) NOT NULL,
      nd_rst_tx varchar(255) NOT NULL,
      nd_rst_currency varchar(255) NOT NULL,
      UNIQUE KEY id (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $nd_rst_sql );
}



///////////////////////////////////////////////////CSS STYLE///////////////////////////////////////////////////////////////

//add custom css
function nd_rst_scripts() {
  
  //basic css plugin
  wp_enqueue_style( 'nd_rst_style', esc_url(plugins_url('assets/css/style.css', __FILE__ )) );

  wp_enqueue_script('jquery');
  
}
add_action( 'wp_enqueue_scripts', 'nd_rst_scripts' );


//START add admin custom css
function nd_rst_admin_style() {
  
  wp_enqueue_style( 'nd_rst_admin_style', esc_url(plugins_url('assets/css/admin-style.css', __FILE__ )), array(), false, false );
  
}
add_action( 'admin_enqueue_scripts', 'nd_rst_admin_style' );
//END add custom css


///////////////////////////////////////////////////GET TEMPLATE ///////////////////////////////////////////////////////////////

//update theme options
function nd_rst_theme_setup_update(){
    update_option( 'nicdark_theme_author', 0 );
}
add_action( 'after_switch_theme' , 'nd_rst_theme_setup_update');


///////////////////////////////////////////////////CPT///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/cpt/*.php" ) as $file ){
  include_once realpath($file);
}


///////////////////////////////////////////////////PLUGIN SETTINGS ///////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/admin/plugin-settings.php';


///////////////////////////////////////////////////SHORTCODES ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/shortcodes/*.php" ) as $file ){
  include_once realpath($file);
}


///////////////////////////////////////////////////ADDONS ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "addons/*/index.php" ) as $file ){
  include_once realpath($file);
}


///////////////////////////////////////////////////FUNCTIONS///////////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/functions/functions.php';


//function for get plugin version
function nd_rst_get_plugin_version(){

    $nd_rst_plugin_data = get_plugin_data( __FILE__ );
    $nd_rst_plugin_version = $nd_rst_plugin_data['Version'];

    return $nd_rst_plugin_version;

}



