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
    echo('<h1>Hola mundoooooo</h1>');
    // Retrieve the checkout object
    $checkout = WC()->checkout();

    // Get the checkout fields
    
    foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ){
        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
    }
    wc_cart_totals_shipping_html();
    wc_cart_totals_order_total_html();
}



add_action('woocommerce_after_single_product','insert_woocommerce_checkout_rows' );
