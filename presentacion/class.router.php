<?php

ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

include_once '../negocios/class.usuario_neg.php';

$p_code=base64_decode($_POST["p_code"]);

switch ($p_code) {
    case 1:
        $p_correo                   =base64_decode($_POST["p_correo"]);
        $p_nombre                   =base64_decode($_POST["p_nombre"]);
        $p_cargo                    =base64_decode($_POST["p_cargo"]);
        $p_establecimiento          =base64_decode($_POST["p_establecimiento"]);
        $p_funcionario              =base64_decode($_POST["p_funcionario"]);
        $p_pass                     =base64_decode($_POST["p_pass"]);

        $obj=new usuario_neg();
        $obj->ObtieneXPks_neg($p_correo);

        if($obj->getFilas()==0){
            $obj->InsertarRegistros_neg($p_correo,ucfirst($p_nombre),ucfirst($p_cargo),ucfirst($p_establecimiento),ucfirst($p_funcionario),$p_pass);
            echo "<!--INGRESADO-->";
        }
        break;
    case 2:
        $p_correo       =base64_decode($_POST["p_correo"]);
        $p_pass         =base64_decode($_POST["p_pass"]);
        
        $obj=new usuario_neg();
        $obj->ValidaClave_neg($p_correo,$p_pass);
        $obj->getSet();
        
        if($obj->getCorreo()){
            session_start();
            $_SESSION['correo']         = $p_correo;
            $_SESSION['nombre']         = $obj->getNombre();
            $_SESSION['funcionario']    = $obj->getFuncionario();

            if ($obj->getFuncionario()=='Jardin') {
                echo "<!--VALIDADO_JAR-->";
            }else if ($obj->getFuncionario()=='Jardin - Administrador') {
                echo "<!--VALIDADO_JAR_ADM-->";
            }else if ($obj->getFuncionario()=='Direccion Regional') {
                echo "<!--VALIDADO_DIR-->";
            }else if ($obj->getFuncionario()=='Direccion Regional - Administrador') {
                echo "<!--VALIDADO_DIR_ADM-->";
            }
        }else{
            echo "<!--INCORRECTO-->";
        }
        break;
    case 3:
        $p_correo   =base64_decode($_POST["p_correo"]);

        $obj=new usuario_neg();
        $obj->EliminarRegistros_neg($p_correo);
        $obj->ObtieneXPks_neg($p_correo);

        if($obj->getFilas()==0){
           echo "<!--ELIMINADO-->";
        }else{
            echo "<!--ERROR-->";
        }
        break;
}

?>