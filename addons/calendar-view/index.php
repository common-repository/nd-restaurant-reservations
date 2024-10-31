<?php




add_action('nd_rst_add_menu_page_after_order','nd_rst_add_settings_menu_calendar_view');
function nd_rst_add_settings_menu_calendar_view(){

  add_submenu_page( 'nd-restaurant-reservations-settings','Calendar', __('Calendar View','nd-restaurant-reservations'), 'manage_options', 'nd-restaurant-reservations-settings-calendar-view', 'nd_rst_add_calendar_view' );

}


function nd_rst_add_calendar_view(){

    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-datepicker-css', esc_url(plugins_url('jquery-ui-datepicker.css', __FILE__ )) );

    //recover variables
    $nd_rst_arrive_from_filter = sanitize_text_field($_POST['nd_rst_arrive_from_filter']); if ( $nd_rst_arrive_from_filter == '' ) { $nd_rst_arrive_from_filter = 0; }
    $nd_rst_order_status = sanitize_text_field($_POST['nd_rst_order_status']); if ( $nd_rst_order_status == '' ) { $nd_rst_order_status = 'confirmed'; }
    $nd_rst_date = sanitize_text_field($_POST['nd_rst_date']); if ( $nd_rst_date == '' ) { $nd_rst_date = date("Y-m-d"); }
    $nd_rst_restaurant = sanitize_text_field($_POST['nd_rst_restaurant']); if ( $nd_rst_restaurant == '' ) { 

        $nd_rst_rooms_args = array( 'posts_per_page' => 1, 'post_type'=> 'nd_rst_cpt_1', 'order' => 'ASC' );
        $nd_rst_rooms = get_posts($nd_rst_rooms_args);
        foreach ($nd_rst_rooms as $nd_rst_room) { $nd_rst_restaurant = $nd_rst_room->ID; } 

    }

    //get datas
    $nd_rst_get_opening_hour = nd_rst_get_opening_hour();
    $nd_rst_get_closing_hour = nd_rst_get_closing_hour();

    //db
    global $wpdb;
    $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';
    
    //query
    $nd_rst_orders_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_date = %s AND nd_rst_order_status = %s AND nd_rst_restaurant = %d", array( $nd_rst_date, $nd_rst_order_status, $nd_rst_restaurant ) );
    $nd_rst_orders = $wpdb->get_results( $nd_rst_orders_query );

    $nd_rst_add_calendar_view = '';
    $nd_rst_add_calendar_view .= '

    <div class="nd_rst_section nd_rst_padding_right_20 nd_rst_padding_left_2 nd_rst_box_sizing_border_box nd_rst_margin_top_25">
        
        <h1 class="nd_rst_margin_0" style="font-size: 23px; font-weight: 400;">'.__('Calendar View','nd-restaurant-reservations').'</h1>

        <ul class="subsubsub">
            <li class=""><a href="#" class="">'.__('All Reservations','nd-restaurant-reservations').' <span class="count">('.count($nd_rst_orders).')</span></a></li>
        </ul>

        <div class="nd_rst_section nd_rst_height_10"></div>

        <div class="nd_rst_section">
            
            <form method="POST"> 

                <input type="hidden" name="nd_rst_arrive_from_filter" value="1">';

                $nd_rst_add_calendar_view .= '
                <div class="nd_rst_display_table">
                    <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_padding_right_10">';

                    //restaurant
                    $nd_rst_rooms_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_rst_cpt_1' );
                    $nd_rst_rooms = get_posts($nd_rst_rooms_args); 
                    $nd_rst_add_calendar_view .= '
                    <select class="nd_rst_min_width_150" name="nd_rst_restaurant">';
                    foreach ($nd_rst_rooms as $nd_rst_room) { 
                        $nd_rst_add_calendar_view .= '<option '; if ( $nd_rst_restaurant == $nd_rst_room->ID ){ $nd_rst_add_calendar_view .= 'selected="selected"'; } $nd_rst_add_calendar_view .= ' value="'.$nd_rst_room->ID.'">'.$nd_rst_room->post_title.'</option>';
                    }
                    $nd_rst_add_calendar_view .= '
                    </select>

                </div>';
                //end restaurants



                //date
                $nd_rst_add_calendar_view .= '
                <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_padding_right_10">
                    <input style="line-height:20px;" type="text" id="nd_rst_datepicker" name="nd_rst_date" value="'.$nd_rst_date.'">
                </div>
                ';
                //end date


                //START inline script
                $nd_rst_search_comp_l1_datepicker_code = '

                    jQuery(document).ready(function() {

                        jQuery( function ( $ ) {

                            $( function() {

                                $( "#nd_rst_datepicker" ).datepicker({
                                  defaultDate: "+1w",
                                  firstDay: 0,
                                  dateFormat: "yy-mm-dd",
                                  monthNames: ["'.__('January','nd-restaurant-reservations').'","'.__('February','nd-restaurant-reservations').'","'.__('March','nd-restaurant-reservations').'","'.__('April','nd-restaurant-reservations').'","'.__('May','nd-restaurant-reservations').'","'.__('June','nd-restaurant-reservations').'", "'.__('July','nd-restaurant-reservations').'","'.__('August','nd-restaurant-reservations').'","'.__('September','nd-restaurant-reservations').'","'.__('October','nd-restaurant-reservations').'","'.__('November','nd-restaurant-reservations').'","'.__('December','nd-restaurant-reservations').'"],
                                  monthNamesShort: [ "'.__('Jan','nd-restaurant-reservations').'", "'.__('Feb','nd-restaurant-reservations').'", "'.__('Mar','nd-restaurant-reservations').'", "'.__('Apr','nd-restaurant-reservations').'", "'.__('Maj','nd-restaurant-reservations').'", "'.__('Jun','nd-restaurant-reservations').'", "'.__('Jul','nd-restaurant-reservations').'", "'.__('Aug','nd-restaurant-reservations').'", "'.__('Sep','nd-restaurant-reservations').'", "'.__('Oct','nd-restaurant-reservations').'", "'.__('Nov','nd-restaurant-reservations').'", "'.__('Dec','nd-restaurant-reservations').'" ],
                                  dayNamesMin: ["'.__('S','nd-restaurant-reservations').'","'.__('M','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('W','nd-restaurant-reservations').'","'.__('T','nd-restaurant-reservations').'","'.__('F','nd-restaurant-reservations').'", "'.__('S','nd-restaurant-reservations').'"],
                                  nextText: "'.__('NEXT','nd-restaurant-reservations').'",
                                  prevText: "'.__('PREV','nd-restaurant-reservations').'",
                                  beforeShow : function() {
                                    $("#ui-datepicker-div").addClass( "nd_rst_calendar_view_backend" );
                                  }
                                });
                                

                            } );
                          
                        });

                      });
                  
                ';
                wp_add_inline_script( 'jquery-ui-datepicker', $nd_rst_search_comp_l1_datepicker_code );
                //END inline script


                //order status
                $nd_rst_add_calendar_view .= '
                <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_padding_right_10">
                    <select class="nd_rst_min_width_150" name="nd_rst_order_status">
                        <option '; if( $nd_rst_order_status == 'confirmed' ){ $nd_rst_add_calendar_view .= 'selected="selected"'; }  $nd_rst_add_calendar_view .= ' value="confirmed">'.__('Confirmed','nd-restaurant-reservations').'</option>
                        <option '; if( $nd_rst_order_status == 'pending' ){ $nd_rst_add_calendar_view .= 'selected="selected"'; }  $nd_rst_add_calendar_view .= ' value="pending">'.__('Pending','nd-restaurant-reservations').'</option>
                    </select>
                </div>';
                //end order status


                $nd_rst_add_calendar_view .= '
                <div class="nd_rst_display_table_cell nd_rst_vertical_align_middle nd_rst_padding_right_10">
                    <input type="submit" class="button" value="'.__('Filter','nd-restaurant-reservations').'">
                </div>';

                
                $nd_rst_add_calendar_view .= '
                </div>';


            $nd_rst_add_calendar_view .= '
            </form>

        </div>


        <div class="nd_rst_section">

            <div style="background-color:#fff; border:1px solid #e1e1e1; width:30%; border-right-width: 0px;" class="nd_rst_section nd_rst_margin_top_20 nd_rst_box_sizing_border_box">
            
                <div id="nd_rst_order_info_container" class="nd_rst_float_left nd_rst_width_100_percentage">
                    <div style="border-bottom: 1px solid #e1e1e1;" class="nd_rst_section">
 
                            <p style="padding:0px 12px;" class="nd_rst_section"><span class="nd_rst_section">'.__('Reservations','nd-restaurant-reservations').'</span></p>

                    </div>';

                    $nd_rst_bg_i = 0;
                    $nd_rst_add_calendar_view .= '<div class="nd_rst_section">'; 
                    foreach ( $nd_rst_orders as $nd_rst_order ) 
                    {

                        //bg class
                        if ( $nd_rst_bg_i & 1 ) {
                            $nd_rst_bg_class = ' nd_rst_tr_lightt ';
                        }else{
                            $nd_rst_bg_class = ' nd_rst_tr_darkk ';
                        }

                        //get avatar
                        $nd_rst_account_avatar_url_args = array( 'size'   => 100 );
                        $nd_rst_account_avatar_url = get_avatar_url($nd_rst_order->nd_rst_booking_form_email, $nd_rst_account_avatar_url_args);

                        $nd_rst_add_calendar_view .= '

                            <div style="padding:12px; height:65px;" class=" '.$nd_rst_bg_class.' nd_rst_box_sizing_border_box nd_rst_section">


                                <div style="width:50px;" class="nd_rst_float_left">
                                  <img width="40" src="'.$nd_rst_account_avatar_url.'">
                                </div>
                                <div class="nd_rst_float_left">
                                  <span class="nd_rst_section">'.$nd_rst_order->nd_rst_booking_form_name.'</span>
                                  <form action="'.admin_url('admin.php?page=nd-restaurant-reservations-settings-orders').'" class="nd_rst_float_left" method="POST">
                                    <input type="hidden" name="edit_order_id" value="'.$nd_rst_order->id.'">
                                    <input type="submit" class="nd_rst_edit" value="'.__('View','nd-restaurant-reservations').'">
                                  </form>
                                  <form action="'.admin_url('admin.php?page=nd-restaurant-reservations-settings-orders').'" class="nd_rst_float_left nd_rst_padding_left_10" method="POST">
                                    <input type="hidden" name="delete_order_id" value="'.$nd_rst_order->id.'">
                                    <input type="submit" class="nd_rst_delete" value="'.__('Delete','nd-restaurant-reservations').'">
                                  </form>
                                </div>


                            </div>

                        ';  

                         $nd_rst_bg_i = $nd_rst_bg_i + 1;

                    }
                    $nd_rst_add_calendar_view .= '</div>'; 

                $nd_rst_add_calendar_view .= '
                </div>

            </div>


        
            <div style="background-color:#fff; border:1px solid #e1e1e1; width:70%; overflow: scroll; border-left-width: 0px;" class="nd_rst_section nd_rst_margin_top_20 nd_rst_box_sizing_border_box">

                <div style="cursor:move;" id="nd_rst_order_container" class="nd_rst_float_left nd_rst_width_100_percentage">';
            
                $nd_rst_time_slot = $nd_rst_get_opening_hour;
                
                $nd_rst_width_i = 0;

                $nd_rst_add_calendar_view .= '<div style="border-bottom: 1px solid #e1e1e1;" class="nd_rst_section">';
                while ( strtotime($nd_rst_time_slot) <= strtotime($nd_rst_get_closing_hour) ) {

                    $nd_rst_add_calendar_view .= '
                    <div class="nd_rst_float_left nd_rst_text_align_center" style="width:50px">    
                        <p class="nd_rst_section"><span class="nd_rst_section">'.$nd_rst_time_slot.'</span></p>
                    </div>
                    ';

                    $nd_rst_time_slot = date("H:i", strtotime('+ 30 minutes', strtotime($nd_rst_time_slot)));
                    $nd_rst_width_i = $nd_rst_width_i + 1;

                }
                $nd_rst_add_calendar_view .= '</div>';

                $nd_rst_section_width = 50*$nd_rst_width_i;


                //START inline script
                $nd_rst_cal_view_style = '

                    #nd_rst_order_container { width:'.$nd_rst_section_width.'px; }

                    .nd_rst_order_active.pending{ background-color:#e68843; }
                    .nd_rst_order_active.confirmed{ background-color:#54ce59; }

                    .nd_rst_tr_lightt { background-color:#fff; }
                    .nd_rst_tr_darkk { background-color:#f9f9f9; }

                    .nd_rst_edit {
                        color: #0073aa;
                        cursor: pointer;
                        background: none;
                        border: 0px;
                        font-size: 13px;
                        padding: 0px; 
                      }
                      .nd_rst_edit:hover {
                        color:#00a0d2;  
                      }
                      .nd_rst_delete {
                        color: #a00;
                        cursor: pointer;
                        background: none;
                        border: 0px;
                        font-size: 13px;
                        padding: 0px; 
                      }
                  
                ';
                wp_add_inline_style( 'jquery-ui-datepicker-css', $nd_rst_cal_view_style );
                //END inline script



                //START ALL ORDERS
                if ( empty($nd_rst_orders) ) { 
                    //any orders
                }else{
        




                    $nd_rst_add_calendar_view .= '<div class="nd_rst_section nd_rst_all_order_content">';
                    $nd_rst_bg_i = 0;
                    foreach ( $nd_rst_orders as $nd_rst_order ) 
                    {
                
                        $nd_rst_order_time_start = $nd_rst_order->nd_rst_time_start;
                        $nd_rst_time_end = $nd_rst_order->nd_rst_time_end;

                        //bg class
                        if ( $nd_rst_bg_i & 1 ) {
                            $nd_rst_bg_class = ' nd_rst_tr_lightt ';
                        }else{
                            $nd_rst_bg_class = ' nd_rst_tr_darkk ';
                        }

                        $nd_rst_add_calendar_view .= '<div style="padding:12px 0px; height:65px;" class=" '.$nd_rst_bg_class.' nd_rst_box_sizing_border_box nd_rst_section nd_rst_single_order_content nd_rst_single_order_content_'.$nd_rst_order->id.'">';
                        $nd_rst_time_slot = $nd_rst_get_opening_hour;
                        while ( strtotime($nd_rst_time_slot) <= strtotime($nd_rst_get_closing_hour) ) {

                            if ( strtotime($nd_rst_time_slot) >= strtotime($nd_rst_order_time_start) AND strtotime($nd_rst_time_slot) <= strtotime($nd_rst_time_end) ) {
                                $nd_rst_slot_class = ' nd_rst_order_active '.$nd_rst_order->nd_rst_order_status.' ';
                            }else{
                                $nd_rst_slot_class = '';   
                            }

                            $nd_rst_add_calendar_view .= '
                            <div class=" '.$nd_rst_slot_class.' nd_rst_single_slot nd_rst_single_slot_'.str_replace(':','_',$nd_rst_time_slot).' nd_rst_float_left nd_rst_text_align_center" style="width:50px; margin-top:7px;">    
                                <p class="nd_rst_section"><span class="nd_rst_section"></span></p>
                            </div>
                            ';

                            $nd_rst_time_slot = date("H:i", strtotime('+ 30 minutes', strtotime($nd_rst_time_slot))); 

                        }
                        $nd_rst_add_calendar_view .= '</div>';

                        $nd_rst_bg_i = $nd_rst_bg_i+1;


                    }
                    $nd_rst_add_calendar_view .= '</div>';

                }


                $nd_rst_add_calendar_view .= '
                </div>
            </div>
        </div>
    </div>';  


    $nd_rst_allowed_html = [
        'div'      => [ 
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'h1'      => [
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'p'      => [
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'ul'      => [
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'li'      => [
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'a'      => [
            'href' => [],
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'span'      => [
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'form'      => [
            'method' => [],
            'class' => [],
            'id' => [],
            'style' => [],
            'action' => [],
        ],
        'input'      => [
            'type' => [],
            'name' => [],
            'value' => [],
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'select'      => [
            'name' => [],
            'class' => [],
            'id' => [],
            'style' => [],
        ],
        'img'      => [
            'width' => [],
            'src' => [],
        ],
        'option'      => [
            'value' => [],
            'selected' => [],
            'class' => [],
            'id' => [],
            'style' => [],
        ],
    ];

    echo wp_kses( $nd_rst_add_calendar_view, $nd_rst_allowed_html );    

}


