<?php

add_action('admin_menu','nd_rst_add_settings_menu_stripe');
function nd_rst_add_settings_menu_stripe(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Stripe', __('Stripe','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-stripe', 'nd_rst_settings_menu_stripe' );
  add_action( 'admin_init', 'nd_rst_reservation_settings_stripe' );

}



function nd_rst_reservation_settings_stripe() {

  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_enable' );
  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_deposit' );
  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_currency' );
  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_description' );
  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_public_key' );
  register_setting( 'nd_booking_reservation_settings_stripe_group', 'nd_rst_stripe_secret_key' );

}




function nd_rst_settings_menu_stripe() {

?>


  <form method="post" action="options.php">

  <?php settings_fields( 'nd_booking_reservation_settings_stripe_group' ); ?>
  <?php do_settings_sections( 'nd_booking_reservation_settings_stripe_group' ); ?>
  
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
            <li class="nd_rst_admin_menu_stripe"><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;"class="" href="#"><?php _e('Stripe','nd-restaurant-reservations'); ?></a></li>
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
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Stripe Settings','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Below you can find all stripe settings','nd-restaurant-reservations'); ?></p>
            </div>
          </div>
          <!--END-->
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>



          <!--START-->
        <div class="nd_rst_section">
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Stripe Enable','nd-restaurant-reservations'); ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Enable or disable Stripe','nd-restaurant-reservations'); ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <input <?php if( get_option('nd_rst_stripe_enable') == 1 ) { echo esc_attr('checked="checked"'); } ?> name="nd_rst_stripe_enable" type="checkbox" value="1">
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Check for enable stripe booking method','nd-restaurant-reservations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>



          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Deposit Value','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set deposit','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_stripe_deposit" value="<?php echo esc_attr( get_option('nd_rst_stripe_deposit') ); ?>" />
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Set your deposit value for stripe ( ONLY NUMBER )','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->



          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Currency','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set the currency','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
                

                <select class="nd_rst_width_100_percentage" name="nd_rst_stripe_currency">
                <?php $nd_rst_stripe_currencies = array(
                  
                  "USD","AED","AFN","ALL","AMD","ANG","AOA","ARS","AUD","AWG","AZN","BAM","BBD","BDT","BGN","BIF","BMD","BND","BOB","BRL","BSD","BWP","BZD","CAD","CDF","CHF","CLP","CNY","COP","CRC","CVE","CZK","DJF","DKK","DOP","DZD","EGP","ETB","EUR","FJD","FKP","GBP","GEL","GIP","GMD","GNF","GTQ","GYD","HKD","HNL","HRK","HTG","HUF","IDR","ILS","INR","ISK","JMD","JPY","KES","KGS","KHR","KMF","KRW","KYD","KZT","LAK","LBP","LKR","LRD","LSL","MAD","MDL","MGA","MKD","MMK","MNT","MOP","MRO","MUR","MVR","MWK","MXN","MYR","MZN","NAD","NGN","NIO","NOK","NPR","NZD","PAB","PEN","PGK","PHP","PKR","PLN","PYG","QAR","RON","RSD","RUB","RWF","SAR","SBD","SCR","SEK","SGD","SHP","SLL","SOS","SRD","STD","SZL","THB","TJS","TOP","TRY","TTD","TWD","TZS","UAH","UGX","UYU","UZS","VND","VUV","WST","XAF","XCD","XOF","XPF","YER","ZAR","ZMW"

                  ); ?>
                <?php foreach ($nd_rst_stripe_currencies as $nd_rst_stripe_currency) : ?>
                    <option 

                    <?php 
                      if( get_option('nd_rst_stripe_currency') == $nd_rst_stripe_currency ) { 
                        echo esc_attr('selected="selected"');
                      } 
                    ?>

                    value="<?php echo esc_attr($nd_rst_stripe_currency); ?>">
                        <?php echo esc_html($nd_rst_stripe_currency); ?>
                    </option>
                <?php endforeach; ?>
              </select>



              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Set the currency that you want to use for Stripe payment','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->



          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Public Key','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set the key','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_stripe_public_key" value="<?php echo esc_attr( get_option('nd_rst_stripe_public_key') ); ?>" />
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert here your Stripe public key','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->


          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Secret Key','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Set the key','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <input class="nd_rst_width_100_percentage" type="text" name="nd_rst_stripe_secret_key" value="<?php echo esc_attr( get_option('nd_rst_stripe_secret_key') ); ?>" />
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert here your Stripe secret key','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->



          <!--option-->
          <div class="nd_rst_section">
            
            <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Stripe Description','nd-restaurant-reservations'); ?></h2>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Insert the description','nd-restaurant-reservations'); ?></p>
            </div>
            
            <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              <textarea id="nd_rst_stripe_description" class=" nd_rst_width_100_percentage" name="nd_rst_stripe_description" rows="6"><?php echo esc_attr( get_option('nd_rst_stripe_description') ); ?></textarea>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_20"><?php _e('Insert the description that is shown in the Stripe toogle on the confirm step','nd-restaurant-reservations'); ?></p>
            </div>

          </div>
          <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>
          <!--option-->



          <div class="nd_rst_section nd_rst_padding_left_20 nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
            <?php submit_button(); ?>
          </div> 


        </div>
        <!--END content-->

             


      </div>
      <!--END content-->

    </div>

  </form>

  

<?php } 