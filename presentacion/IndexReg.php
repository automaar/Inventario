<?php
ini_set ( 'error_reporting', E_ALL & ~ E_NOTICE );
ini_set ( 'display_errors', 1 );

include_once '../negocios/class.usuario_neg.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 1900 05:00:00 GMT");

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="icon" type="image/x-icon" href="Img/favicon-16x16.png">';
    echo '<title>Junji | Registrarse</title>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script type="text/javascript" language="javascript" src="./Js/funciones.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="./Js/Funciones_base.js"></script>';
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    echo '<link rel="stylesheet" href="./Style/style.css">';
    echo '<script src="./Js/main.js"></script>';

    echo '<script type="text/javascript" language="javascript">
            function guardar_form(varcode,adm){
                var v_respuesta;
                var varurl;
                var vartarget;
                varurl="class.router.php";
                vartarget="div_msg";
                var confCorreo = false;

                if(document.getElementById("p_correo").value.length==0){
                    Swal.fire("Tiene que indicar su Correo");
                    return
                }if(document.getElementById("p_nombre").value.length==0){
                    Swal.fire("Tiene que indicar su Nombre");
                    return
                }if(document.getElementById("p_cargo").value.length==0){
                    Swal.fire("Tiene que indicar su Cargo");
                    return
                }if(!document.getElementById("p_jardin").checked && !document.getElementById("p_junji").checked){
                    Swal.fire("Por favor, Indique el tipo de Funcionario/a");
                    return
                }if(document.getElementById("p_establecimiento").value.length==0){
                    Swal.fire("Tiene que indicar su Establecimiento");
                    return
                }if(document.getElementById("p_pass").value.length==0){
                    Swal.fire("Tiene que indicar su Contraseña");
                    return
                }if(document.getElementById("p_pass").value.length<=6){
                    Swal.fire("Su Contraseña debe tener al menos 7 Carácteres");
                    return
                }if(document.getElementById("p_pass").value != document.getElementById("p_pass1").value){
                    Swal.fire("Las Contraseñas no Coinciden");
                    return
                }if(valida_correo(document.getElementById("p_correo"),confCorreo)==true){
                    Swal.fire("Ingrese Correo Valido");
                    return
                }

                varparam="p_code="+varcode;
                varparam+="&p_correo="+base64_encode(document.getElementById("p_correo").value);
                varparam+="&p_nombre="+base64_encode(document.getElementById("p_nombre").value);
                varparam+="&p_cargo="+base64_encode(document.getElementById("p_cargo").value);
                varparam+="&p_establecimiento="+base64_encode(document.getElementById("p_establecimiento").value);
                if (document.getElementById("p_jardin").checked){
                    if (adm===true){varparam+="&p_funcionario="+base64_encode(document.getElementById("p_jardin").value+" - Administrador");}
                    else{varparam+="&p_funcionario="+base64_encode(document.getElementById("p_jardin").value);}
                }if (document.getElementById("p_junji").checked){
                    if (adm===true){varparam+="&p_funcionario="+base64_encode(document.getElementById("p_junji").value+" - Administrador");}
                    else{varparam+="&p_funcionario="+base64_encode(document.getElementById("p_junji").value);}
                }
                varparam+="&p_pass="+base64_encode(document.getElementById("p_pass").value);

                Swal.fire({
                    title: "¿Desea registrarse?",
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
                                            title: "Su Cuenta ha sido Creada",
                                            showConfirmButton: false,
                                            timer: 1800
                                        });
                                        setTimeout(() => {
                                            window.location="index.php";
                                        }, "2000");
                                    }else if(ajax.responseText.indexOf("<!--ACTUALIZADO-->") != -1) {
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Su Cuenta ha sido Actualizada",
                                            showConfirmButton: false,
                                            timer: 1800
                                        });
                                        setTimeout(() => {
                                            window.location="index.php";
                                        }, "2000");
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

    echo '<script>
        async function verificar() {
            var confCorreo = false;

            if(document.getElementById("p_correo").value.length==0){
                Swal.fire("Tiene que indicar su Correo");
                return
            }if(document.getElementById("p_nombre").value.length==0){
                Swal.fire("Tiene que indicar su Nombre");
                return
            }if(document.getElementById("p_cargo").value.length==0){
                Swal.fire("Tiene que indicar su Cargo");
                return
            }if(!document.getElementById("p_jardin").checked && !document.getElementById("p_junji").checked){
                Swal.fire("Por favor, Indique el tipo de Funcionario/a");
                return
            }if(document.getElementById("p_establecimiento").value.length==0){
                Swal.fire("Tiene que indicar su Establecimiento");
                return
            }if(document.getElementById("p_pass").value.length==0){
                Swal.fire("Tiene que indicar su Contraseña");
                return
            }if(document.getElementById("p_pass").value.length<=6){
                Swal.fire("Su Contraseña debe tener al menos 7 Carácteres");
                return
            }if(document.getElementById("p_pass").value != document.getElementById("p_pass1").value){
                Swal.fire("Las Contraseñas no Coinciden");
                return
            }if(valida_correo(document.getElementById("p_correo"),confCorreo)==true){
                Swal.fire("Ingrese Correo Valido");
                return
            }else{
                async function VerificarADM(){
                    let adm=false;
                    let Code = \''.base64_encode("adminreg01").'\';
                    const { value: valCode } = await Swal.fire({
                        title: "Verificación",
                        html: `
                            <input type="password" id="codeV" class="swal2-input">
                        `,
                        focusConfirm: false,
                        preConfirm: () => {
                            return [
                                document.getElementById("codeV").value,
                            ];
                        }
                    });
                    if (valCode==base64_decode(Code)) {
                        
                        guardar_form(\''.base64_encode(1).'\', adm=true);
                    }
                }
                VerificarADM();
            }
        }
    </script>';
echo '</head>';
echo '<body class="p-5" id="bodyIndex">';
    echo '<div class="md:pt-20 pt-6">';
        echo '<form class="max-w-md mx-auto bg-gray-100 p-5 rounded-lg bg-opacity-50">';
            echo '<div class="pb-5">';
                echo '<img src="./Img/logo_Junji.png" alt="img_header" class="rounded-lg w-44">';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="email" name="p_correo" id="p_correo" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_correo" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Correo Electrónico</label>';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="text" name="p_nombre" id="p_nombre" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Nombre</label>';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="text" name="p_cargo" id="p_cargo" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_cargo" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Cargo</label>';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<input type="text" name="p_establecimiento" id="p_establecimiento" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                echo '<label for="p_establecimiento" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Nombre de Establecimiento</label>';
            echo '</div>';
            echo '<div class="relative z-0 w-full mb-5 group">';
                echo '<h3 class="mb-5 text-case font-sm text-gray-500">Funcionario/a de</h3>';
                echo '<ul class="grid w-full gap-6 md:grid-cols-2">';
                    echo '<li class="flex">';
                        echo '<input type="radio" id="p_jardin" name="p_funcionario" value="Jardin" class="hidden peer" required>';
                        echo '<label for="p_jardin" class="inline-flex items-center bg-gray-200 justify-between w-full p-5 text-gray-500 border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-200 bg-opacity-25">';
                            echo '<div class="block">';
                                echo '<div class="w-full text-lg font-semibold">Jardin</div>';
                            echo '</div>';
                            echo '<svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                                echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                            echo '</svg>';
                        echo '</label>';
                    echo '</li>';
                    echo '<li>';
                        echo '<input type="radio" id="p_junji" name="p_funcionario" value="Direccion Regional" class="hidden peer">';
                        echo '<label for="p_junji" class="inline-flex items-center bg-gray-200 justify-between w-full p-5 text-gray-500 border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-200 bg-opacity-25">';
                            echo '<div class="block">';
                                echo '<div class="w-full text-base font-semibold">Dirección Regional</div>';
                            echo '</div>';
                            echo '<svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                                echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                            echo '</svg>';
                        echo '</label>';
                    echo '</li>';
                echo '</ul>';
            echo '</div>';
            echo '<div class="grid md:grid-cols-2 md:gap-6">';
                echo '<div class="relative z-0 w-full mb-5 group">';
                    echo '<input type="password" name="p_pass" id="p_pass" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                    echo '<label for="p_pass" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Contraseña</label>';
                echo '</div>';
                echo '<div class="relative z-0 w-full mb-5 group">';
                    echo '<input type="password" name="p_pass1" id="p_pass1" class="block py-2.5 px-0 w-full font-medium text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />';
                    echo '<label for="p_pass1" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Confirme Contraseña</label>';
                echo '</div>';
            echo '</div>';
            echo '<div class="grid grid-cols-2">';
                echo '<div class="pl-2 p-5 md:pt-2">';
                   echo '<a href="javascript:void(0,0)" onClick="guardar_form(\''.base64_encode(1).'\')" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Registrarse</a>';
                echo '</div>';
                echo '<div class="flex justify-end p-5 md:pt-2 font-medium text-gray-600 whitespace-nowrap hover:text-blue-600">';
                    echo '<a href="Index.php">Iniciar Sesion</a>';
                echo '</div>';
            echo '</div>';

            echo '<div class="relative z-0 w-full mb-5 group pt-2">';
                echo '<ul class="grid w-full gap-6 md:grid-cols-1">';
                    echo '<a onClick="verificar()" class="flex justify-center">';
                        echo '<div class="inline-flex items-center bg-gray-200 justify-center p-5 text-gray-500 border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-200 bg-opacity-25">';
                            echo '<div class="block">';
                                echo '<div class="w-full text-base font-semibold">Tengo clave Administrador</div>';
                            echo '</div>';
                            echo '<svg class="w-4 h-4 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                                echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                            echo '</svg>';
                        echo '</div>';
                    echo '</a>';
                echo '</ul>';
            echo '</div>';

        echo '</form>';
    echo '</div>';
echo '</body>';
echo '</html>';