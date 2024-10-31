//START function
function nd_rst_import_settings(){

  //variables
  var nd_rst_value_import_settings = jQuery( "#nd_rst_import_settings").val();

  //empty result div
  jQuery( "#nd_rst_import_settings_result_container").empty();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_rst_my_vars_import_settings.nd_rst_ajaxurl_import_settings,
    {
      action : 'nd_rst_import_settings_php_function',         
      nd_rst_value_import_settings: nd_rst_value_import_settings,
      nd_rst_import_settings_security : nd_rst_my_vars_import_settings.nd_rst_ajaxnonce_import_settings
    },
    //end ajax


    //START success
    function( nd_rst_import_settings_result ) {
    
      jQuery( "#nd_rst_import_settings").val('');
      jQuery( "#nd_rst_import_settings_result_container").append(nd_rst_import_settings_result);

    }
    //END
  

  );
  //END

  
}
//END function
