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
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'WooAjaxCheckoutSetings';
    $nombre_tabla2 = $wpdb->prefix . 'WooAjaxCheckoutOferSetings';
    $nombre_tabla3 = $wpdb->prefix . 'WooAjaxCheckoutTkYouPage';
    try {
        $sql = "CREATE TABLE " . $nombre_tabla . "(
            id INT NOT NULL AUTO_INCREMENT,
                btntitle VARCHAR(50) NULL,
                btnsubtitle VARCHAR(50) NULL,
                btntextcolor VARCHAR(20) NULL,
                btncolor VARCHAR(20) NULL,
                btnbordercolor VARCHAR(20) NULL,
                btnanimated BOOLEAN NULL,
                btnicon INT NULL,
                btnborder INT NULL,
                
                PRIMARY KEY  (id));";

        $sql2 = "CREATE TABLE " . $nombre_tabla2 . "(
                    id INT NOT NULL AUTO_INCREMENT,
                        ofproductid INT NOT NULL,
                        oftitle VARCHAR(50) NULL,
                        oftitlecolor VARCHAR(20) NULL,
                        ofcantidad INT NULL,
                        ofprice INT NULL,
                        ofpricecolor VARCHAR(20) NULL,
                        oftikectcolor VARCHAR(20) NULL,
                        oftiketextcolor VARCHAR(20) NULL,
                        ofobsequioid INT NULL,
                        
                        PRIMARY KEY  (id));";

        $sql3 = "CREATE TABLE " . $nombre_tabla3 . "(
                            id INT NOT NULL AUTO_INCREMENT,
                                productid INT NOT NULL,
                                url VARCHAR(250) NULL,
                                
                                PRIMARY KEY  (id));";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        dbDelta($sql2);
        dbDelta($sql3);
    } catch (\Throwable $th) {
        echo '<div class="notice notice-error ">
                <h2>Error WooAjaxCheckout: Para usar debes tener instalado y activo el plugin WooCommerce</h2>
                <a href=' . Site_URL() . '/wp-admin/plugin-install.php?s=woocommerce&tab=search&type=term' . '><button>Activar Woocomerce</button></a>
            </div>';
    }
}

register_activation_hook(__FILE__, "Activar");

function Desactivar()
{
}
register_deactivation_hook(__FILE__, "Desactivar");
function Uninstall()
{
}
register_uninstall_hook(__FILE__, 'Uninstall');


require_once(__DIR__ . '/clases/ClassWooajaxcheckout.php');
$init = new \Wooajaxcheckout;
$init->init();
