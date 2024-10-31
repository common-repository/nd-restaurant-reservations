<?php


function nd_rst_get_opening_hour(){

  //get qnt timing
  $nd_rst_timing_qnt = get_option('nd_rst_timing_qnt');

  $nd_rst_get_opening_hour = '23:00';
  $nd_rst_get_opening_hour_time = strtotime($nd_rst_get_opening_hour);

  for ( $nd_rst_time_i = 1; $nd_rst_time_i <= $nd_rst_timing_qnt; $nd_rst_time_i++) {

    $nd_rst_stringg_option = 'nd_rst_timing_start_'.$nd_rst_time_i; 
    $nd_rst_stringg_option_time = strtotime(get_option($nd_rst_stringg_option));

    if ( $nd_rst_stringg_option_time < $nd_rst_get_opening_hour_time ) {

      $nd_rst_get_opening_hour = $nd_rst_stringg_option_time;
      $nd_rst_get_opening_hour_time = $nd_rst_stringg_option_time;

    }
    
  }

  return date("H:i", $nd_rst_get_opening_hour);

}




function nd_rst_get_closing_hour(){

  //get qnt timing
  $nd_rst_timing_qnt = get_option('nd_rst_timing_qnt');

  $nd_rst_get_opening_hour = '01:00';
  $nd_rst_get_opening_hour_time = strtotime($nd_rst_get_opening_hour);

  for ( $nd_rst_time_i = 1; $nd_rst_time_i <= $nd_rst_timing_qnt; $nd_rst_time_i++) {

    $nd_rst_stringg_option = 'nd_rst_timing_end_'.$nd_rst_time_i; 
    $nd_rst_stringg_option_time = strtotime(get_option($nd_rst_stringg_option));

    if ( $nd_rst_stringg_option_time > $nd_rst_get_opening_hour_time ) {

      $nd_rst_get_opening_hour = $nd_rst_stringg_option_time;
      $nd_rst_get_opening_hour_time = $nd_rst_stringg_option_time;

    }
    
  }

  return date("H:i", $nd_rst_get_opening_hour);

}




function nd_rst_get_qnt_guests_on_local($nd_rst_time_slot,$nd_rst_date,$nd_rst_restaurant){

  $nd_rst_time_slott = new DateTime($nd_rst_time_slot);
  $nd_rst_time_slot_normal_format = date_format($nd_rst_time_slott, 'H:i:s');

  $nd_rst_get_qnt_guests_on_local = 0;

  //START db query
  global $wpdb;
  $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

  $nd_rst_confirmed_term = 'confirmed';
  $nd_rst_reservations_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_date = %s AND nd_rst_restaurant = %d AND %s >= nd_rst_time_start AND %s <= nd_rst_time_end AND nd_rst_order_status = %s", array( $nd_rst_date, $nd_rst_restaurant, $nd_rst_time_slot_normal_format, $nd_rst_time_slot_normal_format, $nd_rst_confirmed_term ) );
  $nd_rst_reservations = $wpdb->get_results( $nd_rst_reservations_query );

  if ( empty($nd_rst_reservations) ) { 

    $nd_rst_get_qnt_guests_on_local = 0;

  }
  else{

    foreach ( $nd_rst_reservations as $nd_rst_reservation ) {

      //order datas
      $nd_rst_time_start = $nd_rst_reservation->nd_rst_time_start;
      $nd_rst_time_end = $nd_rst_reservation->nd_rst_time_end;
      $nd_rst_guests = $nd_rst_reservation->nd_rst_guests;
      
      $nd_rst_get_qnt_guests_on_local = $nd_rst_get_qnt_guests_on_local+$nd_rst_guests;

    }

  }


  return $nd_rst_get_qnt_guests_on_local;

}





function nd_rst_get_availability($nd_rst_date,$nd_rst_time_slot,$nd_rst_guests,$nd_rst_restaurant_id){

  $nd_rst_time_slott = new DateTime($nd_rst_time_slot);
  $nd_rst_time_slot = date_format($nd_rst_time_slott, 'H:i:s');

  //recover options
  $nd_rst_max_guests = get_option('nd_rst_max_guests'); if ( $nd_rst_max_guests == '' ) { $nd_rst_max_guests = 10; }
  $nd_rst_booking_duration = get_option('nd_rst_booking_duration'); if ( $nd_rst_booking_duration == '' ) { $nd_rst_booking_duration = 30; }
  $nd_rst_slot_interval = get_option('nd_rst_slot_interval'); if ( $nd_rst_slot_interval == '' ) { $nd_rst_slot_interval = 30; }
  
  //recover datas
  $nd_rst_dateee = new DateTime($nd_rst_date); //declare the string as time()
  $nd_rst_date_normal_format = date_format($nd_rst_dateee, 'Y-m-d');

  //deafult availability
  $nd_rst_get_availability = 0;


  //START db query
  global $wpdb;
  $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

  $nd_rst_confirmed_term = 'confirmed';
  $nd_rst_reservations_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_date = %s AND nd_rst_restaurant = %d AND nd_rst_order_status = %s", array( $nd_rst_date_normal_format, $nd_rst_restaurant_id, $nd_rst_confirmed_term ) );
  $nd_rst_reservations = $wpdb->get_results( $nd_rst_reservations_query );

  if ( empty($nd_rst_reservations) ) { 

  }
  else{

    
    //for each order check if
    foreach ( $nd_rst_reservations as $nd_rst_reservation ) {

      $nd_rst_time_start = $nd_rst_reservation->nd_rst_time_start;
      $nd_rst_time_end = $nd_rst_reservation->nd_rst_time_end;

      //calculate end time of slot
      $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
      $nd_rst_time_slot_end = date("H:i:s", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($nd_rst_time_slot))); //add minutes slot to start time

      //cicle for every slot ( check the integer result )
      $nd_rst_qnt_cicle = $nd_rst_booking_duration/$nd_rst_slot_interval;
      $nd_rst_time_slot_incr = $nd_rst_time_slot;

      for ($nd_rst_availability_i = 1; $nd_rst_availability_i <= $nd_rst_qnt_cicle; $nd_rst_availability_i++) {
           
        //analyze all slots 
        if ( $nd_rst_time_slot_incr >= $nd_rst_time_start && $nd_rst_time_slot_incr <= $nd_rst_time_end ){

          $nd_rst_get_availability = nd_rst_get_qnt_guests_on_local($nd_rst_time_slot_incr,$nd_rst_date_normal_format,$nd_rst_restaurant_id);

          if ( $nd_rst_get_availability+$nd_rst_guests > $nd_rst_max_guests ){
            return 1;
          }else{
            $nd_rst_get_availability = 0;  
          }
 
        }

        $nd_rst_time_slot_incr = date("H:i:s", strtotime('+'.$nd_rst_slot_interval.' minutes', strtotime($nd_rst_time_slot_incr)));
             
      }
      //end cicle for


    }
    //end for each


  }
  //END query


  return $nd_rst_get_availability;

}



function nd_rst_close_day($nd_rst_date_to_check){

  $nd_rst_close_day_result = 0;

  //recover datas from options
  $nd_rst_exceptions_qnt = get_option('nd_rst_exceptions_qnt');

  for ( $nd_rst_close_i = 0; $nd_rst_close_i <= $nd_rst_exceptions_qnt; $nd_rst_close_i++) {

    $nd_rst_stringg_option = 'nd_rst_exception_date_'.$nd_rst_close_i;  

    if ( $nd_rst_date_to_check == get_option($nd_rst_stringg_option) ) {
      
      $nd_rst_close_value = get_option('nd_rst_exception_close_'.$nd_rst_close_i);

      if ( $nd_rst_close_value == 1 ){
        $nd_rst_close_day_result = 1;
      }else{
        $nd_rst_close_day_result = 2;  
      }

    }

  }

  return $nd_rst_close_day_result;

}








function nd_rst_set_day($nd_rst_date_to_check){

  $nd_rst_n = date("N",strtotime($nd_rst_date_to_check));

  $nd_rst_set_day = 0;

  //recover datas from options
  $nd_rst_exceptions_qnt = get_option('nd_rst_timing_qnt');

  for ( $nd_rst_close_i = 0; $nd_rst_close_i <= $nd_rst_exceptions_qnt; $nd_rst_close_i++) {

    $nd_rst_stringg_option = 'nd_rst_timing_'.$nd_rst_n.'_'.$nd_rst_close_i;  

    if ( get_option($nd_rst_stringg_option) == 1 ) {
      
      return 1;

    }

  }

  return get_option($nd_rst_stringg_option);

}









function nd_rst_get_timing($nd_rst_datee,$nd_rst_guests,$nd_rst_restaurant_id){

  $nd_rst_dateee = new DateTime($nd_rst_datee); //declare the string as time()
  $nd_rst_number_week_day = date_format($nd_rst_dateee, 'N');
  $nd_rst_date_normal_format = date_format($nd_rst_dateee, 'Y-m-d');

  //set format time
  $nd_rst_format_time = 'G:i';

  //recover datas from options
  $nd_rst_timing_qnt = get_option('nd_rst_timing_qnt');
  $nd_rst_slot_interval = get_option('nd_rst_slot_interval');
  if ( $nd_rst_slot_interval == '' ){ $nd_rst_slot_interval = 60; }

  $nd_rst_get_slot_times = '';

  //cicle for get the hours of the day
  $nd_rst_get_day_hours = '';
  for ( $nd_rst_timing_i = 1; $nd_rst_timing_i <= $nd_rst_timing_qnt; $nd_rst_timing_i++) {

    $nd_rst_string_option = 'nd_rst_timing_'.$nd_rst_number_week_day.'_'.$nd_rst_timing_i;

    if ( get_option($nd_rst_string_option) == 1 ) {
      $nd_rst_timing_start = get_option('nd_rst_timing_start_'.$nd_rst_timing_i);
      $nd_rst_timing_end = get_option('nd_rst_timing_end_'.$nd_rst_timing_i);
      $nd_rst_get_day_hours = $nd_rst_timing_start.'-'.$nd_rst_timing_end;
    }

  } 
  //end cicle



  //recover datas from options
  $nd_rst_exceptions_qnt = get_option('nd_rst_exceptions_qnt');

  for ( $nd_rst_ext_i = 0; $nd_rst_ext_i <= $nd_rst_exceptions_qnt; $nd_rst_ext_i++) {

    $nd_rst_stringg_option = 'nd_rst_exception_date_'.$nd_rst_ext_i;  

    if ( $nd_rst_date_normal_format == get_option($nd_rst_stringg_option) ) {
      
      $nd_rst_close_value = get_option('nd_rst_exception_close_'.$nd_rst_ext_i);

      if ( $nd_rst_close_value == 0 ){

          //the date is an exception time
          $nd_rst_exception_start_option = get_option('nd_rst_exception_start_'.$nd_rst_ext_i);
          $nd_rst_exception_end_option = get_option('nd_rst_exception_end_'.$nd_rst_ext_i);
          $nd_rst_get_day_hours = $nd_rst_exception_start_option.'-'.$nd_rst_exception_end_option;

      }

    }

  }



  //explode for insert the two hours in array
  $nd_rst_hours = explode("-", $nd_rst_get_day_hours);
  
  //start hour
  $nd_rst_hour_start = $nd_rst_hours[0]; //recover hour from array
  $nd_rst_strtotime_hour_start = strtotime($nd_rst_hour_start); //convert to strtotime
  $nd_rst_time_hour_start = new DateTime($nd_rst_hour_start); //declare the string as time()
  $nd_rst_time_hour_start_format = date_format($nd_rst_time_hour_start, $nd_rst_format_time); //set the format
  
  //end hour
  $nd_rst_hour_end = $nd_rst_hours[1]; //recover hour from array
  $nd_rst_strtotime_hour_end = strtotime($nd_rst_hour_end); //convert to strtotime
  $nd_rst_time_hour_end = new DateTime($nd_rst_hour_end); //declare the string as time()
  $nd_rst_time_hour_end_format = date_format($nd_rst_time_hour_end, $nd_rst_format_time); //set the format


  //get qnt slots to create
  $nd_rst_slots_times_qnt = ($nd_rst_strtotime_hour_end-$nd_rst_strtotime_hour_start)/60/$nd_rst_slot_interval;
  $nd_rst_strtotime_hour_new_time = $nd_rst_time_hour_start_format;
  //start cicle




  //check if default date is closed
  if ( nd_rst_close_day($nd_rst_date_normal_format) == 1 OR $nd_rst_get_day_hours == '' ) {
      
    //close
    $nd_rst_get_slot_times .= '
    <div class="nd_rst_section nd_rst_all_time_slots_single">
      <p>'.__('Our structure is closed, please change the date to select an available time and proceed with the reservation.','nd-restaurant-reservations').'</p>
      <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_time" id="nd_rst_time" value="">
    </div>


    <script type="text/javascript">
     
      jQuery(document).ready(function() {

        jQuery( function ( $ ) {

             $("#nd_rst_btn_go_to_booking").addClass("nd_rst_display_none_important"); 
          
        });

      });

    </script>


    ';


  }else{
      
    //open
    $nd_rst_get_slot_times .= '
    <div class="nd_rst_section nd_rst_all_time_slots_single">';

      $nd_rst_ava_all = 0;
      for ($i = 0; $i <= $nd_rst_slots_times_qnt-1; $i++) {

        //first slot
        if ($i == 0) { 

          if ( nd_rst_get_availability($nd_rst_date_normal_format,$nd_rst_time_hour_start_format,$nd_rst_guests,$nd_rst_restaurant_id) == 0 ){
            $nd_rst_ava_all = 1;

            //convert only for visual
            $nd_rst_time_hour_start_format_new = new DateTime($nd_rst_time_hour_start_format);
            $nd_rst_time_hour_start_format_visual = date_format($nd_rst_time_hour_start_format_new, get_option('time_format'));

            $nd_rst_get_slot_times .= '<li class="nd_rst_display_inline_block"><p class="nd_rst_margin_0 nd_rst_padding_0 nd_rst_bg_color_ccc nd_rst_margin_right_10 nd_rst_time nd_rst_bg_color_blue" data-time="'.$nd_rst_time_hour_start_format.'">'.$nd_rst_time_hour_start_format_visual.'</p></li>';
          }

        }

        //increment
        $nd_rst_strtotime_hour_new_time = date($nd_rst_format_time, strtotime('+'.$nd_rst_slot_interval.' minutes', strtotime($nd_rst_strtotime_hour_new_time))); //add minutes slot to start time

        //convert only for visual
        $nd_rst_strtotime_hour_new_time_new = new DateTime($nd_rst_strtotime_hour_new_time);
        $nd_rst_strtotime_hour_new_time_visual = date_format($nd_rst_strtotime_hour_new_time_new, get_option('time_format'));

        //other slots
        if ( nd_rst_get_availability($nd_rst_date_normal_format,$nd_rst_strtotime_hour_new_time,$nd_rst_guests,$nd_rst_restaurant_id) == 0 ) {
          $nd_rst_ava_all = 1;
          $nd_rst_get_slot_times .= '<li class="nd_rst_display_inline_block"><p class="nd_rst_margin_0 nd_rst_padding_0 nd_rst_bg_color_ccc nd_rst_margin_right_10 nd_rst_time" data-time="'.$nd_rst_strtotime_hour_new_time.'">'.$nd_rst_strtotime_hour_new_time_visual.'</p></li>';
        }

      }


      //START if
      if ( $nd_rst_ava_all == 0 ){
        $nd_rst_get_slot_times .= '
        <p>'.__('Our structure is full, please change the date to select an available time and proceed with the reservation.','nd-restaurant-reservations').'</p>

        <div class="nd_rst_section nd_rst_height_20"></div>
        <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_time" id="nd_rst_time" value="">

      </div>'; 


      //START inline script
      $nd_rst_bat_shortcode_full_code = '

        jQuery(document).ready(function() {

          jQuery( function ( $ ) {

               $("#nd_rst_btn_go_to_booking").addClass("nd_rst_display_none_important"); 
            
          });

        });
        
      ';
      wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_bat_shortcode_full_code );
      //END inline script


      }else{

        $nd_rst_get_slot_times .= '
       <div class="nd_rst_section nd_rst_height_20"></div>
        <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_time" id="nd_rst_time" value="'.$nd_rst_time_hour_start_format.'">
        </div>';

        //START inline script
        $nd_rst_bat_shortcode_slots_code = '

          jQuery(document).ready(function() {

            jQuery( function ( $ ) {

                 $("#nd_rst_btn_go_to_booking").removeClass("nd_rst_display_none_important"); 

                 $(".nd_rst_all_time_slots_single li:first-child p").trigger( "click" );
              
            });

          });
          
        ';
        wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_bat_shortcode_slots_code );
        //END inline script


      }
      //END if
    

  }



  return $nd_rst_get_slot_times;

}






function nd_rst_get_next_prev_month_year($nd_rst_date,$nd_rst_month_year,$nd_rst_next_prev){

    //YYYY-mm-dd
    $nd_rst_year = substr($nd_rst_date,0,4);
    $nd_rst_month = substr($nd_rst_date,5,2);
    $nd_rst_day = substr($nd_rst_date,8,2);

    


    //START month calculate
    if ( $nd_rst_month_year == 'month' ){


      if ($nd_rst_next_prev == 'next') {

        //calculate next
        if ( $nd_rst_month == 12 ) { $nd_rst_ris = '01'; }
        else{ 
            $nd_rst_ris = $nd_rst_month + 1;
            if ( strlen($nd_rst_ris) == 1 ) {
                $nd_rst_ris = '0'.$nd_rst_ris;   
            }
        }

        return $nd_rst_ris;

      }else{

        //calculate prev
        if ( $nd_rst_month == 01 ) {
          $nd_rst_ris = 12;
        }else{
          $nd_rst_ris = $nd_rst_month - 1;
          if ( strlen($nd_rst_ris) == 1 ) {
            $nd_rst_ris = '0'.$nd_rst_ris;   
          }
        }

        return $nd_rst_ris;

      }


    }
    //END MONTH Calculate







    //START YEAR CALCULATE
    if ( $nd_rst_month_year == 'year' ){

      if ($nd_rst_next_prev == 'next') {
      
        //calculate next
        if ( $nd_rst_month == 12 ) { 
          $nd_rst_ris = $nd_rst_year + 1;
        }
        else{ 
          $nd_rst_ris = $nd_rst_year;    
        }

        return $nd_rst_ris;

      }else{

        //calculate prev
        if ( $nd_rst_month == 01 ) { 
          $nd_rst_ris = $nd_rst_year - 1;
        }
        else{ 
          $nd_rst_ris = $nd_rst_year;    
        }

        return $nd_rst_ris;

      } 

    }
    //END YEAR CALCULATE


}



function nd_rst_get_month_name($nd_rst_date){

    $nd_rst_get_month_name = date('Y-m-d', strtotime($nd_rst_date));    
    $nd_rst_get_month_name_new = new DateTime($nd_rst_get_month_name);
    $nd_rst_get_month = date_format($nd_rst_get_month_name_new,'F');
    
    return $nd_rst_get_month;

}





/* **************************************** START WORDPRESS INFORMATION **************************************** */

//function for get color profile admin
function nd_rst_get_profile_bg_color($nd_rst_color){
  
  global $_wp_admin_css_colors;
  $nd_rst_admin_color = get_user_option( 'admin_color' );
  
  $nd_rst_profile_bg_colors = $_wp_admin_css_colors[$nd_rst_admin_color]->colors; 


  if ( $nd_rst_profile_bg_colors[$nd_rst_color] == '#e5e5e5' ) {

    return '#6b6b6b';

  }else{

    return $nd_rst_profile_bg_colors[$nd_rst_color];
    
  }

  
}

/* **************************************** END WORDPRESS INFORMATION **************************************** */







/* **************************************** START DATABASE **************************************** */



//function for check if the order is already present
function nd_rst_check_if_order_is_present($nd_rst_tx){

  global $wpdb;

  $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

  
  //START query
  $nd_rst_order_ids_query = $wpdb->prepare( "SELECT id FROM $nd_rst_table_name WHERE nd_rst_tx = %s", $nd_rst_tx );
  $nd_rst_order_ids = $wpdb->get_results( $nd_rst_order_ids_query );

  
  //no results
  if ( empty($nd_rst_order_ids) ) { 

  return 0;

  }else{

  return 1;

  }

}


//function for add order in db
function nd_rst_add_booking_in_db(
  
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

) {




    //START add order if the plugin is not in dev mode
    if ( get_option('nd_rst_dev_mode') == 1 ){

      //dev mode active not insert in db

    }else{



      if ( nd_rst_check_if_order_is_present($nd_rst_tx) == 0 ) {


        global $wpdb;
        $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';


        //START INSERT DB
        $nd_rst_add_booking = $wpdb->insert( 

        $nd_rst_table_name, 

        array( 

          'nd_rst_restaurant' => $nd_rst_restaurant,
          'nd_rst_guests' => $nd_rst_guests,
          'nd_rst_date' => $nd_rst_date,
          'nd_rst_time_start' => $nd_rst_time_start,
          'nd_rst_time_end' => $nd_rst_time_end,
          'nd_rst_occasion' => $nd_rst_occasion,
          'nd_rst_booking_form_name' => $nd_rst_booking_form_name,
          'nd_rst_booking_form_surname' => $nd_rst_booking_form_surname,
          'nd_rst_booking_form_email' => $nd_rst_booking_form_email,
          'nd_rst_booking_form_phone' => $nd_rst_booking_form_phone,
          'nd_rst_booking_form_requests' => $nd_rst_booking_form_requests,
          'nd_rst_order_type' => $nd_rst_order_type,
          'nd_rst_order_status' => $nd_rst_order_status,
          'nd_rst_deposit' => $nd_rst_deposit,
          'nd_rst_tx' => $nd_rst_tx,
          'nd_rst_currency' => $nd_rst_currency
        )

        );

        if ($nd_rst_add_booking){

            //order added in db
            do_action('nd_rst_reservation_added_in_db',$nd_rst_restaurant,$nd_rst_guests,$nd_rst_date,$nd_rst_time_start,$nd_rst_time_end,$nd_rst_occasion,$nd_rst_booking_form_name,$nd_rst_booking_form_surname,$nd_rst_booking_form_email,$nd_rst_booking_form_phone,$nd_rst_booking_form_requests,$nd_rst_order_type,$nd_rst_order_status,$nd_rst_deposit,$nd_rst_tx,$nd_rst_currency);

        }else{

            $wpdb->show_errors();
            $wpdb->print_error();

        }
        //END INSERT DB

      }


    }
    //END add order if the plugin is not in dev mode


}
//end function
/* **************************************** END DATABASE **************************************** */




