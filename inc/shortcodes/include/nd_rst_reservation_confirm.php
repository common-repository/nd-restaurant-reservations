<?php


//convert date format
$nd_rst_dat_new = new DateTime($nd_rst_date);
$nd_rst_date_visual = date_format($nd_rst_dat_new, get_option('date_format'));
$nd_rst_tim_new = new DateTime($nd_rst_time);
$nd_rst_time_visual = date_format($nd_rst_tim_new, get_option('time_format'));


$nd_rst_checkout_result .= '
    <div class="nd_rst_section nd_rst_booking_container_3">

        <!--info booking-->
        <input type="hidden" name="nd_rst_restaurant" id="nd_rst_restaurant" value="'.$nd_rst_restaurant.'">
        <input type="hidden" name="nd_rst_guests" id="nd_rst_guests" value="'.$nd_rst_guests.'">
        <input type="hidden" name="nd_rst_date" id="nd_rst_date" value="'.$nd_rst_date.'">
        <input type="hidden" name="nd_rst_time" id="nd_rst_time" value="'.$nd_rst_time.'">
        <input type="hidden" name="nd_rst_occasion" id="nd_rst_occasion" value="'.$nd_rst_occasion.'">
        <input type="hidden" name="nd_rst_booking_form_name" id="nd_rst_booking_form_name" value="'.$nd_rst_booking_form_name.'">
        <input type="hidden" name="nd_rst_booking_form_surname" id="nd_rst_booking_form_surname" value="'.$nd_rst_booking_form_surname.'">
        <input type="hidden" name="nd_rst_booking_form_email" id="nd_rst_booking_form_email" value="'.$nd_rst_booking_form_email.'">
        <input type="hidden" name="nd_rst_booking_form_phone" id="nd_rst_booking_form_phone" value="'.$nd_rst_booking_form_phone.'">
        <input type="hidden" name="nd_rst_booking_form_requests" id="nd_rst_booking_form_requests" value="'.$nd_rst_booking_form_requests.'">
        
        <input type="hidden" name="nd_rst_order_type" id="nd_rst_order_type" value="request">
        <input type="hidden" name="nd_rst_order_status" id="nd_rst_order_status" value="'.get_option('nd_rst_default_order_status').'">


        <div id="nd_rst_checkout_all_container_3" class="nd_rst_section">


        <!--START Resume-->
        <div id="nd_rst_checkout_step_resume" class="nd_rst_section">

            <div class="nd_rst_section nd_rst_position_relative">
                
                <img class="nd_rst_section" src="'.$nd_rst_image_src[0].'">

                <div id="nd_rst_checkout_step_resume_filter"></div>

                <p class="nd_rst_margin_0 nd_rst_checkout_resume_restaurant ">'.get_the_title($nd_rst_restaurant).'</p>

            </div>


            

            <div id="nd_rst_checkout_step_resume_all_info" class="nd_rst_section">

                <h1 id="nd_rst_checkout_step_resume_all_info_word" class="nd_options_third_font">'.__('Details','nd-restaurant-reservations').'</h1>

                <div class="nd_rst_section">
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_left">
                        <p class="nd_rst_margin_0"><span>'.__('Guests','nd-restaurant-reservations').':</span> '.$nd_rst_guests.'</p>
                        <p class="nd_rst_margin_0 nd_rst_step_resume_check_occasion"><span>'.__('Occasion','nd-restaurant-reservations').' :</span> '.$nd_rst_occasion_title.'</p>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_right">
                        <p class="nd_rst_margin_0"><span>'.__('Time','nd-restaurant-reservations').' :</span> '.$nd_rst_time_visual.'</p>
                        <p class="nd_rst_margin_0"><span>'.__('Date','nd-restaurant-reservations').' :</span> '.$nd_rst_date_visual.'</p>
                    </div>
                </div> 

                <div class="nd_rst_section nd_rst_height_15"></div>

                <div class="nd_rst_section">
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_left">
                        <p class="nd_rst_margin_0"><span>'.__('Name','nd-restaurant-reservations').':</span> '.$nd_rst_booking_form_name.'</p>
                        <p class="nd_rst_margin_0"><span>'.__('Email','nd-restaurant-reservations').' :</span> '.$nd_rst_booking_form_email.'</p>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_50_percentage nd_rst_text_align_right">
                        <p class="nd_rst_margin_0"><span>'.__('Surname','nd-restaurant-reservations').' :</span> '.$nd_rst_booking_form_surname.'</p>
                        <p class="nd_rst_margin_0"><span>'.__('Phone','nd-restaurant-reservations').' :</span> '.$nd_rst_booking_form_phone.'</p>
                    </div>
                </div>   
                
            </div>

            
        </div>
        <!--END resume-->


        <!--START FORM-->
        <div id="nd_rst_checkout_step_datas_form" class="nd_rst_section">

            <div id="nd_rst_checkout_step_datas_form_container" class="nd_rst_section">

                <div id="nd_rst_checkout_form_name_container" class="nd_rst_section">
                    

                    <h3>'.__('Booking Methods','nd-restaurant-reservations').' :</h3>

                    <div class="nd_rst_section nd_rst_height_30"></div>

                    <p class="nd_rst_checkout_form_description">'.get_option('nd_rst_general_description').'</p>

                    <div class="nd_rst_section nd_rst_height_30"></div>';





                    if ( get_option('nd_rst_stripe_enable') == 1 ) {

                      //static stripe variables
                      $nd_rst_stripe_public_key = get_option('nd_rst_stripe_public_key');
                      $nd_rst_stripe_currency = get_option('nd_rst_stripe_currency');
                      $nd_rst_return_page_s = $nd_rst_action_return;
                      $nd_rst_stripe_deposit = get_option('nd_rst_stripe_deposit');

                      //color
                      $nd_rst_customizer_color_1 = get_option( 'nd_rst_customizer_color_1', '#c0a58a' );
                      $nd_rst_customizer_font_color_p = get_option( 'nd_options_customizer_font_color_p', '#7e7e7e' );

                      //font
                      $nd_rst_customizer_font_family_p = get_option( 'nd_options_customizer_font_family_p', 'Montserrat:400,700' );
                      $nd_rst_font_family_p_array = explode(":", $nd_rst_customizer_font_family_p);
                      $nd_rst_font_family_p = str_replace("+"," ",$nd_rst_font_family_p_array[0]);

                      //set deposit
                      if ( get_option('nd_rst_deposit_guests') == 1 ){ $nd_rst_stripe_deposit = $nd_rst_stripe_deposit * $nd_rst_guests; }

                      $nd_rst_checkout_result .= '
                      <style>
                      #nd_rst_section_confirm_stripe { font-weight:normal; color: '.$nd_rst_customizer_font_color_p.'; }
                      </style>

                      <div class="nd_rst_section nd_rst_height_15 nd_rst_border_bottom_1_solid_grey"></div>
                      <div class="nd_rst_section nd_rst_height_15 "></div>

                      <div id="nd_rst_section_confirm_stripe" class="nd_rst_section ">

                          <div class="nd_rst_section nd_rst_box_sizing_border_box">
                            <p class="nd_rst_toogle_title nd_rst_position_relative nd_rst_padding_left_45 nd_options_color_greydark">
                              <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_open_3 nd_rst_width_25 nd_rst_display_none nd_rst_height_25  nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                                <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-add-white.png', __FILE__ )).'">
                              </span> 
                              <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_close_3 nd_rst_width_25  nd_rst_height_25 nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                                <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-less-white.png', __FILE__ )).'">
                              </span>
                              '.__('CREDIT CARD','nd-restaurant-reservations').'
                            </p>
                          </div>
                          
                          <div class=" nd_rst_padding_20 nd_rst_padding_left_0 nd_rst_padding_right_0 nd_rst_toogle_content_3 nd_rst_section nd_rst_box_sizing_border_box">
                            <p>'.get_option('nd_rst_stripe_description').'</p>
                            <div class="nd_rst_section nd_rst_height_20"></div>


                              <form action="'.$nd_rst_return_page_s.'" method="post" id="payment-form">
                                  
                                  <div class="form-row nd_rst_margin_top_20 nd_rst_margin_bottom_20">
                                      <div id="card-element"></div>
                                      <div class="nd_rst_margin_top_10" id="card-errors" role="alert"></div>
                                  </div>

                                  
                                  <input type="hidden" name="nd_rst_restaurant" id="nd_rst_restaurant" value="'.$nd_rst_restaurant.'">
                                  <input type="hidden" name="nd_rst_guests" id="nd_rst_guests" value="'.$nd_rst_guests.'">
                                  <input type="hidden" name="nd_rst_date" id="nd_rst_date" value="'.$nd_rst_date.'">
                                  <input type="hidden" name="nd_rst_time" id="nd_rst_time" value="'.$nd_rst_time.'">
                                  <input type="hidden" name="nd_rst_occasion" id="nd_rst_occasion" value="'.$nd_rst_occasion.'">
                                  <input type="hidden" name="nd_rst_booking_form_name" id="nd_rst_booking_form_name" value="'.$nd_rst_booking_form_name.'">
                                  <input type="hidden" name="nd_rst_booking_form_surname" id="nd_rst_booking_form_surname" value="'.$nd_rst_booking_form_surname.'">
                                  <input type="hidden" name="nd_rst_booking_form_email" id="nd_rst_booking_form_email" value="'.$nd_rst_booking_form_email.'">
                                  <input type="hidden" name="nd_rst_booking_form_phone" id="nd_rst_booking_form_phone" value="'.$nd_rst_booking_form_phone.'">
                                  <input type="hidden" name="nd_rst_booking_form_requests" id="nd_rst_booking_form_requests" value="'.$nd_rst_booking_form_requests.'">
                                  <input type="hidden" name="nd_rst_order_type" id="nd_rst_order_type" value="stripe">
                                  <input type="hidden" name="nd_rst_arrive_from_stripe" id="nd_rst_arrive_from_stripe" value="1">
                                  

                                  <input class="nd_rst_margin_top_20" type="submit" id="" name="" value="'.__('DEPOSIT','nd-restaurant-reservations').' '.$nd_rst_stripe_deposit.' '.get_option('nd_rst_stripe_currency').'">

                              </form>

                              <script type="text/javascript">

                                  var stripe = Stripe("'.$nd_rst_stripe_public_key.'");
                                  var elements = stripe.elements();

                                  var style = {
                                    base: {
                                      color: "'.$nd_rst_customizer_font_color_p.'",
                                      lineHeight: "18px",
                                      fontFamily: "'.$nd_rst_font_family_p.', sans-serif",
                                      fontWeight: "normal",
                                      fontSize: "14px",
                                      "::placeholder": {
                                        color: "'.$nd_rst_customizer_font_color_p.'"
                                      }
                                    },
                                    invalid: {
                                      color: "'.$nd_rst_customizer_color_1.'",
                                      iconColor: "'.$nd_rst_customizer_color_1.'"
                                    }
                                  };

                                  var card = elements.create("card", {style: style});
                                  card.mount("#card-element");

                                  card.addEventListener("change", function(event) {
                                    var displayError = document.getElementById("card-errors");
                                    if (event.error) {
                                      displayError.textContent = event.error.message;
                                    } else {
                                      displayError.textContent = "";
                                    }
                                  });

                                  var form = document.getElementById("payment-form");
                                  form.addEventListener("submit", function(event) {
                                    event.preventDefault();
                                    stripe.createToken(card).then(function(result) {
                                      if (result.error) {
                                        var errorElement = document.getElementById("card-errors");
                                        errorElement.textContent = result.error.message;
                                      } else {
                                        stripeTokenHandler(result.token);
                                      }
                                    });
                                  });

                                  function stripeTokenHandler(token) {
                                    var form = document.getElementById("payment-form");
                                    var hiddenInput = document.createElement("input");
                                    hiddenInput.setAttribute("type", "hidden");
                                    hiddenInput.setAttribute("name", "stripeToken");
                                    hiddenInput.setAttribute("value", token.id);
                                    form.appendChild(hiddenInput);
                                    form.submit();
                                  }

                              </script>

                          </div>

                      </div>
                      <!--END STRIPE-->';

                    }




                    if ( get_option('nd_rst_paypal_enable') == 1 ) {

                      //static paypal variables
                      if ( get_option('nd_rst_paypal_dev_mode') == 1 ) { 
                        $nd_rst_paypal_action_1 = 'https://www.sandbox.paypal.com/cgi-bin';
                      }else{
                        $nd_rst_paypal_action_1 = 'https://www.paypal.com/cgi-bin';
                      }
                      $nd_rst_paypal_email = get_option('nd_rst_paypal_email');
                      $nd_rst_price = get_option('nd_rst_paypal_deposit');
                      $nd_rst_paypal_currency = get_option('nd_rst_paypal_currency');
                      $nd_rst_paypal_deposit = get_option('nd_rst_paypal_deposit');

                      //set deposit
                      if ( get_option('nd_rst_deposit_guests') == 1 ){ $nd_rst_paypal_deposit = $nd_rst_paypal_deposit * $nd_rst_guests; }
                      $nd_rst_price = $nd_rst_paypal_deposit;

                      $nd_rst_return_page = $nd_rst_action_return;

                      $nd_rst_checkout_result .= '
                      <div class="nd_rst_section nd_rst_height_15 nd_rst_border_bottom_1_solid_grey"></div>
                      <div class="nd_rst_section nd_rst_height_15 "></div>

                      <div id="nd_rst_section_confirm_paypal" class="nd_rst_section ">

                          <div class="nd_rst_section nd_rst_box_sizing_border_box">
                            <p class="nd_rst_toogle_title nd_rst_position_relative nd_rst_padding_left_45 nd_options_color_greydark">
                              <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_open_2 nd_rst_width_25 nd_rst_height_25  nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                                <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-add-white.png', __FILE__ )).'">
                              </span> 
                              <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_close_2 nd_rst_width_25 nd_rst_display_none nd_rst_height_25 nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                                <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-less-white.png', __FILE__ )).'">
                              </span>
                              '.__('PAYPAL','nd-restaurant-reservations').'
                            </p>
                          </div>
                          
                          <div class="nd_rst_display_none nd_rst_padding_20 nd_rst_padding_left_0 nd_rst_padding_right_0 nd_rst_toogle_content_2 nd_rst_section nd_rst_box_sizing_border_box">
                            <p>'.get_option('nd_rst_paypal_description').'</p>
                            <div class="nd_rst_section nd_rst_height_20"></div>


                            <form target="paypal" action="'.$nd_rst_paypal_action_1.'" method="post" >
                                
                              <input type="hidden" name="cmd" value="_xclick">
                              <input type="hidden" name="business" value="'.$nd_rst_paypal_email.'">
                              <input type="hidden" name="lc" value="">
                              <input type="hidden" name="item_name" value="'.get_the_title($nd_rst_restaurant).' : '.$nd_rst_guests.' '.__('Guests','nd-restaurant-reservations').', '.$nd_rst_date_visual.', '.$nd_rst_time_visual.'">
                              <input type="hidden" name="item_number" value="'.$nd_rst_restaurant.'">
                              <input type="hidden" name="custom" value="'.$nd_rst_guests.'[ndbcpm]'.$nd_rst_date.'[ndbcpm]'.$nd_rst_time.'[ndbcpm]'.$nd_rst_booking_form_phone.'[ndbcpm]'.$nd_rst_occasion_title.'[ndbcpm]'.$nd_rst_booking_form_requests.'[ndbcpm]'.$nd_rst_occasion.'[ndbcpm]">
                              <input type="hidden" name="amount" value="'.$nd_rst_price.'">
                              <input type="hidden" name="currency_code" value="'.$nd_rst_paypal_currency.'">
                              <input type="hidden" name="rm" value="2" />
                              <input type="hidden" name="return" value="'.$nd_rst_return_page.'" />
                              <input type="hidden" name="cancel_return" value="" />
                              <input type="hidden" name="button_subtype" value="services">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                          
                              <input class="" type="submit" id="" name="" value="'.__('DEPOSIT','nd-restaurant-reservations').' '.$nd_rst_paypal_deposit.' '.get_option('nd_rst_paypal_currency').'">

                            </form>




                          </div>

                      </div>
                      <!--END PAYPAL-->';

                    }






                    $nd_rst_checkout_result .= '
                    <div class="nd_rst_section nd_rst_height_15 nd_rst_border_bottom_1_solid_grey"></div>
                    <div class="nd_rst_section nd_rst_height_15 "></div>

                    <div id="nd_rst_section_confirm_br" class="nd_rst_section">

                        <div class="nd_rst_section nd_rst_box_sizing_border_box">
                          <p class="nd_rst_toogle_title nd_rst_position_relative nd_rst_padding_left_45 nd_options_color_greydark">
                            <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_open_1 nd_rst_width_25 nd_rst_height_25  nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                              <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-add-white.png', __FILE__ )).'">
                            </span> 
                            <span class=" nd_rst_toogle_icon nd_rst_cursor_pointer nd_rst_text_align_center nd_rst_toogle_title_close_1 nd_rst_width_25 nd_rst_display_none nd_rst_height_25 nd_rst_position_absolute nd_rst_top_0 nd_rst_left_0">
                              <img alt="" class="nd_rst_margin_top_6" width="12" src="'.esc_url(plugins_url('icon-less-white.png', __FILE__ )).'">
                            </span>
                            '.__('BOOKING REQUEST','nd-restaurant-reservations').'
                          </p>
                        </div>
                        
                        <div class=" nd_rst_display_none nd_rst_padding_20 nd_rst_padding_left_0 nd_rst_padding_right_0 nd_rst_toogle_content_1 nd_rst_section nd_rst_box_sizing_border_box">
                          <p>'.get_option('nd_rst_br_description').'</p>
                          <div class="nd_rst_section nd_rst_height_20"></div>
                          <button class="nd_options_first_font" onclick="nd_rst_add_to_db()">'.__('SEND REQUEST','nd-restaurant-reservations').'</button>
                        </div>

                    </div>
                    <!--END BOOKING REQUEST-->';






                    



                    
                $nd_rst_checkout_result .= '
                </div>

            </div>

        </div>
        <!--END FORM-->


        </div>


    </div>

    ';