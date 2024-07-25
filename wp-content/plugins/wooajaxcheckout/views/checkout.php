<?php

add_action( 'wp_ajax_getCheckoutPageContent', 'getCheckoutPageContentCallBack' );
    add_action( 'wp_ajax_nopriv_getCheckoutPageContent', 'getCheckoutPageContentCallBack' );

    function getCheckoutPageContentCallBack() {


        $product_id        = absint( $_POST['product_id'] );
        $quantity          = absint( $_POST['quantity'] );
        $product_status    = get_post_status( $product_id );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status ) {

            do_action( 'woocommerce_ajax_added_to_cart', $product_id );
            global $woocommerce;
            $items = $woocommerce->cart->get_cart();

            wc_setcookie( 'woocommerce_items_in_cart', count( $items ) );
            wc_setcookie( 'woocommerce_cart_hash', md5( json_encode( $items ) ) );
            do_action( 'woocommerce_set_cart_cookies', true );

            define( 'WOOCOMMERCE_CHECKOUT', true );
            echo do_shortcode('[woocommerce_checkout]');


        } else {

            echo "Something went wrong, please try again later.";
        }

        die();
    }

    /* woocommerce shop page*/

    
    /*
        Template Name:costom shop
    */

    get_header();
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/bootstrap/js/bootstrap.min.js"></script>

    <?php  
      $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'orderby' => 'rand'
        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <div class="row">
            <div class="col-md-12">
                <h2><?php the_title() ?></h2>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="col-md-6">
                            <a href="#!" data-productid="<?php echo $post->ID; ?>" class="btn btn-primary" onclick="customCheckout(event)">Add to Cart</a>
                        </div>
                    </div>
                    <strong>Description</strong>
                    <div><?php the_excerpt(); ?></div>
                </div>
            </div>
        </div>

        <?php endwhile; else : ?>

        <p>There in no product : </p>

    <?php endif;
    wp_reset_postdata(); ?>


    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="checkoutModalLabel">Checkout</h4>
          </div>
          <div class="modal-body">
            <div id="checkOutPageContent">

            </div>
          </div>      
        </div>
      </div>
    </div>

    <script type="text/javascript">

        function customCheckout(event){
            var wp_ajax_url="<?php echo site_url();?>/wp-admin/admin-ajax.php";
            var data = {
                action: 'getCheckoutPageContent',
                product_id: jQuery(event.target).data('productid'),
                quantity: 1
            };

            jQuery.post( wp_ajax_url, data, function(content) {
                jQuery("#checkOutPageContent").html(content);
                jQuery("#checkoutModal").modal('show');

            });
        }

    </script>
    <?php
    get_footer();
    ?>