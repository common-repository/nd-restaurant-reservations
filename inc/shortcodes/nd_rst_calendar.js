//START function
function nd_rst_update_timing(nd_rst_date_select){

  //add layer for avoid double click
  jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_all_time_slots_single_layer'></div>" );

  var nd_rst_guest_select = jQuery( "#nd_rst_guests").val();
  var nd_rst_restaurant = jQuery( "#nd_rst_restaurant").val();

  //START post method
  jQuery.get(
    
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_get_timing_php',
      nd_rst_date_select: nd_rst_date_select,
      nd_rst_guest_select: nd_rst_guest_select,
      nd_rst_restaurant: nd_rst_restaurant,
      nd_rst_update_timing_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax

    //START success
    function( nd_rst_get_timing_result ) {

      jQuery( ".nd_rst_all_time_slots_single" ).remove();
      jQuery( "#nd_rst_all_time_slots_container" ).append(nd_rst_get_timing_result);
      jQuery( ".nd_rst_all_time_slots_single li:first-child p" ).trigger( "click" );

      //remove layer
      jQuery( "#nd_rst_all_time_slots_single_layer" ).remove();  

      //update time select on click
      jQuery(".nd_rst_time").click(function() {

        jQuery(".nd_rst_time").removeClass("nd_rst_bg_color_blue");
        var nd_rst_calendar_time_select = jQuery(this).attr("data-time");
        jQuery(this).addClass("nd_rst_bg_color_blue");

        jQuery("#nd_rst_time").val(nd_rst_calendar_time_select);

      });

    }
    //END

    

  );
  //END


}




function nd_rst_add_to_db(){

  //add layer for avoid double click
  jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_component_container_layer'></div>" );

  //add loader
  var nd_rst_sorting_result_loader = jQuery('<div id="nd_rst_sorting_result_loader"></div>').hide();
  jQuery( "#nd_rst_component_container" ).append(nd_rst_sorting_result_loader);
  nd_rst_sorting_result_loader.fadeIn('slow');


  var nd_rst_restaurant = jQuery( "#nd_rst_restaurant").val();
  var nd_rst_guests = jQuery( "#nd_rst_guests").val();
  var nd_rst_date = jQuery( "#nd_rst_date").val();
  var nd_rst_time = jQuery( "#nd_rst_time").val();
  var nd_rst_occasion = jQuery( "#nd_rst_occasion").val();
  var nd_rst_booking_form_name = jQuery( "#nd_rst_booking_form_name").val();
  var nd_rst_booking_form_surname = jQuery( "#nd_rst_booking_form_surname").val();
  var nd_rst_booking_form_email = jQuery( "#nd_rst_booking_form_email").val();
  var nd_rst_booking_form_phone = jQuery( "#nd_rst_booking_form_phone").val();
  var nd_rst_booking_form_requests = jQuery( "#nd_rst_booking_form_requests").val();
  var nd_rst_order_type = jQuery( "#nd_rst_order_type").val();
  var nd_rst_order_status = jQuery( "#nd_rst_order_status").val();


  //START post method
  jQuery.get(
    
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_add_to_db_php',
      nd_rst_restaurant: nd_rst_restaurant,
      nd_rst_guests: nd_rst_guests,
      nd_rst_date: nd_rst_date,
      nd_rst_time: nd_rst_time,
      nd_rst_occasion: nd_rst_occasion,
      nd_rst_booking_form_name: nd_rst_booking_form_name,
      nd_rst_booking_form_surname: nd_rst_booking_form_surname,
      nd_rst_booking_form_email: nd_rst_booking_form_email,
      nd_rst_booking_form_phone: nd_rst_booking_form_phone,
      nd_rst_booking_form_requests: nd_rst_booking_form_requests,
      nd_rst_order_type: nd_rst_order_type,
      nd_rst_order_status: nd_rst_order_status,
      nd_rst_add_to_db_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax

    //START success
    function( nd_rst_add_to_db_result ) {

      jQuery( ".nd_rst_booking_container_3" ).remove();
      jQuery( ".nd_rst_booking_container_all" ).append(nd_rst_add_to_db_result);


      //remove loader
      jQuery( "#nd_rst_sorting_result_loader" ).fadeOut( "slow", function() {
        jQuery( "#nd_rst_sorting_result_loader" ).remove();  
      });

      //remove layer
      jQuery( "#nd_rst_component_container_layer" ).remove();

    }
    //END

    

  );
  //END

}
















function nd_rst_go_to_checkout(){

  //add layer for avoid double click
  jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_component_container_layer'></div>" );

  //add loader
  var nd_rst_sorting_result_loader = jQuery('<div id="nd_rst_sorting_result_loader"></div>').hide();
  jQuery( "#nd_rst_component_container" ).append(nd_rst_sorting_result_loader);
  nd_rst_sorting_result_loader.fadeIn('slow');

  var nd_rst_restaurant = jQuery( "#nd_rst_restaurant").val();
  var nd_rst_guests = jQuery( "#nd_rst_guests").val();
  var nd_rst_date = jQuery( "#nd_rst_date").val();
  var nd_rst_time = jQuery( "#nd_rst_time").val();
  var nd_rst_occasion = jQuery( "#nd_rst_occasion").val();
  var nd_rst_booking_form_name = jQuery( "#nd_rst_booking_form_name").val();
  var nd_rst_booking_form_surname = jQuery( "#nd_rst_booking_form_surname").val();
  var nd_rst_booking_form_email = jQuery( "#nd_rst_booking_form_email").val();
  var nd_rst_booking_form_phone = jQuery( "#nd_rst_booking_form_phone").val();
  var nd_rst_booking_form_requests = jQuery( "#nd_rst_booking_form_requests").val();
  var nd_rst_action_return = jQuery( "#nd_rst_action_return").val();


  //START post method
  jQuery.get(
    
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_checkout_php',
      nd_rst_restaurant: nd_rst_restaurant,
      nd_rst_guests: nd_rst_guests,
      nd_rst_date: nd_rst_date,
      nd_rst_time: nd_rst_time,
      nd_rst_occasion: nd_rst_occasion,
      nd_rst_booking_form_name: nd_rst_booking_form_name,
      nd_rst_booking_form_surname: nd_rst_booking_form_surname,
      nd_rst_booking_form_email: nd_rst_booking_form_email,
      nd_rst_booking_form_phone: nd_rst_booking_form_phone,
      nd_rst_booking_form_requests: nd_rst_booking_form_requests,
      nd_rst_action_return: nd_rst_action_return,
      nd_rst_go_to_checkout_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax

    //START success
    function( nd_rst_checkout_result ) {

      jQuery( ".nd_rst_booking_container_2" ).remove();
      jQuery( ".nd_rst_booking_container_all" ).append(nd_rst_checkout_result);


      //remove loader
      jQuery( "#nd_rst_sorting_result_loader" ).fadeOut( "slow", function() {
        jQuery( "#nd_rst_sorting_result_loader" ).remove();  
      });

      //remove layer
      jQuery( "#nd_rst_component_container_layer" ).remove();
      
      //steps
      jQuery("#nd_rst_steps_container .nd_rst_single_step").removeClass("nd_rst_step_active");
      jQuery("#nd_rst_steps_container .nd_rst_step_checkout").addClass("nd_rst_step_active");


      //toogle 3
      jQuery( ".nd_rst_toogle_title_open_3" ).click(function() {
        jQuery( ".nd_rst_toogle_content_3" ).show( "slow", function() {
          jQuery( ".nd_rst_toogle_title_open_3" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_close_3" ).css("display","block");
        });
      });
      jQuery( ".nd_rst_toogle_title_close_3" ).click(function() {
        jQuery( ".nd_rst_toogle_content_3" ).hide( "slow", function() {
          jQuery( ".nd_rst_toogle_title_close_3" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_open_3" ).css("display","block");  
        }); 
      });

      //toogle 1
      jQuery( ".nd_rst_toogle_title_open_1" ).click(function() {
        jQuery( ".nd_rst_toogle_content_1" ).show( "slow", function() {
          jQuery( ".nd_rst_toogle_title_open_1" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_close_1" ).css("display","block");
        });
      });
      jQuery( ".nd_rst_toogle_title_close_1" ).click(function() {
        jQuery( ".nd_rst_toogle_content_1" ).hide( "slow", function() {
          jQuery( ".nd_rst_toogle_title_close_1" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_open_1" ).css("display","block");  
        }); 
      });


      //toogle 2
      jQuery( ".nd_rst_toogle_title_open_2" ).click(function() {
        jQuery( ".nd_rst_toogle_content_2" ).show( "slow", function() {
          jQuery( ".nd_rst_toogle_title_open_2" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_close_2" ).css("display","block");
        });
      });
      jQuery( ".nd_rst_toogle_title_close_2" ).click(function() {
        jQuery( ".nd_rst_toogle_content_2" ).hide( "slow", function() {
          jQuery( ".nd_rst_toogle_title_close_2" ).css("display","none");
          jQuery( ".nd_rst_toogle_title_open_2" ).css("display","block");  
        }); 
      });

    }
    //END

    

  );
  //END

}














function nd_rst_validate_fields(){

  //variables
  var nd_rst_email = jQuery( "#nd_rst_booking_form_email").val();
  var nd_rst_name = jQuery( "#nd_rst_booking_form_name").val();
  var nd_rst_surname = jQuery( "#nd_rst_booking_form_surname").val();
  var nd_rst_message = jQuery( "#nd_rst_booking_form_requests").val();
  var nd_rst_phone = jQuery( "#nd_rst_booking_form_phone").val();

  //term
  if ( jQuery( "#nd_rst_booking_form_term").is(':checked') ) { 
    var nd_rst_term = 1;
  }else{ 
    var nd_rst_term = 0;
  }

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_validate_fields_php_function',   
      nd_rst_email: nd_rst_email,
      nd_rst_name: nd_rst_name,
      nd_rst_surname: nd_rst_surname,
      nd_rst_message: nd_rst_message,
      nd_rst_phone: nd_rst_phone,
      nd_rst_term: nd_rst_term,
      nd_rst_validate_fields_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax


    //START success
    function( nd_rst_validate_fields_result ) {

      //add layer for avoid double click
      jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_all_time_slots_single_layer'></div>" );

     if ( nd_rst_validate_fields_result == 1 ){

        jQuery( ".nd_rst_validation_errors").remove();
        jQuery("#nd_rst_submit_go_to_checkout").trigger("click");
        
     }else{
        
        jQuery( ".nd_rst_validation_errors").remove();

        //split all result
        var nd_rst_errors_validation = nd_rst_validate_fields_result.split("[divider]");
        
        //declare variables
        var nd_rst_error_validation_name = nd_rst_errors_validation[0];
        var nd_rst_error_validation_surname = nd_rst_errors_validation[1];
        var nd_rst_error_validation_email = nd_rst_errors_validation[2];
        var nd_rst_error_validation_phone = nd_rst_errors_validation[3];
        var nd_rst_error_validation_message = nd_rst_errors_validation[4];
        var nd_rst_error_validation_term = nd_rst_errors_validation[5]

        jQuery( "#nd_rst_booking_form_name_container label").append(nd_rst_error_validation_name);
        jQuery( "#nd_rst_booking_form_surname_container label").append(nd_rst_error_validation_surname);
        jQuery( "#nd_rst_booking_form_email_container label").append(nd_rst_error_validation_email);
        jQuery( "#nd_rst_booking_form_phone_container label").append(nd_rst_error_validation_phone);
        jQuery( "#nd_rst_booking_form_requests_container label").append(nd_rst_error_validation_message);
        jQuery( "#nd_rst_booking_form_term_container label").append(nd_rst_error_validation_term);
     
     }

     //remove layer
      jQuery( "#nd_rst_all_time_slots_single_layer" ).remove();  

     

    }
    //END

  
  );
  //END

  
}
//END function








//START functions
function nd_rst_go_to_booking(){

  //add layer for avoid double click
  jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_component_container_layer'></div>" );

  //add loader
  var nd_rst_sorting_result_loader = jQuery('<div id="nd_rst_sorting_result_loader"></div>').hide();
  jQuery( "#nd_rst_component_container" ).append(nd_rst_sorting_result_loader);
  nd_rst_sorting_result_loader.fadeIn('slow');

  //get all variables
  var nd_rst_restaurant = jQuery( "#nd_rst_restaurant").val();
  var nd_rst_guests = jQuery( "#nd_rst_guests").val();
  var nd_rst_date = jQuery( "#nd_rst_date").val();
  var nd_rst_time = jQuery( "#nd_rst_time").val();
  var nd_rst_occasion = jQuery( "#nd_rst_occasion").val();
  var nd_rst_action_return = jQuery( "#nd_rst_action_return").val();


  //START post method
  jQuery.get(
    
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_booking_php',
      nd_rst_restaurant : nd_rst_restaurant,
      nd_rst_guests : nd_rst_guests,
      nd_rst_date : nd_rst_date,
      nd_rst_time : nd_rst_time,
      nd_rst_occasion : nd_rst_occasion,
      nd_rst_action_return : nd_rst_action_return,
      nd_rst_go_to_booking_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax

    //START success
    function( nd_rst_booking_result ) {

      jQuery( ".nd_rst_booking_container_1" ).remove();
      jQuery( ".nd_rst_booking_container_all" ).append(nd_rst_booking_result);

      //remove loader
      jQuery( "#nd_rst_sorting_result_loader" ).fadeOut( "slow", function() {
        jQuery( "#nd_rst_sorting_result_loader" ).remove();  
      });

      //remove layer
      jQuery( "#nd_rst_component_container_layer" ).remove();

      jQuery("#nd_rst_steps_container .nd_rst_single_step").removeClass("nd_rst_step_active");
      jQuery("#nd_rst_steps_container .nd_rst_step_booking").addClass("nd_rst_step_active");

    }
    //END

    

  );
  //END




}





function nd_rst_calendar(nd_rst_action){

  //add layer for avoid double click
  jQuery( "#nd_rst_component_container" ).append( "<div id='nd_rst_all_time_slots_single_layer'></div>" );

  var nd_rst_prev_month = jQuery( "#nd_rst_prev_month").val();
  var nd_rst_prev_year = jQuery( "#nd_rst_prev_year").val();
  var nd_rst_next_month = jQuery( "#nd_rst_next_month").val();
  var nd_rst_next_year = jQuery( "#nd_rst_next_year").val();
  var nd_rst_selected_date = jQuery( "#nd_rst_date").val();

  //variables passed on function
  if( nd_rst_action === 1){
    var nd_rst_month = nd_rst_prev_month;
    var nd_rst_year = nd_rst_prev_year;
  }else{
    var nd_rst_month = nd_rst_next_month;
    var nd_rst_year = nd_rst_next_year;
  }

  //START post method
  jQuery.get(
    
    //ajax
    nd_rst_my_vars_calendar.nd_rst_ajaxurl,
    {
      action : 'nd_rst_calendar_php',
      nd_rst_month : nd_rst_month,
      nd_rst_year : nd_rst_year,
      nd_rst_selected_date : nd_rst_selected_date,
      nd_rst_calendar_security : nd_rst_my_vars_calendar.nd_rst_ajaxnonce,
    },
    //end ajax

    //START success
    function( nd_rst_calendar_result ) {

      jQuery( "#nd_rst_calendar_content" ).remove();
      jQuery( "#nd_rst_calendar_container" ).append(nd_rst_calendar_result);

      //remove layer
      jQuery( "#nd_rst_all_time_slots_single_layer" ).remove();  


      //update date selection on not default month
      jQuery(".nd_rst_calendar_date").click(function() {

        jQuery(".nd_rst_calendar_date").removeClass("nd_rst_cal_active");
        var nd_rst_calendar_date_select = jQuery(this).attr("data-date");
        jQuery(this).addClass("nd_rst_cal_active");

        jQuery("#nd_rst_date").val(nd_rst_calendar_date_select);

        nd_rst_update_timing(nd_rst_calendar_date_select);
        
      });

    }
    //END

    

  );
  //END

  
}
//END function