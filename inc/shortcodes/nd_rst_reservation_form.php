<?php


//START
function nd_rst_shortcode_reservation_form($nd_rst_atts) {

    //parameters
    $nd_rst_shortcode_reservation_form = shortcode_atts( 
    array(
        'layout' => '',
    ), 
    $nd_rst_atts );


    $nd_rst_result = '';


    //START get layout
    if ( $nd_rst_shortcode_reservation_form['layout'] == '' ) { 

        //import style
        wp_enqueue_style( 'nd_rst_style_layout', esc_url(plugins_url('css/reservation-form/layout-0.css', __FILE__ )) );

    } else { 

        //import style
        wp_enqueue_style( 'nd_rst_style_layout', esc_url(plugins_url('css/reservation-form/', __FILE__ )).''.$nd_rst_shortcode_reservation_form['layout'].'.css'  );

        //get colors
        $nd_rst_customizer_color_dark_1 = get_option( 'nd_rst_customizer_color_dark_1', '#2d2d2d' );
        $nd_rst_customizer_color_1 = get_option( 'nd_rst_customizer_color_1', '#c0a58a' );
        $nd_rst_customizer_color_2 = get_option( 'nd_rst_customizer_color_2', '#b66565' );


        //START inline script
        $nd_rst_style_layout_inline = '

            /*dark 1*/
            #nd_rst_steps_container h5 span{background-color: '.$nd_rst_customizer_color_dark_1.';  }
            #nd_rst_cal_occa_section { background-color: '.$nd_rst_customizer_color_dark_1.'; }
            #nd_rst_booking_step_datas_form label span { background-color: '.$nd_rst_customizer_color_dark_1.'; }
            #nd_rst_booking_step_resume_all_info { background-color: '.$nd_rst_customizer_color_dark_1.'; }
            #nd_rst_checkout_step_resume_all_info { background-color: '.$nd_rst_customizer_color_dark_1.'; }
            .nd_rst_ul_restaurant li.nd_rst_bg_color_blue { background-color: '.$nd_rst_customizer_color_dark_1.';}
            .nd_rst_ul_occasion li.nd_rst_bg_color_blue {background-color: '.$nd_rst_customizer_color_dark_1.';}
            #nd_rst_time_section .nd_rst_time.nd_rst_bg_color_blue { background-color: '.$nd_rst_customizer_color_dark_1.'; }
            .nd_rst_toogle_icon { background-color: '.$nd_rst_customizer_color_dark_1.'; }

            /*color 1*/
            #nd_rst_steps_container .nd_rst_step_active h5 span { background-color: '.$nd_rst_customizer_color_1.'; }
            .nd_rst_legend_selected span { background-color: '.$nd_rst_customizer_color_1.'; }
            .nd_rst_legend_not_available span { background-color: '.$nd_rst_customizer_color_1.'; }
            .nd_rst_cal_active.nd_rst_calendar_date{ background-color: '.$nd_rst_customizer_color_1.' !important; }
            #nd_rst_time_section p { background-color: '.$nd_rst_customizer_color_1.'; }
            #nd_rst_btn_go_to_booking { background-color: '.$nd_rst_customizer_color_1.'; }
            #nd_rst_booking_step_datas_form button { background-color: '.$nd_rst_customizer_color_1.';}
            .nd_rst_checkout_container_3 button { background-color: '.$nd_rst_customizer_color_1.'; }
            #nd_rst_checkout_step_datas_form button,#nd_rst_checkout_step_datas_form input[type="submit"] { background-color: '.$nd_rst_customizer_color_1.'; }
            .nd_rst_cal_not_set:after { background-color: '.$nd_rst_customizer_color_1.'; }

            /*color 2*/
            .nd_rst_legend_current span { background-color: '.$nd_rst_customizer_color_2.'; }
            .nd_rst_cal_today.nd_rst_calendar_date{ background-color: '.$nd_rst_customizer_color_2.'; }
          
        ';
        wp_add_inline_style( 'nd_rst_style_layout', $nd_rst_style_layout_inline );
        //END inline script


    }
    //END get layout



    if ( isset($_GET['tx']) ) {

        //recover datas from plugin settings
        $nd_rst_paypal_email = get_option('nd_rst_paypal_email');
        $nd_rst_paypal_currency = get_option('nd_rst_paypal_currency');
        $nd_rst_paypal_token = get_option('nd_rst_paypal_token');
        if ( get_option('nd_rst_paypal_dev_mode') == 1 ) { 
          $nd_rst_paypal_action_1 = 'https://www.sandbox.paypal.com/cgi-bin';
          $nd_rst_paypal_action_2 = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
        }else{
          $nd_rst_paypal_action_1 = 'https://www.paypal.com/cgi-bin';
          $nd_rst_paypal_action_2 = 'https://www.paypal.com/cgi-bin/webscr'; 
        }
        $nd_rst_paypal_tx = sanitize_text_field($_GET['tx']);
        $nd_rst_tx = $nd_rst_paypal_tx;
        $nd_rst_paypal_url = $nd_rst_paypal_action_2;


        //prepare the request
        $nd_rst_paypal_response = wp_remote_post( 

            $nd_rst_paypal_url, 

            array(
            
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 
                    'cmd' => '_notify-synch',
                    'tx' => $nd_rst_paypal_tx,
                    'at' => $nd_rst_paypal_token
                ),
                'cookies' => array()
            
            )
        );

        $nd_rst_http_paypal_response_code = wp_remote_retrieve_response_code( $nd_rst_paypal_response );


        //START if is 200
        if ( $nd_rst_http_paypal_response_code == 200 ) {
            
            $nd_rst_paypal_response_body = wp_remote_retrieve_body( $nd_rst_paypal_response );

            //START SUCCESS
            if ( strpos($nd_rst_paypal_response_body, 'SUCCESS') === 0 ) {

                $nd_rst_paypal_response = substr($nd_rst_paypal_response_body, 7);
                $nd_rst_paypal_response = urldecode($nd_rst_paypal_response);
                preg_match_all('/^([^=\s]++)=(.*+)/m', $nd_rst_paypal_response, $m, PREG_PATTERN_ORDER);
                $nd_rst_paypal_response = array_combine($m[1], $m[2]);  


                if(isset($nd_rst_paypal_response['charset']) AND strtoupper($nd_rst_paypal_response['charset']) !== 'UTF-8')
                {
                  foreach($nd_rst_paypal_response as $key => &$value)
                  {
                    $value = mb_convert_encoding($value, 'UTF-8', $nd_rst_paypal_response['charset']);
                  }
                  $nd_rst_paypal_response['charset_original'] = $nd_rst_paypal_response['charset'];
                  $nd_rst_paypal_response['charset'] = 'UTF-8';
                }
                ksort($nd_rst_paypal_response);


                //START RECOVER ALL VARIABLES
                $nd_rst_booking_date = $nd_rst_paypal_response['payment_date'];
                $nd_rst_deposit = $nd_rst_paypal_response['mc_gross'];
                $nd_rst_booking_form_name = $nd_rst_paypal_response['first_name'];
                $nd_rst_booking_form_surname = $nd_rst_paypal_response['last_name'];
                $nd_rst_booking_form_email = $nd_rst_paypal_response['payer_email'];
                $nd_rst_restaurant = $nd_rst_paypal_response['item_number'];
                $nd_rst_currency = $nd_rst_paypal_response['mc_currency'];
                $nd_rst_custom_field_array = explode('[ndbcpm]', $nd_rst_paypal_response['custom']);
                $nd_rst_guests = $nd_rst_custom_field_array[0];
                $nd_rst_date = $nd_rst_custom_field_array[1];
                $nd_rst_time_start = $nd_rst_custom_field_array[2];
                $nd_rst_booking_form_phone = $nd_rst_custom_field_array[3];
                $nd_rst_occasion_title = $nd_rst_custom_field_array[4];
                $nd_rst_booking_form_requests = $nd_rst_custom_field_array[5];
                $nd_rst_occasion = $nd_rst_custom_field_array[6];
                $nd_rst_order_type_name = 'paypal';
                $nd_rst_order_status = 'confirmed';
                //END RECOVER ALL VARIABLES

                //calculate end time
                $nd_rst_booking_duration = get_option('nd_rst_booking_duration');
                $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
                $nd_rst_time_end = date("G:i", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($nd_rst_time_start))); //add minutes slot to start time

                //add reservation in db
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
                    $nd_rst_order_type_name,
                    $nd_rst_order_status,
                    $nd_rst_deposit,
                    $nd_rst_tx,
                    $nd_rst_currency
                );


            }
            //END SUCCESS

        }
        //END if is 200


        $nd_rst_result .= '
        <!--START step index-->
        <div id="nd_rst_steps_container" class="nd_rst_section nd_rst_text_align_center">
            <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_first ">
                <h5 class="nd_options_color_grey"><span>1</span>'.__('BROWSE','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_booking">
                <h5 class="nd_options_color_grey"><span>2</span>'.__('DETAILS','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_checkout nd_rst_step_active">
                <h5 class="nd_options_color_grey"><span>3</span>'.__('THANKS','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
        </div>
        <!--END step index-->';

        include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_thanks.php');

        $nd_rst_result .= $nd_rst_add_to_db_result;


    }elseif( isset($_POST['nd_rst_arrive_from_stripe']) ){

        //START STRIPE
        $nd_rst_guests = sanitize_text_field($_POST['nd_rst_guests']);

        //static stripe variables
        $nd_rst_deposit = get_option('nd_rst_stripe_deposit');
        //set deposit
        if ( get_option('nd_rst_deposit_guests') == 1 ){ $nd_rst_deposit = $nd_rst_deposit * $nd_rst_guests; }

        $nd_rst_amount = $nd_rst_deposit*100;
        $nd_rst_currency = get_option('nd_rst_stripe_currency');
        $nd_rst_stripe_secret_key = get_option('nd_rst_stripe_secret_key');

        //get datas
        $nd_rst_stripe_token = sanitize_text_field($_POST['stripeToken']);
        $nd_rst_restaurant = sanitize_text_field($_POST['nd_rst_restaurant']);
        $nd_rst_date = sanitize_text_field($_POST['nd_rst_date']);
        $nd_rst_time_start = sanitize_text_field($_POST['nd_rst_time']);
        $nd_rst_occasion = sanitize_text_field($_POST['nd_rst_occasion']);
        $nd_rst_booking_form_name = sanitize_text_field($_POST['nd_rst_booking_form_name']);
        $nd_rst_booking_form_surname = sanitize_text_field($_POST['nd_rst_booking_form_surname']);
        $nd_rst_booking_form_email = sanitize_email($_POST['nd_rst_booking_form_email']);
        $nd_rst_booking_form_phone = sanitize_text_field($_POST['nd_rst_booking_form_phone']);
        $nd_rst_booking_form_requests = sanitize_text_field($_POST['nd_rst_booking_form_requests']);
        $nd_rst_order_type_name = 'stripe';
        $nd_rst_order_status = 'pending';

        //occasion
        $nd_rst_occasions = get_option('nd_rst_occasions');
        $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
        $nd_rst_occasion_title = $nd_rst_occasions_array[$nd_rst_occasion];

        //calculate end time
        $nd_rst_booking_duration = get_option('nd_rst_booking_duration');
        $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
        $nd_rst_time_end = date("G:i", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($nd_rst_time_start))); //add minutes slot to start time

        
        //call the api stripe only if we are not in dev mode
        if ( get_option('nd_rst_dev_mode') == 1 ){

             

        }else{

            //convert date format
            $nd_rst_dat_new = new DateTime($nd_rst_date);
            $nd_rst_date_visual = date_format($nd_rst_dat_new, get_option('date_format'));
            $nd_rst_tim_new = new DateTime($nd_rst_time_start);
            $nd_rst_time_visual = date_format($nd_rst_tim_new, get_option('time_format'));
            
            //stripe data
            $nd_rst_description = get_the_title($nd_rst_restaurant).' : '.$nd_rst_booking_form_name.' '.$nd_rst_booking_form_surname.', '.$nd_rst_guests.' '.__('Guests','nd-restaurant-reservations').', '.$nd_rst_date_visual.', '.$nd_rst_time_visual;
            $nd_rst_source = $nd_rst_stripe_token;
            $nd_rst_stripe_url = 'https://api.stripe.com/v1/charges';


            //prepare the request
            $nd_rst_stripe_response = wp_remote_post( 

                $nd_rst_stripe_url, 

                array(
                
                    'method' => 'POST',
                    'timeout' => 45,
                    'redirection' => 5,
                    'httpversion' => '1.0',
                    'blocking' => true,
                    'headers' => array(
                        'Authorization' => 'Bearer '.$nd_rst_stripe_secret_key
                    ),
                    'body' => array( 
                        'amount' => $nd_rst_amount,
                        'currency' => $nd_rst_currency,
                        'description' => $nd_rst_description,
                        'source' => $nd_rst_source,
                        'metadata[restaurant]' => get_the_title($nd_rst_restaurant),
                        'metadata[guests]' => $nd_rst_guests,
                        'metadata[date]' => $nd_rst_date,
                        'metadata[time]' => $nd_rst_time_start,
                        'metadata[name]' => $nd_rst_booking_form_name,
                        'metadata[surname]' => $nd_rst_booking_form_surname,
                        'metadata[email]' => $nd_rst_booking_form_email,
                        'metadata[phone]' => $nd_rst_booking_form_phone,
                        'metadata[requests]' => $nd_rst_booking_form_requests
                    ),
                    'cookies' => array()
                
                )
            );

            // START check the response
            $nd_rst_http_stripe_response_code = wp_remote_retrieve_response_code( $nd_rst_stripe_response );


            if ( $nd_rst_http_stripe_response_code == 200 ) {

                $nd_rst_response_body = wp_remote_retrieve_body( $nd_rst_stripe_response );
                $nd_rst_stripe_data = json_decode( $nd_rst_response_body );

                if ( $nd_rst_stripe_data->paid == 1 ) { $nd_rst_order_status = 'confirmed'; }

                $nd_rst_tx = $nd_rst_stripe_data->id;

                //add reservation in db
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
                    $nd_rst_order_type_name,
                    $nd_rst_order_status,
                    $nd_rst_deposit,
                    $nd_rst_tx,
                    $nd_rst_currency
                );

            }


        }


        $nd_rst_result .= '
        <!--START step index-->
        <div id="nd_rst_steps_container" class="nd_rst_section nd_rst_text_align_center">
            <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_first ">
                <h5 class="nd_options_color_grey"><span>1</span>'.__('BROWSE','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_booking">
                <h5 class="nd_options_color_grey"><span>2</span>'.__('DETAILS','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_checkout nd_rst_step_active">
                <h5 class="nd_options_color_grey"><span>3</span>'.__('THANKS','nd-restaurant-reservations').'</h5>
            </div>
            <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
        </div>
        <!--END step index-->';

        include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_thanks.php');

        $nd_rst_result .= $nd_rst_add_to_db_result;

        //END STRIPE



    //START FIRST STEP SHORTCODE
    }else{



        //get options
        $nd_rst_max_guests = get_option('nd_rst_max_guests'); if ( $nd_rst_max_guests == '' ) { $nd_rst_max_guests = 10; }
        $nd_rst_occasions = get_option('nd_rst_occasions');

        
        //ajax results
        if ( get_option('nd_rst_stripe_enable') == 1 ){ 
            wp_enqueue_script( 'nd_rst_stripe_script', 'https://js.stripe.com/v3/'); 
        }


        //ajax results
        $nd_rst_ajax_params = array(
            'nd_rst_ajaxurl' => admin_url('admin-ajax.php'),
            'nd_rst_ajaxnonce' => wp_create_nonce('nd_rst_nonce'),
        );
        wp_enqueue_script( 'nd_rst_calendar_script', esc_url( plugins_url( 'nd_rst_calendar.js', __FILE__ ) ), array( 'jquery' ) ); 
        wp_localize_script( 'nd_rst_calendar_script', 'nd_rst_my_vars_calendar', $nd_rst_ajax_params );


        //START get all restaurants
        $nd_rst_rest_args = array(
          'post_type' => 'nd_rst_cpt_1',
          'posts_per_page' => -1,
          'order' => 'ASC',
          'orderby' => 'date'
        );
        $nd_rst_rest_the_query = new WP_Query( $nd_rst_rest_args );

        $nd_rst_rest_list = '';
        $nd_rst_restaurant_i = 0;
        $nd_rst_rest_single = '';
        $nd_rst_rest_list .= '<ul class="nd_rst_ul_restaurant nd_rst_display_none">';

        while ( $nd_rst_rest_the_query->have_posts() ) : $nd_rst_rest_the_query->the_post();

            //get datas
            $nd_rst_restaurant_image = '';
            $nd_rst_restaurant_id = get_the_ID();
            $nd_rst_restaurant_title = get_the_title($nd_rst_restaurant_id);

            //image
            if ( has_post_thumbnail() ) {

                $nd_rst_image_id = get_post_thumbnail_id( $nd_rst_restaurant_id );
                $nd_rst_image_src = wp_get_attachment_image_src( $nd_rst_image_id,'large');

                $nd_rst_restaurant_image .= '
                <div class="nd_rst_section nd_rst_position_relative nd_rst_restaurant_image">
                    <img class="nd_rst_section" src="'.$nd_rst_image_src[0].'">

                    <div class="nd_rst_restaurant_image_filter nd_rst_position_absolute nd_rst_left_0 nd_rst_height_100_percentage nd_rst_width_100_percentage nd_rst_box_sizing_border_box">

                        <div class="nd_rst_position_absolute nd_rst_bottom_20 nd_rst_restaurant_image_content">
                            <h3>'.$nd_rst_restaurant_title.'</h3>    
                        </div>

                    </div>

                </div>
                ';    
            }else{
                $nd_rst_restaurant_image .= '';
            }

            if ( $nd_rst_restaurant_i == 0 ) { 
                $nd_rst_restaurant_id_first = $nd_rst_restaurant_id; 
                $nd_rst_restaurant_class = ' nd_rst_bg_color_blue ';
                $nd_rst_class_single = ''; 
            }else{
                $nd_rst_restaurant_class = ''; 
                $nd_rst_class_single = 'nd_rst_display_none';
            }


            $nd_rst_rest_single .= '
            <div class="nd_rst_rest_single '.$nd_rst_class_single.' nd_rst_rest_single_'.$nd_rst_restaurant_id.' ">

                '.$nd_rst_restaurant_image.'

            </div>';

            $nd_rst_rest_list .= '<li data-restaurant="'.$nd_rst_restaurant_id.'" class="nd_rst_ulli_restaurant '.$nd_rst_restaurant_class.' ">'.$nd_rst_restaurant_title.'</li>';

            $nd_rst_restaurant_i = $nd_rst_restaurant_i + 1;

        endwhile;

        $nd_rst_rest_list .= '</ul>';

        if ( $nd_rst_restaurant_i == 0 ) {
            $nd_rst_rest_class = ' nd_rst_display_none ';
            $nd_rst_restaurant_id_first = 0;
        }else{
            $nd_rst_rest_class = '';
        }

        wp_reset_postdata();
        //END get all restaurants


        //date default
        $nd_rst_date_default = sanitize_text_field($_GET['nd_rst_send_date']);
        
        if ( $nd_rst_date_default == '' ) { 

            $nd_rst_date_default = date("Y-m-d");
            $nd_rst_day_today = date('d');
            $nd_rst_month_today = date('m');
            $nd_rst_year_today = date('Y');

        }else{
            $nd_rst_year_today = substr($nd_rst_date_default,0,4);
            $nd_rst_month_today = substr($nd_rst_date_default,5,2);
            $nd_rst_day_today = substr($nd_rst_date_default,8,2);
        }
        
        //guests default
        $nd_rst_guests_default = sanitize_text_field($_GET['nd_rst_send_guests']);
        if ( $nd_rst_guests_default == '' ) { 
            $nd_rst_guests_default = 1; 
        }

        include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_calendar.php');

        //START inline script
        $nd_rst_search_comp_rest_code = '

            jQuery(document).ready(function() {

                jQuery( function ( $ ) {


                    $(".nd_rst_rest_single").click(function() {

                        $(".nd_rst_ul_restaurant").removeClass("nd_rst_display_none");

                    }); 


                    $(".nd_rst_ulli_restaurant").click(function() {

                        $(".nd_rst_rest_single").removeClass("nd_rst_display_block");
                        $(".nd_rst_ulli_restaurant").removeClass("nd_rst_bg_color_blue");
                        var nd_rst_rest_select = $(this).attr("data-restaurant");
                        $(this).addClass("nd_rst_bg_color_blue");

                        $("#nd_rst_restaurant").val(nd_rst_rest_select);
                        
                        var nd_rst_calendar_date_select = $("#nd_rst_date").val();';

                        //call the update slots only if not dev mode
                        if ( get_option('nd_rst_dev_mode') != 1 ){ $nd_rst_search_comp_rest_code .= 'nd_rst_update_timing(nd_rst_calendar_date_select);'; }
                        
                        $nd_rst_search_comp_rest_code .= '
                        $(".nd_rst_rest_single").addClass("nd_rst_display_none");
                        $(".nd_rst_rest_single_"+nd_rst_rest_select).addClass("nd_rst_display_block");
                        $(".nd_rst_ul_restaurant").addClass("nd_rst_display_none");

                    }); 
                  
                });

            });
          
        ';
        wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_search_comp_rest_code );
        //END inline script

        //START inline script
        $nd_rst_search_compd_guests_code = '

            jQuery(document).ready(function() {

                jQuery( function ( $ ) {

                  $(".nd_rst_guests_increase").click(function() {
                    var value = $(".nd_rst_guests_number").text();
                            
                    if ( value < '.$nd_rst_max_guests.' ){
                        value++;
                        $(".nd_rst_guests_number").text(value);
                        $("#nd_rst_guests").val(value);   

                        var nd_rst_calendar_date_select = $("#nd_rst_date").val();';

                        //call the update slots only if not dev mode
                        if ( get_option('nd_rst_dev_mode') != 1 ){ $nd_rst_search_compd_guests_code .= 'nd_rst_update_timing(nd_rst_calendar_date_select);'; }

                    $nd_rst_search_compd_guests_code .= '
                    } 

                  }); 

                  $(".nd_rst_guests_decrease").click(function() {
                    var value = $(".nd_rst_guests_number").text();
                    
                    if ( value > 1 ) {
                      value--;
                      $(".nd_rst_guests_number").text(value);
                      $("#nd_rst_guests").val(value);

                      var nd_rst_calendar_date_select = $("#nd_rst_date").val();';
                      
                      //call the update slots only if not dev mode
                      if ( get_option('nd_rst_dev_mode') != 1 ){ $nd_rst_search_compd_guests_code .= 'nd_rst_update_timing(nd_rst_calendar_date_select);'; }
                      
                    $nd_rst_search_compd_guests_code .= '
                    }
                    
                  }); 
                  
                });

            });
            

        ';
        wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_search_compd_guests_code );
        //END inline script


        $nd_rst_result .= '

            <div id="nd_rst_component_container" class="nd_rst_section nd_rst_padding_30 nd_rst_box_sizing_border_box nd_rst_border_1_solid_grey">

               
                <input id="nd_rst_action_return" type="hidden" name="nd_rst_action_return" value="'.get_the_permalink().'">


                <!--START step index-->
                <div id="nd_rst_steps_container" class="nd_rst_section nd_rst_text_align_center">
                    <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
                    <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_first nd_rst_step_active">
                        <h5 class="nd_options_color_grey"><span>1</span>'.__('BROWSE','nd-restaurant-reservations').'</h5>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_booking">
                        <h5 class="nd_options_color_grey"><span>2</span>'.__('DETAILS','nd-restaurant-reservations').'</h5>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_20_percentage nd_rst_single_step nd_rst_step_checkout">
                        <h5 class="nd_options_color_grey"><span>3</span>'.__('CONFIRM','nd-restaurant-reservations').'</h5>
                    </div>
                    <div class="nd_rst_float_left nd_rst_width_20_percentage "><div class="nd_rst_section nd_rst_height_1"></div></div>
                </div>
                <!--END step index-->


                <div class="nd_rst_section nd_rst_booking_container_all">
                <div class="nd_rst_section nd_rst_booking_container_1">
                

                    <div id="nd_rst_rest_guests_legend_section" class="nd_rst_section">

                        <!--START RESTAURANT-->
                        <div id="nd_rst_section_restaurant" class="nd_rst_section '.$nd_rst_rest_class.' ">
                            <label class="" for="nd_rst_restaurant">'.__('Restaurant','nd-restaurant-reservations').'</label>
                            
                            <div class="nd_rst_section nd_rst_position_relative">
                                '.$nd_rst_rest_single.'
                                '.$nd_rst_rest_list.'
                            </div>
                            
                            <input readonly class="nd_rst_display_none_important" type="number" name="nd_rst_restaurant" id="nd_rst_restaurant" value="'.$nd_rst_restaurant_id_first.'">

                        </div>
                        <!--END RESTAURANT-->



                        <div id="nd_rst_guests_legend_section" class="nd_rst_section">
                            
                            <!--START GUESTS-->
                            <div id="nd_rst_guests_section" class="nd_rst_section">
                                
                                <h3 class="">'.__('Guests','nd-restaurant-reservations').'</h3>

                                <div class=" nd_rst_section">

                                    <div class=" nd_rst_guest_number  nd_rst_section">
                                        <h1 class="nd_rst_guests_number nd_rst_margin_0 nd_rst_padding_0">'.$nd_rst_guests_default.'</h1> 


                                        <div class=" nd_rst_guest_number_add  nd_rst_width_50_percentage">
                                            <button class="nd_rst_guests_increase" type="button">'.__('Add','nd-restaurant-reservations').'</button>
                                        </div>

                                        <div class=" nd_rst_guest_number_remove  nd_rst_width_50_percentage">
                                            <button class="nd_rst_guests_decrease" type="button">'.__('Remove','nd-restaurant-reservations').'</button>
                                        </div>


                                    </div>

                                    

                                </div>

                                <input readonly class="nd_rst_display_none_important" type="number" name="nd_rst_guests" id="nd_rst_guests" min="1" value="'.$nd_rst_guests_default.'">

                            </div>
                            <!--END GUESTS-->            

                            <!--START LEGEND-->
                            <div id="nd_rst_legend_section" class="nd_rst_section">
                                <p class="nd_rst_legend_current"><span></span>'.__('Current Day','nd-restaurant-reservations').'</p>
                                <p class="nd_rst_legend_selected"><span></span>'.__('Selected Day','nd-restaurant-reservations').'</p>
                                <p class="nd_rst_legend_not_available"><span></span>'.__('Not Available','nd-restaurant-reservations').'</p>
                            </div>
                            <!--END LEGEND-->


                        </div>

                    </div>



                    <div id="nd_rst_cal_occa_section" class="nd_rst_section">

                        <h1 id="nd_rst_calendar_word_bg">'.__('Occasion','nd-restaurant-reservations').'</h1>';

                        
                        if ( get_option('nd_rst_dev_mode') != 1 ) {

                            $nd_rst_result .= '
                            <!--START CALENDAR-->
                            <div id="nd_rst_calendar_section" class="">
                                '.$nd_rst_calendar.'
                                <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_date" id="nd_rst_date" value="'.$nd_rst_date_default.'">
                            </div>
                            <!--END CALENDAR-->';

                        }else{

                            // script for calendar
                            wp_enqueue_script('jquery-ui-datepicker');
                            wp_enqueue_style('jquery-ui-datepicker-dev', esc_url(plugins_url('css/datepicker-dev.css', __FILE__ )) );

                            //get colors
                            $nd_rst_customizer_color_text = get_option( 'nd_options_customizer_font_color_p', '#7e7e7e' );
                            $nd_rst_customizer_color_1 = get_option( 'nd_rst_customizer_color_1', '#c0a58a' );
                            $nd_rst_customizer_color_2 = get_option( 'nd_rst_customizer_color_2', '#b66565' );


                            //START inline script
                            $nd_rst_searc_comp_l1_datepicker_code = '

                            jQuery(document).ready(function() {

                              jQuery( function ( $ ) {

                                  $( "#nd_rst_datepicker_dev" ).datepicker({
                                    defaultDate : "'.$nd_rst_date_default.'",
                                    minDate: 0,
                                    altField: "#nd_rst_date",
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
                            wp_add_inline_script( 'jquery-ui-datepicker', $nd_rst_searc_comp_l1_datepicker_code );
                            //END inline script



                            $nd_rst_datepickerdev_style = '

                                /* color */
                                #nd_rst_datepicker_dev .ui-datepicker-today { background-color: '.$nd_rst_customizer_color_2.'; }
                                #nd_rst_datepicker_dev .ui-datepicker-current-day { background-color: '.$nd_rst_customizer_color_1.'; }
                                #nd_rst_datepicker_dev .ui-state-disabled span{ color: '.$nd_rst_customizer_color_text.' !important; }

                            ';
                            wp_add_inline_style( 'jquery-ui-datepicker-dev', $nd_rst_datepickerdev_style );




                            $nd_rst_result .= '
                            <div id="nd_rst_datepicker_dev"></div>
                            <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_date" id="nd_rst_date" value="'.$nd_rst_date_default.'">';   

                        }
                        



                        //START inline script
                        $nd_rst_search_comp_occasions_code = '

                        jQuery(document).ready(function() {

                            jQuery( function ( $ ) {


                                $(".nd_rst_occas_single").click(function() {

                                    $(".nd_rst_ul_occasion").removeClass("nd_rst_display_none");

                                }); 


                                $(".nd_rst_ulli_occasion").click(function() {

                                    $(".nd_rst_occas_single").removeClass("nd_rst_display_block");
                                    $(".nd_rst_ulli_occasion").removeClass("nd_rst_bg_color_blue");
                                    var nd_rst_occas_select = $(this).attr("data-occasion");
                                    $(this).addClass("nd_rst_bg_color_blue");

                                    $("#nd_rst_occasion").val(nd_rst_occas_select);

                                    $(".nd_rst_occas_single").addClass("nd_rst_display_none");
                                    $(".nd_rst_occas_single_"+nd_rst_occas_select).addClass("nd_rst_display_block");
                                    $(".nd_rst_ul_occasion").addClass("nd_rst_display_none");

                                }); 
                              
                            });

                        });    

                        ';
                        wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_search_comp_occasions_code );
                        //END inline script



                        if ( $nd_rst_occasions == '' ) {
                            $nd_rst_occasion_class = 'nd_rst_display_none'; 
                            $nd_rst_occasion_default_value = 'null';  
                        }else { 
                            $nd_rst_occasion_class = ''; 
                            $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
                            $nd_rst_occasion_default_value = 0;  
                        }

                        $nd_rst_result .= '
                        <!--START OCCASION-->
                        <div id="nd_rst_occasion_section" class="nd_rst_section">
                            <div id="nd_rst_occasion_cont" class="nd_rst_section '.$nd_rst_occasion_class.' ">
                                <h3 class="">'.__('Occasion','nd-restaurant-reservations').' :</h3>

                                <div id="nd_rst_occasion_cont_change" class="nd_rst_section nd_rst_position_relative">';


                                    for ( $nd_rst_occasions_array_i = 0; $nd_rst_occasions_array_i < count($nd_rst_occasions_array); $nd_rst_occasions_array_i++) { 
                                        
                                        if ( $nd_rst_occasions_array_i != 0 ) { $nd_rst_oc_class = ' nd_rst_display_none '; } else { $nd_rst_oc_class = ''; }
                                        
                                        $nd_rst_result .= '<div class="nd_rst_occas_single '.$nd_rst_oc_class.' nd_rst_occas_single_'.$nd_rst_occasions_array_i.'">'.$nd_rst_occasions_array[$nd_rst_occasions_array_i].'</div>';   
                                        
                                         
                                    }   
                                
                                    $nd_rst_result .= '<ul class="nd_rst_ul_occasion nd_rst_display_none">';

                                    for ( $nd_rst_occasions_array_i = 0; $nd_rst_occasions_array_i < count($nd_rst_occasions_array); $nd_rst_occasions_array_i++) { 
                                        
                                        if ( $nd_rst_occasions_array_i == 0 ) { $nd_rst_oc_class = ' nd_rst_bg_color_blue '; } else { $nd_rst_oc_class = ' '; }
                                        
                                        $nd_rst_result .= '<li data-occasion="'.$nd_rst_occasions_array_i.'" class="nd_rst_ulli_occasion '.$nd_rst_oc_class.' ">'.$nd_rst_occasions_array[$nd_rst_occasions_array_i].'</li>';   
                                          
                                    } 

                                    $nd_rst_result .= '</ul>';


                                $nd_rst_result .= '
                                </div>
                            
                            </div>

                            <input readonly class="nd_rst_display_none_important" type="text" name="nd_rst_occasion" id="nd_rst_occasion" value="'.$nd_rst_occasion_default_value.'">

                        </div>
                        <!--END OCCASION-->

                    </div>';




                    //START inline script
                    $nd_rst_searc_comp_timee_code = '
                        
                        jQuery(document).ready(function() {

                        jQuery( function ( $ ) {

                          $(".nd_rst_time").click(function() {

                            $(".nd_rst_time").removeClass("nd_rst_bg_color_blue");
                            var nd_rst_calendar_time_select = $(this).attr("data-time");
                            $(this).addClass("nd_rst_bg_color_blue");

                            $("#nd_rst_time").val(nd_rst_calendar_time_select);

                          }); 
                          
                        });

                      });

                    ';
                    wp_add_inline_script( 'nd_rst_calendar_script', $nd_rst_searc_comp_timee_code );
                    //END inline script


                    $nd_rst_result .= '
                    <div id="nd_rst_time_section" class="nd_rst_section">
                        <h3 class="">'.__('Time','nd-restaurant-reservations').' :</h3>
                    
                        <ul id="nd_rst_all_time_slots_container" class="nd_rst_margin_0 nd_rst_padding_0 nd_rst_list_style_none">
                            '.nd_rst_get_timing($nd_rst_date_default,$nd_rst_guests_default,$nd_rst_restaurant_id_first).'
                        </ul>
                    </div>
                    <!--END TIME-->



                    <div id="nd_rst_btn_go_to_booking_container" class="nd_rst_section">
                        <button class="nd_options_first_font" id="nd_rst_btn_go_to_booking" onclick="nd_rst_go_to_booking()">'.__('BOOK A TABLE','nd-restaurant-reservations').'</button>
                    </div>


                </div>

            </div>
            </div>

        ';

    }





    return $nd_rst_result;
  

}
//END
add_shortcode('nd_rst_reservation_form', 'nd_rst_shortcode_reservation_form');





//START function for AJAX
function nd_rst_calendar_php() {

    check_ajax_referer( 'nd_rst_nonce', 'nd_rst_calendar_security' );

    $nd_rst_real_month_today = date('m');
    $nd_rst_real_day_today = date('d');
    $nd_rst_real_year_today = date('Y');

    //recover var
    $nd_rst_month_today = sanitize_text_field($_GET['nd_rst_month']);
    $nd_rst_year_today = sanitize_text_field($_GET['nd_rst_year']);
    
    $nd_rst_selected_date = sanitize_text_field($_GET['nd_rst_selected_date']);
    $nd_rst_selected_dates = explode("-", $nd_rst_selected_date);
    $nd_rst_selected_year = $nd_rst_selected_dates[0];
    $nd_rst_selected_month = $nd_rst_selected_dates[1];
    $nd_rst_selected_day = $nd_rst_selected_dates[2];

    $nd_rst_day_today = date("d");
    $nd_rst_new_date = $nd_rst_year_today.'-'.$nd_rst_month_today.'-'.$nd_rst_day_today;
    $nd_rst_tot_days_this_month = cal_days_in_month(CAL_GREGORIAN, $nd_rst_month_today, $nd_rst_year_today);

    //calculate next and prev date
    $nd_rst_next_month = nd_rst_get_next_prev_month_year($nd_rst_new_date,'month','next');
    $nd_rst_next_year = nd_rst_get_next_prev_month_year($nd_rst_new_date,'year','next');
    $nd_rst_prev_month = nd_rst_get_next_prev_month_year($nd_rst_new_date,'month','prev');
    $nd_rst_prev_year = nd_rst_get_next_prev_month_year($nd_rst_new_date,'year','prev');

    //variables
    $nd_rst_date_cell_width = 100/$nd_rst_tot_days_this_month;
    $nd_rst_get_month_name_date = $nd_rst_year_today.'-'.$nd_rst_month_today.'-1';
    $nd_rst_calendar = '';

    //prev button
    if ( $nd_rst_month_today == $nd_rst_real_month_today AND $nd_rst_year_today == $nd_rst_real_year_today ) { 
        $nd_rst_button_prev = '
        <div class="nd_rst_section nd_rst_height_1"></div>';
    }else{
        $nd_rst_button_prev = '
        <input type="hidden" name="nd_rst_prev_month" id="nd_rst_prev_month" value="'.$nd_rst_prev_month.'">
        <input type="hidden" name="nd_rst_prev_year" id="nd_rst_prev_year" value="'.$nd_rst_prev_year.'">
        <button onclick="nd_rst_calendar(1)" class="nd_rst_prev_next_cal nd_rst_float_left" type="button">'.__('Prev','nd-restaurant-reservations').'</button>';
    }

    //START CALENDAR CONTENT
    $nd_rst_calendar .= '
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

                if ( strlen($nd_rst_i) == 1 ) {  
                    $nd_rst_i_visual = '0'.$nd_rst_i;    
                }else{
                    $nd_rst_i_visual = $nd_rst_i; 
                }
                $nd_rst_calendar .= '<div class="nd_rst_float_left nd_rst_width_14_percentage"><p data-date="'.$nd_rst_year_today.'-'.$nd_rst_month_today.'-'.$nd_rst_i_visual.'" class="'.$nd_rst_class.'">'.$nd_rst_i.'</p></div>';      

            }

        $nd_rst_calendar .= '
        </div>';

    $nd_rst_calendar .= '
    </div>';
    //END CALENDAR


    $nd_rst_calendar_result = '';
    $nd_rst_calendar_result .= $nd_rst_calendar;

    $nd_rst_allowed_html = [
        'div'      => [ 
            'style' => [],
            'id' => [],
            'class' => [],
        ],
        'h3'      => [ 
            'style' => [],
            'id' => [],
            'class' => [],
        ],
        'input'      => [  
            'type' => [], 
            'name' => [],
            'value' => [],
            'style' => [],
            'id' => [],
            'class' => [],
        ],
        'button'      => [  
            'onclick' => [],
            'type' => [],
            'style' => [],
            'id' => [],
            'class' => [],
        ],
        'p'      => [  
            'data-date' => [],
            'style' => [],
            'id' => [],
            'class' => [],
        ],
        'strong'      => [ 
            'style' => [],
            'id' => [],
            'class' => [],
        ],
    ];
 
    echo wp_kses( $nd_rst_calendar_result, $nd_rst_allowed_html );

    die();

}
add_action( 'wp_ajax_nd_rst_calendar_php', 'nd_rst_calendar_php' );
add_action( 'wp_ajax_nopriv_nd_rst_calendar_php', 'nd_rst_calendar_php' );





//START function for AJAX
function nd_rst_booking_php() {

    check_ajax_referer( 'nd_rst_nonce', 'nd_rst_go_to_booking_security' );

    //recover var
    $nd_rst_restaurant = sanitize_text_field($_GET['nd_rst_restaurant']);
    $nd_rst_guests = sanitize_text_field($_GET['nd_rst_guests']);
    $nd_rst_date = sanitize_text_field($_GET['nd_rst_date']);
    $nd_rst_time = sanitize_text_field($_GET['nd_rst_time']);
    $nd_rst_occasion = sanitize_text_field($_GET['nd_rst_occasion']);
    $nd_rst_action_return = sanitize_text_field($_GET['nd_rst_action_return']);

    //set variables
    $nd_rst_booking_result = '';
    $nd_rst_booking_result_image = '';


    //image rest
    $nd_rst_image_id = get_post_thumbnail_id( $nd_rst_restaurant );
    $nd_rst_image_src = wp_get_attachment_image_src( $nd_rst_image_id,'large');
    $nd_rst_booking_result_image .= '

    <style>
    #nd_rst_booking_step_resume {

        background-image:url('.$nd_rst_image_src[0].');
        background-repeat:no-repeat;
        background-size: cover;
        background-position: center;
    }  
    </style>';


    //occasion
    $nd_rst_occasions = get_option('nd_rst_occasions');
    $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
    $nd_rst_occasion_title = $nd_rst_occasions_array[$nd_rst_occasion];

    include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_details.php');

    $nd_rst_allowed_html = [
        'div'      => [  
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'input'      => [  
            'type' => [], 
            'name' => [], 
            'value' => [],
            'checked' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'img'      => [  
            'src' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'p'      => [ 
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'h1'      => [ 
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'h3'      => [ 
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'span'      => [ 
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'label'      => [  
            'for' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'textarea'      => [  
            'rows' => [],
            'name' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'a'      => [  
            'target' => [], 
            'href' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'button'      => [  
            'onclick' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
    ];
 
    echo wp_kses( $nd_rst_booking_result, $nd_rst_allowed_html );

    die();

}
add_action( 'wp_ajax_nd_rst_booking_php', 'nd_rst_booking_php' );
add_action( 'wp_ajax_nopriv_nd_rst_booking_php', 'nd_rst_booking_php' );















//php function for validation fields on booking form
function nd_rst_validate_fields_php_function() {

check_ajax_referer( 'nd_rst_nonce', 'nd_rst_validate_fields_security' );

    //validate if a number is numeric
function nd_rst_is_numeric($nd_rst_number){

  if ( is_numeric($nd_rst_number) ) {
    return 1;
  }else{
    return 0;
  }

}


//validate if email is valid
function nd_rst_is_email($nd_rst_email){

  if (filter_var($nd_rst_email, FILTER_VALIDATE_EMAIL)) {
    return 1;  
  } else {
    return 0;
  }


}



  //recover datas
  $nd_rst_name = sanitize_text_field($_GET['nd_rst_name']);
  $nd_rst_surname = sanitize_text_field($_GET['nd_rst_surname']);
  $nd_rst_email = sanitize_email($_GET['nd_rst_email']);
  $nd_rst_message = sanitize_text_field($_GET['nd_rst_message']);
  $nd_rst_phone = sanitize_text_field($_GET['nd_rst_phone']);
  $nd_rst_term = sanitize_text_field($_GET['nd_rst_term']);
  
  //declare
  $nd_rst_string_result = '';


  //name
  if ( $nd_rst_name == '' ) {

    $nd_rst_result_name = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('MANDATORY','nd-restaurant-reservations').'[divider]'.'</span>';     

  }else{

    $nd_rst_result_name = 1;

    $nd_rst_string_result .= ' [divider]';   

  }

  //surname
  if ( $nd_rst_surname == '' ) {

    $nd_rst_result_surname = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('MANDATORY','nd-restaurant-reservations').'[divider]'.'</span>';     

  }else{

    $nd_rst_result_surname = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }


  //email
  if ( $nd_rst_email == '' ) {

    $nd_rst_result_email = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('MANDATORY','nd-restaurant-reservations').'[divider]'.'</span>';     

  }elseif ( nd_rst_is_email($nd_rst_email) == 0 ) {

    $nd_rst_result_email = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('NOT VALID','nd-restaurant-reservations').'[divider]'.'</span>';  

  }else{

    $nd_rst_result_email = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }



  //phone
  if ( $nd_rst_phone == '' ) {

    $nd_rst_result_phone = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('MANDATORY','nd-restaurant-reservations').'[divider]'.'</span>';     

  }elseif ( 
($nd_rst_phone) == 0 ) {

    $nd_rst_result_phone = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('NOT VALID','nd-restaurant-reservations').'[divider]'.'</span>';  

  }else{

    $nd_rst_result_phone = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }



  //message
  if ( strlen($nd_rst_message) >= 250 ) {

    $nd_rst_result_message = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('THE MAXIMUM ALLOWED CHARACTERS IS 250','nd-restaurant-reservations').'[divider]'.'</span>';     

  }else{

    $nd_rst_result_message = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }


  //term
  if ( $nd_rst_term == 0 ){

    $nd_rst_result_term = 0; 

    $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('MANDATORY','nd-restaurant-reservations').'[divider]'.'</span>';     


  }else{

    $nd_rst_result_term = 1;

    $nd_rst_string_result .= ' [divider]'; 

  }



  //coupon
  if ( $nd_rst_coupon == '' ) {

    $nd_rst_result_coupon = 1; 

    $nd_rst_string_result .= ' [divider]'; 

  }else{

    if ( nd_rst_is_coupon_valid($nd_rst_coupon) == 1 ){

      $nd_rst_result_coupon = 1; 

      $nd_rst_string_result .= ' [divider]'; 

    }else{

      $nd_rst_result_coupon = 0;

      $nd_rst_string_result .= '<span class="nd_rst_validation_errors nd_rst_margin_left_20 nd_rst_color_red">'.__('NOT VALID','nd-restaurant-reservations').'[divider]'.'</span>';     

    }
    
  }



  //Determiante the final result
  if ( $nd_rst_result_name == 1 AND  $nd_rst_result_surname == 1 AND $nd_rst_result_email == 1 AND $nd_rst_result_phone == 1 AND $nd_rst_result_message == 1 AND $nd_rst_result_term == 1 AND $nd_rst_result_coupon == 1 ){
    
    echo esc_attr(1);

  }else{

    $nd_rst_allowed_html = [
        'span'      => [ 
            'class' => [],
        ],
    ];
 
    echo wp_kses( $nd_rst_string_result, $nd_rst_allowed_html );

  }

  
     
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_rst_validate_fields_php_function', 'nd_rst_validate_fields_php_function' );
add_action( 'wp_ajax_nopriv_nd_rst_validate_fields_php_function', 'nd_rst_validate_fields_php_function' );
















//START function for AJAX
function nd_rst_checkout_php() {

    check_ajax_referer( 'nd_rst_nonce', 'nd_rst_go_to_checkout_security' );

    //recover var
    $nd_rst_restaurant = sanitize_text_field($_GET['nd_rst_restaurant']);
    $nd_rst_guests = sanitize_text_field($_GET['nd_rst_guests']);
    $nd_rst_date = sanitize_text_field($_GET['nd_rst_date']);
    $nd_rst_time = sanitize_text_field($_GET['nd_rst_time']);
    $nd_rst_occasion = sanitize_text_field($_GET['nd_rst_occasion']);
    $nd_rst_booking_form_name = sanitize_text_field($_GET['nd_rst_booking_form_name']);
    $nd_rst_booking_form_surname = sanitize_text_field($_GET['nd_rst_booking_form_surname']);
    $nd_rst_booking_form_email = sanitize_email($_GET['nd_rst_booking_form_email']);
    $nd_rst_booking_form_phone = sanitize_text_field($_GET['nd_rst_booking_form_phone']);
    $nd_rst_booking_form_requests = sanitize_text_field($_GET['nd_rst_booking_form_requests']);
    $nd_rst_action_return = sanitize_text_field($_GET['nd_rst_action_return']);


    //set variables
    $nd_rst_checkout_result = '';
    $nd_rst_checkout_result_image = '';


    //image rest
    $nd_rst_image_id = get_post_thumbnail_id( $nd_rst_restaurant );
    $nd_rst_image_src = wp_get_attachment_image_src( $nd_rst_image_id,'large');
    $nd_rst_checkout_result_image .= '

    <style>
    #nd_rst_checkout_step_resume {

        background-image:url('.$nd_rst_image_src[0].');
        background-repeat:no-repeat;
        background-size: cover;
        background-position: center;
    }  
    </style>';


    //occasion
    $nd_rst_occasions = get_option('nd_rst_occasions');
    $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
    $nd_rst_occasion_title = $nd_rst_occasions_array[$nd_rst_occasion];

    include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_confirm.php');

    $nd_rst_allowed_html = [
        'div'      => [ 
          'id' => [],
          'class' => [],
          'style' => [],
          'role' => [],
        ],
        'input'      => [
          'type' => [],
          'name' => [],
          'value' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'img'      => [
          'alt' => [],
          'width' => [],
          'src' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'p'      => [
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'h1'      => [
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'h3'      => [
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'span'      => [
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'style'      => [
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'form'      => [
          'action' => [], 
          'method' => [],
          'target' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],             
        'iframe'      => [ 
          'name' => [], 
          'frameborder' => [], 
          'allowtransparency' => [], 
          'scrolling' => [], 
          'allow' => [], 
          'src' => [],
          'title' => [], 
          'id' => [],
          'class' => [],
          'style' => [],
        ],            
        'input'      => [ 
          'type' => [],
          'name' => [],
          'value' => [],
          'aria-hidden' => [],
          'aria-label' => [], 
          'autocomplete' => [], 
          'maxlength' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],
        'script'      => [ 
          'type' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],                
        'button'      => [ 
          'onclick' => [],
          'id' => [],
          'class' => [],
          'style' => [],
        ],                       
    ];

    echo wp_kses( $nd_rst_checkout_result, $nd_rst_allowed_html );

    die();

}
add_action( 'wp_ajax_nd_rst_checkout_php', 'nd_rst_checkout_php' );
add_action( 'wp_ajax_nopriv_nd_rst_checkout_php', 'nd_rst_checkout_php' );














//START function for AJAX
function nd_rst_add_to_db_php() {

    check_ajax_referer( 'nd_rst_nonce', 'nd_rst_add_to_db_security' );

    //recover var
    $nd_rst_restaurant = sanitize_text_field($_GET['nd_rst_restaurant']);
    $nd_rst_guests = sanitize_text_field($_GET['nd_rst_guests']);
    $nd_rst_date = sanitize_text_field($_GET['nd_rst_date']);
    $nd_rst_time_start = sanitize_text_field($_GET['nd_rst_time']);
    $nd_rst_occasion = sanitize_text_field($_GET['nd_rst_occasion']);
    $nd_rst_booking_form_name = sanitize_text_field($_GET['nd_rst_booking_form_name']);
    $nd_rst_booking_form_surname = sanitize_text_field($_GET['nd_rst_booking_form_surname']);
    $nd_rst_booking_form_email = sanitize_email($_GET['nd_rst_booking_form_email']);
    $nd_rst_booking_form_phone = sanitize_text_field($_GET['nd_rst_booking_form_phone']);
    $nd_rst_booking_form_requests = sanitize_text_field($_GET['nd_rst_booking_form_requests']);
    $nd_rst_order_type = sanitize_text_field($_GET['nd_rst_order_type']);
    $nd_rst_order_status = sanitize_text_field($_GET['nd_rst_order_status']);

    $nd_rst_deposit = 0;
    $nd_rst_tx = rand(100000000,999999999);
    $nd_rst_currency = __('Not Set','nd-restaurant-reservations');

    //restaurant
    $nd_rst_image_id = get_post_thumbnail_id( $nd_rst_restaurant );
    $nd_rst_image_src = wp_get_attachment_image_src( $nd_rst_image_id,'thumbnail');

    //occasion
    $nd_rst_occasions = get_option('nd_rst_occasions');
    $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
    $nd_rst_occasion_title = $nd_rst_occasions_array[$nd_rst_occasion];

    //calculate end time
    $nd_rst_booking_duration = get_option('nd_rst_booking_duration');
    $nd_rst_booking_duration_insert = $nd_rst_booking_duration-1;
    $nd_rst_time_end = date("G:i", strtotime('+'.$nd_rst_booking_duration_insert.' minutes', strtotime($nd_rst_time_start))); //add minutes slot to start time

    //order type name
    if ( $nd_rst_order_type == 'request' ) { $nd_rst_order_type_name = __('Request','nd-restaurant-reservations');  }


    //add reservation in d
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


    $nd_rst_add_to_db_result = '';
    
    include realpath(dirname( __FILE__ ).'/include/nd_rst_reservation_thanks.php');

    $nd_rst_allowed_html = [
        'div'      => [ 
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'h3'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'img'      => [
            'alt' => [],
            'width' => [],
            'src' => [],
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'p'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'strong'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'span'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
    ];
 
    echo wp_kses( $nd_rst_add_to_db_result, $nd_rst_allowed_html );

    die();

}
add_action( 'wp_ajax_nd_rst_add_to_db_php', 'nd_rst_add_to_db_php' );
add_action( 'wp_ajax_nopriv_nd_rst_add_to_db_php', 'nd_rst_add_to_db_php' );







function nd_rst_get_timing_php(){

    check_ajax_referer( 'nd_rst_nonce', 'nd_rst_update_timing_security' );

    //recover date
    $nd_rst_date_select = sanitize_text_field($_GET['nd_rst_date_select']);
    $nd_rst_guest_select = sanitize_text_field($_GET['nd_rst_guest_select']);
    $nd_rst_restaurant = sanitize_text_field($_GET['nd_rst_restaurant']);

    $nd_rst_get_timing_result = '';

    $nd_rst_get_timing_result .= nd_rst_get_timing($nd_rst_date_select,$nd_rst_guest_select,$nd_rst_restaurant);

    $nd_rst_allowed_html = [
        'div'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'ul'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'li'      => [
            'id' => [],
            'class' => [],
            'style' => [],
        ],
        'script'      => [],
        'p'      => [
            'id' => [],
            'class' => [],
            'style' => [],
            'data-time' => [],
        ],
        'input'      => [ 
            'readonly' => [], 
            'class' => [],
            'type' => [],
            'name' => [],
            'id' => [],
            'value' => [],
        ],
    ];
 
    echo wp_kses( $nd_rst_get_timing_result, $nd_rst_allowed_html );

    die();


}
add_action( 'wp_ajax_nd_rst_get_timing_php', 'nd_rst_get_timing_php' );
add_action( 'wp_ajax_nopriv_nd_rst_get_timing_php', 'nd_rst_get_timing_php' );






