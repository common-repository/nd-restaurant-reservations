<?php


//START CALENDAR
//dates variables
$nd_rst_tot_days_this_month = cal_days_in_month(CAL_GREGORIAN, $nd_rst_month_today, $nd_rst_year_today);

//calculate next and prev date
$nd_rst_next_month = nd_rst_get_next_prev_month_year($nd_rst_date_default,'month','next');
$nd_rst_next_year = nd_rst_get_next_prev_month_year($nd_rst_date_default,'year','next');
$nd_rst_prev_month = nd_rst_get_next_prev_month_year($nd_rst_date_default,'month','prev');
$nd_rst_prev_year = nd_rst_get_next_prev_month_year($nd_rst_date_default,'year','prev');

//variables
$nd_rst_date_cell_width = 100/$nd_rst_tot_days_this_month;
$nd_rst_get_month_name_date = $nd_rst_year_today.'-'.$nd_rst_month_today.'-1';
$nd_rst_calendar = '';


//prev button
$nd_rst_real_month_today = date('m');
$nd_rst_real_year_today = date('Y');
$nd_rst_real_day_today = date('d');
if ( $nd_rst_month_today == $nd_rst_real_month_today AND $nd_rst_year_today == $nd_rst_real_year_today ) { 
    $nd_rst_button_prev = '
    <div class="nd_rst_section nd_rst_height_1"></div>';
}else{
    $nd_rst_button_prev = '
    <input type="hidden" name="nd_rst_prev_month" id="nd_rst_prev_month" value="'.$nd_rst_prev_month.'">
    <input type="hidden" name="nd_rst_prev_year" id="nd_rst_prev_year" value="'.$nd_rst_prev_year.'">
    <button onclick="nd_rst_calendar(1)" class="nd_rst_prev_next_cal nd_rst_float_left" type="button">'.__('Prev','nd-restaurant-reservations').'</button>';
}



//START inline script
$nd_rst_bat_cal_date_code = '
    
    jQuery(document).ready(function() {

        jQuery( function ( $ ) {

          $(".nd_rst_calendar_date").click(function() {

            $(".nd_rst_calendar_date").removeClass("nd_rst_cal_active");
            var nd_rst_calendar_date_select = $(this).attr("data-date");
            $(this).addClass("nd_rst_cal_active");

            $("#nd_rst_date").val(nd_rst_calendar_date_select);';

            //call the update slots only if not dev mode
            if ( get_option('nd_rst_dev_mode') != 1 ){ $nd_rst_bat_cal_date_code .= 'nd_rst_update_timing(nd_rst_calendar_date_select);'; }

          $nd_rst_bat_cal_date_code .= '
          }); 
          
        });

    });
  
';
wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_bat_cal_date_code );
//END inline script




//START CALENDAR CONTENT
$nd_rst_calendar .= '

<div id="nd_rst_calendar_container" class="nd_rst_section nd_rst_text_align_center">

    <div id="nd_rst_calendar_content" class="nd_rst_section">

        <div class="nd_rst_display_table nd_rst_section">

            <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_width_25_percentage">
                '.$nd_rst_button_prev.'       
            </div>

            <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_width_50_percentage">
                <h3 class="nd_rst_margin_0 nd_rst_padding_0">'.nd_rst_get_month_name($nd_rst_get_month_name_date).' '.$nd_rst_year_today.'</h3>
            </div>

            <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_width_25_percentage">
                    
                <input type="hidden" name="nd_rst_next_month" id="nd_rst_next_month" value="'.$nd_rst_next_month.'">
                <input type="hidden" name="nd_rst_next_year" id="nd_rst_next_year" value="'.$nd_rst_next_year.'">
                <button onclick="nd_rst_calendar(2)" class="nd_rst_prev_next_cal nd_rst_float_right" type="button">'.__('Next','nd-restaurant-reservations').'</button>

            </div>

        </div>
        

        <div class="nd_rst_section nd_rst_height_20"></div> 

        <div class="nd_rst_section nd_rst_calendar_week">
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('M','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('T','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('W','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('T','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('F','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('S','nd-restaurant-reservations').'</strong></p></div>
            <div class="nd_rst_float_left nd_rst_width_14_percentage"><p><strong>'.__('S','nd-restaurant-reservations').'</strong></p></div>
        </div>

        <div class="nd_rst_section">';

            for ($nd_rst_i = 1; $nd_rst_i <= $nd_rst_tot_days_this_month; $nd_rst_i++) {

                $nd_rst_date = $nd_rst_month_today.'/'.$nd_rst_i.'/'.$nd_rst_year_today;

                if ( $nd_rst_i == 1 ) {

                    $nd_rst_n = date("N",strtotime($nd_rst_date));

                    for ($i = 1; $i <= $nd_rst_n-1; $i++) {
                       $nd_rst_calendar .= '<div class="nd_rst_float_left nd_rst_width_14_percentage nd_rst_height_1"></div>';
                    }

                }else{
                    $test = '';   
                }

                //days classes
                $nd_rst_class = '';
                if ( $nd_rst_real_month_today == $nd_rst_month_today AND $nd_rst_real_year_today == $nd_rst_year_today ) { 
                   
                    //today class
                    if ( $nd_rst_i == $nd_rst_real_day_today ) { $nd_rst_class .= " nd_rst_cal_today"; }
                    
                    if ( $nd_rst_i >= $nd_rst_real_day_today ) { 

                        $nd_rst_date_total = $nd_rst_year_today.'-'.$nd_rst_month_today.'-'.$nd_rst_i;

                        //call the update slots only if not dev mode
                        if ( get_option('nd_rst_dev_mode') != 1 ){ 

                            //check if date is close
                            if ( nd_rst_close_day($nd_rst_date_total) == 1 ) { $nd_rst_class .= "  nd_rst_cal_ex_close ";  }
                            if ( nd_rst_close_day($nd_rst_date_total) == 2 ) { $nd_rst_class .= " nd_rst_cal_ex_hour_change "; }
                            if ( nd_rst_set_day($nd_rst_date_total) == 1 ) { }else{ $nd_rst_class .= " nd_rst_cal_not_set "; }   

                        }
                        //end dev mode

                        $nd_rst_class .= " nd_rst_cursor_pointer nd_rst_calendar_date ";  

                    } else { $nd_rst_class .= ''; }
                    if ( $nd_rst_month_today == $nd_rst_selected_month AND $nd_rst_year_today == $nd_rst_selected_year AND $nd_rst_i == $nd_rst_selected_day ) { $nd_rst_class .= " nd_rst_cal_active"; }
                
                }else{

                    $nd_rst_date_total = $nd_rst_year_today.'-'.$nd_rst_month_today.'-'.$nd_rst_i;

                    //call the update slots only if not dev mode
                    if ( get_option('nd_rst_dev_mode') != 1 ){ 

                        //check if date is close
                        if ( nd_rst_close_day($nd_rst_date_total) == 1 ) { $nd_rst_class .= "  nd_rst_cal_ex_close ";  }
                        if ( nd_rst_close_day($nd_rst_date_total) == 2 ) { $nd_rst_class .= " nd_rst_cal_ex_hour_change "; }
                        if ( nd_rst_set_day($nd_rst_date_total) == 1 ) { }else{ $nd_rst_class .= " nd_rst_cal_not_set "; }   

                    }
                    //end dev mode

                    $nd_rst_class .= " nd_rst_cursor_pointer nd_rst_calendar_date ";  

                    if ( $nd_rst_month_today == $nd_rst_selected_month AND $nd_rst_year_today == $nd_rst_selected_year AND $nd_rst_i == $nd_rst_selected_day ) { $nd_rst_class .= " nd_rst_cal_active"; }  
                }

                if ( $nd_rst_i == $nd_rst_day_today ) { $nd_rst_class .= ' nd_rst_cal_active '; }

                if ( strlen($nd_rst_i) == 1 ) {  
                    $nd_rst_i_visual = '0'.$nd_rst_i;    
                }else{
                    $nd_rst_i_visual = $nd_rst_i; 
                }
                $nd_rst_calendar .= '<div class="nd_rst_float_left nd_rst_width_14_percentage"><p data-date="'.$nd_rst_year_today.'-'.$nd_rst_month_today.'-'.$nd_rst_i_visual.'" class="'.$nd_rst_class.'">'.$nd_rst_i.'</p></div>';      

            }

        $nd_rst_calendar .= '
        </div></div>';


$nd_rst_calendar .= '</div>';
//END CALENDAR












