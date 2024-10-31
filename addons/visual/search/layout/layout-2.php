<?php

//get colors from options
$nd_rst_text_color_h = get_option( 'nd_options_customizer_font_color_h', '#2d2d2d' );
$nd_rst_text_color_p = get_option( 'nd_options_customizer_font_color_p', '#7e7e7e' );



$nd_rst_search2_datep_style = '

  #nd_rst_search_l2_datepicker .ui-datepicker .ui-datepicker-title { color: '.$nd_rst_text_color_h.';  }
  #nd_rst_search_l2_datepicker .ui-datepicker th { color: '.$nd_rst_text_color_h.';  }
  #nd_rst_search_l2_datepicker .ui-datepicker td span,
  #nd_rst_search_l2_datepicker .ui-datepicker td a { color: '.$nd_rst_text_color_p.'; }
  #nd_rst_search_l2_datepicker .ui-datepicker td a.ui-state-active { background-color:'.$nd_rst_submit_bg.'; }

';
wp_add_inline_style( 'jquery-ui-datepicker-layout-2-css', $nd_rst_search2_datep_style );



$str .= '

    <div class="nd_rst_section '.$nd_rst_class.' ">

        <!--START FORM-->
        <form action="'.$nd_rst_action.'" method="get">

          <div id="nd_rst_search_l2_datepicker"></div>

          <input placeholder="Check In" class="nd_rst_section nd_rst_border_width_0_important nd_rst_padding_0_important nd_rst_height_0_important" type="text" name="nd_rst_send_date" id="nd_rst_send_date" value="'.date('Y-m-d').'" />

          <input style="padding: '.$nd_rst_submit_padding.'; background-color:'.$nd_rst_submit_bg.'; margin-top:'.$nd_rst_submit_margin_top.'px; " class=" nd_options_color_white nd_options_second_font_important nd_rst_width_100_percentage nd_rst_border_width_0_important nd_rst_letter_spacing_2" type="submit" value="'.__('BOOK A TABLE','nd-restaurant-reservations').'">

        </form>
        <!--END FORM-->

    </div>


';




//START inline script
$nd_rst_search_comp_l2_datepicker_code = '
  
  jQuery(document).ready(function() {

    jQuery( function ( $ ) {

        $( "#nd_rst_search_l2_datepicker" ).datepicker({
          minDate: 0,
          altField: "#nd_rst_send_date",
          altFormat: "yy-mm-dd",
          firstDay: 0,
          dateFormat: "yy-mm-dd",
          monthNames: ["'.__('January','nd-restaurant-reservations').'","'.__('February','nd-restaurant-reservations').'","'.__('March','nd-restaurant-reservations').'","'.__('April','nd-restaurant-reservations').'","'.__('May','nd-restaurant-reservations').'","'.__('June','nd-restaurant-reservations').'", "'.__('July','nd-restaurant-reservations').'","'.__('August','nd-restaurant-reservations').'","'.__('September','nd-restaurant-reservations').'","'.__('October','nd-restaurant-reservations').'","'.__('November','nd-restaurant-reservations').'","'.__('December','nd-restaurant-reservations').'"],
          monthNamesShort: [ "'.__('Jan','nd-restaurant-reservations').'", "'.__('Feb','nd-restaurant-reservations').'", "'.__('Mar','nd-restaurant-reservations').'", "'.__('Apr','nd-restaurant-reservations').'", "'.__('Maj','nd-restaurant-reservations').'", "'.__('Jun','nd-restaurant-reservations').'", "'.__('Jul','nd-restaurant-reservations').'", "'.__('Aug','nd-restaurant-reservations').'", "'.__('Sep','nd-restaurant-reservations').'", "'.__('Oct','nd-restaurant-reservations').'", "'.__('Nov','nd-restaurant-reservations').'", "'.__('Dec','nd-restaurant-reservations').'" ],
          dayNamesMin: ["'.__('S','nd-restaurant-reservations').'","'.__('M','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('W','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('F','nd-restaurant-reservations').'", "'.__('S','nd-restaurant-reservations').'"],
          nextText: "'.__('NEXT','nd-restaurant-reservations').'",
          prevText: "'.__('PREV','nd-restaurant-reservations').'",
          changeMonth: false,
          numberOfMonths: 1
        });
        
    });

  });
  
';
wp_add_inline_script( 'jquery-ui-datepicker', $nd_rst_search_comp_l2_datepicker_code );
//END inline script

