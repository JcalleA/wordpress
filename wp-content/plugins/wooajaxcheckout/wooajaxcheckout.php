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

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_ajax_checkout_button', 20 );

function woocommerce_ajax_checkout_button() {
    global $product;

    if ( ! $product->is_purchasable() ) {
        return;
    }

    ?>
    <button id="woocommerce-ajax-checkout-button" data-product-id="<?php echo $product->get_id(); ?>" data-quantity="1">Agregar al carrito</button>

    <script type="text/javascript">
        jQuery(function($) {
            $(document).on('click', '#woocommerce-ajax-checkout-button', function(event) {
                event.preventDefault();

                var product_id = $(this).data('product-id');
                var quantity = $(this).data('quantity');

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    method: 'POST',
                    data: {
                        action: 'woocommerce_ajax_checkout',
                        nonce: '<?php echo wp_create_nonce('woocommerce-ajax-checkout'); ?>',
                        product_id: product_id,
                        quantity: quantity
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);

                            if (response.checkout_url) {
                                $('<div id="woocommerce-ajax-checkout-modal"></div>').appendTo('body');

                                $('#woocommerce-ajax-checkout-modal').load(response.checkout_url, function() {
                                    $(this).dialog({
                                        modal: true,
                                        width: 'auto',
                                        height: 'auto'
                                    });
                                });
                            }
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });
        });
    </script>
    <?php
}

add_action( 'wp_ajax_woocommerce_ajax_checkout', 'woocommerce_ajax_checkout_handler' );

function woocommerce_ajax_checkout_handler() {
    if ( ! check_ajax_referer( 'woocommerce-ajax-checkout', 'nonce' ) ) {
        wp_send_json_error( array(
            'message' => __( 'Invalid nonce.', 'woocommerce' )
        ) );
    }

    $product_id = intval( $_POST['product_id'] );
    $quantity = intval( $_POST['quantity'] );

    if ( ! $product_id || ! $quantity ) {
        wp_send_json_error( array(
            'message' => __( 'Invalid product ID or quantity.', 'woocommerce' )
        ) );
    }

    WC()->cart->add_to_cart( $product_id, $quantity );

    $checkout_url = wc_get_checkout_url();

    wp_send_json_success( array(
        'message' => __( 'Product added to cart.', 'woocommerce' ),
        'checkout_url' => $checkout_url
    ) );
}
