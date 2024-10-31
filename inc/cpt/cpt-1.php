<?php

///////////////////////////////////////////////////CPT1///////////////////////////////////////////////////////////////
function nd_rst_create_post_type_1() {

    register_post_type('nd_rst_cpt_1',
        array(
            'labels' => array(
                'name' => __('Restaurants', 'nd-restaurant-reservations'),
                'singular_name' => __('Restaurants', 'nd-restaurant-reservations')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'restaurants' ),
            'menu_icon'   => 'dashicons-admin-multisite',
            'supports' => array('title', 'editor', 'thumbnail','excerpt' )
        )
    );
}
add_action('init', 'nd_rst_create_post_type_1');

