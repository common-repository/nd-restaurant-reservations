<?php


//convert date format
$nd_rst_dat_new = new DateTime($nd_rst_date);
$nd_rst_date_visual = date_format($nd_rst_dat_new, get_option('date_format'));
$nd_rst_tim_new = new DateTime($nd_rst_time_start);
$nd_rst_time_visual = date_format($nd_rst_tim_new, get_option('time_format'));


$nd_rst_add_to_db_result .= '
    
    <div id="nd_rst_thanks_step" class="nd_rst_section nd_rst_padding_30 nd_rst_box_siing_border_box">

    	<h3 class="nd_rst_text_align_center">'.__('Thanks For Your Reservation','nd-restaurant-reservations').' :</h3>

    	<div class="nd_rst_section nd_rst_height_30"></div> 

    	<div id="nd_rst_thanks_step_resume" class="nd_rst_section">

    		
    		<!--START icons-->
    		<div id="nd_rst_thanks_step_resume_icons" class="nd_rst_section">

    			<div class="nd_rst_width_25_percentage nd_rst_float_left nd_rst_text_align_center">
    				
    				<img alt="" class="" width="50" src="'.esc_url(plugins_url('004-restaurant.png', __FILE__ )).'">
    				<p>'.get_the_title($nd_rst_restaurant).'</p>

    			</div>	

    			<div class="nd_rst_width_25_percentage nd_rst_float_left nd_rst_text_align_center">
    				
    				<img alt="" class="" width="50" src="'.esc_url(plugins_url('003-users.png', __FILE__ )).'">
    				<p><strong class="nd_options_color_greydark">'.__('GUESTS','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_guests.'</span></p>

    			</div>

    			<div class="nd_rst_width_25_percentage nd_rst_float_left nd_rst_text_align_center">
    				
    				<img alt="" class="" width="50" src="'.esc_url(plugins_url('002-calendar.png', __FILE__ )).'">
    				<p><strong class="nd_options_color_greydark">'.__('DATE','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_date_visual.'</span></p>

    			</div>

    			<div class="nd_rst_width_25_percentage nd_rst_float_left nd_rst_text_align_center">
    				
    				<img alt="" class="" width="50" src="'.esc_url(plugins_url('001-time.png', __FILE__ )).'">
    				<p><strong class="nd_options_color_greydark">'.__('TIME','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_time_visual.'</span></p>

    			</div>	

    		</div>
    		<!--END icons-->

    		<div id="nd_rst_thanks_step_resume_table" class="nd_rst_section">

	    		<div class="nd_rst_section nd_rst_thanks_step_resume_left ">

	    			<p><strong class="nd_options_color_greydark">'.__('NAME','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_booking_form_name.'</span></p>
	    			<div class="nd_rst_section nd_rst_height_10"></div> 
                    <p><strong class="nd_options_color_greydark">'.__('SURNAME','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_booking_form_surname.'</span></p>
		    		<div class="nd_rst_section nd_rst_height_10"></div> 
                    <p><strong class="nd_options_color_greydark">'.__('EMAIL','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_booking_form_email.'</span></p>
                    <div class="nd_rst_section nd_rst_height_10"></div> 
                    <p><strong class="nd_options_color_greydark">'.__('PHONE','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_booking_form_phone.'</span></p>
                    <div class="nd_rst_section nd_rst_height_10"></div> 
                    <p class="nd_rst_thanks_step_resume_table_occasion"><strong class="nd_options_color_greydark">'.__('OCCASION','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_occasion_title.'</span></p>
                    <div class="nd_rst_section nd_rst_height_10"></div> 
                    <p class="nd_rst_thanks_step_resume_table_booking_method"><strong class="nd_options_color_greydark">'.__('BOOKING METHOD','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_order_type_name.'</span></p>
                    <div class="nd_rst_section nd_rst_height_10"></div> 
                    <p class="nd_rst_thanks_step_resume_table_deposit"><strong class="nd_options_color_greydark">'.__('DEPOSIT VALUE','nd-restaurant-reservations').' : </strong><span>'.$nd_rst_deposit.' '.$nd_rst_currency.'</span></p>
		    		
	    		</div>

    		</div>

    	</div>

    </div>
    

';