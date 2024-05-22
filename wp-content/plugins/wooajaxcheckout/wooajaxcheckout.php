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
    $checkout_fields = $checkout->get_checkout_fields();

    // Start generating the HTML output
    $html = '<div class="woocommerce-checkout-rows">';

    // Loop through each checkout field
    foreach ( $checkout_fields as $field_name => $field ) {
        // Skip fields that don't have a label
        if ( ! isset( $field['label'] ) ) {
            continue;
        }

        // Get the field value
        $field_value = $checkout->get_value( $field_name );

        // Generate the HTML for the checkout row
        $html .= '<div class="woocommerce-checkout-row">';
        $html .= '<label for="' . esc_attr( $field_name ) . '">' . esc_html( $field['label'] ) . ':</label>';
        $html .= '<span class="woocommerce-checkout-value">' . esc_html( $field_value ) . '</span>';
        $html .= '</div>';
    }

    // Close the HTML output
    $html .= '</div>';
    echo $html;
    // Insert the HTML into the specified hook
}



add_action('woocommerce_after_single_product','insert_woocommerce_checkout_rows' );
