<?php

$ofproductid = $_GET['ofproductid'];
global $wpdb;
$nombre_tabla = $wpdb->prefix . 'WooAjaxCheckoutTkYouPage';
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
    
}

if ($ofproductid) {

    $loadSetings = $wpdb->get_results("SELECT * FROM " . $nombre_tabla . " WHERE productid = $ofproductid");
    
    if ($loadSetings) {
        $tkurl = $loadSetings[0]->url;
        
        
    } else {
        $tkurl = 'https//yoursite.com/custom-tk-page';
        
    }


?>

    <div>Pagina de gracias personalizada</div>

    <div class=" flex flex-row mt-5">
        <div class=" flex flex-col w-[40%] justify-center">
        <?php echo $image_url ?>

            <form id="formTkSetings" class="  w-[90%] mx-auto ">
                <div class="flex flex-col justify-between m-2 ">
                    <label>Selecciona un producto</label>
                    <select name="ofproduct" id="ofproductinit" >
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
                    <label>Url pagina gracias personalizada</label>
                    <input required id="tkurl" type="url" name="tkurl" value='<?php echo $tkurl ?>' placeholder='<?php echo $tkurl ?>'>
                </div>
                
                
                <button  tipe="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Guardar
                </button>

            </form>
        </div>

        <div class='flex flex-col justify-center w-[60%] items-center'>
            <?php
            
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