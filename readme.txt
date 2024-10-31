=== Restaurant Reservations ===
Contributors: nicdark
Tags: restaurants, table
Requires at least: 4.5
Tested up to: 6.3
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Perfect solution to manage your restaurant reservations. For any food activities. Show and manage your reservations in the best way possible. Restaurant WP plugin.

== Description ==

= Welcome to Restaurant Reservations WP plugin =
This plugin is an useful system to manage all your restaurant reservations, search and filter them in a very simple way. 

Inside the plugin you can also find the OpenTable component. If you decide to use this component you will see an iframe that will give you the possibility to book, entering your data, the restaurant that you have set in the plugin settings. Below some useful links :

[Official site](https://www.opentable.com/)
[Information for developers](https://dev.opentable.com/)
[Terms and conditions](https://www.opentable.com/legal/terms-and-conditions)
[Privacy Policy](https://www.opentable.com/legal/privacy-policy)

In the [nd_rst_reservation_form] shortcode, Stripe is used as the booking method. In the last step the user should enter his data through an iframe provided by Stripe. Once the operation has been completed, the user will be redirect to the thank you page. Below some useful links :

[Official site](https://stripe.com)
[Information for developers](https://stripe.com/docs)
[Terms and conditions](https://stripe.com/legal)

= Below some live preview demos =
Click on the links below for view all plugin features in action:

* Table Reservation [DEMO](http://www.nicdarkthemes.com/themes/restaurant/wp/demo/restaurant/book-a-table/)

== Installation ==

1. Install and activate the "ND Restaurant" plugin.
2. Create a page and add in it the shortcode [nd_rst_reservation_form] for display the table reservation steps.
3. By default the system does not allow the reservation of any table since you will have to add at least one restaurant and create the time-slots through the plugin settings.
4. Create your restaurant : Restaurants -> Add New.
5. Set the required settings : ND Restaurant -> Plugin Settings -> Max guests number option, remember to save the option using the "Save Changes" at the bottom of the panel. ( Saving in this step is essential since if you don't do it you won't be able to create the time slots in the next step )
6. Create your time slots : ND Restaurant -> Add Timing -> Check all checkboxes and set the hours for start to receive reservations, use always the "Save Changes" button for save all options.
7. The steps above are mandatory for start to use the reservation form. Remember that you have more settings available for fit the plugin to your needs.

== Screenshots ==

1. Table Reservation
2. Table Reservation - Details
3. Table Reservation - Confirm
4. Table Reservation - Thanks

== Changelog ==

= 2.0 =
* Improved plugin security on addons/visual/search/index.php

= 1.9 =
* Added Data Sanitization/Escaping variables

= 1.8 =
* Improved plugin security ( added realpath(), Data Sanitization/Escaping variables )
* Added wpdb::prepare() function on db query

= 1.7 =
* elementor compatibility 3.6

= 1.6 =
* added elementor booking search widget
* added elementor opentable widget

= 1.5 =
* added nonce on ajax calls

= 1.3.4 =
* moved some js script in the proper js file.
* added useful links on readme.txt

= 1.3.3 =
* added wp_add_inline_script() for some script in page
* added wp_add_inline_style() for some style in page

= 1.3.2 =
* improved plugins_url()
* added wp_remote_get() function for external requests ( stripe,paypal )

= 1.3.1 =
* sanitize, validate, and escape all datas on POST and GET requests
* improved plugins_url()
* added nonce on ajax calls
* removed import/export feature

= 1.3 =
* Added compatibility with new wp version

= 1.2 =
* Added css rules
* Added some optimization functions

= 1.1 =
* Added payment options

= 1.0 =
* Initial version