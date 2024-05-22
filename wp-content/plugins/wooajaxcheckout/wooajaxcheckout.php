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
    echo('<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">');
    echo('<div class="col2-set" id="customer_details">
			<div class="col-1">');
				
			
    foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ){
        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
    }
    
    
    include  'template-checkout.php';
    
}



add_action('woocommerce_after_single_product','insert_woocommerce_checkout_rows' );
