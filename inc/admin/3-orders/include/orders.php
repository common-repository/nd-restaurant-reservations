<?php

//pagination
$nd_rst_qnt_orders_pag = 10;
$nd_rst_pag_from = sanitize_text_field($_GET["nd_rst_pag_from"]);
$nd_rst_pag_to = sanitize_text_field($_GET["nd_rst_pag_to"]);
$nd_rst_order_status = sanitize_text_field($_GET["nd_rst_order_status"]);
if ( $nd_rst_pag_from == '' ) { $nd_rst_pag_from = 0; }
if ( $nd_rst_pag_to == '' ) { $nd_rst_pag_to = $nd_rst_qnt_orders_pag; }

//START show all orders
global $wpdb;

$nd_rst_result = '';
$nd_rst_order_id = get_the_ID();
$nd_rst_table_name = $wpdb->prefix . 'nd_rst_booking';

//START select for items
if ( $nd_rst_order_status == '' ) { 
  
  $nd_rst_orders_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name ORDER BY id DESC LIMIT %d, %d", array( $nd_rst_pag_from, $nd_rst_pag_to ) );
  $nd_rst_orders = $wpdb->get_results( $nd_rst_orders_query ); 

}else{
  
  $nd_rst_orders_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_order_status = %s ORDER BY id DESC LIMIT %d, %d", array( $nd_rst_order_status, $nd_rst_pag_from, $nd_rst_pag_to ) );
  $nd_rst_orders = $wpdb->get_results( $nd_rst_orders_query ); 

}

//all orders
$nd_rst_all_orders_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name" );
$nd_rst_all_orders = $wpdb->get_results( $nd_rst_all_orders_query ); 

//pending orders
$nd_rst_pending_term = 'pending';
$nd_rst_all_orders_pending_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_order_status = %s", $nd_rst_pending_term );
$nd_rst_all_orders_pending = $wpdb->get_results( $nd_rst_all_orders_pending_query ); 

//confirmed orders
$nd_rst_confirmed_term = 'confirmed';
$nd_rst_all_orders_confirmed_query = $wpdb->prepare( "SELECT * FROM $nd_rst_table_name WHERE nd_rst_order_status = %s", $nd_rst_confirmed_term );
$nd_rst_all_orders_confirmed = $wpdb->get_results( $nd_rst_all_orders_confirmed_query );

if ( empty($nd_rst_orders) ) { 

  $nd_rst_result .= '

  <style>
    .update-nag { display:none; } 
  </style>

  <h1 class="nd_rst_margin_0" style="font-size: 23px; font-weight: 400;">'.__('Orders','nd-restaurant-reservations').'</h1>
  <div class="nd_rst_section nd_rst_height_20"></div>
  <div class="nd_rst_position_relative  nd_rst_width_100_percentage nd_rst_box_sizing_border_box nd_rst_display_inline_block">           
    <p class=" nd_rst_margin_0 nd_rst_padding_0">'.__('Still no orders','nd-restaurant-reservations').'</p>
  </div>';              


}else{


  $nd_rst_result .= '
  <h1 class="nd_rst_margin_0" style="font-size: 23px; font-weight: 400;">'.__('Orders','nd-restaurant-reservations').'</h1>

  <ul class="subsubsub">
    <li class=""><a href="admin.php?page=nd-restaurant-reservations-settings-orders&nd_rst_pag_from=0&nd_rst_pag_to='.$nd_rst_qnt_orders_pag.'&nd_rst_order_status=" class="current">'.__('All','nd-restaurant-reservations').' <span class="count">('.count($nd_rst_all_orders).')</span></a> |</li>
    <li class=""><a href="admin.php?page=nd-restaurant-reservations-settings-orders&nd_rst_pag_from=0&nd_rst_pag_to='.$nd_rst_qnt_orders_pag.'&nd_rst_order_status=pending">'.__('Pending','nd-restaurant-reservations').' <span class="count">('.count($nd_rst_all_orders_pending).')</span></a> |</li>
    <li class=""><a href="admin.php?page=nd-restaurant-reservations-settings-orders&nd_rst_pag_from=0&nd_rst_pag_to='.$nd_rst_qnt_orders_pag.'&nd_rst_order_status=confirmed">'.__('Confirmed','nd-restaurant-reservations').' <span class="count">('.count($nd_rst_all_orders_confirmed).')</span></a></li>
  </ul>

  <div class="nd_rst_section nd_rst_height_10"></div>

  ';


  //pagination
  $nd_rst_orders_limit = 0;

  if ( $nd_rst_order_status == '' ) { 
    $nd_rst_number_pages = ceil(count($nd_rst_all_orders)/$nd_rst_qnt_orders_pag); 
  }else{
    
    if ( $nd_rst_order_status == 'pending' ){
      $nd_rst_number_pages = ceil(count($nd_rst_all_orders_pending)/$nd_rst_qnt_orders_pag); 
    }else{
      $nd_rst_number_pages = ceil(count($nd_rst_all_orders_confirmed)/$nd_rst_qnt_orders_pag);  
    }

  }
  
  $nd_rst_result_pag = '';
  $nd_rst_result_pag .= '<div style="margin-top:-37px; float:right; width:50%;" class="nd_rst_section nd_rst_text_align_right">';

  for ($nd_rst_number_page = 1; $nd_rst_number_page <= $nd_rst_number_pages; ++$nd_rst_number_page) {
    
    if ( ceil($nd_rst_pag_from/$nd_rst_qnt_orders_pag)+1 == $nd_rst_number_page ) { $nd_rst_pag_active = 'nd_rst_pag_active'; }else{ $nd_rst_pag_active = ''; }

    $nd_rst_result_pag .= '
      
      <span style="line-height:16px; padding:5px;" class="tablenav-pages-navspan '.$nd_rst_pag_active.' " aria-hidden="true">
        <a style="text-decoration: none; color: #a0a5aa;" href="admin.php?page=nd-restaurant-reservations-settings-orders&nd_rst_pag_from='.$nd_rst_orders_limit.'&nd_rst_pag_to='.$nd_rst_qnt_orders_pag.'&nd_rst_order_status='.$nd_rst_order_status.'">'.$nd_rst_number_page.'</a>
      </span>

    ';  
    
    $nd_rst_orders_limit = $nd_rst_orders_limit + $nd_rst_qnt_orders_pag;

  } 

  $nd_rst_result_pag .= '</div>';


  $nd_rst_result .= '

  '.$nd_rst_result_pag.'

  <style>
  .nd_rst_table{
    float:left;
    width:100%;
    background-color:#ccc;
    border-collapse: collapse;
    font-size: 14px;
    line-height: 20px;
    border: 1px solid #e5e5e5;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
    box-sizing:border-box;
  }
  .nd_rst_table tr td{
    padding:12px; 
  }


  .nd_rst_table_thead{
    width:100%;
    background-color:#fff;
    border-bottom:1px solid #e1e1e1;
  }
  .nd_rst_table_thead td, .nd_rst_table_tfoot td{
    /*color:#0073aa;*/
  }

  .nd_rst_table_tfoot{
    border-top:1px solid #e1e1e1;
    border-bottom:0px solid #e1e1e1;
    background-color:#fff;
  }
  
  .nd_rst_table tbody{
    width:100%;
  }
  .nd_rst_table_tbody{
    width: 100%;
    background-color: #777;
  }

  .nd_rst_tr_light { background-color:#fff; }
  .nd_rst_tr_dark { background-color:#f9f9f9; }

  .nd_rst_table_tbody td .nd_rst_edit {
    color: #0073aa;
    cursor: pointer;
    background: none;
    border: 0px;
    font-size: 13px;
    padding: 0px; 
  }
  .nd_rst_table_tbody td .nd_rst_edit:hover {
    color:#00a0d2;  
  }
  .nd_rst_table_tbody td .nd_rst_delete {
    color: #a00;
    cursor: pointer;
    background: none;
    border: 0px;
    font-size: 13px;
    padding: 0px; 
  }

  .update-nag { display:none; } 

  .nd_rst_pag_active { background-color:#00a0d2; border-color:#5b9dd9; }
  .nd_rst_pag_active a { color:#fff !important; }
  
  </style>

  <table class="nd_rst_table">
    <tbody>
      <tr class="nd_rst_table_thead">
        <td width="30%">'.__('Guest','nd-restaurant-reservations').'</td>
        <td width="20%">'.__('Guest Contacts','nd-restaurant-reservations').'</td>
        <td width="30%">'.__('Date','nd-restaurant-reservations').'</td>
        <td width="20%">'.__('Status','nd-restaurant-reservations').'</td>

      </tr>
    ';


  $nd_rst_i = 0;
  foreach ( $nd_rst_orders as $nd_rst_order ) 
  {
    
    //decide status color
    if ( $nd_rst_order->nd_rst_order_status == 'pending' ){
      $nd_rst_color_bg_status = '#e68843';
    }else{
      $nd_rst_color_bg_status = '#54ce59'; 
    }

    //define action type
    $nd_rst_new_action_type = str_replace("_"," ",$nd_rst_order->action_type);

    //get room image
    $nd_rst_id = $nd_rst_order->id_post;
    $nd_rst_image_id = get_post_thumbnail_id($nd_rst_id);
    $nd_rst_image_attributes = wp_get_attachment_image_src( $nd_rst_image_id, 'thumbnail' );
    $nd_rst_room_img_src = $nd_rst_image_attributes[0];

    //get avatar
    $nd_rst_account_avatar_url_args = array( 'size'   => 100 );
    $nd_rst_account_avatar_url = get_avatar_url($nd_rst_order->nd_rst_booking_form_email, $nd_rst_account_avatar_url_args);

    
    if ( $nd_rst_i & 1 ) { $nd_rst_tr_class = 'nd_rst_tr_light'; } else { $nd_rst_tr_class = 'nd_rst_tr_dark'; } 

    $nd_rst_order_id = $nd_rst_order->id_user;

    $nd_rst_result .= '
                               
        <tr class="nd_rst_table_tbody '.$nd_rst_tr_class.'">

          <td>
            <div style="width:50px;" class="nd_rst_float_left">
              <img width="40" src="'.$nd_rst_account_avatar_url.'">
            </div>
            <div class="nd_rst_float_left">
              <span class="nd_rst_section">'.$nd_rst_order->nd_rst_booking_form_name.' '.$nd_rst_order->nd_rst_booking_form_surname.'</span>
              <form class="nd_rst_float_left" method="POST">
                <input type="hidden" name="edit_order_id" value="'.$nd_rst_order->id.'">
                <input type="submit" class="nd_rst_edit" value="'.__('View','nd-restaurant-reservations').'">
              </form>
              <form class="nd_rst_float_left nd_rst_padding_left_10" method="POST">
                <input type="hidden" name="delete_order_id" value="'.$nd_rst_order->id.'">
                <input type="submit" class="nd_rst_delete" value="'.__('Delete','nd-restaurant-reservations').'">
              </form>
            </div>
          </td>
        
          <td>
            <div style="display:table;" class="nd_rst_section">
              <div style="display:table-cell; vertical-align:middle;" class="nd_rst_box_sizing_border_box">
                <span class="nd_rst_section">
                  <a style="background-color: #23282d;color: #fff; text-decoration:none; font-size: 10px;padding: 3px;float: left;line-height: 10px;margin-top: 2px;" href="mailto:'.$nd_rst_order->nd_rst_booking_form_email.'">'.__('EMAIL ME','nd-restaurant-reservations').'</a><br/>
                  <a style="background-color: #0076b3;color: #fff; text-decoration:none; font-size: 10px;padding: 3px;float: left;line-height: 10px;margin-top: 2px;" href="#">'.$nd_rst_order->nd_rst_booking_form_phone.'</a>
                </span>
              </div>
            </div>
          </td>

          <td>
            <span class=""><u>'.__('Date','nd-restaurant-reservations').'</u> : '.$nd_rst_order->nd_rst_date.'</span><bR/>
            <span class=""><u>'.__('From','nd-restaurant-reservations').'</u> : '.$nd_rst_order->nd_rst_time_start.'</span>
            <span class=""><u>'.__('To','nd-restaurant-reservations').'</u> : '.$nd_rst_order->nd_rst_time_end.'</span>
          </td>

          <td><span style="background-color:'.$nd_rst_color_bg_status.';" class="nd_rst_padding_5 nd_rst_color_ffffff nd_rst_font_size_12 nd_rst_text_transform_uppercase">'.$nd_rst_order->nd_rst_order_status.'</span></td>
        
        </tr>

    ';

    $nd_rst_i = $nd_rst_i + 1;


  }


  $nd_rst_result .= '
    <tr class="nd_rst_table_tfoot">
      <td>'.__('Guest','nd-restaurant-reservations').'</td>
      <td>'.__('Guest Contacts','nd-restaurant-reservations').'</td>
      <td>'.__('Date','nd-restaurant-reservations').'</td>
      <td>'.__('Status','nd-restaurant-reservations').'</td>
    </tr>
    </tbody>
  </table>

  <div class="nd_rst_section nd_rst_height_50"></div>

  '.$nd_rst_result_pag.'

  ';





}
//END show all orders
  
  
  