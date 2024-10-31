<?php


add_action('admin_menu','nd_rst_add_settings_menu_import_export');
function nd_rst_add_settings_menu_import_export(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Import Export', __('Import Export','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings-import-export', 'nd_rst_settings_menu_import_export' );

}



function nd_rst_settings_menu_import_export() {

  $nd_rst_import_settings_params = array(
      'nd_rst_ajaxurl_import_settings' => admin_url('admin-ajax.php'),
      'nd_rst_ajaxnonce_import_settings' => wp_create_nonce('nd_rst_import_settings_nonce'),
  );

  wp_enqueue_script( 'nd_rst_import_sett', esc_url( plugins_url( 'js/nd_rst_import_settings.js', __FILE__ ) ), array( 'jquery' ) ); 
  wp_localize_script( 'nd_rst_import_sett', 'nd_rst_my_vars_import_settings', $nd_rst_import_settings_params ); 

?>

  
  <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">

    

    <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(0)); ?>; border-bottom:3px solid <?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="nd_rst_section nd_rst_padding_20 nd_rst_box_sizing_border_box">
      <h2 class="nd_rst_color_ffffff nd_rst_display_inline_block"><?php _e('ND Restaurant','nd-restaurant-reservations'); ?></h2><span class="nd_rst_margin_left_10 nd_rst_color_a0a5aa"><?php echo esc_html(nd_rst_get_plugin_version()); ?></span>
    </div>

    

    <div class="nd_rst_section  nd_rst_box_shadow_0_1_1_000_04 nd_rst_background_color_ffffff nd_rst_border_1_solid_e5e5e5 nd_rst_border_top_width_0 nd_rst_border_left_width_0 nd_rst_overflow_hidden nd_rst_position_relative">
    
      <!--START menu-->
        <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(1)); ?>;" class="nd_rst_width_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_min_height_3000 nd_rst_position_absolute">

          <ul class="nd_rst_navigation">
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-settings')); ?>"><?php _e('Plugin Settings','nd-restaurant-reservations'); ?></a></li>    
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-timing')); ?>"><?php _e('Timing','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-exception')); ?>"><?php _e('Exceptions','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-reservation-settings')); ?>"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_stripe"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-stripe')); ?>"><?php _e('Stripe','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_paypal"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-paypal')); ?>"><?php _e('Paypal','nd-restaurant-reservations'); ?></a></li>
            <li><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;"class="" href="#"><?php _e('Import Export','nd-restaurant-reservations'); ?></a></li>
            <li><a target="_blank" class="" href="http://documentations.nicdark.com/restaurant/"><?php _e('Documentation','nd-restaurant-reservations'); ?></a></li>
          
            <?php 

            if ( get_option('nicdark_theme_author') != 1 ){ ?>

              <li><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-settings-premium-addons')); ?>" ><?php _e('Premium Addons','nd-restaurant-reservations'); ?></a></li>

            <?php }
            
            ?>

          </ul>
        </div>
        <!--END menu-->


      <!--START content-->
      <div class="nd_rst_width_80_percentage nd_rst_margin_left_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">


        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Import/Export','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Export or Import your theme options.','nd-restaurant-reservations'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>


        <?php


          $nd_rst_all_options = wp_load_alloptions();
          $nd_rst_my_options  = array();

          $nd_rst_name_write = '';
           
          foreach ( $nd_rst_all_options as $nd_rst_name => $nd_rst_value ) {
              if ( stristr( $nd_rst_name, 'nd_rst_' ) ) {
                
                if ( stristr( $nd_rst_name, 'nd_rst_exception_' ) OR stristr( $nd_rst_name, 'nd_rst_timing_' ) ) {

                }else{

                  $nd_rst_my_options[ $nd_rst_name ] = $nd_rst_value;
                  $nd_rst_name_write .= $nd_rst_name.'[nd_rst_option_value]'.$nd_rst_value.'[nd_rst_end_option]';

                }

              }
          }

          $nd_rst_name_write_new_1 = str_replace(" ", "%20", $nd_rst_name_write);
          $nd_rst_name_write_new = str_replace("#", "[SHARP]", $nd_rst_name_write_new_1);
           
        ?>


        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Export Settings','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Export plugin and customizer options.','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
              
                <a class="button button-primary" href="data:application/octet-stream;charset=utf-8,<?php echo esc_attr($nd_rst_name_write_new); ?>" download="nd-restaurant-reservations-export.txt"><?php _e('Export','nd-restaurant-reservations'); ?></a>
              
            </div>

          </div>
        </div>
        <!--END-->

        
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

        

        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Import Settings','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Paste in the textarea the text of your export file','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
              
                <textarea id="nd_rst_import_settings" class="nd_rst_margin_bottom_20 nd_rst_width_100_percentage" name="nd_rst_import_settings" rows="10"><?php echo esc_attr( get_option('nd_rst_textarea') ); ?></textarea>
                
                <a onclick="nd_rst_import_settings()" class="button button-primary"><?php _e('Import','nd-restaurant-reservations'); ?></a>

                <div class="nd_rst_margin_top_20 nd_rst_section" id="nd_rst_import_settings_result_container"></div>
                
            </div>

          </div>
        </div>
        <!--END-->


      </div>
      <!--END content-->


    </div>

  </div>

<?php } 
/*END 1*/







//START nd_rst_import_settings_php_function for AJAX
function nd_rst_import_settings_php_function() {

  check_ajax_referer( 'nd_rst_import_settings_nonce', 'nd_rst_import_settings_security' );

  //recover datas
  $nd_rst_value_import_settings = sanitize_text_field($_GET['nd_rst_value_import_settings']);

  $nd_rst_import_settings_result .= '';



  //START import and update options only if is superadmin
  if ( current_user_can('manage_options') ) {


    if ( $nd_rst_value_import_settings != '' ) {

      $nd_rst_array_options = explode("[nd_rst_end_option]", $nd_rst_value_import_settings);

      foreach ($nd_rst_array_options as $nd_rst_array_option) {
          
        $nd_rst_array_single_option = explode("[nd_rst_option_value]", $nd_rst_array_option);
        $nd_rst_option = $nd_rst_array_single_option[0];
        $nd_rst_new_value = $nd_rst_array_single_option[1];
        $nd_rst_new_value = str_replace("[SHARP]","#",$nd_rst_new_value);

        if ( $nd_rst_new_value != '' ){


          //START update option only it contains the plugin suffix
          if ( strpos($nd_rst_option, 'nd_rst_') !== false ) {

            $nd_rst_update_result = update_option($nd_rst_option,$nd_rst_new_value);  

            if ( $nd_rst_update_result == 1 ) {
              $nd_rst_import_settings_result .= '

                <div class="notice updated is-dismissible nd_rst_margin_0_important">
                  <p>'.__('Updated option','nd-restaurant-reservations').' "'.$nd_rst_option.'" '.__('with','nd-restaurant-reservations').' '.$nd_rst_new_value.'.</p>
                </div>

                ';

            }else{
              $nd_rst_import_settings_result .= '

                <div class="notice updated is-dismissible nd_rst_margin_0_important">
                  <p>'.__('Updated option','nd-restaurant-reservations').' "'.$nd_rst_option.'" '.__('with the same value','nd-restaurant-reservations').'.</p>
                </div>

              ';    
            }


          }else{

            $nd_rst_import_settings_result .= '
              <div class="notice notice-error is-dismissible nd_rst_margin_0">
                <p>'.__('You do not have permission to change this option','nd-restaurant-reservations').'</p>
              </div>
            ';

          }
          //END update option only it contains the plugin suffix


        }else{

          if ( $nd_rst_option != '' ){
            $nd_rst_import_settings_result .= '

          <div class="notice notice-warning is-dismissible nd_rst_margin_0">
            <p>'.__('No value founded for','nd-restaurant-reservations').' "'.$nd_rst_option.'" '.__('option.','nd-restaurant-reservations').'</p>
          </div>
          ';
          }

          
        }
        
      }

    }else{

      $nd_rst_import_settings_result .= '
        <div class="notice notice-error is-dismissible nd_rst_margin_0">
          <p>'.__('Empty textarea, please paste your export options.','nd-restaurant-reservations').'</p>
        </div>
      ';

    }



  }else{

    $nd_rst_import_settings_result .= '
      <div class="notice notice-error is-dismissible nd_rst_margin_0">
        <p>'.__('You do not have the privileges to do this.','nd-restaurant-reservations').'</p>
      </div>
    ';

  }
  //START import and update options only if is superadmin


  $nd_rst_allowed_html = [
    'div'      => [
      'id' => [],
      'class' => [],
      'style' => [],
    ], 
    'p'      => [
      'id' => [],
      'class' => [],
      'style' => [],
    ],      
  ];

  echo wp_kses( $nd_rst_import_settings_result, $nd_rst_allowed_html );
  
  die();


}
add_action( 'wp_ajax_nd_rst_import_settings_php_function', 'nd_rst_import_settings_php_function' );
//END