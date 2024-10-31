<?php    

$nd_rst_result = '';
$nd_rst_order_id = sanitize_text_field($_POST['delete_order_id']);

if ( isset($_POST['nd_rst_delete_order_id']) ) {

  global $wpdb;
  $nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

  $nd_rst_delete_record = $wpdb->delete( 
        
    $nd_rst_table_name, 
    array( 'ID' => sanitize_text_field($_POST['nd_rst_delete_order_id']) )

  );


  if ($nd_rst_delete_record){

    $nd_rst_result .= '

      <style>
        .update-nag { display:none; } 
      </style>


      <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible nd_rst_margin_left_0_important nd_rst_margin_bottom_20_important"> 
        <p>
          <strong>'.__('Deleted','nd-restaurant-reservations').'</strong>
        </p>
        <button type="button" class="notice-dismiss">
          <span class="screen-reader-text">'.__('Dismiss this notice.','nd-restaurant-reservations').'</span>
        </button>
      </div>

    ';

  }else{

    #$wpdb->show_errors();
    #$wpdb->print_error();

  }


}else{

  $nd_rst_result .= '

    <style>
        .update-nag { display:none; } 
      </style>

    <h1>'.__('Delete Order','nd-restaurant-reservations').' : '.$nd_rst_order_id.'</h1>
    <p>'.__('Please confirm delete by clicking on the button below','nd-restaurant-reservations').'</p>
    <form method="POST">
      <input type="hidden" name="nd_rst_delete_order_id" value="'.$nd_rst_order_id.'">
      <input class="button button-primary" type="submit" value="'.__('Delete','nd-restaurant-reservations').'">
    </form>
  ';

}

