

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="producto">
  <input  type="checkbox" name="opcion_seleccionada" id="opcion_1" value="opcion_1">
  <label for="opcion_1">Opción 1 (agregar 1 unidad)</label><br>

  <input  type="checkbox" name="opcion_seleccionada" id="opcion_2" value="opcion_2">
  <label for="opcion_2">Opción 2 (agregar 2 unidades)</label><br>
  <a href="<?php echo wc_get_product()->add_to_cart_url() ?>" id="add_to_cart_button" value="<?php echo esc_attr( wc_get_product()->get_id() ); ?>" class="ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo wc_get_product()->get_id(); ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"> 
Add to Cart 
</a>
  <button class="add_to_cart_button" data-product_id="<?php echo wc_get_product()->get_id(); ?>" data-quantity="1">Agregar al carrito</button>
</div>
	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php $wc_ajax=new WC_AJAX();
$wc_ajax->add_ajax_events();
 ?>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<script>
jQuery(document).ready(function($) {

$('#add_to_cart_button').click(function(event) {
  event.preventDefault();


  var product_id = $(this).data('product_id');
  var quantity = $(this).data('quantity');

  var data = {
    action: 'add_to_cart',
    product_id: product_id,
    quantity: quantity
  };

  $.ajax({
    url: '',
    method: 'POST',
    data: data,
    success: function(response) {
      if (response.success) {
        alert('Producto agregado al carrito!');

        // Actualizar el fragmento del carrito
        $(document).trigger('wc_fragment_refresh');
      } else {
        alert('Error al agregar producto al carrito.');
      }
    }
  });
});

});


</script>