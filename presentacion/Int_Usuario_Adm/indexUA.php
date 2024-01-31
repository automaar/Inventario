<?php
session_start();
if(!isset($_SESSION['correo']))
{
    header('Location: ../index.php');

    exit();
}

ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

include_once '../../negocios/class.materiales_neg.php';
include_once '../../negocios/class.usuario_neg.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jan 1900 05:00:00 GMT"); // Indicamos una fecha en el pasado

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Inventario Junji</title>';
    echo '<link rel="icon" type="image/x-icon" href="../Img/favicon-16x16.png">';
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />';
    echo '<script defer src="../Js/main.js"></script>';
    echo '<link rel="stylesheet" href="../Style/style.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script type="text/javascript" language="javascript" src="../Js/funciones_base.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="../Js/funciones.js"></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>';

    echo '<script type="text/javascript" language="javascript">
            function guardar_form(varcode){
                var v_respuesta;
                var varurl;
                var vartarget;
                varurl="class.router.php";
                vartarget="div_msg";



                varparam="p_code="+varcode;


                Swal.fire({
                    title: "¿Desea Agregar el Material?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                }).then((result) => {
                    if(result.isConfirmed){
                        var ajax=fgo_Ajax();

                        ajax.open("POST",varurl);
                        ajax.onreadystatechange=function()
                            {
                                if(ajax.readyState==1){
                                    $("[id="+vartarget+"]").html("Cargando!!");
                                }
                                if(ajax.readyState==4){
                                    if (ajax.responseText.indexOf("<!--INGRESADO-->") != -1) {
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "El Artículo se Agregó Correctamente",
                                            showConfirmButton: false,
                                            timer: 1800
                                        });
                                        setTimeout(() => {
                                            window.location="indexUA.php";
                                        }, "2000");
                                    }else if(ajax.responseText.indexOf("<!--ACTUALIZADO-->") != -1) {
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "El Artículo se Modificó Correctamente",
                                            showConfirmButton: false,
                                            timer: 1800
                                        });
                                        setTimeout(() => {
                                            window.location="indexUA.php";
                                        }, "2000");
                                    }else if(ajax.responseText.indexOf("<!--ERROR-->") != -1) {
                                        Swal.fire("Ocurrió un Error");
                                    }
                                }
                            }
                        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        ajax.send(varparam);
                    }
                });
            }
    </script>';

    echo '<script type="text/javascript" language="javascript">

        async function instrucciones(){
            const { value: accept } = await Swal.fire({
                title: "Ayuda",
                inputValue: 1,
                html: `
                    <h3 class="font-semibold text-gray-500 text-justify ">
                        Si desea Ingresar un Artículo nuevo use el que está Ingresado por defecto y complete las demás casillas Correspondientes. </br>
                        En Cambio si Desea Modificar los Datos de algún Artículo Agregado Ingrese su codigo Correspondiente, sino, 
                        Seleccione en
                        <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right" class=" text-white bg-gray-300 font-medium rounded-lg text-sm px-2 py-2">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                        </button>
                        El Nombre/Codigo del Item que desea modificar y se autocompletaran ciertos campos.

                    </h3>
                `,
                confirmButtonText: `
                De Acuerdo&nbsp;<i class="fa fa-arrow-right"></i>
                `,
                inputValidator: (result) => {
                return !result && "ni modo marque la casilla";
                }
            });
            //   if (accept) {
            //     Swal.fire("You agreed with T&C :)");
            //   }

        }
    </script>';

    echo '<script type="text/javascript" language="javascript">
            var varparam=null;

            function verificarNuevo(){
                if(document.getElementById("p_codigo").value.length==0){
                    Swal.fire("Tiene que indicar el Codigo");
                    return
                }if(document.getElementById("p_item").value.length==0){
                    Swal.fire("Tiene que indicar Nombre del Item");
                    return
                }if(document.getElementById("p_unidad").value.length==0){
                    Swal.fire("Tiene que indicar la Unidad");
                    return
                }if(document.getElementById("p_stok_minimo").value.length==0){
                    Swal.fire("Tiene que indicar el Stock Minimo del Articulo");
                    return
                }if(document.getElementById("p_stok").value.length==0){
                    Swal.fire("Tiene que indicar la Cantidad de Items");
                    return
                }

                varparam+="&p_codigo="+base64_encode(document.getElementById("p_codigo").value);
                varparam+="&p_item="+base64_encode(document.getElementById("p_item").value);
                varparam+="&p_unidad="+base64_encode(document.getElementById("p_unidad").value);
                varparam+="&p_stok_minimo="+base64_encode(document.getElementById("p_stok_minimo").value);
                varparam+="&p_stok="+base64_encode(document.getElementById("p_stok").value);
            }
    </script>';

    echo '<script type="text/javascript" language="javascript">

            function bannerBienvenida(){
                let banner = document.getElementById("bannerBienvenida");

                return banner.innerHTML = "";
            }
    </script>';

    echo '<script type="text/javascript" language="javascript">

            function IngresarNombre(valItem, valCodigo, valUnidad){
                var ndc = document.getElementById("p_codigo");
                var nda = document.getElementById("p_item");
                var ndu = document.getElementById("p_unidad");

                
                nda.value = valItem;
                ndu.value = valUnidad;
                ndc.value = valCodigo;
            }
    </script>';

    echo '<script type="text/javascript" language="javascript">

        function CerrarSesion(){
            Swal.fire({
                title: "¿Desea Cerrar Sesión?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No",
            }).then((result) => {
                if(result.isConfirmed){
                    let timerInterval;
                    Swal.fire({
                        title: "Cerrando Sesión",
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            cargar_pestanha_grilla(\''.base64_encode(8).'\')
                            
                        }
                    });
                }
            });
            }
    </script>';

    echo '<script type="text/javascript" language="javascript">

        function eliminar_registro(varcode,varcode2,varemail){
            var varurl;
            var varparam;
            varurl    ="class.router.php";
            varparam  ="p_code="+varcode;

            Swal.fire({
                title: "¿Desea Eliminar El Artículo?",
                text: "Podrá Añadirlo Otra vez manualmente",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    varparam+="&p_codigo="+base64_encode(varemail);
                    var ajax=fgo_Ajax();
                    
                    ajax.open("POST",varurl,true);
                    ajax.onreadystatechange=function()
                        { 
                            if(ajax.readyState==1){
                            $("[id="+vartarget+"]").html("Cargando!!");
                            }
                            if(ajax.readyState==4){
                            if (ajax.responseText.indexOf("<!--ELIMINADO-->") != -1) {
                                Swal.fire({
                                    title: "Eliminado Correctamente",
                                    icon: "success"
                                });
                                // alert("Registro Eliminado Satisfactoriamente!!");
                                cargar_pestanha_grilla(varcode2);
                            }else if(ajax.responseText.indexOf("<!--ERROR-->") != -1) {
                                alert("Ocurrio un Error, Por favor informar!!");
                            }
                            } 
                        }
                    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
                    ajax.send(varparam);
                }
            });

            
        }
    </script>';

    echo '<script type="text/javascript" language="javascript">

        function cargar_pestanha_grilla(varcode){
            var vartarget;
            var varurl;
            var varparam;

            vartarget ="Usuario";
            varurl    ="class.router.php";
            varparam  ="p_code="+varcode;

            var ajax=fgo_Ajax();

            // swal.fire(".");

            ajax.open("POST",varurl,true);
            ajax.onreadystatechange=function()
                {
                    if(ajax.readyState==1){
                        $("[id="+vartarget+"]").html("Cargando!!");
                    }
                    if(ajax.readyState==4){
                        $("[id="+vartarget+"]").html(ajax.responseText);
                    }
                }
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send(varparam);
        }
    </script>';

echo '</head>';
echo '<body class="p-5">';

    echo '<div class="md:flex">';
        echo '<ul id="TablaNavegacion" class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 md:me-4 mb-4 md:mb-0" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">';
            echo '<li>';
                echo '<div>';
                    echo '<img src="../Img/logo_Junji.png" alt="logo" class="w-36">';
                echo '</div>';
            echo '</li>';
            echo '<li role="presentation">';
                echo '<button class="w-full" id="Usuario-tab" data-tabs-target="#Usuario" type="button" role="tab" aria-controls="Usuario" aria-selected="false ">';
                    echo '<a href="#Utiliario" onClick="cargar_pestanha_grilla(\''.base64_encode(2).'\'),bannerBienvenida()" class="inline-flex items-center px-4 py-3 rounded-lg text-gray-500 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full transition duration-300 ease-in-out hover:-translate-y-1">';
                        echo '<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">';
                            echo '<path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>';
                        echo '</svg>';
                        echo 'Utiliario';
                    echo '</a>';
                echo '</button>';
            echo '</li>';
            echo '<li role="presentation">';
                echo '<button class="w-full" id="Usuario-tab" data-tabs-target="#Usuario" type="button" role="tab" aria-controls="Usuario" aria-selected="false">';
                    echo '<a href="#Registro" onClick="cargar_pestanha_grilla(\''.base64_encode(4).'\'),bannerBienvenida()" class="inline-flex items-center px-4 py-3 rounded-lg text-gray-500 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full transition duration-300 ease-in-out hover:-translate-y-1">';
                        echo '<svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">';
                            echo '<path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>';
                        echo '</svg>';
                        echo 'Registro';
                    echo '</a>';
                echo '</button>';
            echo '</li>';
            echo '<li role="presentation">';
                echo '<button class="w-full" id="Usuario-tab" data-tabs-target="#Usuario" type="button" role="tab" aria-controls="Usuario" aria-selected="false">';
                    echo '<a href="#Usuarios" onClick="cargar_pestanha_grilla(\''.base64_encode(5).'\'),bannerBienvenida()" class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 text-gray-500 bg-gray-50 hover:bg-gray-100 w-full transition duration-300 ease-in-out hover:-translate-y-1">';
                        echo '<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
                            echo'<path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>';
                        echo '</svg>';
                        echo 'Usuarios';
                    echo '</a>';
                echo '</button>';
            echo '</li>';
            echo '<li role="presentation">';
                echo '<button class="w-full" id="Agregar-tab" data-tabs-target="#Agregar" type="button" role="tab" aria-controls="Agregar" aria-selected="false">';
                    echo '<a href="#Agregar" onClick="bannerBienvenida()" class="inline-flex text-gray-500 items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full transition duration-300 ease-in-out hover:-translate-y-1">';
                        echo '<svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
                            echo '<path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>';
                        echo '</svg>';
                        echo 'Agregar Material';
                    echo '</a>';
                echo '</button>';
            echo '</li>';
            echo '<li role="presentation">';
                echo '<button class="w-full" id="Usuario-tab" data-tabs-target="#Usuario" type="button" role="tab" aria-controls="Usuario" aria-selected="false">';
                    echo '<a href="./mainUA.php" class="inline-flex text-gray-500 items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full transition duration-300 ease-in-out hover:-translate-y-1">';
                        echo '<svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
                            echo '<path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>';
                        echo '</svg>';
                        echo 'Solicitar Material';
                    echo '</a>';
                echo '</button>';
            echo '</li>';
        echo '</ul>';

        echo '<div class="w-full md:pl-44 md:pt-2 pt-5" id="TablaMostrar">';
            echo '<div id="bannerBienvenida" class="flex justify-center flex-col">';
                echo '<div class="flex justify-center">';
                    echo '<img src="../Img/header_full_2022.png" alt="header_full">';
                echo '</div>';
                echo '<div>';
                    echo '<h3 class="flex justify-center py-3 text-2xl font-bold text-gray-600">Bienvenido/a, '.$_SESSION['nombre'].'</h3>';
                    echo '<h3 class="flex justify-center py-3 text-xl font-bold text-gray-500">'.$_SESSION['funcionario'].'</h3>';
                echo '</div>';
            echo '</div>';

            echo '<div class="hidden p-2 rounded-lg bg-gray-50" id="Usuario" role="tabpanel" aria-labelledby="Usuario-tab">';
            echo '</div>';
            echo '<div class="hidden p-2 rounded-lg bg-gray-50" id="Usuario" role="tabpanel" aria-labelledby="Usuario-tab">';
            echo '</div>';
            echo '<div class="hidden p-2 rounded-lg bg-gray-50" id="Agregar" role="tabpanel" aria-labelledby="Agregar-tab">';
                echo '<div class="p-4 pt-5 md:pt-16" id="">';
                    echo '<div class="flex justify-center text-sm font-medium text-center text-gray-500 border-b border-gray-200">';
                        echo '<ul class="flex justify-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">';
                            echo '<li class="me-2">';
                                echo '<button onClick="instrucciones()">';
                                    echo '<img src="../Img/duda.png" class="w-14 h-14 transition duration-300 ease-in-out hover:-translate-y-2">';
                                    echo '<h1 class="text-semibold text-gray-500 hover:text-gray-600 border-b border-gray-300 hover:border-gray-400">Ayuda</h1>';
                                echo '</button>';
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';

                    $obj_usuario=new materiales_neg();
                    $obj_usuario->ObtieneTodos_neg();

                    for($i=0;$i<$obj_usuario->getFilas();$i++){
                        $obj_usuario->getSet($i);
                    }
                    $UCode=$obj_usuario->getCodigo()+1;

                    echo '<div class="pt-5 md:pt-16 pb-5 md:pb-36">';
                        echo '<div class="" id="NuevoArt" aria-labelledby="Nuevo-tab" role="tabpanel" >';
                            echo '<form class="max-w-md mx-auto pt-10">';
                                echo '<div class="text-center pb-8 "><h3 class="font-bold text-gray-500">INGRESE LOS DATOS PARA INSERTAR UN  ARTICULO</h3></div>';
                                echo '<div class="relative z-0 w-full mb-5 group">';
                                    echo '<input type="number" name="p_codigo" id="p_codigo" value="'.$UCode.'" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                                    echo '<label for="p_codigo" class="font-medium peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Codigo del articulo:</label>';
                                echo '</div>';
                                echo '<div class="relative z-0 w-full mb-5 group">';
                                    echo '<div class="flex">';
                                        echo '<input type="text" name="p_item" id="p_item" value="" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                                        echo '<label for="p_item" class="font-medium peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Nombre del articulo:</label>';    

                                        echo '<div class="">';
                                            echo '<button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right" class="md:mb-0 text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2" type="button">';
                                                echo '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">';
                                                    echo '<path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>';
                                                echo '</svg>';
                                            echo '</button>';
                                        echo '</div>';

                                        echo '<div id="dropdownRight" class=" hidden bg-gray-200 rounded-lg shadow w-48 mb-36">';
                                            echo '<h3 class="flex items-center p-2 text-sm font-medium text-gray-600 border-t border-gray-200 rounded-b-lg bg-gray-200">';
                                                echo 'Buscar por:';
                                            echo '</h3>';
                                            echo '<ul class="py-2 text-semibold text-gray-700 h-72 overflow-y-auto" aria-labelledby="dropdownRightButton">';
                                                for($i=0;$i<$obj_usuario->getFilas();$i++){
                                                    $obj_usuario->getSet($i);
                                                    echo '<li>';
                                                        echo '<button onClick="IngresarNombre(this.value,this.id, this.name)" id="'.$obj_usuario->getCodigo().'" name="'.$obj_usuario->getUnidad().'" value="'.$obj_usuario->getItem().'" class="flex px-4 py-2 hover:bg-gray-100 w-full">';
                                                            echo '<h3 class="pr-2"> '.$obj_usuario->getCodigo().' </h3>';
                                                            echo '<h3 class="text-left pl-2 border-l border-gray-400"> '.$obj_usuario->getItem().' </h3>';
                                                        echo '</button>';
                                                    echo '</li>';
                                                }
                                            echo '</ul>';
                                        echo '</div>';

                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="relative z-0 w-full mb-5 group">';
                                    echo '<input type="text" name="p_unidad" id="p_unidad" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                                    echo '<label for="p_unidad" class="font-medium peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Unidad:</label>';
                                echo '</div>';
                                echo '<div class="relative z-0 w-full mb-5 group">';
                                    echo '<input type="number" name="p_stok_minimo" id="p_stok_minimo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                                    echo '<label for="p_stok_minimo" class="font-medium peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Cantidad Mínima Requerida:</label>';
                                echo '</div>';
                                echo '<div class="relative z-0 w-full mb-5 group">';
                                    echo '<input type="number" name="p_stok" id="p_stok" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                                    echo '<label for="p_stok" class="font-medium peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Cantidad a Agregar:</label>';
                                echo '</div>';
                                echo '<a href="javascript:void(0,0)" onClick="verificarNuevo(guardar_form(\''.base64_encode(1).'\'))" class="text-white bg-blue-600 pt-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Ingresar Articulo</a>';
                            echo '</form>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="hidden p-2 rounded-lg bg-gray-50" id="Usuario" role="tabpanel" aria-labelledby="Usuario-tab">';
            echo '</div>';
            echo '<div class="hidden p-2 rounded-lg bg-gray-50" id="Usuario" role="tabpanel" aria-labelledby="Usuario-tab">';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<div id="svgIcon" class="">
            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" data-dropdown-placement="top" type="button">
                <svg class="absolute w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </button>
            <div id="dropdownHover" class="bg-gray-50 hidden rounded-lg shadow">
                <div class="py-2" aria-labelledby="dropdownHoverButton">
                    <a href="javascript:void(0,0)" onClick="CerrarSesion()" class="flex w-36 text-sm font-bold px-4 py-2 text-gray-500 hover:bg-gray-100">Cerrar Sesión</a>
                </div>
            </div>
        </div>';

    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>';
echo '</body>';
echo '</html>';