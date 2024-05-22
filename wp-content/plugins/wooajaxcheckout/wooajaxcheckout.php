<?php
/*
Plugin Name: WooCommerce Ajax Checkout
Plugin URI: https://example.com/woocommerce-ajax-checkout
Description: Muestra el checkout de WooCommerce en la página del producto y es Ajax.
Version: 1.0.0
Author: Bard
Author URI: https://example.com/bard
License: GPLv2 or later
*/


function insert_woocommerce_checkout_rows(  ) {
    echo('<h1>Checout Pro</h1>');
    // Retrieve the checkout object
    $checkout = WC()->checkout();

    // Get the checkout fields
    

				
			
    
    include  'template-checkout.php';
    
}

add_action('woocommerce_after_single_product','insert_woocommerce_checkout_rows' );


function utm_user_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );

wp_enqueue_style( 'style',  $plugin_url . "pro-checkout.css");
}

add_action( 'admin_print_styles', 'utm_user_scripts' );