<?php    

$nd_rst_result = '';
$nd_rst_order_id = sanitize_text_field($_POST['edit_order_id']);

global $wpdb;
$nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';


//START UPDATE RECORD
if ( isset($_POST['nd_rst_order_id']) ){

  $nd_rst_order_id = sanitize_text_field($_POST['nd_rst_order_id']);

  //calculate end time
  $nd_rst_booking_duration = get_option('nd_rst_booking_duration');
  $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
  $nd_rst_time_end = date("G:i:s", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($_POST['nd_rst_time_start'])));


  $nd_rst_edit_record = $wpdb->update( 
        
    $nd_rst_table_name, 
    
    array( 
      'id' => sanitize_text_field($_POST['nd_rst_order_id']),
      'nd_rst_restaurant' => sanitize_text_field($_POST['nd_rst_restaurant']),
      'nd_rst_guests' => sanitize_text_field($_POST['nd_rst_guests']),
      'nd_rst_date' => sanitize_text_field($_POST['nd_rst_date']),
      'nd_rst_time_start' => sanitize_text_field($_POST['nd_rst_time_start']),
      'nd_rst_time_end' => $nd_rst_time_end,
      'nd_rst_occasion' => sanitize_text_field($_POST['nd_rst_occasion']),
      'nd_rst_booking_form_name' => sanitize_text_field($_POST['nd_rst_booking_form_name']),
      'nd_rst_booking_form_surname' => sanitize_text_field($_POST['nd_rst_booking_form_surname']),
      'nd_rst_booking_form_email' => sanitize_email($_POST['nd_rst_booking_form_email']),
      'nd_rst_booking_form_phone' => sanitize_text_field($_POST['nd_rst_booking_form_phone']),
      'nd_rst_booking_form_requests' => sanitize_text_field($_POST['nd_rst_booking_form_requests']),
      'nd_rst_order_type' => sanitize_text_field($_POST['nd_rst_order_type']),
      'nd_rst_order_status' => sanitize_text_field($_POST['nd_rst_order_status']),
      'nd_rst_deposit' => sanitize_text_field($_POST['nd_rst_deposit']),
      'nd_rst_tx' => sanitize_text_field($_POST['nd_rst_tx']),
      'nd_rst_currency' => sanitize_text_field($_POST['nd_rst_currency'])
    ),
    array( 'ID' => sanitize_text_field($_POST['nd_rst_order_id']) )

  );


  if ($nd_rst_edit_record){

    $nd_rst_result .= '

      <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible nd_rst_margin_left_0_important nd_rst_margin_bottom_20_important"> 
        <p>
          <strong>'.__('Settings saved.','nd-restaurant-reservations').'</strong>
        </p>
        <button type="button" class="notice-dismiss">
          <span class="screen-reader-text">'.__('Dismiss this notice.','nd-restaurant-reservations').'</span>
        </button>
      </div>

    ';

  }else{

    #$wpdb->show_errors();
    #$wpdb->print_error();

  }



}
//END UPDATE RECORD


//START select order
$nd_rst_orders_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE id = %d", $nd_rst_order_id );
$nd_rst_orders = $wpdb->get_results( $nd_rst_orders_query );


if ( empty($nd_rst_orders) ) { 

  $nd_rst_result .= '
  <div class="nd_rst_position_relative  nd_rst_width_100_percentage nd_rst_box_sizing_border_box nd_rst_display_inline_block">           
    <p class=" nd_rst_margin_0 nd_rst_padding_0">'.__('There was some db problem','nd-restaurant-reservations').'</p>
  </div>';              


}else{


  foreach ( $nd_rst_orders as $nd_rst_order ) 
  {
     
    //get avatar
    $nd_rst_account_avatar_url_args = array( 'size'   => 100 );
    $nd_rst_account_avatar_url = get_avatar_url($nd_rst_order->nd_rst_booking_form_email, $nd_rst_account_avatar_url_args);


    //decide status color
    if ( $nd_rst_order->nd_rst_order_status == 'pending' ){
      $nd_rst_color_bg_status = '#e68843';
    }else{
      $nd_rst_color_bg_status = '#54ce59'; 
    }

    $nd_rst_result .= '


    <style>
    .update-nag { display:none; }

    .nd_rst_custom_tables table td p {
        margin-bottom: 10px !important;
        margin-top: 10px !important;
        padding-bottom: 0px;
        padding-top: 0px;
    }

    </style>


  
    <form method="POST">

      <div class="nd_rst_section">


        <div style="width:80%;" class="nd_rst_float_left  nd_rst_padding_right_20 nd_rst_box_sizing_border_box">
          
          <div style="border: 1px solid #e5e5e5; box-shadow: 0 1px 1px rgba(0,0,0,.04);" class="nd_rst_section nd_rst_background_color_ffffff nd_rst_padding_10 nd_rst_box_sizing_border_box">

            <div style="padding-bottom:0px;" class="nd_rst_section nd_rst_box_sizing_border_box nd_rst_padding_20">
              


              <div style="display:table;" class="nd_rst_section">
                
                <div style="width:80px; display:table-cell; vertical-align:middle;">
                  <img class="nd_rst_float_left" width="60" src="'.$nd_rst_account_avatar_url.'">
                </div>

                <div style="display:table-cell; vertical-align:middle;" class="nd_rst_box_sizing_border_box">
                  
                  <div class="nd_rst_section nd_rst_height_5"></div>
                  <div class="nd_rst_section">
                    <h1 class="nd_rst_margin_0 nd_rst_display_inline_block nd_rst_float_left">'.__('Order','nd-restaurant-reservations').' #'.$nd_rst_order->id.' '.__('details','nd-restaurant-reservations').' </h1>
                    <span style="background-color:'.$nd_rst_color_bg_status.'; margin-left:15px; margin-top:-5px;" class="nd_rst_padding_5 nd_rst_display_block nd_rst_float_left nd_rst_color_ffffff nd_rst_font_size_12 nd_rst_text_transform_uppercase">'.$nd_rst_order->nd_rst_order_status.'</span>
                  </div>
                  
                  <div class="nd_rst_section nd_rst_height_10"></div>
                  <p class="nd_rst_margin_0">'.get_the_title($nd_rst_order->nd_rst_restaurant).' #'.$nd_rst_order->nd_rst_restaurant.' '.__('for','nd-restaurant-reservations').' <u>'.$nd_rst_order->nd_rst_guests.' '.__('Guests','nd-restaurant-reservations').'</u></p>

                </div>

              </div>


              


            </div>

            <div style="width:33.33%;" class="nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">
              

                <h3>'.__('General Details','nd-restaurant-reservations').'</h3>

                <input readonly name="nd_rst_order_id" class="nd_rst_display_none nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->id.'"> 


                <label class="nd_rst_section">'.__('Restaurant','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <select class="nd_rst_width_100_percentage" name="nd_rst_restaurant" id="">';
                

                  $nd_rst_rooms_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_rst_cpt_1' );
                  $nd_rst_rooms = get_posts($nd_rst_rooms_args); 

                  foreach ($nd_rst_rooms as $nd_rst_room) { 
                      $nd_rst_result .= '<option '; if ( $nd_rst_order->nd_rst_restaurant == $nd_rst_room->ID ){ $nd_rst_result .= 'selected="selected"'; } $nd_rst_result .= ' value="'.$nd_rst_room->ID.'">'.$nd_rst_room->post_title.'</option>';
                  }

                $nd_rst_result .= '  
                </select>
                <div class="nd_rst_section nd_rst_height_20"></div>


                <label class="nd_rst_section">'.__('Date ( YYYY-MM-DD )','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <input name="nd_rst_date" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_date.'"> 

                <div class="nd_rst_section nd_rst_height_20"></div>

                <label class="nd_rst_section">'.__('Time Start/End','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>

                <div class="nd_rst_width_50_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_right_10">

                  <select class="nd_rst_width_100_percentage" name="nd_rst_time_start">';
                
                  $nd_rst_exception_sols = array('00:00:00','00:30:00','01:00:00','01:30:00','02:00:00','02:30:00','03:00:00','03:30:00','04:00:00','04:30:00','05:00:00','05:30:00','06:00:00','06:30:00','07:00:00','07:30:00','08:00:00','08:30:00','09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00','12:00:00','12:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00','16:00:00','16:30:00','17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00','20:00:00','20:30:00','21:00:00','21:30:00','22:00:00','22:30:00','23:00:00','23:30:00');

                  foreach ($nd_rst_exception_sols as $nd_rst_exceptions_sol) :

                    $nd_rst_result .= '<option '; if ( $nd_rst_exceptions_sol == $nd_rst_order->nd_rst_time_start ) { $nd_rst_result .= 'selected="selected"'; } $nd_rst_result .= ' value="'.$nd_rst_exceptions_sol.'">'.$nd_rst_exceptions_sol.'</option>';

                  endforeach;

                  $nd_rst_result .= ' 
                  </select>
                </div>
                <div class="nd_rst_width_50_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_left_10">
                  <input readonly name="nd_rst_time_end" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_time_end.'"> 
                </div>

                <div class="nd_rst_section nd_rst_height_20"></div>

                <label class="nd_rst_section">'.__('Guests and Occasion','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>

                <div class="nd_rst_width_50_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_right_10">
                  <input name="nd_rst_guests" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_guests.'">
                </div>
                <div class="nd_rst_width_50_percentage nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_left_10">

                  <select class="nd_rst_width_100_percentage" name="nd_rst_occasion" id="">';

                    $nd_rst_occasions = get_option('nd_rst_occasions');
                    if ( $nd_rst_occasions == '' ) {
                        $nd_rst_occasion_value = 0;  
                    }else { 
                        $nd_rst_occasions_array = explode(',', $nd_rst_occasions ); 
                    }

                    for ( $nd_rst_occasions_array_i = 0; $nd_rst_occasions_array_i < count($nd_rst_occasions_array); $nd_rst_occasions_array_i++) { 

                      $nd_rst_result .= '<option '; if ( $nd_rst_occasions_array_i == $nd_rst_order->nd_rst_occasion ) { $nd_rst_result .= 'selected="selected"'; }  $nd_rst_result .= ' value="'.$nd_rst_occasions_array_i.'">'.$nd_rst_occasions_array[$nd_rst_occasions_array_i].'</option>';

                    }

                  $nd_rst_result .= '  
                  </select>

                </div>



            </div>

            <div style="width:33.33%;" class="nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">


                <h3>'.__('Customer Details','nd-restaurant-reservations').'</h3>

                <label class="nd_rst_section">'.__('Name','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <div class="nd_rst_width_100_percentage nd_rst_float_left nd_rst_box_sizing_border_box">
                  <input name="nd_rst_booking_form_name" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_booking_form_name.'">
                </div>

                <div class="nd_rst_section nd_rst_height_20"></div>

                <label class="nd_rst_section">'.__('Surname','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <div class="nd_rst_width_100_percentage nd_rst_float_left nd_rst_box_sizing_border_box">
                  <input name="nd_rst_booking_form_surname" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_booking_form_surname.'"> 
                </div>
                
                <div class="nd_rst_section nd_rst_height_20"></div>

                <label class="nd_rst_section">'.__('Email','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <input name="nd_rst_booking_form_email" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_booking_form_email.'"> 

                <div class="nd_rst_section nd_rst_height_20"></div>

                <label class="nd_rst_section">'.__('Phone','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <input name="nd_rst_booking_form_phone" class="nd_rst_section nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_booking_form_phone.'"> 

            </div>

            <div style="width:33.33%;" class="nd_rst_float_left nd_rst_box_sizing_border_box nd_rst_padding_20">

                <label style="margin-top:50px;" class="nd_rst_section">'.__('Message','nd-restaurant-reservations').'</label>
                <div class="nd_rst_section nd_rst_height_5"></div>
                <textarea rows="12" name="nd_rst_booking_form_requests" class="nd_rst_section nd_rst_display_block regular-text">'.$nd_rst_order->nd_rst_booking_form_requests.'</textarea>

            </div>
            
          
          </div>';






        $nd_rst_result .= '
        </div>

        <div style="width:20%; border: 1px solid #e5e5e5; box-shadow: 0 1px 1px rgba(0,0,0,.04);" class="nd_rst_float_left nd_rst_background_color_ffffff nd_rst_box_sizing_border_box">
          
        
          <h4 class="nd_rst_margin_0 nd_rst_padding_10_20 nd_rst_border_bottom_1_solid_eee">'.__('Order Options','nd-restaurant-reservations').'</h4>

          <div class="nd_rst_section nd_rst_box_sizing_border_box nd_rst_padding_20">

            <label class="nd_rst_section">'.__('Order Type','nd-restaurant-reservations').'</label>
            <div class="nd_rst_section nd_rst_height_5"></div>
            <input readonly name="nd_rst_order_type" class="nd_rst_section  nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_order_type.'">

            <div class="nd_rst_section nd_rst_height_20"></div>

            <label class="nd_rst_section">'.__('Order Status','nd-restaurant-reservations').'</label>
            <div class="nd_rst_section nd_rst_height_5"></div>
            <select name="nd_rst_order_status" class="nd_rst_section nd_rst_display_block">
              <option '; if ( $nd_rst_order->nd_rst_order_status == 'pending' ){ $nd_rst_result .= 'selected="selected"'; }  $nd_rst_result .= 'value="pending">'.__('Pending','nd-restaurant-reservations').'</option>
              <option '; if ( $nd_rst_order->nd_rst_order_status == 'confirmed' ){ $nd_rst_result .= 'selected="selected"'; }  $nd_rst_result .= 'value="confirmed">'.__('Confirmed','nd-restaurant-reservations').'</option>
            </select>

            <div class="nd_rst_section nd_rst_height_20"></div>

            <label class="nd_rst_section">'.__('Order Tx','nd-restaurant-reservations').'</label>
            <div class="nd_rst_section nd_rst_height_5"></div>
            <input readonly name="nd_rst_tx" class="nd_rst_section  nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_tx.'">

            <div class="nd_rst_section nd_rst_height_20"></div>

            <label class="nd_rst_section">'.__('Deposit already Paid','nd-restaurant-reservations').' ( '.$nd_rst_order->nd_rst_currency.' )</label>
            <div class="nd_rst_section nd_rst_height_5"></div>
            <input readonly name="nd_rst_deposit" class="nd_rst_section  nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_deposit.'">
            <input readonly name="nd_rst_currency" class="nd_rst_section nd_rst_display_none nd_rst_display_block regular-text" type="text" value="'.$nd_rst_order->nd_rst_currency.'">

          </div>


          <div class="nd_rst_background_color_f5f5f5 nd_rst_section nd_rst_box_sizing_border_box nd_rst_padding_20 nd_rst_border_top_1_solid_eee">
            <input class="button button-primary" type="submit" value="'.__('Update Record','nd-restaurant-reservations').'"> 
          </div>


        </div>


      </div>


      

    </form>
    ';

  }


} 