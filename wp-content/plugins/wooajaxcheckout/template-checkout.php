<form>

<?php
$checkout = WC()->checkout();
$product=wc_get_product();
$shop_country = WC()->countries->get_base_country();
$states = WC()->countries->get_states($shop_country);
$cityes =WC()->countries->country_dropdown_options($shop_country,$state);
print_r($cityes) ;
$image_url = wp_get_attachment_image_url( $product->image_id, 'full' );
?>
<div class=" flex flex-wrap">
<div class=" flex align-center  m-0 p-0 border-2 border-black" data-value="option1">
<img class="w-[10%] mr-4 " src="<?php echo $image_url; ?>">
  <input type="radio" name="image-select" value="option1" id="option1">
</div>
</div>
<?php

    ?>
    <div id="payment" class="woocommerce-checkout-payment">
    <ul class="wc_payment_methods payment_methods methods">
    <?php
    $methods = WC()->payment_gateways->payment_gateways();
    foreach ( $methods as $method ){
      
      if ('yes' === $method->enabled ) {
        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $method ) );
      }
    }
    ?>
    
    </ul>
	<div class="form-row place-order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>
</form>

<?php /*wc_order_add_discount( $order_id, __("Fixed discount"), 12 ); 
$order = new WC_Order();
// $order = wc_create_order(); 

// add products
$order->add_product( wc_get_product( 136 ), 2 );
$order->add_product( wc_get_product( 70 ) );

// add shipping
$shipping = new WC_Order_Item_Shipping();
$shipping->set_method_title( 'Free shipping' );
$shipping->set_method_id( 'free_shipping:1' ); // set an existing Shipping method ID
$shipping->set_total( 0 ); // optional
$order->add_item( $shipping );

// add billing and shipping addresses
$address = array(
	'first_name' => 'Misha',
	'last_name'  => 'Rudrastyh',
	'company'    => 'rudrastyh.com',
	'email'      => 'no-reply@rudrastyh.com',
	'phone'      => '+995-123-4567',
	'address_1'  => '29 Kote Marjanishvili St',
	'address_2'  => '',
	'city'       => 'Tbilisi',
	'state'      => '',
	'postcode'   => '0108',
	'country'    => 'GE'
);

$order->set_address( $address, 'billing' );
$order->set_address( $address, 'shipping' );

// add payment method
$order->set_payment_method( 'stripe' );
$order->set_payment_method_title( 'Credit/Debit card' );

// order status
$order->set_status( 'wc-completed', 'Order is created programmatically' );

// add two meta values of the same meta key
$order->add_meta_data( 'my_custom_key', 'value-1' );
$order->add_meta_data( 'my_custom_key', 'value-2' );

// calculate and save
$order->calculate_totals();
$order->save();

*/
?>