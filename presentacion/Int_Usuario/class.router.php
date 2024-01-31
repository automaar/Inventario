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
                                echo '</tr>';
                            }
                    echo '</tbody>';
                echo '</table>';
            echo '</div>';
        echo '</div>';

        break;

    case 8:
        session_start();

        session_destroy();
        echo '<script> window.location= "../Index.php" </script>';

        break;
}

?>