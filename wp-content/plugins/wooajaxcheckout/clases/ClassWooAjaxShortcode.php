<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class WooAjaxShortcode
{

    function getBtn()
    {
        $listaIcons=[
            1=>'bi bi-house-check-fill',
            2=>'bi bi-house-door',
            3=>'bi bi-house-heart-fill',
            4=>'bi bi-house'
        ];
        global $wpdb;
        $nombre_tabla = $wpdb->prefix . 'WooAjaxCheckoutSetings';
        $loadSetings = $wpdb->get_row("SELECT * FROM " . $nombre_tabla . " WHERE id = 1");
        
        if ($loadSetings) {
            $btntitle = $wpdb->get_var(" SELECT btntitle FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btnsubtitle = $wpdb->get_var(" SELECT btnsubtitle FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btntextcolor =  $wpdb->get_var(" SELECT btntextcolor FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btncolor =  $wpdb->get_var(" SELECT btncolor FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btnanimated = $wpdb->get_var(" SELECT btnanimated FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btnicon = $wpdb->get_var(" SELECT btnicon FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btnBorder =  $wpdb->get_var(" SELECT btnborder FROM " . $nombre_tabla . " WHERE id = 1 ");
            $btnbordercolor =  $wpdb->get_var(" SELECT btnbordercolor FROM " . $nombre_tabla . " WHERE id = 1 ");
            if (!$btnicon) {
                $btnicon = '<i class=" ml-2 text-lg bi bi-house-heart-fill"></i>';
            }
            if ($btnanimated === '1') {
                $btnanimated= 'animate-btn_saltar';
            }
        } else {
            $btntitle = 'Compra Ahora';
            $btnsubtitle = 'Paga en casa';
            $btntextcolor = '#ffffff';
            $btncolor = '#000000';
            $btnanimated = 'animate-btn_saltar';
            $btnicon = '<i class=" ml-2 text-lg bi bi-house-heart-fill"></i>';
            $btnBorder = '#ffffff';
        }

        $btn = "<div class= 'flex justify-center'> 
        <button id='btnSample' class='  $btnanimated  px-3 py-1 rounded-md border-2  text-xl font-bold' style='background-color:  $btncolor; color: $btntextcolor; border-color: $btnbordercolor; border-width:  $btnBorder px;'>
                    $btntitle  <br>
                    <span id='btnSampleSubtitle' class='!text-xs'>
                        $btnsubtitle
                    </span>
                    <span id='btnicon'>
                        <i style=' color: $btntextcolor;' id='wooIcon$btnicon' class=' !w-8 !h-8 !ml-2 !text-lg $listaIcons[$btnicon]'></i>
                        
                    </span>
                </button>
                </div>";
                
        return $btn;
    }
}
