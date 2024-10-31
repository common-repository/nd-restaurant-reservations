<?php


if ( get_option('nicdark_theme_author') != 1 ){



  add_action('admin_menu','nd_rst_add_settings_menu_premium_addons');
  function nd_rst_add_settings_menu_premium_addons(){

    add_submenu_page( 'nd-restaurant-reservations-settings','Premium Addons', __('Premium Addons','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings-premium-addons', 'nd_rst_settings_menu_premium_addons' );

  }



  function nd_rst_settings_menu_premium_addons() {

  ?>

    
    <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">

      

      <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(0)); ?>; border-bottom:3px solid <?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="nd_rst_section nd_rst_padding_20  nd_rst_box_sizing_border_box">
        <h2 class="nd_rst_color_ffffff nd_rst_display_inline_block"><?php _e('ND Restaurant','nd-restaurant-reservations'); ?></h2><span class="nd_rst_margin_left_10 nd_rst_color_a0a5aa"><?php echo esc_html(nd_rst_get_plugin_version()); ?></span>
      </div>

      

      <div class="nd_rst_section nd_rst_min_height_400  nd_rst_box_shadow_0_1_1_000_04 nd_rst_background_color_ffffff nd_rst_border_1_solid_e5e5e5 nd_rst_border_top_width_0 nd_rst_border_left_width_0 nd_rst_overflow_hidden nd_rst_position_relative">
      
        

        <!--START menu-->
        <div style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(1)); ?>;" class="nd_rst_width_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_min_height_3000 nd_rst_position_absolute">

          <ul class="nd_rst_navigation">
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-settings')); ?>"><?php _e('Plugin Settings','nd-restaurant-reservations'); ?></a></li>   
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-timing')); ?>"><?php _e('Timing','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-add-exception')); ?>"><?php _e('Exceptions','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-reservation-settings')); ?>"><?php _e('Reservation Settings','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_stripe"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-stripe')); ?>"><?php _e('Stripe','nd-restaurant-reservations'); ?></a></li>
            <li class="nd_rst_admin_menu_paypal"><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-paypal')); ?>"><?php _e('Paypal','nd-restaurant-reservations'); ?></a></li>
            <li><a class="" href="<?php echo esc_url(admin_url('admin.php?page=nd-restaurant-reservations-settings-import-export')); ?>"><?php _e('Import Export','nd-restaurant-reservations'); ?></a></li>
            <li><a target="_blank" class="" href="http://documentations.nicdark.com/restaurant/"><?php _e('Documentation','nd-restaurant-reservations'); ?></a></li>
          
            <?php 

            if ( get_option('nicdark_theme_author') != 1 ){ ?>

              <li><a style="background-color:<?php echo esc_attr(nd_rst_get_profile_bg_color(2)); ?>;" class="" href="" ><?php _e('Premium Addons','nd-restaurant-reservations'); ?></a></li>

            <?php }
            
            ?>

          </ul>
        </div>
        <!--END menu-->


        <!--START content-->
        <div class="nd_rst_width_80_percentage nd_rst_margin_left_20_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">


          <!--START-->
          <div class="nd_rst_section">
            
              


               <div class="nd_rst_section nd_rst_padding_20 nd_rst_box_sizing_border_box">
                <div class="nd_rst_section nd_rst_padding_30 nd_rst_box_sizing_border_box nd_rst_border_1_solid_e5e5e5 nd_rst_position_relative">
                  <h2 class="nd_rst_font_size_21 nd_rst_line_height_21 nd_rst_margin_0"><?php _e('Get All Addons','nd-restaurant-reservations'); ?></h2>
                  <p class="nd_rst_margin_top_10 nd_rst_color_666666 nd_rst_font_size_16 nd_rst_line_height_16 nd_rst_margin_0"><?php _e('Get all addons and an amazing Restaurant WP theme all in one pack.','nd-restaurant-reservations'); ?></p>
                  <a target="_blank" class="button button-primary button-hero nd_rst_top_30 nd_rst_right_30 nd_rst_position_absolute" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('CHECK IT NOW !','nd-restaurant-reservations'); ?></a>
                </div>
              </div>





              <table id="nd_rst_table_premium_addons" class="nd_rst_width_60_percentage nd_rst_margin_auto nd_rst_border_collapse_collapse">
                
                <thead class="nd_rst_text_align_center">
                  <tr>
                    <td>
                    </td>
                    <td>
                      <h2><?php _e('FREE','nd-restaurant-reservations'); ?></h2>
                    </td>
                    <td>
                      <h2><?php _e('PREMIUM','nd-restaurant-reservations'); ?></h2>
                    </td>
                  </tr>
                </thead>

                <tbody>
                  

                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Book a Table','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('[nd_rst_reservation_form] book a table shortcode built in ajax','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>

                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Email Template','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Email notification on each table reservation','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>

                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Exceptions','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Create timing exceptions for special dates and hours','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>

                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Cool Design','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Amazing design and color managment for your site','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Menu Components','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('A lot of solutions to show your special dishes and menu','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Paypal & Stripe','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Different payment methods for manage your deposit on table reservations','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Branches','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Possibility to reserve your table on different branches','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Occasions','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Possibility to set the table reservation occasion','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Calendar View','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Possibility to filter all reservations on a specific day','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Add New Reservation','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Add reservation through your dashboard easily','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Steps','nd-restaurant-reservations'); ?></h2>
                      <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Show the reservation steps above the book a table shortcode','nd-restaurant-reservations'); ?>. <a target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-restaurant-reservations"><?php _e('View Demo','nd-restaurant-reservations'); ?></a></p>
                    </td>
                    
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_rst_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>






                </tbody>

              </table>




          </div>
          <!--END-->


          


        </div>
        <!--END content-->


      </div>

    </div>

  <?php } 
  /*END 1*/




  function nd_rst_admin_style_2() {
  
    wp_enqueue_style( 'nd_rst_admin_style_2', esc_url(plugins_url('admin-style-2.css', __FILE__ )), array(), false, false );
    
  }
  add_action( 'admin_enqueue_scripts', 'nd_rst_admin_style_2' );



}



