

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<form>

	<?php
	
	$checkout = WC()->checkout();
	$product = wc_get_product();
	$shop_countries = WC()->countries->get_allowed_countries();
	$states = WC()->countries->get_states($shop_country);
	
	
	

	$image_url = $product->get_image();

	?>

	<div class=" flex flex-wrap">
		<div class=" flex align-center  m-0 p-0 border-2 border-black" data-value="option1">
			<input type="radio" name="image-select" value="option1" id="option1">
			<div class=" w-[20%]">
				<?php echo $image_url; ?>
			</div>
		</div>
	</div>
	<?php

	?>
	<div id="payment" class="woocommerce-checkout-payment">
		<ul class="wc_payment_methods payment_methods methods">
			<?php
			$methods = WC()->payment_gateways->payment_gateways();
			foreach ($methods as $method) {
				if ('yes' === $method->enabled) {
					wc_get_template('checkout/payment-method.php', array('gateway' => $method));
				}
			}
			?>

		</ul>
		<div class="form-row place-order">
			<noscript>
				<?php
				/* translators: $1 and $2 opening and closing emphasis tags respectively */
				printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
				?>
				<br /><button type="submit" class="button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
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
<div class="  border-2 inset-x-0 mx-auto border-black bg-white z-10  w-[98%] sm:w-[80%] lg:w-[60%] rounded-lg h-screen">
<form class=" text-black  mx-auto border-2 border-black rounded-md p-3 mt-3 mb-5 w-[95%] sm:w-[80%]" onSubmit={handleSubmit(submit)}>
                    <h5 class=" ml-2 text-xl font-semibold text-center">Datos Para El Envio</h5>
                    <div class=" flex flex-row m-1 mt-5 rounded-md text-center border-2 border-black">
                        <div class="  p-2 animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] w-[13%] h-full">
						<i class="bi bi-person-bounding-box text-2xl"></i>
                        </div>
                        <input required class=" checkoutInpuSelect  w-[87%] h-[100%] text-center text-2xl  rounded-md " placeholder="Nombres" type="text" name="first_name" onChange={handleBillingInput} />
                    </div >
                    <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
						<i class="bi bi-person-bounding-box text-2xl"></i>
                        </div>
                        <input required class="checkoutInpuSelect w-[87%] text-center rounded-md " placeholder="Apellidos" type="text" name="last_name" onChange={handleBillingInput} />
                    </div>
                    <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
						<i class="bi bi-pin-map text-2xl"></i>
                        </div>
                        <select
                            required
                            class=" checkoutInpuSelect w-[87%] text-center rounded-md"
							id="countrySelect"
                            
                            >
                            <option value="Seleccionar Pais" >Seleccionar Pais</option>
                            <?PHP
							foreach ($shop_countries as $key => $country) {
								echo"<option key=$key value=$key>$country</option>";
							}
                                
                            
							?>
                        </select>
                    </div>

                    
                        <!-- Ciudades -->
                            <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                                <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
								<i class="bi bi-buildings text-2xl"></i>
                                </div>
								<div required id="citiesOptions" class=" checkoutInpuSelect w-[87%] text-center rounded-md" >

								</div>
                            </div>
							<div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                                <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
								<i class="bi bi-buildings text-2xl"></i>
                                </div>
								<div required id="citiesSelect" class=" checkoutInpuSelect w-[87%] text-center rounded-md" >

								</div>
                            </div>
                    <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
						<i class="bi bi-geo-alt-fill text-2xl"></i>
                        </div>
                        <input
                            class="checkoutInpuSelect w-[87%] text-center rounded-md"
                            required
                            type="text"
                            placeholder="Direccion Carrera... #calle.."
                            name="address_1"
                            onChange={handleBillingInput} />
                    </div>
                    <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
						<i class="bi bi-houses text-2xl"></i>
                        </div>
                        <input
                            class="checkoutInpuSelect w-[87%] text-center rounded-md"
                            required
                            placeholder="Barrio"
                            type="text" name="address_2"
                            onChange={handleBillingInput} />
                    </div>
                    <div class="flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto]   bg-gray-300 p-2 w-[13%] h-[100%] ">
						<i class="bi bi-whatsapp text-2xl"></i>
                        </div>
                        <input
                            class="checkoutInpuSelect w-[87%] text-center rounded-md"
                            required
                            placeholder="Celular"
                            type="tel" name="phone"
                            pattern="[0-9]{10}"
                            onChange={handleBillingInput} />
                    </div>
                    <div class=" flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black">
                        <div class=" animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full">
						<i class="bi bi-envelope-at-fill text-2xl"></i>
                        </div>
                        <input
                            class="checkoutInpuSelect w-[87%] text-center rounded-md"
                            required
                            placeholder="Correo"
                            type="email" name="email"
                            pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
                            onChange={handleBillingInput} />
                    </div>
                    <div class=" flex flex-row m-1 mt-2 p-2 bg-green-200 rounded-md text-center border-2 border-black">
                        <input
                            class="checkoutInpuSelect text-center rounded-md mx-2"
                            name="Check"
                            value="Check"
                            type="checkbox"
                            required
                        />
                        <label htmlFor="Check">Confirmo que estoy dispuesto a recibir el producto y pagar el valor cuando este sea entregado.</label>
                    </div>
                    <div class=" align-middle">
                        <button
                            type="submit"

                            class=" flex justify-center shadow-md shadow-black font-semibold text-xl mx-auto items-center px-2 py-3 my-4 animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] border-2 border-black rounded-full"
                        >Finalizar Pedido
						<div>
						<i class="bi bi-bag-check-fill text-2xl ml-2"></i>
						</div>
                            

                        </button>
                    </div>
                </form>
</div>



				
