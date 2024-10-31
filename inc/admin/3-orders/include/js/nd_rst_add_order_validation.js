//START function
function nd_rst_check_order_val(){

  //variables
  var nd_rst_date = jQuery( "#nd_rst_date").val();
  var nd_rst_guests = jQuery( "#nd_rst_guests").val();
  var nd_rst_booking_form_name = jQuery( "#nd_rst_booking_form_name").val();
  var nd_rst_booking_form_surname = jQuery( "#nd_rst_booking_form_surname").val();
  var nd_rst_booking_form_email = jQuery( "#nd_rst_booking_form_email").val();

  //empty result div
  jQuery( "#nd_rst_import_settings_result_container").empty();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_rst_my_vars_add_order_val.nd_rst_ajaxurl_add_order_val,
    {
      action : 'nd_rst_add_order_validation_php_function',         
      nd_rst_date: nd_rst_date,
      nd_rst_guests: nd_rst_guests,
      nd_rst_booking_form_name: nd_rst_booking_form_name,
      nd_rst_booking_form_surname: nd_rst_booking_form_surname,
      nd_rst_booking_form_email: nd_rst_booking_form_email,
      nd_rst_add_order_val_security : nd_rst_my_vars_add_order_val.nd_rst_ajaxnonce_add_order_val,
    },
    //end ajax


    //START success
    function( nd_rst_add_order_val_result ) {
    

      if ( nd_rst_add_order_val_result == 1 ){

          jQuery( ".nd_rst_validation_errors").empty();

          jQuery("#nd_rst_add_order_check_availability_btn").addClass("nd_rst_display_none_important");
          jQuery("#nd_rst_add_order_add_reservation_btn").removeClass("nd_rst_display_none_important");
          
       }else{
          
          jQuery( ".nd_rst_validation_errors").empty();

          //split all result
          var nd_rst_errors_validation = nd_rst_add_order_val_result.split("[divider]");
          
          //declare variables
          var nd_rst_error_validation_date = nd_rst_errors_validation[0];
          var nd_rst_error_validation_guests = nd_rst_errors_validation[1];
          var nd_rst_error_validation_name = nd_rst_errors_validation[2];
          var nd_rst_error_validation_surname = nd_rst_errors_validation[3];
          var nd_rst_error_validation_email = nd_rst_errors_validation[4];

          jQuery( ".nd_rst_date .nd_rst_validation_errors").append(nd_rst_error_validation_date);
          jQuery( ".nd_rst_guests .nd_rst_validation_errors").append(nd_rst_error_validation_guests);
          jQuery( ".nd_rst_booking_form_name .nd_rst_validation_errors").append(nd_rst_error_validation_name);
          jQuery( ".nd_rst_booking_form_surname .nd_rst_validation_errors").append(nd_rst_error_validation_surname);
          jQuery( ".nd_rst_booking_form_email .nd_rst_validation_errors").append(nd_rst_error_validation_email);

       }


    }
    //END
  

  );
  //END

  
}
//END function
