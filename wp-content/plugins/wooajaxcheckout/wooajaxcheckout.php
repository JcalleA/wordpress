<?php
/*
Plugin Name: WooCommerce Ajax Checkout
Plugin URI: https://example.com/woocommerce-ajax-checkout
Description: Muestra el checkout de WooCommerce en la página del producto y es Ajax.
Version: 1.0
Author: Bard
Author URI: https://example.com/bard
License: GPLv2 or later
*/


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function Activar()
{
}
register_activation_hook(__FILE__, "Activar");

function Desactivar()
{
}
register_deactivation_hook(__FILE__, "Desactivar");
function Uninstall()
{
    require_once "uninstall.php";
}
register_uninstall_hook(__FILE__, 'Uninstall');



function insert_woocommerce_checkout_rows()
{

    echo ('<h1>Checout Pro</h1>');
    include  'template-checkout.php';
}
add_action('woocommerce_after_single_product', 'insert_woocommerce_checkout_rows');
function add_tailwind()
{
    wp_register_style('pro-checkout-style', '/wp-content/plugins/wooajaxcheckout/css/pro-checkout.css');

    if (is_product()) {
        wp_enqueue_script('my_js_products', plugin_dir_url(__DIR__) . 'js/product-events.js', array('jquery'));
        wp_enqueue_script('tailwincss', 'https://cdn.tailwindcss.com', array('jquery'), true);



        wp_enqueue_style('pro-checkout-style');
    }
}
add_action('wp_enqueue_scripts', 'add_tailwind', 101);

function checkoutt_enquiu_ajax()
{
    if (is_product()) {
        wp_register_script('pro-checkout-script', plugin_dir_url(__FILE__) . '/js/wooajaxcheckoutFunctions.js', array('jquery'), date('YmdHis'), true);

        wp_enqueue_script('pro-checkout-script');

        wp_localize_script('pro-checkout-script', 'pro_checkout_var', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('pro-checkout-script'),
            'action' => 'getCitiesAC'
        ));
    }
}

add_action('wp_enqueue_scripts', 'checkoutt_enquiu_ajax', 101);

function get_Cities(){
    
    $shop_countries = WC()->countries->get_allowed_countries();
    foreach ($shop_countries as $key => $country) {
        if (file_exists(__DIR__ . '/states/' . $key . '.php')) {
            include(__DIR__ . '/states/' . $key . '.php');
        }
        if (file_exists(__DIR__ . '/places/' . $key . '.php')) {
            include(__DIR__ . '/places/' . $key . '.php');
        }
    }
    
    die(json_encode([
        'states'=>$states,
        'places'=>$places

    ]));
}
add_action('wp_ajax_getCitiesAC', 'get_Cities');
add_action('wp_ajax_nopriv_getCitiesAC', 'get_Cities');
