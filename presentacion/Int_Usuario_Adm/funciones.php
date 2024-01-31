<?php
ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

function cargarPaginado($vall){
    $contraseña = "";
    $usuario = "root";
    $nombre_base_de_datos = "inventario_junji";
    try {
        $base_de_datos = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
        $base_de_datos->query("set names utf8;");
        $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (Exception $e) {
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
    }
    $sentencia = $base_de_datos->query("SELECT count(*) AS conteo FROM materiales");
    $conteo = $sentencia->fetchObject()->conteo;

    $productosPorPagina = 10;

    $pagina = 1;
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
    }

    $limit = $productosPorPagina;

    $offset = ($pagina - 1) * $productosPorPagina;

    $sentencia = $base_de_datos->query("SELECT count(*) AS conteo FROM materiales");
    $conteo = $sentencia->fetchObject()->conteo;

    $paginas = ceil($conteo / $productosPorPagina);


    $sentencia = $base_de_datos->prepare("SELECT * FROM materiales LIMIT ? OFFSET ?");
    $sentencia->execute([$limit, $offset]);
    $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);

    ?>
    <div id="Usuario" class="rounded-lg bg-gray-50 p-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="tablaTodo" class="p-2 w-full text-sm text-left rtl:text-right text-gray-500">
                <caption class="pb-2.5 pt-2 pl-4 text-lg font-semibold text-left rtl:text-right text-gray-600 bg-white">
                    SELECCIONE EL MATERIAL QUE REQUIERE :
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4 w-10">
                            Seleccione
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Codigo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Item
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                    </tr>
                </thead>
                <tbody id="root">
                    <?php foreach ($productos as $producto) { 
                        if ($producto->stok <= $producto->stok_minimo) { ?>
                            <tr class="border-b bg-red-100 hover:bg-red-200">
                        <?php } else{ ?>
                            <tr class="border-b bg-green-100 hover:bg-green-200">
                        <?php } ?>
                            <td class="flex justify-center">
                                <div id="codigoValiar" class="pt-3.5">
                                    <?php if ($producto->stok!=0) {?>
                                        <button type="button" name="<?php echo $producto->stok ?>" onClick="pedirArticulo(this.name, '<?php echo $producto->item ?>')">
                                            <a href="#" class="font-semibold text-gray-500 inline-block hover:text-gray-700 border-b-2 hover:border-gray-300 rounded-t-lg">PEDIR</a>
                                        </button>
                                    <?php } ?>
                                </div>
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap"><?php echo $producto->codigo ?></th>
                            <td class="px-6 py-4 hover:text-gray-600"><?php echo $producto->item ?></td>
                            <td class="px-6 py-4"><?php echo $producto->unidad ?></td>
                                <?php if ($producto->stok==0) { ?>
                                    <td class="px-6 py-4 font-bold text-gray-400 whitespace-nowrap">AGOTADO</td>
                                <?php } else {?>
                                    <td class="px-6 py-4"><?php echo $producto->stok ?></td>
                                <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <div class="flex flex-row justify-between px-5 pt-2">
            <div class="md:fixed md:buttom-36 md:left-60">
                <p class="font-semibold text-gray-500 md:w-full w-16">Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> productos disponibles</p>
            </div>
            <div class="md:fixed md:buttom-36 md:right-16">
                <p class="font-semibold text-gray-500 flex justify-right">Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
            </div>
        </div>
    </div>

    <div class="md:fixed md:buttom-36 md:right-14 md:p-10 pt-6 pb-16 flex justify-center">
        <div class="flex">
            <?php if ($pagina > 1) { ?>
                <div>
                    <button>
                        <a href="./mainUA.php?pagina=<?php echo $pagina - 1 ?>" onClick="localStorage.setItem('N_pag','<?php echo $pagina - 1 ?>')" class="flex items-center justify-center px-5 h-10 me-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                            </svg>
                            Anterior
                        </a>
                    </button>
                </div>
            <?php } ?>
    
            <div id="mostrarPagina" class="flex items-center justify-center px-4 h-10 me-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                <?php echo $pagina ?>
            </div>
    
            <?php if ($pagina < $paginas) { ?>
                <div>
                    <button>
                        <a href="./mainUA.php?pagina=<?php echo $pagina + 1 ?>" onClick="localStorage.setItem('N_pag','<?php echo $pagina + 1 ?>')" class="flex items-center justify-center px-5 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Siguiente
                        </a>
                    </button>
                </div>
            <?php } ?>
        </div>
    </div>
    
<?php } ?>