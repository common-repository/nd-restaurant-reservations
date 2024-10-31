<?php

//get color customizer
$nd_rst_customizer_color_dark_1 = get_option( 'nd_rst_customizer_color_dark_1', '#2d2d2d' );
$nd_rst_customizer_color_1 = get_option( 'nd_rst_customizer_color_1', '#c0a58a' );
$nd_rst_customizer_color_2 = get_option( 'nd_rst_customizer_color_2', '#b66565' );

//add style based on color
$nd_rst_search1_datep_style = '.nd_rst_bookingform_component_cal_l1.ui-datepicker {  background-color: '.$nd_rst_customizer_color_dark_1.'; }';
wp_add_inline_style( 'jquery-ui-datepicker-layout-1-css', $nd_rst_search1_datep_style );


$nd_rst_result .= '

  
  <div class="nd_rst_section nd_rst_bookingform_component">
    

    <form action="'.$bookingform_action.'" method="get">


      <!--NEW date-->
      <div class="nd_rst_width_33_percentage nd_rst_width_100_percentage_all_iphone nd_rst_float_left nd_rst_box_sizing_border_box">


          <div id="nd_rst_open_calendar_from" class="nd_rst_section nd_rst_box_sizing_border_box nd_rst_text_align_center nd_rst_cursor_pointer">
            <div class="nd_rst_section  nd_rst_box_sizing_border_box nd_rst_text_align_center">
              <p class="nd_rst_letter_spacing_2">'.__('SET DATE','nd-restaurant-reservations').' :</p>
              <div class="nd_rst_section nd_rst_height_15"></div> 
              <div class="nd_rst_display_inline_flex ">
                
                <div class="nd_rst_float_left nd_rst_text_align_right">
                  <h1 style="color:'.$nd_rst_number_color.'" id="nd_rst_date_number_from_front" class="nd_rst_font_weight_300 nd_rst_line_height_1 nd_rst_font_size_50 nd_options_color_greydark">'.$nd_rst_date_number_from_front.'</h1>
                </div>
                
                <div class="nd_rst_float_right nd_rst_text_align_center nd_rst_margin_left_10">
                    <h6 id="nd_rst_date_month_from_front" class="nd_options_color_grey nd_rst_margin_top_2 nd_rst_font_size_12">'.$nd_rst_date_month_from_front.'</h6>
                    <div class="nd_rst_section nd_rst_height_5"></div>
                    <img alt="" width="12" src="'.$nd_rst_image.'">
                </div>

              </div>
            </div>
          </div>

          <input type="hidden" id="nd_rst_date_month_from" class="nd_rst_section nd_rst_margin_top_20" value="'.$nd_rst_date_month_from_front.'">
          <input type="hidden" id="nd_rst_date_number_from" class="nd_rst_section nd_rst_margin_top_20" value="'.date('d').'">
          <input placeholder="Check In" class="nd_rst_section nd_rst_border_width_0_important nd_rst_padding_0_important nd_rst_height_0_important" type="text" name="nd_rst_send_date" id="nd_rst_send_date" value="'.date('Y-m-d').'" />
      
      </div>
      <!--NEW date-->





        <!--guests-->
        <div class="nd_rst_width_33_percentage nd_rst_margin_top_20_all_iphone nd_rst_width_100_percentage_all_iphone nd_rst_float_left  nd_rst_box_sizing_border_box">
            <div class="nd_rst_section  nd_rst_box_sizing_border_box nd_rst_text_align_center">
              <div class="nd_rst_section  nd_rst_box_sizing_border_box nd_rst_text_align_center">
                <p  class="nd_rst_letter_spacing_2 nd_rst_margin_top_20_all_iphone">'.__('GUESTS','nd-restaurant-reservations').' :</p>
                <div class="nd_rst_section nd_rst_height_15"></div> 
                <div class="nd_rst_display_inline_flex ">
                  <div class="nd_rst_float_left nd_rst_text_align_right">
                      <h1 class="nd_rst_line_height_1 nd_rst_font_size_50 nd_rst_color_greydark nd_rst_font_weight_300 nd_rst_guests_number nd_rst_min_width_35 nd_rst_text_align_center">1</h1>
                  </div>
                  <div class="nd_rst_float_right nd_rst_text_align_center nd_rst_margin_left_10">
                      <div class="nd_rst_section nd_rst_height_8"></div>
                      <div class="nd_rst_section">
                          <img class="nd_rst_float_right nd_rst_guests_increase nd_rst_cursor_pointer" style="transform: rotate(180deg);" alt="" width="12" src="'.$nd_rst_image.'">
                      </div>
                      <div class="nd_rst_section nd_rst_height_10"></div>
                      <div class="nd_rst_section">
                          <img class="nd_rst_float_right nd_rst_guests_decrease nd_rst_cursor_pointer" alt="" width="12" src="'.$nd_rst_image.'">
                      </div>
                  </div>
                </div>
              </div> 
            </div>

            <input placeholder="Guests" class="nd_rst_section nd_rst_display_none" type="number" name="nd_rst_send_guests" id="nd_rst_send_guests" min="1" value="'.$nd_rst_send_guests.'" />
        </div>

         <!--guests-->




      <div class="nd_rst_width_33_percentage nd_rst_width_100_percentage_all_iphone nd_rst_margin_top_20_all_iphone nd_rst_float_left nd_rst_text_align_center">
        <input class="nd_rst_white_space_normal  nd_rst_letter_spacing_2 nd_rst_font_size_15 nd_rst_line_height_1_5 nd_rst_padding_10_30_important" type="submit" value="'.__('RESERVE','nd-restaurant-reservations').'">
      </div>

    </form>

  </div>';
  



//START inline script
$nd_rst_search_comp_l1_datepicker_code = '

  jQuery(document).ready(function() {

    jQuery( function ( $ ) {

        $( "#nd_rst_send_date" ).datepicker({
          defaultDate: "+1w",
          minDate: 0,
          altField: "#nd_rst_date_month_from",
          altFormat: "M",
          firstDay: 0,
          dateFormat: "yy-mm-dd",
          monthNames: ["'.__('January','nd-restaurant-reservations').'","'.__('February','nd-restaurant-reservations').'","'.__('March','nd-restaurant-reservations').'","'.__('April','nd-restaurant-reservations').'","'.__('May','nd-restaurant-reservations').'","'.__('June','nd-restaurant-reservations').'", "'.__('July','nd-restaurant-reservations').'","'.__('August','nd-restaurant-reservations').'","'.__('September','nd-restaurant-reservations').'","'.__('October','nd-restaurant-reservations').'","'.__('November','nd-restaurant-reservations').'","'.__('December','nd-restaurant-reservations').'"],
          monthNamesShort: [ "'.__('Jan','nd-restaurant-reservations').'", "'.__('Feb','nd-restaurant-reservations').'", "'.__('Mar','nd-restaurant-reservations').'", "'.__('Apr','nd-restaurant-reservations').'", "'.__('Maj','nd-restaurant-reservations').'", "'.__('Jun','nd-restaurant-reservations').'", "'.__('Jul','nd-restaurant-reservations').'", "'.__('Aug','nd-restaurant-reservations').'", "'.__('Sep','nd-restaurant-reservations').'", "'.__('Oct','nd-restaurant-reservations').'", "'.__('Nov','nd-restaurant-reservations').'", "'.__('Dec','nd-restaurant-reservations').'" ],
          dayNamesMin: ["'.__('S','nd-restaurant-reservations').'","'.__('M','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('W','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('F','nd-restaurant-reservations').'", "'.__('S','nd-restaurant-reservations').'"],
          nextText: "'.__('NEXT','nd-restaurant-reservations').'",
          prevText: "'.__('PREV','nd-restaurant-reservations').'",
          changeMonth: false,
          numberOfMonths: 1,
          beforeShow : function() {
            $("#ui-datepicker-div").addClass( "nd_rst_bookingform_component_cal_l1" );
          },
          onClose: function() {   
            var nd_rst_input_date_from = $( "#nd_rst_send_date" ).val();
            var nd_rst_date_number_from = nd_rst_input_date_from.substring(8, 10);
            $( "#nd_rst_date_number_from" ).val(nd_rst_date_number_from);
            $( "#nd_rst_date_number_from_front" ).text(nd_rst_date_number_from);
            var nd_rst_date_month_from = $( "#nd_rst_date_month_from" ).val();
            $( "#nd_rst_date_month_from_front" ).text(nd_rst_date_month_from);
          }
        });
        
        $("#nd_rst_open_calendar_from").click(function () {
            $("#nd_rst_send_date").datepicker("show");
        });


    });

  });

';
wp_add_inline_script( 'jquery-ui-datepicker', $nd_rst_search_comp_l1_datepicker_code );




$nd_rst_search_comp_l1_guests_code = '

  jQuery(document).ready(function() {

    jQuery( function ( $ ) {

      $(".nd_rst_guests_increase").click(function() {
        var value = $(".nd_rst_guests_number").text();

        if ( value < '.$nd_rst_max_guests.' ){
          value++;
          $(".nd_rst_guests_number").text(value);
          $("#nd_rst_send_guests").val(value);
        }
        
      }); 

      $(".nd_rst_guests_decrease").click(function() {
        var value = $(".nd_rst_guests_number").text();
        
        if ( value > 1 ) {
          value--;
          $(".nd_rst_guests_number").text(value);
          $("#nd_rst_send_guests").val(value);
        }
        
      }); 
      
    });

  });

';
wp_add_inline_script( 'jquery-ui-datepicker', $nd_rst_search_comp_l1_guests_code );
//END inline script

