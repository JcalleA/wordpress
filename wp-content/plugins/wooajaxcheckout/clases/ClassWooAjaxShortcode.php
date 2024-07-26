<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}



class WooAjaxShortcode
{

    function getBtn($productId,)
    {
        
        if (wc_get_product($productId)) {
            global $wpdb;
            
            $nombre_tabla = $wpdb->prefix . 'WooAjaxCheckoutOferSetings';
            $loadSetings = $wpdb->get_results("SELECT * FROM " . $nombre_tabla . " WHERE ofproductid = $productId" );
            $product = wc_get_product($productId);
            $image_url = $product->get_image();
            $regularPrice = number_format( $product->get_regular_price());
            $ofers='';
            if ($product->get_sale_price()) {
                $salePrice = number_format( $product->get_sale_price());
                $salePrice2 = number_format( $product->get_sale_price());
            }else{
                $salePrice=$regularPrice;
            }
            
        };

        if ($loadSetings) {
            foreach ($loadSetings as $val) {
                $ofDiscount = ceil(($salePrice / $val->ofprice) * 100);
                $ofers.="<label class='border border-black ml-2 mr-2 rounded-md rarioContainer cursor-pointer flex flex-row items-center justify-around '>
                <input class=' radioCheckout  !hidden ' type='radio' name='image-select' value='1' />
                <div class=' w-[20%]'>
                    <picture class='  '>
                         $image_url 
                    </picture>
                </div>
                <div class=' w-[40%]'>
                    <h3> <?php echo $val->oftitle ?> </h3>
                    <span class='break-keep py-1 px-2 '>Ahorra  $ofDiscount %</span>
                </div>
                <div class='text-lg font-black '>
                     $val->ofprice 

                </div>

            </label>" ;

            }}else{
                $ofDiscount=ceil(100-($salePrice/$regularPrice)*100);
                
                $ofers="<label class=' border border-black m-2 rounded-md rarioContainer cursor-pointer  flex flex-row items-center justify-around'>
                    <input class=' radioCheckout  !hidden ' type='radio' name='image-select' value='1' />
                    <div class=' w-[20%]'>
                        <picture class=' '>
                             $image_url

                        </picture>
                    </div>
                    <div class=' w-[40%]'>
                        <h3>Compra 1 unidad</h3>
                        <span class='break-keep py-1 px-2 bg-gray-400 text-white'>Ahorra $ofDiscount%</span>
                    </div>
                    <div class='text-lg font-black'>
                        $salePrice

                    </div>
                </label>";
                
            };

        $shop_countries = WC()->countries->get_allowed_countries();
        $wpSiteTitle = get_bloginfo('name');
        foreach ($shop_countries as $key => $country) {
            if (file_exists(dirname(__DIR__) . '/states/' . $key . '.php')) {
                include(dirname(__DIR__) . '/states/' . $key . '.php');
            }
            if (file_exists(dirname(__DIR__) . '/places/' . $key . '.php')) {
                include(dirname(__DIR__) . '/places/' . $key . '.php');
            }
        }

        $listaIcons = [
            1 => 'bi bi-house-check-fill',
            2 => 'bi bi-house-door',
            3 => 'bi bi-house-heart-fill',
            4 => 'bi bi-house'
        ];
        foreach ($shop_countries as $key => $country) {
            $ListCountries.= "<option key=$key value=$key>$country</option>";
        }
        ;
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
                $btnanimated = 'animate-btn_saltar';
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

        $method = WC()->payment_gateways->payment_gateways()['cod'];
        if ($method->enabled === 'yes') {
            $resumen = "<div class=' bg-green-100 flex flex-col w-[60%] mx-auto mt-3 text-xl font-bold' >
                        <div class=' flex flex-row justify-between' >
                            <span >Subtotal</span>
                            <span id='SubTotal' class=' text-red-600 line-through' >$ $salePrice </span>
                        </div>

                        <div class=' flex flex-row justify-between'>
                            <span  >Envío</span>
                            <span class=' text-green-600' >Gratis</span>
                        </div>
                        <div class=' flex flex-row justify-between'>
                            <span>Total</span>
                            <span class=' border-2 animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] border-black rounded-lg py-1 px-3'>$ $salePrice</span>
                        </div>
                    </div>";
        } else {
            $resumen = "<span class=' text-2xl text-red-500 font-bold' >No tiene configurado metodo contra contra reembolso</span>";
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
                </div>
                <div id='wooajaxcheckout' class=' font-[roboto] hidden fixed  !top-2 !z-[100]  overflow-auto  border-2 inset-x-0 mx-auto border-black bg-slate-50  w-[98%] sm:w-[75%] lg:w-[50%] rounded-lg h-[98vh] pb-5 '>
    <div>
        <h2> $wpSiteTitle </h2>
    </div>
    <div id='btnCloseCheckout' class=' cursor-pointer hover:scale-110 btnCloseCheckout absolute !top-1 !right-3 !z-[101]'>
        <i class='bi bi-x-square-fill  p-2'></i>
    </div>

    
    <form id='WooAjaxForm'>
        <input class=' hidden' type='number' name='productId' value='$productId' />


        <!-- Ofertas -->
        <div class=' '>
            $ofers
        </div>

        <!-- Resumen -->
        $resumen


        <div class=' text-black text-lg  mx-auto border-2 border-black rounded-md p-3 mt-3 mb-5 w-[95%] sm:w-[80%]'>

            <h5 class=' ml-2 text-xl font-semibold text-center'>Datos Para El Envio</h5>

            <!-- Nombres -->
            <div class=' flex items-center flex-row m-1 mt-5 rounded-md text-center border-2 border-black'>
                <div class=' py-2 animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] w-[13%]'>
                    <i class='bi bi-person-bounding-box text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input required class=' checkoutInpuSelect text-center   ' placeholder='Nombres' type='text' name='first_name' id='first_name' />

                </div>

            </div>

            <!-- Apellidos -->
            <div class=' flex items-center flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-person-bounding-box text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input required class='checkoutInpuSelect  text-center  ' placeholder='Apellidos' type='text' name='last_name' id='last_name' />
                </div>
            </div>

            <!-- Paises -->
            <div class=' items-center flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-pin-map text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <select required name='country' class=' checkoutInpuSelect  text-center' id='countrySelect'>
                        <option value='Seleccionar Pais'>Seleccionar Pais</option>
                        $ListCountries
                    </select>

                </div>

            </div>

            <!-- Departamentos -->
            <div class='items-center flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-buildings text-2xl'></i>
                </div>
                <div id='WooFormDepartments' class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                </div>
            </div>

            <!-- Ciudades -->
            <div class='items-center  flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-buildings text-2xl'></i>
                </div>
                <div id='WooFormCities' class='w-[87%] h-[100%] fill-current text-center  rounded-md'>


                </div>

            </div>

            <!-- Direccion -->
            <div class='items-center  flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-geo-alt-fill text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input class='checkoutInpuSelect  text-center ' required type='text' placeholder='Direccion Carrera... #calle..' name='address_1' id='address_1' />
                </div>
            </div>

            <!-- Barrio -->
            <div class='items-center  flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-houses text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input class='checkoutInpuSelect text-center ' required placeholder='Barrio' type='text' name='address_2' id='WooFormBarrio' />
                </div>
            </div>

            <!-- Celular -->
            <div class='items-center  flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto]   bg-gray-300 p-2 w-[13%] h-[100%] '>
                    <i class='bi bi-whatsapp text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input class='checkoutInpuSelect  text-center ' required placeholder='Celular' type='tel' name='phone' pattern='[0-9]{10}' id='WooFormCelular' />

                </div>
            </div>

            <!-- correo -->
            <div class='items-center  flex flex-row m-1 mt-2 rounded-md text-center border-2 border-black'>
                <div class=' animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] p-2 bg-gray-300 w-[13%] h-full'>
                    <i class='bi bi-envelope-at-fill text-2xl'></i>
                </div>
                <div class='w-[87%] h-[100%] fill-current text-center  rounded-md'>
                    <input class='checkoutInpuSelect text-center ' required placeholder='Correo' type='email' name='email' pattern='[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?' id='WooFormCorreo' />

                </div>
            </div>

            <!-- Check Envio -->
            <div class='items-center  flex flex-row m-1 mt-2 p-2 bg-green-200 rounded-md text-center border-2 border-black'>
                <div class='w-[10%]'>
                    <input class=' !scale-150 checkoutInpuSelect  !text-2xl text-center rounded-md mx-2' name='Check' value='Check' type='checkbox' required />

                </div>
                <div class=' !text-sm'>
                    <label htmlFor='Check'>Confirmo que estoy dispuesto a recibir el producto y pagar el valor cuando este sea entregado.</label>

                </div>
            </div>

            <!-- Boton Submit -->
            <div class=' align-middle'>
                <button id='WooAjaxFormBtn' class=' flex justify-center shadow-md shadow-black font-semibold text-xl mx-auto items-center px-2 py-3 my-4 animate-text-gradient bg-gradient-to-r from-[#44a054] via-[#70db75] to-[#44a054] bg-[200%_auto] border-2 border-black rounded-full'>Finalizar Pedido
                    <div>
                        <i class='bi bi-bag-check-fill text-2xl ml-2'></i>
                    </div>
                </button>
            </div>
        </div>
    </form>

    <script>
        function displayCheckout() {
            jQuery(document).ready(function($) {
                $('#wooajaxcheckout').toggleClass('hidden');
            })
        }
    </script>
</div>
</div>";

        return $btn;
    }
}
