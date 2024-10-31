<?php

//convert date format
$nd_rst_dat_new = new DateTime($nd_rst_date);
$nd_rst_date_visual = date_format($nd_rst_dat_new, get_option('date_format'));
$nd_rst_tim_new = new DateTime($nd_rst_time);
$nd_rst_time_visual = date_format($nd_rst_tim_new, get_option('time_format'));


$nd_rst_booking_result .= '
<!--START CONTAINER-->
<div class="nd_rst_section nd_rst_booking_container_2">


     <!--info booking-->
    <input type="hidden" name="nd_rst_restaurant" id="nd_rst_restaurant" value="'.$nd_rst_restaurant.'">
    <input type="hidden" name="nd_rst_guests" id="nd_rst_guests" value="'.$nd_rst_guests.'">
    <input type="hidden" name="nd_rst_date" id="nd_rst_date" value="'.$nd_rst_date.'">
    <input type="hidden" name="nd_rst_time" id="nd_rst_time" value="'.$nd_rst_time.'">
    <input type="hidden" name="nd_rst_occasion" id="nd_rst_occasion" value="'.$nd_rst_occasion.'">


    <div id="nd_rst_booking_all_container_2" class="nd_rst_section">
    
        


        <!--START Resume-->
        <div id="nd_rst_booking_step_resume" class="nd_rst_section">

            <div class="nd_rst_section nd_rst_position_relative">
                
                <img class="nd_rst_section" src="'.$nd_rst_image_src[0].'">

                <div id="nd_rst_booking_step_resume_filter"></div>

                <p class="nd_rst_margin_0 nd_rst_booking_resume_restaurant ">'.get_the_title($nd_rst_restaurant).'</p>

            </div>


            

            <div id="nd_rst_booking_step_resume_all_info" class="nd_rst_section">

                <h1 id="nd_rst_booking_step_resume_all_info_word" class="nd_options_third_font">'.__('Details','nd-restaurant-reservations').'</h1>

                <div class="nd_rst_section">
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_left">
                        <p class="nd_rst_margin_0"><span>'.__('Guests','nd-restaurant-reservations').':</span>  '.$nd_rst_guests.'</p>
                        <p class="nd_rst_margin_0 nd_rst_step_resume_occasion"><span>'.__('Occasion','nd-restaurant-reservations').' :</span>  '.$nd_rst_occasion_title.'</p>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_right">
                        <p class="nd_rst_margin_0"><span>'.__('Time','nd-restaurant-reservations').' :</span>  '.$nd_rst_time_visual.'</p>
                        <p class="nd_rst_margin_0"><span>'.__('Date','nd-restaurant-reservations').' :</span>  '.$nd_rst_date_visual.'</p>
                    </div>
                </div>   
                
            </div>

            
        </div>
        <!--END resume-->





        <!--START FORM-->
        <div id="nd_rst_booking_step_datas_form" class="nd_rst_section">

            <div id="nd_rst_booking_step_datas_form_container" class="nd_rst_section">

                <input type="hidden" id="nd_rst_action_return" name="nd_rst_action_return" value="'.$nd_rst_action_return.'">

                <div class="nd_rst_section">
                    <h3 class="nd_rst_margin_top_5">'.__('Insert your Informations','nd-restaurant-reservations').' :</h3>
                </div>

                <div id="nd_rst_booking_form_name_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_name">'.__('Name','nd-restaurant-reservations').' *</label>
                    <input class="" type="text" name="nd_rst_booking_form_name" id="nd_rst_booking_form_name" value="">
                </div>

                <div id="nd_rst_booking_form_surname_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_surname">'.__('Surname','nd-restaurant-reservations').' *</label>
                    <input class="" type="text" name="nd_rst_booking_form_surname" id="nd_rst_booking_form_surname" value="">
                </div>

                <div id="nd_rst_booking_form_email_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_email">'.__('Email','nd-restaurant-reservations').' *</label>
                    <input class="" type="text" name="nd_rst_booking_form_email" id="nd_rst_booking_form_email" value="">
                </div>

                <div id="nd_rst_booking_form_phone_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_phone">'.__('Phone','nd-restaurant-reservations').' *</label>
                    <input class="" type="text" name="nd_rst_booking_form_phone" id="nd_rst_booking_form_phone" value="">
                </div>

                <div class="nd_rst_section nd_rst_height_20"></div>

                <div id="nd_rst_booking_form_requests_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_requests">'.__('Message','nd-restaurant-reservations').'</label>
                    <textarea rows="7" class="" name="nd_rst_booking_form_requests" id="nd_rst_booking_form_requests"></textarea>
                </div>

                <div class="nd_rst_section nd_rst_height_20"></div>

                <div id="nd_rst_booking_form_term_container" class="nd_rst_section">
                    <label class="" for="nd_rst_booking_form_requests">
                        <input class="" id="nd_rst_booking_form_term" name="nd_rst_booking_form_term" type="checkbox" checked value="1">
                        <a target="_blank" href="'.get_permalink(get_option("nd_rst_terms_page")).'">'.__('Terms and Conditions','nd-restaurant-reservations').' </a>
                    </label>
                </div>

                <div class="nd_rst_section nd_rst_height_20"></div>

                <button class="nd_options_first_font" onclick="nd_rst_validate_fields()">'.__('CHECKOUT','nd-restaurant-reservations').'</button>
                <button onclick="nd_rst_go_to_checkout()" id="nd_rst_submit_go_to_checkout" class="nd_rst_display_none nd_options_first_font">'.__('CHECKOUT','nd-restaurant-reservations').'</button>
            
            </div>
        
        </div>
        <!--END FORM-->

    </div>

</div>
<!--END CONTAINER-->


';












