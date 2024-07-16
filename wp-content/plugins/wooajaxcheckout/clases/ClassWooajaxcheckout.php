<?php

use Automattic\WooCommerce\Admin\Overrides\Order;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class Wooajaxcheckout
{
    public function __construct()
    {
    }

    public function wooajaxcheckoutScripts()
    {
        $this->scripts();
        $this->styles();
    }

    private function scripts()
    {
        $product = wc_get_product();
        if (is_single() && is_product() && $product->get_type() !== 'variable') {

            wp_enqueue_script('wooajaxcheckoutMainScript', plugin_dir_url(__DIR__) . 'dist/js/mainScript.js', array('jquery'), '1.0', true);

            wp_enqueue_script('wooajaxcheckoutFunctionsScript', plugin_dir_url(__DIR__) . 'dist/js/wooajaxcheckoutFunctions.js', array('jquery'), '1.0', true);
            wp_enqueue_script('wooajaxcheckoutOrderScript', plugin_dir_url(__DIR__) . 'dist/js/wooajaxcheckoutOrderScript.js', array('jquery'), '1.0', true);
            wp_localize_script(
                'wooajaxcheckoutOrderScript',
                'OrderScriptVar',
                [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('secure'),
                    'action' => 'PostOrder'
                ]
            );
            wp_localize_script(
                'wooajaxcheckoutFunctionsScript',
                'pro_checkout_var',
                [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('secure'),
                    'action' => 'getCitiesAC'
                ]
            );
        }
    }
    function AdmincheckoutScripts()
    {

        if ($_GET['page'] === 'boton-de-compra' || $_GET['page'] === 'WooAjaxCheckout_menu') {
            wp_enqueue_style('wooajaxcheckoutMainStyle', plugin_dir_url(__DIR__) . '/dist/css/mainStyle.css');
            wp_enqueue_style('iconsBoostrap', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

            wp_enqueue_script('wooajaxcheckoutAdminScript', plugin_dir_url(__DIR__) . 'dist/js/wooajaxcheckoutAdminScript.js', array('jquery'), '1.0', true);

            wp_localize_script(
                'wooajaxcheckoutAdminScript',
                'WooAdmin_var',
                [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('secureAdmin'),
                    'action' => 'SaveBtnSetings'
                ]
            );
        }
    }

    function SaveBtnSetings()
    {

        global $wpdb;
        $nombre_tabla = $wpdb->prefix.'WooAjaxCheckoutSetings';
        $loadSetings= $wpdb->get_row( "SELECT * FROM ".$nombre_tabla." WHERE id = 1" );
        
        $Form = $_POST['form'];
        $btnAnimated=$Form[4]['value'];
        if ($btnAnimated=='true') {
            $btnAnimated=1;
        }else{
            $btnAnimated=0;
        };
        $setings = [
            'id' => 1,
            'btntitle' => $Form[0]['value'],
            'btnsubtitle' => $Form[1]['value'],
            'btntextcolor' => $Form[2]['value'],
            'btncolor' => $Form[3]['value'],
            'btnbordercolor'=>$Form[4]['value'],
            'btnborder'=>$Form[5]['value'],
            'btnanimated' => $btnAnimated,
            'btnicon' => $Form[7]['value'],
            
        ];
        $where=[
            'id'=> 1
        ];
        if ($loadSetings) {
            $resultado=$wpdb->update($nombre_tabla,$setings,$where);
            echo 'update'.$resultado;


        die();
        }else{
            $resultado=$wpdb->insert($nombre_tabla,$setings);
            echo 'insert'.$resultado;
            
            die();

        

        }
        
        
    }

    private function styles()
    {
        $product = wc_get_product();
        if (is_single() && is_product() && $product->get_type() !== 'variable') {
            wp_enqueue_style('wooajaxcheckoutMainStyle', plugin_dir_url(__DIR__) . '/dist/css/mainStyle.css');
            wp_enqueue_style('iconsBoostrap', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
        }
    }


    function getCities()
    {

        $nonce = sanitize_text_field($_REQUEST['nonce']);
        $shop_countries = WC()->countries->get_allowed_countries();
        if (!wp_verify_nonce($nonce, 'secure')) {
            die(json_encode([
                'Mensaje' => $nonce
            ]));
        }
        foreach ($shop_countries as $key => $country) {
            if (file_exists(dirname(__DIR__) . '/states/' . $key . '.php')) {
                include(dirname(__DIR__) . '/states/' . $key . '.php');
            }
            if (file_exists(dirname(__DIR__) . '/places/' . $key . '.php')) {
                include(dirname(__DIR__) . '/places/' . $key . '.php');
            }
        }

        die(json_encode([
            'states' => $states,
            'places' => $places
        ]));
    }

    function PostOrder()
    {

        $nonce = sanitize_text_field($_REQUEST['nonce']);
        $Form = $_POST['form'];
        $productId = $Form[0]["value"];
        $quantity = $Form[1]["value"];
        $order = wc_create_order();
        $order->add_product(wc_get_product($productId), $quantity, [
            'subtotal'     => 260000,
            'total'        => 260000,
        ]);
        $address = [
            'first_name' => $Form[2]["value"],
            'last_name' => $Form[3]["value"],
            'company' => '',
            'email' => $Form[10]["value"],
            'phone' => $Form[9]["value"],
            'address_1' => $Form[7]["value"],
            'address_2' => $Form[8]["value"],
            'city' => $Form[6]["value"],
            'state' => $Form[5]["value"],
            'postcode' => '',
            'country' => $Form[4]["value"]
        ];

        $order->set_address($address, 'billing');
        $order->set_address($address, 'shipping');
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        $order->set_payment_method($payment_gateways['cod']);
        $order->calculate_totals();
        $order->update_status('processing');
        var_dump($order);
        die();
    }

    function register_sub_menues()
    {

        $svg = base64_encode(file_get_contents(dirname(__DIR__) . '/assets/ui-radios.svg'));
        $method = WC()->payment_gateways->payment_gateways()['cod'];

        if (
            class_exists('WooCommerce')
        ) {
            if ($method->enabled === 'no') {

                echo '<div class="notice notice-error ">
                <h2>Error WooAjaxCheckout: Para usar debes habilitar metodo de contra reembolso en los ajustes de Pago de Woocommerce</h2>
                <a class=" mb-2" href=' . Site_URL() . '/wp-admin/admin.php?page=wc-settings&tab=checkout' . '><button>Ir a Ajustes Woo</button></a>
            </div>';
            }
            add_menu_page(
                'WooAjaxCheckout', //Titulo page
                'WooAjaxCheckout', //Titulo Menu
                'manage_options', //Capatability
                'WooAjaxCheckout_menu', //slug
                [$this, 'InitAdminMenu'],
                'data:image/svg+xml;base64,' . $svg,
                6
            );
            add_submenu_page(
                'WooAjaxCheckout_menu',
                'Boton de compra',
                'Boton de Compra',
                'manage_options',
                'boton-de-compra',
                [$this, 'InitSubMenuBtnCompra'],

            );
        } else {
            echo '<div class="notice notice-error ">
                <h2>Error WooAjaxCheckout: Para usar debes tener instalado y activo el plugin WooCommerce</h2>
                <a href=' . Site_URL() . '/wp-admin/plugin-install.php?s=woocommerce&tab=search&type=term' . '><button>Activar Woocomerce</button></a>
            </div>';
        }
    }
    function InitAdminMenu()
    {
        include  dirname(__DIR__) . '/views/template-admin-menu.php';
    }

    function InitSubMenuBtnCompra()
    {
        include  dirname(__DIR__) . '/views/template-boton-submenu.php';
    }

    function insert_woocommerce_checkout()
    {
        

        if (is_single() ) {

            include  dirname(__DIR__) . '/views/template-checkout.php';
        }
    }

    function add_div_after_all_the_widget(  ) {
        ?>
        <div class="after-widget">Wooajaxcheckout</div>
        <?php
    }

    function wooAjaxShortcode()
    {
        $product = wc_get_product();
        if (is_single() && is_product() && $product->get_type() !== 'variable') {
            require_once __DIR__ . '/ClassWooAjaxShortcode.php';

            $btn = new \WooAjaxShortcode;
            $html = $btn->getBtn();

            return $html;
        }
    }


    public function init()
    {

        add_action('admin_menu', [$this, 'register_sub_menues']);
        add_action('admin_enqueue_scripts', [$this, 'AdmincheckoutScripts']);
        add_action('wp_enqueue_scripts', [$this, 'wooajaxcheckoutScripts']);
        add_action('wp_ajax_nopriv_getCitiesAC', [$this, 'getCities']);
        add_action('wp_ajax_getCitiesAC', [$this, 'getCities']);
        add_action('wp_body_open', [$this, 'insert_woocommerce_checkout'], 200);
        add_shortcode('btnWooAjax', [$this, 'wooAjaxShortcode']);
        add_action('wp_ajax_nopriv_PostOrder', [$this, 'PostOrder']);
        add_action('wp_ajax_PostOrder', [$this, 'PostOrder']);
        add_action('wp_ajax_nopriv_SaveBtnSetings', [$this, 'SaveBtnSetings']);
        add_action('wp_ajax_SaveBtnSetings', [$this, 'SaveBtnSetings']);
        add_action( 'elementor/frontend/widget/after_render', 'add_div_after_all_the_widget' );
    }
}
