<?php

$ofproductid = $_GET['ofproductid'];
global $wpdb;
$nombre_tabla = $wpdb->prefix . 'WooAjaxCheckoutOferSetings';
$args = array(
    'limit' => 100,
    'orderby' => 'date',
    'order' => 'DESC',
    'type' => 'simple'
);

// Perform Query
$query = new WC_Product_Query($args);
// Collect Product Object
$products = $query->get_products();
// Loop through products
if ($ofproductid) {
    $product = wc_get_product($ofproductid);
    $image_url = $product->get_image();
    $regularPrice = $product->get_regular_price();
    if ($product->get_sale_price()) {
        $salePrice = number_format($product->get_sale_price());
    } else {
        $salePrice = number_format($regularPrice);
    }
}

if ($ofproductid) {

    $loadSetings = $wpdb->get_results("SELECT * FROM " . $nombre_tabla . " WHERE ofproductid = $ofproductid");
    var_dump($loadSetings);
    if ($loadSetings) {
        $ofTitle = $loadSetings[0]->oftitle;
        $ofTitleColor = $loadSetings[0]->oftitlecolor;
        $ofcantidad = $loadSetings[0]->ofcantidad;
        $ofPrice = $loadSetings[0]->ofprice;
        $ofPriceColor = $loadSetings[0]->ofpricecolor;
        $ofTikectColor = $loadSetings[0]->oftikectcolor;
        $oftiketextcolor = $loadSetings[0]->oftiketextcolor;
        $ofobsequioid=$loadSetings[0]->ofobsequioid;
        
    } else {
        $ofTitle = 'Compra 1 Unidad';
        $ofTitleColor = '#000000';
        $ofcantidad = 1;
        $ofPrice = $salePrice;
        $ofPriceColor = '#E21212';
        $ofTikectColor = '#E21212';
        $oftiketextcolor = '#07CA0B';
        $ofobsequioid=0;
    }


?>

    <div>Crear Ofertas</div>

    <div class=" flex flex-row mt-5">
        <div class=" flex flex-col w-[40%] justify-center">

            <form id="formOfSetings" class="  w-[90%] mx-auto ">
                <div class="flex flex-col justify-between m-2 ">
                    <label>Selecciona un producto</label>
                    <select name="ofproduct" id="ofproduct">
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                if ($product->id == $ofproductid) {
                        ?>
                                    <option selected id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
                                <?php
                                } else {
                                ?>
                                    <option id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class=" flex flex-col justify-between m-2 sm:flex-col">
                    <label>Texto Principal</label>
                    <input id="ofTitle" type="text" name="ofTitle" value='<?php echo $ofTitle ?>' placeholder='<?php echo $ofTitle ?>'>
                </div>
                <div class="flex flex-col justify-between m-2 ">
                    <label>Color Texto Principal</label>
                    <input id="ofTitleColor" type="color" name="ofTitleColor" value="<?php echo $ofTitleColor ?>">
                </div>
                <div class=" flex flex-col justify-between m-2 ">
                    <label>Cantidad de Unidades</label>
                    <input id="ofcantidad" type="number" name="ofcantidad" value='<?php echo $ofcantidad ?>' placeholder="<?php echo $ofcantidad ?>">
                </div>
                <div class=" flex flex-col justify-between m-2 ">
                    <label>Valor de la oferta (Sin Puntos)</label>
                    <input id="ofPrice" type="number" name="ofPrice" value='<?php echo $ofPrice ?>' placeholder="<?php echo $ofPrice ?>">
                </div>
                <div class="flex flex-col justify-between m-2 ">
                    <label>Color Texto De La Oferta</label>
                    <input id="ofPriceColor" type="color" name="ofPriceColor" value="<?php echo $ofPriceColor ?>">
                </div>

                <div class="flex flex-col justify-between m-2 ">
                    <label>Color de la etiqueta</label>
                    <input id="ofTikectColor" type="color" name="ofTikectColor" value="<?php echo $ofTikectColor ?>">
                </div>
                <div class="flex flex-col justify-between m-2 ">
                    <label>Color texto de la etiqueta</label>
                    <input id="oftiketextcolor" type="color" name="oftiketextcolor" value="<?php echo $oftiketextcolor ?>">
                </div>
                <div class="flex flex-col justify-between m-2 ">
                <select name="ofobsequioid" id="ofobsequioid">
                <option disabled selected>Selecciona un obsequio</option>
                <option value="0">Ninguno</option>
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                if ($product->id == $ofobsequioid) {
                        ?>
                                    <option selected id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
                                <?php
                                } else {
                                ?>
                                    <option id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <button  tipe="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Guardar
                </button>

            </form>
        </div>

        <div class='flex flex-col justify-center w-[60%] items-center'>
            <?php
            if ($loadSetings) {
                foreach ($loadSetings as $val) {

                    $ofDiscount = ceil(100 - (number_format($val->ofprice) / (number_format($regularPrice) * $val->ofcantidad)) * 100);

            ?>
                    <div class=" flex flex-row items-center">

                        <label style='border-width:<?php echo $val->ofborder ?> ;border-radius: 20px ;border-color:<?php echo $val->ofbordercolor ?> ;background-color:<?php echo $val->ofbgcolor ?>;' class='border border-black ml-2 mr-2 rounded-md rarioContainer cursor-pointer flex flex-row items-center justify-around '>
                            <input class=' radioCheckout  !hidden ' type='radio' name='image-select' value='1' />
                            <div class=' w-[20%]'>
                                <picture class='  '>
                                    <?php echo $image_url ?>
                                </picture>
                            </div>
                            <div class=' text-lg w-[40%]'>
                                <h3 style=' color: <?php echo $val->oftitlecolor ?>;'> <?php echo $val->oftitle ?> </h3>
                                <span style='color: <?php echo $val->oftiketextcolor ?>;background-color:<?php echo $val->oftikectcolor  ?>' class='break-keep py-1 px-2 '>Ahorra <?php echo $ofDiscount ?>%</span>
                            </div>
                            <div style='color: <?php echo $val->ofpricecolor ?>' class='text-lg font-black '>
                                
                                <span class="line-through text-lg">$<?php echo number_format($regularPrice) ?></span>
                        </br>
                        <span id="samplePrice" class=" text-xl text-green-600" >$<?php echo number_format($val->ofprice) ?></span>

                            </div>

                        </label>
                        <div class=" flex flex-col w-[20%] items-center">
                            <button id='<?php echo $val->id ?>' class=" editOfer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Editar</button>
                            <button id='<?php echo $val->id ?>' class=" deleteOfer mt-3 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Eliminar</button>
                        </div>
                    </div>

                <?php

                }
            } else {
                ?>
                <h3>Crea O Edita Tu Oferta</h3>
                <label style='border-width:<?php echo $ofBorder ?> ;border-radius: 20px ;border-color:<?php echo $ofBorderColor ?> ;background-color:<?php echo $ofBgColor ?>;' class=' border-4 border-green-600 bg-slate-300  m-2 rounded-md rarioContainer cursor-pointer  flex flex-row items-center justify-around'>
                    <input class=' radioCheckout  !hidden ' type='radio' name='image-select' value='1' />
                    <div class=' w-[20%]'>
                        <picture class=' '>
                            <?php echo $image_url ?>

                        </picture>
                    </div>
                    <div class=' text-lg w-[40%]'>
                        <h3 id="sampleTitle" style=' color: <?php echo $ofTitleColor ?>;'>Compra 1 unidad</h3>
                        <span style='background-color:<?php echo $ofTikectColor ?>' class='break-keep py-1 px-2 bg-gray-400 text-white'>Ahorra 0%</span>
                    </div>
                    <div style='color: <?php echo $ofPriceColor ?>' class=' font-black'>
                        <span class="line-through text-lg">$<?php echo number_format($regularPrice) ?></span>
                        </br>
                        <span id="samplePrice" class=" text-xl text-green-600" >$<?php echo $salePrice ?></span>
                        
                    </div>
                </label>

        </div>

    <?php
            }
        } else {
    ?>
    <div class=" text-3xl font-bold flex flex-col justify-center items-center w-full h-[100dvh]">
        <label>Selecciona un producto</label>
        <select class=" text-2xl font-bold" id="ofproductinit">
            <option disabled selected>Selecciona un producto</option>
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
                    if ($product->id === $ofproductid) {
            ?>
                        <option id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
                    <?php
                    } else {
                    ?>
                        <option id='<?php echo $product->id ?>' value='<?php echo $product->id ?>'><?php echo $product->name ?></option>
            <?php
                    }
                }
            }
            ?>
        </select>
    </div>

<?php
        }
