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

function Activar(){
    require_once "activador.php";
}
register_activation_hook( __FILE__,"res_install");

function Desactivar(){
    require_once "activador.php";
}

function Uninstall(){
    require_once "activador.php";
}
register_activation_hook( __FILE__,"Activar");
register_deactivation_hook( __FILE__,"Desactivar");


function insert_woocommerce_checkout_rows(  ) {
    echo('<h1>Checout Pro</h1>');
    // Retrieve the checkout object
    $checkout = WC()->checkout();
    // Get the checkout fields
    include  'template-checkout.php';
    
    
}

add_action('woocommerce_after_single_product','insert_woocommerce_checkout_rows' );
function add_tailwind() {
    if(is_product()){
        
    wp_enqueue_script('tailwincss','https://cdn.tailwindcss.com',array('jquery'),true );
    }
  }
add_action('wp_enqueue_scripts', 'add_tailwind',101);



