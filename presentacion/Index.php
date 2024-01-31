<?php
ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

include_once '../negocios/class.usuario_neg.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 1900 05:00:00 GMT"); 

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link rel="icon" type="image/x-icon" href="Img/favicon-16x16.png">';
    echo '<title>Junji | Iniciar Sesion</title>';
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="./Js/funciones_base.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="./Js/funciones.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<link rel="stylesheet" href="./Style/style.css">';
    echo '<script type="text/javascript" language="javascript">
            function guardar_form(varcode){
                var v_respuesta;
                var varurl;
                var vartarget;
                varurl="class.router.php";
                vartarget="div_msg";
                var confCorreo = false;

                if(document.getElementById("p_correo").value.length==0){
                    Swal.fire("Tiene que indicar el Correo");
                    return
                }if(document.getElementById("p_pass").value.length==0){
                    Swal.fire("Tiene que indicar la Contraseña");
                    return
                }if(valida_correo(document.getElementById("p_correo"),confCorreo)==true){
                    Swal.fire("Ingrese Correo Valido");
                    return
                }

                varparam="p_code="+varcode;
                varparam+="&p_correo="+base64_encode(document.getElementById("p_correo").value);
                varparam+="&p_pass="+base64_encode(document.getElementById("p_pass").value);

                Swal.fire("hola");

                Swal.fire({
                    title: "Desea Iniciar Sesion?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si",
                    cancelButtonText: "No"
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
                                        Swal.fire("Registro Ingresado Satisfactoriamente!!");
                                    }else if(ajax.responseText.indexOf("<!--ACTUALIZADO-->") != -1) {
                                        Swal.fire("Registro Actualizado Satisfactoriamente!!");
                                    }else if(ajax.responseText.indexOf("<!--ERROR-->") != -1) {
                                        Swal.fire("Ocurrio un Error, Por favor informar!!");
                                    }else if(ajax.responseText.indexOf("<!--CORREO_INCORRECTO-->") != -1) {
                                        Swal.fire("EL Correo Indicado es Incorrecto");
                                    }else if(ajax.responseText.indexOf("<!--PASS_INCORRECTA-->") != -1) {
                                        Swal.fire("La Contraseña Indicada es Incorrecta");
                                    }else if(ajax.responseText.indexOf("<!--INCORRECTO-->") != -1) {
                                        Swal.fire("Datos Son Incorrectos");
                                    }else if(ajax.responseText.indexOf("<!--VALIDADO_JAR-->") != -1) {
                                        let timerInterval;
                                        Swal.fire({
                                            title: "Cargando Archivos De Jardin",
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
                                                window.location="./Int_Jardin/indexJ.php";
                                            }
                                        });
                                    }else if(ajax.responseText.indexOf("<!--VALIDADO_JAR_ADM-->") != -1) {
                                        let timerInterval;
                                        Swal.fire({
                                            title: "Cargando Archivos De Jardin",
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
                                                window.location="./Int_Jardin_Adm/indexJA.php";
                                            }
                                        });
                                    }else if(ajax.responseText.indexOf("<!--VALIDADO_DIR-->") != -1) {
                                        let timerInterval;
                                        Swal.fire({
                                            title: "Cargando Archivos De Direccion Regional",
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
                                                window.location="./Int_Usuario/indexU.php";
                                            }
                                        });
                                    }else if(ajax.responseText.indexOf("<!--VALIDADO_DIR_ADM-->") != -1) {
                                        let timerInterval;
                                        Swal.fire({
                                            title: "Cargando Archivos De Direccion Regional",
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
                                                window.location="./Int_Usuario_Adm/indexUA.php";
                                            }
                                        });
                                    }
                                } 
                            }
                        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
                        ajax.send(varparam);
                    }
                });
            }
    </script>';
echo '</head>';
echo '<body class="p-5" id="bodyIndex">';
    echo '<div class="md:pt-64 pt-24">';
        echo '<form class="max-w-md mx-auto bg-gray-100 p-5 rounded-lg bg-opacity-50">';
            echo '<div class="pb-5">';
                echo '<img src="./Img/logo_Junji.png" alt="img_header" class="rounded-lg w-44">';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="email" name="p_correo" id="p_correo" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_correo" class="peer-focus:font-medium absolute text-sm font-normal text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Correo Electrónico</label>';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="password" name="p_pass" id="p_pass" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_pass" class="peer-focus:font-medium absolute text-sm font-normal text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Contraseña</label>';
            echo '</div>';
            echo '<div class="sm:grid sm:grid-cols-2">';
                echo '<div class="pl-2 pt-2">';
                    echo '<a href="javascript:void(0,0)" onClick="guardar_form(\''.base64_encode(2).'\')" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Iniciar Sesion</a>';
                echo '</div>';
                echo '<div class="flex justify-end p-5 md:pt-2 pr-2 font-medium text-gray-600 whitespace-nowrap hover:text-blue-600">';
                    echo '<a href="IndexReg.php">¿No Tienes Cuenta?</a>';
                echo '</div>';
            echo '</div>';
        echo '</form>';
    echo '</div>';
echo '</body>';
echo '</html>';