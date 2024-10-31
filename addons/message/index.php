<?php

//nd_rst_send_message
function nd_rst_send_message($nd_rst_restaurant,$nd_rst_guests,$nd_rst_date,$nd_rst_time_start,$nd_rst_time_end,$nd_rst_occasionn,$nd_rst_booking_form_name,$nd_rst_booking_form_surname,$nd_rst_booking_form_email,$nd_rst_booking_form_phone,$nd_rst_booking_form_requests,$nd_rst_order_type,$nd_rst_order_status,$nd_rst_deposit,$nd_rst_tx,$nd_rst_currency){


	//occasions
	$nd_rst_occasions = get_option('nd_rst_occasions');
	if ( $nd_rst_occasions == '' ) {
    	$nd_rst_occasion = __('Not Set','nd-restaurant-reservations');
    }else { 
        $nd_rst_occasions_array = explode(',', $nd_rst_occasions );
        $nd_rst_occasion = $nd_rst_occasions_array[$nd_rst_occasionn];
    }
    

	//START MAIL TO ADMIN
	$message = '
	<html>
	<head>
	  <title>'.__('New Reservation','nd-restaurant-reservations').'</title>
	</head>
	<body>
	  <p>'.__('Hi, you received a new reservation on your site, here all details','nd-restaurant-reservations').' :</p>
	  
	  <p><strong>'.__('MAIN INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Restaurant','nd-restaurant-reservations').' : '.get_the_title($nd_rst_restaurant).'</p>
	  <p>'.__('Guests','nd-restaurant-reservations').' : '.$nd_rst_guests.'</p>
	  <p>'.__('Date','nd-restaurant-reservations').' : '.$nd_rst_date.'</p>
	  <p>'.__('Time Start','nd-restaurant-reservations').' : '.$nd_rst_time_start.'</p>
	  <p>'.__('Time End','nd-restaurant-reservations').' : '.$nd_rst_time_end.'</p>
	  <p>'.__('Occasion','nd-restaurant-reservations').' : '.$nd_rst_occasion.'</p><br/>
	  
	  <p><strong>'.__('USER INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Name','nd-restaurant-reservations').' : '.$nd_rst_booking_form_name.'</p>
	  <p>'.__('Surname','nd-restaurant-reservations').' : '.$nd_rst_booking_form_surname.'</p>
	  <p>'.__('Phone','nd-restaurant-reservations').' : '.$nd_rst_booking_form_phone.'</p>
	  <p>'.__('Email','nd-restaurant-reservations').' : '.$nd_rst_booking_form_email.'</p>
	  <p>'.__('Message','nd-restaurant-reservations').' : '.$nd_rst_booking_form_requests.'</p><br/>

	  <p><strong>'.__('ORDER INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Order Type','nd-restaurant-reservations').' : '.$nd_rst_order_type.'</p>
	  <p>'.__('Order Status','nd-restaurant-reservations').' : '.$nd_rst_order_status.'</p>

	  <p><strong>'.__('DEPOSIT INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Amount','nd-restaurant-reservations').' : '.$nd_rst_deposit.' '.$nd_rst_currency.'</p>
	  <p>'.__('Transaction ID','nd-restaurant-reservations').' : '.$nd_rst_tx.'</p>

	</body>
	</html>
	';

	$to = get_option('admin_email');
	$nd_rst_email = get_option('admin_email');
	$nd_rst_name = get_bloginfo( 'name' );
	$subject = __('New Reservation','nd-restaurant-reservations');
	$headers = array('Content-Type: text/html; charset=UTF-8','From: '.$nd_rst_name.' <'.$nd_rst_email.'>');
	wp_mail( $to, $subject, $message, $headers );
	//END MAIL TO ADMIN








	//START MAIL TO CUSTOMER
	$message = '
	<html>
	<head>
	  <title>'.__('Your Reservation','nd-restaurant-reservations').'</title>
	</head>
	<body>
	  <p>'.__('Hi, below your reservation details','nd-restaurant-reservations').' :</p>
	  
	  <p><strong>'.__('MAIN INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Restaurant','nd-restaurant-reservations').' : '.get_the_title($nd_rst_restaurant).'</p>
	  <p>'.__('Guests','nd-restaurant-reservations').' : '.$nd_rst_guests.'</p>
	  <p>'.__('Date','nd-restaurant-reservations').' : '.$nd_rst_date.'</p>
	  <p>'.__('Time Start','nd-restaurant-reservations').' : '.$nd_rst_time_start.'</p>
	  <p>'.__('Time End','nd-restaurant-reservations').' : '.$nd_rst_time_end.'</p>
	  <p>'.__('Occasion','nd-restaurant-reservations').' : '.$nd_rst_occasion.'</p><br/>
	  
	  <p><strong>'.__('USER INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Name','nd-restaurant-reservations').' : '.$nd_rst_booking_form_name.'</p>
	  <p>'.__('Surname','nd-restaurant-reservations').' : '.$nd_rst_booking_form_surname.'</p>
	  <p>'.__('Phone','nd-restaurant-reservations').' : '.$nd_rst_booking_form_phone.'</p>
	  <p>'.__('Email','nd-restaurant-reservations').' : '.$nd_rst_booking_form_email.'</p>
	  <p>'.__('Message','nd-restaurant-reservations').' : '.$nd_rst_booking_form_requests.'</p><br/>

	  <p><strong>'.__('ORDER INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Order Type','nd-restaurant-reservations').' : '.$nd_rst_order_type.'</p>
	  <p>'.__('Order Status','nd-restaurant-reservations').' : '.$nd_rst_order_status.'</p>

	  <p><strong>'.__('DEPOSIT INFORMATIONS','nd-restaurant-reservations').' :</strong></p>
	  <p>'.__('Amount','nd-restaurant-reservations').' : '.$nd_rst_deposit.' '.$nd_rst_currency.'</p>
	  <p>'.__('Transaction ID','nd-restaurant-reservations').' : '.$nd_rst_tx.'</p>

	</body>
	</html>
	';

	$to = $nd_rst_booking_form_email;
	$nd_rst_email = get_option('admin_email');
	$nd_rst_name = get_bloginfo( 'name' );
	$subject = __('Your Reservation','nd-restaurant-reservations');
	$headers = array('Content-Type: text/html; charset=UTF-8','From: '.$nd_rst_name.' <'.$nd_rst_email.'>');
	wp_mail( $to, $subject, $message, $headers );
	//END MAIL TO CUSTOMER









}
add_action('nd_rst_reservation_added_in_db','nd_rst_send_message',10,16);

