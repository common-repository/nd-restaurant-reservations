<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

final class Nd_Restaurant_Reservations_Elementor_Extension {

  const VERSION = '1.0.0';
  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
  const MINIMUM_PHP_VERSION = '7.0';
  private static $_instance = null;

  public static function instance() {

    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;

  }

  public function __construct() {
    add_action( 'init', [ $this, 'i18n' ] );
    add_action( 'plugins_loaded', [ $this, 'init' ] );
  }

  public function i18n() { load_plugin_textdomain( 'nd-restaurant-reservations' );  }

  public function init() {

    // Check if Elementor installed and activated
    if ( ! did_action( 'elementor/loaded' ) ) {
      add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
      return;
    }

    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
      return;
    }

    // Check for required PHP version
    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
      return;
    }

    // Add Plugin actions
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

  }

  public function admin_notice_missing_main_plugin() {

    if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'nd-restaurant-reservations' ),
      '<strong>' . esc_html__( 'Elementor ND Restaurant Reservations Extension', 'nd-restaurant-reservations' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'nd-restaurant-reservations' ) . '</strong>'
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

  }

  public function admin_notice_minimum_elementor_version() {

    if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nd-restaurant-reservations' ),
      '<strong>' . esc_html__( 'Elementor ND Restaurant Reservations Extension', 'nd-restaurant-reservations' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'nd-restaurant-reservations' ) . '</strong>',
       self::MINIMUM_ELEMENTOR_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

  }

  public function admin_notice_minimum_php_version() {

    if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nd-restaurant-reservations' ),
      '<strong>' . esc_html__( 'Elementor ND Restaurant Reservations Extension', 'nd-restaurant-reservations' ) . '</strong>',
      '<strong>' . esc_html__( 'PHP', 'nd-restaurant-reservations' ) . '</strong>',
       self::MINIMUM_PHP_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

  }

  /*GET ALL WIDGETS*/
  public function init_widgets() {
    
    //bookingform
    require_once( __DIR__ . '/widgets/bookingform/index.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \nd_rst_bookingform_element() );


    //opentable
    require_once( __DIR__ . '/widgets/opentable/index.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \nd_rst_opentable_element() );

  }



}

Nd_Restaurant_Reservations_Elementor_Extension::instance();



function nd_rst_add_elementor_widget_categories( $elements_manager ) {

  $elements_manager->add_category(
    'nd-restaurant-reservations',
    [
      'title' => __( 'ND Restaurant Reservations', 'nd-restaurant-reservations' ),
      'icon' => 'fa fa-plug',
    ]
  );

}
add_action( 'elementor/elements/categories_registered', 'nd_rst_add_elementor_widget_categories' );



