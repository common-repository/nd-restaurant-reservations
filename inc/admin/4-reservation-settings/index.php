<?php

add_action('admin_menu','nd_rst_add_settings_menu_add_reservation_set');
function nd_rst_add_settings_menu_add_reservation_set(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Reservation Settings', __('Reservation Settings','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-reservation-settings', 'nd_rst_settings_menu_reservation_settings' );
  add_action( 'admin_init', 'nd_rst_reservation_settings_settings' );

}



function nd_rst_reservation_settings_settings() {

  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_general_description' );
  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_deposit_guests' );
  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_br_description' );
  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_default_order_status' );
  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_dev_mode' );
  register_setting( 'nd_booking_reservation_settings_settings_group', 'nd_rst_email_template' );

}




function nd_rst_settings_menu_reservation_settings() {

?>


  <form method="post" action="options.php">

  <?php settings_fields( 'nd_booking_reservation_settings_settings_group' ); ?>
  <?php do_settings_sections( 'nd_booking_reservation_settings_settings_group' ); ?>
  
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
            <li><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;"class="" href="#"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_stripe"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-stripe')); ?>"><?php _e('Stripe','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_paypal"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-paypal')); ?>"><?php _e('Paypal','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-settings-import-export')); ?>"><?php _e('Import Export','nd-restaurant-reservations'); ?></a></li>
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
            <div class="nd_rst_width_100_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set the reservation options','nd-restaurant-reservations'); ?></p>
            </div>
          </div>
          <!--END-->
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>



          <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Order Status','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Default Order Status','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_default_order_status">
              <?php $nd_rst_orders_status = array("confirmed","pending"); ?>
              <?php foreach ($nd_rst_orders_status as $nd_rst_order_status) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_default_order_status') == $nd_rst_order_status ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_order_status); ?>">
                      <?php echo esc_html($nd_rst_order_status); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Select the default order status for your reservations','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>






        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Developer Mode','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Enable developer mode','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <input <?php if( get_option('nd_rst_dev_mode') == 1 ) { echo esc_attr('checked="checked"'); } ?> name="nd_rst_dev_mode" type="checkbox" value="1">
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('In this mode all requests will not be saved in your database','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>



        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Email Template','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set email notifications','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_email_template">
              <?php $nd_rst_email_temps = array("layout-1"); ?>
              <?php foreach ($nd_rst_email_temps as $nd_rst_email_temp) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_email_template') == $nd_rst_email_temp ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_email_temp); ?>">
                      <?php echo esc_html($nd_rst_email_temp); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Select the template that you want to use for email notifications','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>





        <!--START-->
          <div class="nd_rst_section nd_rst_plugin_settings_deposit_section">
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Deposit','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Deposit per Guests','nd-restaurant-reservations'); ?></p>
            </div>
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              
              <input <?php if( get_option('nd_rst_deposit_guests') == 1 ) { echo esc_attr('checked="checked"'); } ?> name="nd_rst_deposit_guests" type="checkbox" value="1">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Multiply the deposit value by number of guests.','nd-restaurant-reservations'); ?></p>

            </div>
          </div>
          <!--END-->
          <div class="nd_rst_section nd_rst_plugin_settings_deposit_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          


          <!--option-->
          <div class="nd_rst_section nd_rst_plugin_settings_descr_confirm_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Description on Confirm Step','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert the description','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <textarea id="nd_rst_general_description" class=" nd_rst_width_100_percentage" name="nd_rst_general_description" rows="6"><?php echo esc_attr( get_option('nd_rst_general_description') ); ?></textarea>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Add the description that is shown in the confirm step below the title','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_plugin_settings_descr_confirm_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->



          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Booking Request','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert the description','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <textarea id="nd_rst_br_description" class=" nd_rst_width_100_percentage" name="nd_rst_br_description" rows="6"><?php echo esc_attr( get_option('nd_rst_br_description') ); ?></textarea>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert the description that is shown in the booking request toogle on the confirm step','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->




          <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box"><?php submit_button(); ?></div> 



        </div>
        <!--END content-->

             


      </div>
      <!--END content-->

    </div>

  </form>

  

<?php } 