<?php


add_action('admin_menu','nd_rst_add_settings_menu_add_orders');
function nd_rst_add_settings_menu_add_orders(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Add Orders', __('Add New Order','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings-add-orders', 'nd_rst_settings_menu_add_orders' );

}


function nd_rst_settings_menu_add_orders() { ?>


  <?php if ( isset($_POST['nd_rst_add_order_page']) ) { ?>

    <?php

    //get datas
    $nd_rst_restaurant = sanitize_text_field($_POST['nd_rst_restaurant']);
    $nd_rst_guests = sanitize_text_field($_POST['nd_rst_guests']);
    $nd_rst_date = sanitize_text_field($_POST['nd_rst_date']);
    $nd_rst_time_start = sanitize_text_field($_POST['nd_rst_time_start']);
    $nd_rst_occasion = sanitize_text_field($_POST['nd_rst_occasion']);
    $nd_rst_booking_form_name = sanitize_text_field($_POST['nd_rst_booking_form_name']);
    $nd_rst_booking_form_surname = sanitize_text_field($_POST['nd_rst_booking_form_surname']);
    $nd_rst_booking_form_email = sanitize_email($_POST['nd_rst_booking_form_email']);
    $nd_rst_booking_form_phone = sanitize_text_field($_POST['nd_rst_booking_form_phone']);
    $nd_rst_booking_form_requests = sanitize_text_field($_POST['nd_rst_booking_form_requests']);
    $nd_rst_order_type = sanitize_text_field($_POST['nd_rst_order_type']);
    $nd_rst_order_status = sanitize_text_field($_POST['nd_rst_order_status']);
    $nd_rst_deposit = sanitize_text_field($_POST['nd_rst_deposit']);
    $nd_rst_tx = rand(100000000,999999999);
    $nd_rst_currency = sanitize_text_field($_POST['nd_rst_currency']);

    //calculate end time
    $nd_rst_booking_duration = get_option('nd_rst_booking_duration');
    $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
    $nd_rst_time_end = date("G:i:s", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($_POST['nd_rst_time_start'])));

    
    //insert order in db
    nd_rst_add_booking_in_db(
      $nd_rst_restaurant,
      $nd_rst_guests,
      $nd_rst_date,
      $nd_rst_time_start,
      $nd_rst_time_end,
      $nd_rst_occasion,
      $nd_rst_booking_form_name,
      $nd_rst_booking_form_surname,
      $nd_rst_booking_form_email,
      $nd_rst_booking_form_phone,
      $nd_rst_booking_form_requests,
      $nd_rst_order_type,
      $nd_rst_order_status,
      $nd_rst_deposit,
      $nd_rst_tx,
      $nd_rst_currency
    );

    ?>


    <style>
      .update-nag { display:none; } 
    </style>


    <div style="margin-top:20px;" id="setting-error-settings_updated" class="updated settings-error notice is-dismissible nd_rst_margin_left_0_important nd_rst_margin_bottom_20_important"> 
      <p>
        <strong><?php _e('Order Added','nd-restaurant-reservations'); ?></strong>
      </p>
      <button type="button" class="notice-dismiss">
        <span class="screen-reader-text"><?php _e('Dismiss this notice.','nd-restaurant-reservations'); ?></span>
      </button>
    </div>




  <?php }else{ ?>


    <?php

      //ajax results
      $nd_rst_add_order_val_params = array(
        'nd_rst_ajaxurl_add_order_val' => admin_url('admin-ajax.php'),
        'nd_rst_ajaxnonce_add_order_val' => wp_create_nonce('nd_rst_add_order_val_nonce'),
      );

      wp_enqueue_script( 'nd_rst_add_order_val', esc_url( plugins_url( 'js/nd_rst_add_order_validation.js', __FILE__ ) ), array( 'jquery' ) ); 
      wp_localize_script( 'nd_rst_add_order_val', 'nd_rst_my_vars_add_order_val', $nd_rst_add_order_val_params ); 

    ?>


    <style>
    .nd_rst_validation_errors{
      background-color: #cb4a21;
      float: left;
      color: #fff;
    }
    .nd_rst_validation_errors span{
      padding: 2px 5px;
      display: inline-block;
    }

    #nd_rst_add_order_check_availability_btn{
      background: #32373d;
      border-color: #24282e #24282e #24282e;
      box-shadow: 0 1px 0 #32373d;
      text-shadow: 0 -1px 1px #24282e, 1px 0 1px #24282e, 0 1px 1px #32373d, -1px 0 1px #24282e;  
    }

    </style>


    <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25 ">

      <form style="max-width: 800px;" class="nd_rst_float_left" method="POST">

        <div class="nd_rst_section">

          <input type="hidden" name="nd_rst_add_order_page" value="1">

          <!--1-->
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Main Informations','nd-restaurant-reservations') ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Reservation datas','nd-restaurant-reservations') ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            
            <select id="nd_rst_restaurant" class="nd_rst_width_100_percentage" name="nd_rst_restaurant" id="">
              <?php 

                $nd_rst_restaurants_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_rst_cpt_1' );
                $nd_rst_restaurants = get_posts($nd_rst_restaurants_args); 

                ?>
              <?php foreach ($nd_rst_restaurants as $nd_rst_restaurant) : ?>
                  <option value="<?php echo esc_attr($nd_rst_restaurant->ID); ?>">
                      <?php echo esc_html($nd_rst_restaurant->post_title); ?>
                  </option>
              <?php endforeach; ?>
            </select>

            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Restaurant','nd-restaurant-reservations') ?></strong></p>
            <div class="nd_rst_section nd_rst_height_20"></div>
            <div class="nd_rst_section nd_rst_height_10"></div>

            
            <div style="padding-right:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_date">
              <input id="nd_rst_date" class="nd_rst_width_100_percentage" type="text" name="nd_rst_date" value="">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Date ( YYYY-MM-DD )','nd-restaurant-reservations') ?> *</strong></p>
              <div class="nd_rst_validation_errors"></div>
            </div>
            <div style="padding-left:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_guests">
              <input id="nd_rst_guests" class="nd_rst_width_100_percentage" type="number" name="nd_rst_guests" value="">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Guests','nd-restaurant-reservations') ?> *</strong></p>
              <div class="nd_rst_validation_errors"></div>
            </div>

            <div class="nd_rst_section nd_rst_height_20"></div>
            <div class="nd_rst_section nd_rst_height_10"></div>

            <div class="nd_rst_float_left nd_rst_width_100_percentage nd_rst_box_sizing_border_box nd_rst_time_start">
              

              <select class="nd_rst_width_100_percentage" name="nd_rst_time_start">
                
                  <?php

                    $nd_rst_exception_sols = array('00:00:00','00:30:00','01:00:00','01:30:00','02:00:00','02:30:00','03:00:00','03:30:00','04:00:00','04:30:00','05:00:00','05:30:00','06:00:00','06:30:00','07:00:00','07:30:00','08:00:00','08:30:00','09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00','12:00:00','12:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00','16:00:00','16:30:00','17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00','20:00:00','20:30:00','21:00:00','21:30:00','22:00:00','22:30:00','23:00:00','23:30:00');

                    foreach ($nd_rst_exception_sols as $nd_rst_exceptions_sol) : ?>

                      <option value="<?php echo esc_attr($nd_rst_exceptions_sol); ?>"><?php echo esc_html($nd_rst_exceptions_sol); ?></option>

                    <?php endforeach; ?>
              
              </select>


              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Time','nd-restaurant-reservations') ?></strong></p>
            
            </div>


            
            


            


        </div>
        <!--END 1-->

        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

        
        <!--2-->
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Customer Datas','nd-restaurant-reservations') ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Main details','nd-restaurant-reservations') ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            

            <div style="padding-right:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_booking_form_name">
              <input id="nd_rst_booking_form_name" class="nd_rst_width_100_percentage" type="text" name="nd_rst_booking_form_name" value="">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Name','nd-restaurant-reservations') ?> *</strong></p>
              <div class="nd_rst_validation_errors"></div>
            </div>
            <div style="padding-left:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_booking_form_surname">
              <input id="nd_rst_booking_form_surname" class="nd_rst_width_100_percentage" type="text" name="nd_rst_booking_form_surname" value="">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Surname','nd-restaurant-reservations') ?> *</strong></p>
              <div class="nd_rst_validation_errors"></div>
            </div>

            <div class="nd_rst_section nd_rst_height_20"></div>
            <div class="nd_rst_section nd_rst_height_10"></div>

            <div style="padding-right:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_booking_form_email">
              <input id="nd_rst_booking_form_email" class="nd_rst_width_100_percentage" type="text" name="nd_rst_booking_form_email" value="">
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Email','nd-restaurant-reservations') ?> *</strong></p>
              <div class="nd_rst_validation_errors"></div>
            </div>
            <div style="padding-left:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box">
              <input class="nd_rst_width_100_percentage" type="number" name="nd_rst_booking_form_phone" value="">
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Phone','nd-restaurant-reservations') ?></strong></p>
            </div>

        </div>
        <!--END 2-->


        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>


        <!--3-->
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Order Details','nd-restaurant-reservations') ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Additional Informations','nd-restaurant-reservations') ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
              
              
              <select class="nd_rst_width_100_percentage" name="nd_rst_occasion" id="">

                <?php 
                  
                  $nd_rst_occasions = get_option('nd_rst_occasions');
                  
                  if ( $nd_rst_occasions == '' ) {
                    $nd_rst_occasion_value = 0;  
                  }else { 
                    $nd_rst_occasions_array = explode(',', $nd_rst_occasions ); 
                  }

                  for ( $nd_rst_occasions_array_i = 0; $nd_rst_occasions_array_i < count($nd_rst_occasions_array); $nd_rst_occasions_array_i++) { ?>

                    <option <?php if ( $nd_rst_occasions_array_i == $nd_rst_order->nd_rst_occasion ) { ?> 'selected="selected"' <?php } ?> value="<?php echo esc_attr($nd_rst_occasions_array_i); ?>"><?php echo esc_html($nd_rst_occasions_array[$nd_rst_occasions_array_i]); ?></option>

                  <?php } ?>

              </select>


              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Occasion','nd-restaurant-reservations') ?></strong></p>
              <div class="nd_rst_section nd_rst_height_20"></div>
              <div class="nd_rst_section nd_rst_height_10"></div>

              <textarea id="nd_rst_booking_form_requests" rows="5" class="nd_rst_width_100_percentage" name="nd_rst_booking_form_requests"></textarea>
              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Message','nd-restaurant-reservations') ?></strong></p>
              <div class="nd_rst_section nd_rst_height_20"></div>
              <div class="nd_rst_section nd_rst_height_10"></div>

         
        </div>
        <!--END 3-->

        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

        <!--4-->
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Reservation Details','nd-restaurant-reservations') ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Settings','nd-restaurant-reservations') ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
          
              <select class="nd_rst_width_100_percentage" name="nd_rst_order_type" id="">
                <option value="request"><?php _e('Request','nd-restaurant-reservations'); ?></option>
              </select>

              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Order Type','nd-restaurant-reservations') ?></strong></p>
              <div class="nd_rst_section nd_rst_height_20"></div>
              <div class="nd_rst_section nd_rst_height_10"></div>


              <select class="nd_rst_width_100_percentage" name="nd_rst_order_status" id="">
                <option value="pending"><?php _e('Pending','nd-restaurant-reservations'); ?></option>
                <option value="confirmed"><?php _e('Confirmed','nd-restaurant-reservations'); ?></option>
              </select>

              <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Order Status','nd-restaurant-reservations') ?></strong></p>
              <div class="nd_rst_section nd_rst_height_20"></div>
              <div class="nd_rst_section nd_rst_height_10"></div>

         
        </div>
        <!--END 4-->



        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

        <!--5-->
          <div class="nd_rst_width_40_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
            <h2 class="nd_rst_section nd_rst_margin_0"><?php _e('Deposit Details','nd-restaurant-reservations') ?></h2>
            <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><?php _e('Settings','nd-restaurant-reservations') ?></p>
          </div>
          <div class="nd_rst_width_60_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">
          
              <div style="padding-right:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_deposit">
                <input id="nd_rst_deposit" class="nd_rst_width_100_percentage" type="number" name="nd_rst_deposit" value="">
                <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Amount ( Only numbers )','nd-restaurant-reservations') ?></strong></p>
              </div>

              <div style="padding-left:10px;" class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_box_sizing_border_box nd_rst_currency">
                <input id="nd_rst_currency" class="nd_rst_width_100_percentage" type="text" name="nd_rst_currency" value="">
                <p class="nd_rst_color_666666 nd_rst_section nd_rst_margin_0 nd_rst_margin_top_10"><strong><?php _e('Currency','nd-restaurant-reservations') ?></strong></p>
              </div>

        </div>
        <!--END 5-->


        <div class="nd_rst_section nd_rst_height_1 nd_rst_background_color_E7E7E7 nd_rst_margin_top_10 nd_rst_margin_bottom_10"></div>

        <div class="nd_rst_width_100_percentage nd_rst_padding_20 nd_rst_box_sizing_border_box nd_rst_float_left">

          <a id="nd_rst_add_order_check_availability_btn" onclick="nd_rst_check_order_val()" class="button button-primary"><?php _e('CHECK ORDER','nd-restaurant-reservations'); ?></a>

          <input id="nd_rst_add_order_add_reservation_btn" class="button button-primary nd_rst_display_none_important" type="submit" name="" value="<?php _e('ADD RESERVATION','nd-restaurant-reservations') ?>">

        </div>

        </div>

      </form>

    </div>

  <?php } ?>


<?php } 




//START nd_rst_import_settings_php_function for AJAX
function nd_rst_add_order_validation_php_function() {

  check_ajax_referer( 'nd_rst_add_order_val_nonce', 'nd_rst_add_order_val_security' );

  //validate if email is valid
  function nd_rst_is_email($nd_rst_email){

    if (filter_var($nd_rst_email, FILTER_VALIDATE_EMAIL)) {
      return 1;  
    } else {
      return 0;
    }


  }


  //declare
  $nd_rst_string_result = '';

  //recover datas
  $nd_rst_date = sanitize_text_field($_GET['nd_rst_date']);
  $nd_rst_guests = sanitize_text_field($_GET['nd_rst_guests']);
  $nd_rst_booking_form_name = sanitize_text_field($_GET['nd_rst_booking_form_name']);
  $nd_rst_booking_form_surname = sanitize_text_field($_GET['nd_rst_booking_form_surname']);
  $nd_rst_booking_form_email = sanitize_email($_GET['nd_rst_booking_form_email']);
  
  
  //date
  if ( $nd_rst_date == '' ){ 
    
    $nd_rst_result_date = 0; 
    $nd_rst_string_result .= '<span>'.__('Date is mandatory','nd-restaurant-reservations').'</span>[divider]'; 
  
  }else{

    $nd_rst_result_date = 1; 
    $nd_rst_string_result .= ' [divider]'; 

  }


  //guests
  if ( $nd_rst_guests == '' ){ 
    
    $nd_rst_result_guests = 0; 
    $nd_rst_string_result .= '<span>'.__('Guests is mandatory','nd-restaurant-reservations').'</span>[divider]'; 
  
  }else{

    $nd_rst_result_guests = 1; 
    $nd_rst_string_result .= ' [divider]'; 

  }


  //name
  if ( $nd_rst_booking_form_name == '' ){ 
    
    $nd_rst_result_name = 0; 
    $nd_rst_string_result .= '<span>'.__('Name is mandatory','nd-restaurant-reservations').'</span>[divider]'; 
  
  }else{

    $nd_rst_result_name = 1; 
    $nd_rst_string_result .= ' [divider]'; 

  }

  //surname
  if ( $nd_rst_booking_form_surname == '' ){ 
    
    $nd_rst_result_surname = 0; 
    $nd_rst_string_result .= '<span>'.__('Surname is mandatory','nd-restaurant-reservations').'</span>[divider]'; 
  
  }else{

    $nd_rst_result_surname = 1; 
    $nd_rst_string_result .= ' [divider]'; 

  }


  //email
  if ( $nd_rst_booking_form_email == '' ) {

    $nd_rst_result_email = 0; 

    $nd_rst_string_result .= '<span>'.__('Email is mandatory','nd-restaurant-reservations').'</span>[divider]';    

  }elseif ( nd_rst_is_email($nd_rst_booking_form_email) == 0 ) {

    $nd_rst_result_email = 0; 

    $nd_rst_string_result .= '<span>'.__('Email not valid','nd-restaurant-reservations').'</span>[divider]';  

  }else{

    $nd_rst_result_email = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }





  //Determiante the final result
  if ( $nd_rst_result_date == 1 AND $nd_rst_result_guests == 1 AND $nd_rst_result_name == 1 AND $nd_rst_result_surname == 1 AND $nd_rst_result_email == 1 )
  { echo esc_attr(1); }else{

    $nd_rst_allowed_html = [
        'span'      => [
          'class' => [],
        ],
    ];

    echo wp_kses( $nd_rst_string_result, $nd_rst_allowed_html );
 
  }


  die();


}
add_action( 'wp_ajax_nd_rst_add_order_validation_php_function', 'nd_rst_add_order_validation_php_function' );
//END