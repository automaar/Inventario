<?php
ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

include_once './funciones.php';
include_once '../../negocios/class.materiales_neg.php';
include_once '../../negocios/class.registro_neg.php';
include_once '../../negocios/class.usuario_neg.php';
include_once '../../datos/class.bd_sql.php';


$p_code     =base64_decode($_POST["p_code"]);
$vall=1;
$UCode;

switch ($p_code) {
    case 1:
        $p_codigo           =base64_decode($_POST["p_codigo"]);
        $p_item             =base64_decode($_POST["p_item"]);
        $p_unidad           =base64_decode($_POST["p_unidad"]);
        $p_stok_minimo      =base64_decode($_POST["p_stok_minimo"]);
        $p_stok             =base64_decode($_POST["p_stok"]);
        $p_requerimiento    =null;

        if ($p_stok_minimo>=$p_stok) {
            $p_requerimiento='Solicitar Material';
        }else{
            $p_requerimiento='Hay Suficiente';
        }

        $obj=new materiales_neg();
        $obj->ObtieneXPks_neg($p_codigo);
        $obj->getFilas();

        if($obj->getFilas()==0){
            $obj->InsertarRegistros_neg($p_codigo,ucfirst($p_item),ucfirst($p_unidad),$p_stok_minimo,$p_stok,$p_requerimiento);
            echo "<!--INGRESADO-->";
        }
        break;

    case 2:
        echo '<div id="Utiliario" class="p-5 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">';
            echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">';
                echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500">';
                    echo '<caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">';
                        echo 'Materiales';
                    echo '</caption>';
                    echo '<thead class="text-xs text-gray-700 uppercase">';
                        echo '<tr>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Codigo';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Item';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Unidad';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Stok Minimo';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Stok';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Requerimiento';
                            echo '</th>';
                            echo '<th scope="col" class="">';
                                echo '';
                            echo '</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody id="utiliario">';
                        $obj_usuario=new materiales_neg();
                        $obj_usuario->ObtieneTodos_neg();

                        echo '<tbody>';
                            for($i=0;$i<$obj_usuario->getFilas();$i++){
                                $obj_usuario->getSet($i);

                                if ($obj_usuario->getStok()<=$obj_usuario->getStok_minimo()) {
                                    echo '<tr class="border-b bg-red-100 hover:bg-red-200">';
                                }else{
                                    echo '<tr class="border-b bg-green-100 hover:bg-green-200">';
                                }
                                    echo '<th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap">'.$obj_usuario->getCodigo().'</th>';
                                    echo '<td class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">'.$obj_usuario->getItem().'</td>';
                                    echo '<td class="px-6 py-4">'.$obj_usuario->getUnidad().'</td>';
                                    echo '<td class="px-6 py-4">'.$obj_usuario->getStok_minimo().'</td>';
                                    echo '<td class="px-6 py-4">'.$obj_usuario->getStok().'</td>';
                                    echo '<td class="px-6 py-4 font-medium text-gray-400 whitespace-nowrap hover:text-gray-600">'.$obj_usuario->getRequerimiento().'</td>';
                                    echo '<td class="px-6 py-4"><img src="../Img/basurero.png" class="w-7 h-7 transition duration-300 ease-in-out hover:-translate-y-2" onClick="eliminar_registro(\''.base64_encode(7).'\',\''.base64_encode(2).'\',\''.$obj_usuario->getCodigo().'\')"></td>';
                                echo '</tr>';
                            }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        echo '</div>';

        break;

    case 3:

        
        break;
    case 4:
        echo '<div id="Registro" class="p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">';
            echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">';
                echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500">';
                    echo '<caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">';
                        echo 'Registro';
                    echo '</caption>';
                    echo '<thead class="text-xs text-gray-700 uppercase">';
                        echo '<tr>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Codigo';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Fecha';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Item';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Unidad';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Entrada';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Salida';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Entregado A';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Jardin';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Observaciones';
                            echo '</th> <th scope="col" class="px-6 py-3">';
                                echo 'N° Registro';
                            echo '</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody id="Reg">';
                        $obj_usuario=new registro_neg();
                        $obj_usuario->ObtieneTodos_neg();

                        echo '<tbody>';
                        for($i=0;$i<$obj_usuario->getFilas();$i++){
                            $obj_usuario->getSet($i);

                            echo '<tr class="border-b bg-green-100">';
                                echo '<th scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap">'.$obj_usuario->getCodigo().'</th>';
                                echo '<td class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap">'.$obj_usuario->getFecha().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getItem().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getUnidad().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getEntrada().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getSalida().'</td>';
                                echo '<td class="px-6 py-4 font-medium text-gray-600 whitespace-nowrap">'.$obj_usuario->getEntregado_a().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getJardin().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getObservaciones().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getN_registro().'</td>';
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        echo '</div>';

        break;
    case 5:
        echo '<div id="Usuario" class="p-5 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">';
            echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">';
                echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500">';
                    echo '<caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">';
                        echo 'Listado de Usuarios Registrados';
                    echo '</caption>';
                    echo '<thead class="text-xs text-gray-700 uppercase">';
                        echo '<tr>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Correo';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Nombre';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3 bg-gray-50">';
                                echo 'Cargo';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Establecimiento';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Funcionario';
                            echo '</th>';
                            echo '<th scope="col" class="px-6 py-3">';
                                echo 'Contraseña';
                            echo '</th>';
                        echo '</tr>';
                    echo '</thead>';

                    $obj_usuario=new usuario_neg();
                    $obj_usuario->ObtieneTodos_neg();

                    echo '<tbody>';
                        for($i=0;$i<$obj_usuario->getFilas();$i++){
                            $obj_usuario->getSet($i);

                            echo '<tr class="border-b bg-green-100 hover:bg-green-200">';
                                echo '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">'.$obj_usuario->getCorreo().'</th>';
                                echo '<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">'.$obj_usuario->getNombre().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getCargo().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getEstablecimiento().'</td>';
                                echo '<td class="px-6 py-4">'.$obj_usuario->getFuncionario().'</td>';
                                echo '<td class="px-6 py-4">';
                                    $a = 0;
                                    while ($a != strlen($obj_usuario->getPass())) {
                                        echo '*';
                                        $a = $a+1;
                                    };
                                echo '</td>';
                            echo '</tr>';
                        }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        echo '</div>';

        break;

    case 6:
        cargarPaginado($vall);

        break;

    case 7:
        $p_codigo          =base64_decode($_POST["p_codigo"]);

        $obj=new materiales_neg();
        $obj->EliminarRegistros_neg($p_codigo);
        $obj->ObtieneXPks_neg($p_codigo);

        if($obj->getFilas()==0){
            echo "<!--ELIMINADO-->";
        }else{
            echo "<!--ERROR-->";
        }
        
        break;

    case 8:
        session_start();

        session_destroy();
        echo '<script> window.location= "../Index.php" </script>';

        break;
}

?>