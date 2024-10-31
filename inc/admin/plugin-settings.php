<?php


/////////////////////////////////////////////////// START MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////
add_action('admin_menu', 'nd_rst_create_menu');
function nd_rst_create_menu() {
  
  add_menu_page('Restaurant R.', __('ND Restaurant','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings', 'nd_rst_settings_page', 'dashicons-admin-generic' );
  add_action( 'admin_init', 'nd_rst_settings' );

}

function nd_rst_settings() {
  register_setting( 'nd_rst_settings_group', 'nd_rst_max_guests' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_booking_duration' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_slot_interval' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_occasions' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_timing_qnt' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_exceptions_qnt' );
  register_setting( 'nd_rst_settings_group', 'nd_rst_terms_page' );
}

function nd_rst_settings_page() {

?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_rst_settings_group' ); ?>
  <?php do_settings_sections( 'nd_rst_settings_group' ); ?>


  <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">


    <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(0)); ?>; border-bottom:3px solid <?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="nd_rst_section nd_rst_padding_20 nd_rst_box_sizing_border_box">
      <h2 class="nd_rst_color_ffffff nd_rst_display_inline_block"><?php _e('ND Restaurant','nd-restaurant-reservations'); ?></h2><span class="nd_rst_margin_left_10 nd_rst_color_a0a5aa"><?php echo esc_html(nd_rst_get_plugin_version()); ?></span>
    </div>

    

    <div class="nd_rst_section  nd_rst_box_shadow_0_1_1_000_04 nd_rst_background_color_ffffff nd_rst_border_1_solid_e5e5e5 nd_rst_border_top_width_0 nd_rst_border_left_width_0 nd_rst_overflow_hidden nd_rst_position_relative">

      <!--START menu-->
      <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(1)); ?>;" class="nd_rst_width_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_min_height_3000 nd_rst_position_absolute">

        <ul class="nd_rst_navigation">
          <li><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="" href="#"><?php _e('Plugin Settings','nd-restaurant-reservations'); ?></a></li>    
          <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-timing')); ?>"><?php _e('Timing','nd-restaurant-reservations'); ?></a></li>
          <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-exception')); ?>"><?php _e('Exceptions','nd-restaurant-reservations'); ?></a></li>
          <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-reservation-settings')); ?>"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></a></li>
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
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Plugin Settings','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Below some important plugin settings.','nd-restaurant-reservations'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

      

        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Max guests number','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Maximum number of guests','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_max_guests" value="<?php echo esc_attr( get_option('nd_rst_max_guests') ); ?>" />
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert the maximum number of guests ( Only number ). Eg: 10','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>






        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Booking Duration','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Avarage booking duration','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_booking_duration">
              <?php $nd_rst_booking_durations = array("60","120","180","240","300","360","420","480"); ?>
              <?php foreach ($nd_rst_booking_durations as $nd_rst_booking_duration) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_booking_duration') == $nd_rst_booking_duration ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_booking_duration); ?>">
                      <?php echo esc_html($nd_rst_booking_duration); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Set the avarage booking duration for each reservation ( number in mimutes )','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>











        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Slot Interval','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Slot booking interval','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_slot_interval">
              <?php $nd_rst_slot_intervals = array("30","60"); ?>
              <?php foreach ($nd_rst_slot_intervals as $nd_rst_slot_interval) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_slot_interval') == $nd_rst_slot_interval ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_slot_interval); ?>">
                      <?php echo esc_html($nd_rst_slot_interval); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Set the slot booking interval ( number in mimutes )','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>









        <!--START-->
        <div class="nd_rst_section nd_rst_plugin_settings_occasion_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Occasions','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert all occasions','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_occasions" value="<?php echo esc_attr( get_option('nd_rst_occasions') ); ?>" />
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert occasions divided by comma. Eg: anniversary,celebration,work','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_plugin_settings_occasion_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>







        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Max Timing','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert max timing','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_timing_qnt">
              <?php $nd_rst_timing_qnts = array("1","2","3","4","5","6","7","8","9","10"); ?>
              <?php foreach ($nd_rst_timing_qnts as $nd_rst_timing_qnt) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_timing_qnt') == $nd_rst_timing_qnt ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_timing_qnt); ?>">
                      <?php echo esc_html($nd_rst_timing_qnt); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Enter the maximum number of times that you can create in the timing tab','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>








        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Max Exceptions','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert max exceptions','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_exceptions_qnt">
              <?php $nd_rst_exception_qnts = array("1","2","3","4","5","6","7","8","9","10"); ?>
              <?php foreach ($nd_rst_exception_qnts as $nd_rst_exceptions_qnt) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_rst_exceptions_qnt') == $nd_rst_exceptions_qnt ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                  value="<?php echo esc_attr($nd_rst_exceptions_qnt); ?>">
                      <?php echo esc_html($nd_rst_exceptions_qnt); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Enter the maximum number of exceptions that you can create in the exceptions tab','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>










        <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Terms and conditions','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Select your terms and conditions page','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select class="nd_rst_width_100_percentage" name="nd_rst_terms_page">
              <?php $nd_rst_pages = get_pages(); ?>
              <?php foreach ($nd_rst_pages as $nd_rst_page) : ?>
                  <option

                  <?php 
                    if( get_option('nd_rst_terms_page') == $nd_rst_page->ID ) { 
                      echo esc_attr('selected="selected"');
                    } 
                  ?>

                   value="<?php echo esc_attr($nd_rst_page->ID); ?>">
                      <?php echo esc_html($nd_rst_page->post_title); ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Select the page where you have added your terms and conditions informations','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>




        <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

<?php } 
/////////////////////////////////////////////////// END MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////




// all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once realpath($file);
}
