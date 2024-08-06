<?php

$listaIcons = [
    1 => 'bi bi-house-check-fill',
    2 => 'bi bi-house-door',
    3 => 'bi bi-house-heart-fill',
    4 => 'bi bi-house'
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
} else {
    $btntitle = 'Compra Ahora';
    $btnsubtitle = 'Paga en casa';
    $btntextcolor = '#ffffff';
    $btncolor = '#000000';
    $btnanimated = 'animate-btn_saltar';
    $btnicon = '<i id="1" class=" ml-2 text-lg bi bi-house-heart-fill"></i>';
    $btnBorder = '#ffffff';
}

?>

<div>
    <div id="wooAjaxCheckLoading" class=" hidden opacity-80  bg-slate-200 absolute top-0 left-0 w-full h-full">
        <div class=" flex w-full h-full items-center justify-center ">
            <span class=" animate-wooAjaxCheckLoading text-xl font-bold w-auto h-auto">Guardando...</span>

        </div>

    </div>
    <h1 class=" text-xl font-bold">Ajustes del Boton</h1>
    <div class=" flex flex-row mt-5">
        <div class=" flex flex-col w-[50%] justify-center">
            <form id="formBtnsetings" class="  w-[90%] mx-auto ">
                <div class=" flex flex-col justify-between m-2 sm:flex-col">
                    <label>Texto Principal del boton</label>
                    <input id="btntitle" type="text" name="btntitle" value='<?php echo $btntitle ?>' placeholder='<?php echo $btntitle ?>'>
                </div>
                <div class=" flex flex-col justify-between m-2 ">
                    <label>Texto Secundario del boton</label>
                    <input id="btnsubtitle" type="text" name="btnsubtitle" value='<?php echo $btnsubtitle ?>' placeholder="<?php echo $btnsubtitle ?>">
                    <div class="flex flex-col justify-between m-2 ">
                        <label>Color del texto</label>
                        <input id="btntextcolor" type="color" name="btntextcolor" value="<?php echo $btntextcolor ?>">
                    </div>
                    <div class="flex flex-col justify-between m-2 ">
                        <label>Color del boton</label>
                        <input id="btncolor" type="color" name="btncolor" value="<?php echo $btncolor ?>">
                    </div>
                    <div class="flex flex-col justify-between m-2 ">
                        <label>Color del borde</label>
                        <input id="btnbordercolor" type="color" name="btnbordercolor" value="<?php echo $btnbordercolor ?>">
                    </div>
                    <div class="flex flex-col justify-between m-2 ">
                        <label>Grosor borde</label>

                        <input type="range" id="btnborder" name="btnborder" min="0" max="6" value="<?php echo $btnBorder ?>" />
                    </div>
                </div>

                <div class="flex flex-col justify-between m-2 ">
                    <label>Usar Animacion del boton</label>
                    <select name="btnanimated" id="btnanimated">

                        <option selected value="true">Si</option>
                        <option value="flase">No</option>
                    </select>

                </div>

                <div class="flex flex-col justify-between m-2 ">
                    <label>Icono boton</label>
                    <div id="ListaIcons">
                        <?php foreach ($listaIcons as $key => $value) {
                            echo "<label>
                        <input id=wooIcon$key  name='btnicon' class='peer  !hidden' type='radio' value=$key />
                        <i  class= 'mt-1 peer peer-checked:border-2 peer-checked:border-green-600 peer-checked:rounded-lg ml-2 text-lg $value'></i>
                    </label>";
                        } ?>
                    </div>

                </div>



                <button  tipe="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Guardar
                </button>

            </form>



        </div>

        <div class='flex justify-center w-[50%] items-center'>
            <div>
                <button id="btnSample" class=' <?php if ($btnanimated === '1') {
                                                    echo 'animate-btn_saltar';
                                                }  ?>  px-3 py-1 rounded-md border-2  text-xl font-bold' style="background-color: <?php echo $btncolor; ?>; color: <?php echo $btntextcolor; ?>; border-color: <?php echo $btnbordercolor; ?>; border-width: <?php echo $btnBorder; ?>px;">
                    <?php echo $btntitle ?> <br>
                    <span id="btnSampleSubtitle" class='!text-xs'>
                        <?php echo $btnsubtitle ?>
                    </span>
                    <span id="btnicon"><?php echo "
                        <i id='wooIcon$btnicon' class= 'mt-1  ml-2 text-lg $listaIcons[$btnicon]'></i>
                    ";  ?>
                    </span>
                </button>

            </div>
        </div>

    </div>