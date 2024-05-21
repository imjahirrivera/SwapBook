<?php

$servidor = "localhost";
$basedatos = "intercambio";
$usuario = "postgres";
$password = "admin";

try{
    $conexion = pg_connect("host=$servidor dbname=$basedatos user=$usuario password=$password");
 }catch(Exception $ex){
    echo $ex->getMessage();
 }

$id = $_GET['id'];
$query = "SELECT * FROM usuarios WHERE codigo_estudiante = '$id';";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

$id_estudiante = $row -> id;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>SwapBook: Perfil</title>
</head>
<body>
    
<nav class="bg-gray-900">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">

                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                        Icon when menu is closed.
            
                        Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
                        Icon when menu is open.
            
                        Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>


                <!-- Secciones del header-->
                <div class="flex flex-1 items-center justify-center ">
                    <a href="javascript:void(0);" onclick="paginaPrincipal();" id="image_logo">
                    <div class="flex flex-shrink-0 items-center space-x-4">
                        <img class="h-14 w-auto rounded-full border-4 border-stone-500" src="../img/logo.png" alt="User">
                        <span class="text-white">SwapBook UDG</span>
                    </div>
                    </a>
                    <!-- Barra de busqueda-->
                    <div class="flex flex-1 items-center justify-center">
                        <form class="w-8/12">   
                            <div class="relative">
                                <input type="search" id="search_input" class="block w-full p-2  text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar un libro..." required />
                                <button type="button" onclick="search();" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-full border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div class="relative">
                            <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                              <span class="absolute -inset-1.5"></span>
                              <span class="sr-only">Open user menu</span>
                              <img class="h-8 w-8 rounded-full" src="" alt="" id="img_de_perfil">
                            </button>
                          
                            <div id="user-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: none;">
                              <!-- Opciones del menú -->
                              <a href="#" onclick="abrirProfile()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Ver perfil</a>
                              <a href="#" onclick="abrirSolicitudes()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Solicitudes</a>
                              <a href="http://localhost/libros/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Cerrar sesión</a>
                            </div>
                          </div>
                          
                          <script>
                            const userMenuButton = document.getElementById('user-menu-button');
                            const userMenu = document.getElementById('user-menu');
                          
                            userMenuButton.addEventListener('click', () => {
                              const expanded = userMenuButton.getAttribute('aria-expanded') === 'true';
                              userMenuButton.setAttribute('aria-expanded', !expanded);
                              userMenu.style.display = expanded ? 'none' : 'block';
                            });
                          </script>
                          
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
          <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="./profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Ver perfil</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Chats</a>
            <a href="http://localhost/libros/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Cerrar sesión</a>
          </div>
        </div>
      </nav>
<!-- Aqui termina la NavBar -->



<div id="body" class="p-10 bg-local bg-cover bg-no-repeat" style="background-image: url(../img/library.jpg);">
    <!-- DIV DEL CUADRO NEGRO DE FONDO -->
    <div class="mx-auto w-full max-w-screen-xl p-20 py-6 lg:py-8 bg-black/90 rounded-3xl md:flex  md:flex-col">
        <!-- ENCABEZADO DE LA PAGINA DE PERFIL -->
        <div class="md:flex md:justify-between items-center">
            <span class="text-6xl font-semibold whitespace-nowrap dark:text-white">Solicitudes</span>
        </div>

        <!-- SOLICITUDES -->
        <div class=" pt-10 pb-10 w-full">

            <!-- TABS -->
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 mt-6">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <a href="#" role="tab" aria-controls="profile" aria-selected="false" id="profile-tab" data-tabs-target="#profile" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                            </svg>Solicitudes
                        </a>
                    </li>
                    <li class="me-2" role="presentation">
                        <a href="#" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false" class="inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group" aria-current="page">
                        <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                        </svg>Pendientes
                        </a>
                    </li>
                    <li class="me-2" role="presentation">
                        <a href="#" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 10 16">
                                <path d="M3.414 1A2 2 0 0 0 0 2.414v11.172A2 2 0 0 0 3.414 15L9 9.414a2 2 0 0 0 0-2.828L3.414 1Z"/>
                            </svg>En curso
                        </a>
                    </li>
                    <li class="me-2" role="presentation">
                        <a href="#" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6.072 10.072 2 2 6-4m3.586 4.314.9-.9a2 2 0 0 0 0-2.828l-.9-.9a2 2 0 0 1-.586-1.414V5.072a2 2 0 0 0-2-2H13.8a2 2 0 0 1-1.414-.586l-.9-.9a2 2 0 0 0-2.828 0l-.9.9a2 2 0 0 1-1.414.586H5.072a2 2 0 0 0-2 2v1.272a2 2 0 0 1-.586 1.414l-.9.9a2 2 0 0 0 0 2.828l.9.9a2 2 0 0 1 .586 1.414v1.272a2 2 0 0 0 2 2h1.272a2 2 0 0 1 1.414.586l.9.9a2 2 0 0 0 2.828 0l.9-.9a2 2 0 0 1 1.414-.586h1.272a2 2 0 0 0 2-2V13.8a2 2 0 0 1 .586-1.414Z"/>
                            </svg>Finalizados
                        </a>
                    </li>
                    
                </ul>
            </div>

            <?php 
            
            ?>

            <!-- CONTENIDO DE TABS -->
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 bg-gray-800 flex flex-col justify-between" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- SOLICITUDES -->
                    <?php
                        $query2 = "SELECT * FROM solicitud_prestamos WHERE id_propietario = $id_estudiante;";
                        $result2 = pg_query($conexion, $query2);

                        while($solicitud = pg_fetch_object($result2)){
                            $status = $solicitud -> status_propietario;
                            if($status == "Solicitud"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_solicitante = $solicitud -> id_solicitante;
                                $querySolicitante = "SELECT * FROM usuarios WHERE codigo_estudiante = '$id_solicitante';";
                                $resultSolicitante = pg_query($conexion, $querySolicitante);
                                $solicitante = pg_fetch_object($resultSolicitante);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $solicitante -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $solicitante -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<button class="w-28 h-12 rounded-full bg-green-700 text-white mr-2 hover:bg-green-900" onclick="aceptarSolicitud('. $solicitud -> id . ')">Aceptar</button>';
                                echo            '<button class="w-12 h-12 rounded-full bg-red-700 text-white mr-2 hover:bg-red-900" onclick="cancelarSolicitud('. $solicitud -> id . ');">X</button>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }
                    ?>
                    
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 bg-gray-800 flex flex-col justify-between h-auto" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <!-- PENDIENTES -->
                    <?php
                        $query3 = "SELECT * FROM solicitud_prestamos WHERE id_solicitante = $id;";
                        $result3 = pg_query($conexion, $query3);

                        while($solicitud = pg_fetch_object($result3)){
                            $status = $solicitud -> status_solicitante;
                            if($status == "Pendiente"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_propietario = $solicitud -> id_propietario;
                                $queryPropietario = "SELECT * FROM usuarios WHERE id = '$id_propietario';";
                                $resultPropietario = pg_query($conexion, $queryPropietario);
                                $propietario = pg_fetch_object($resultPropietario);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $propietario -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $propietario -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-gray-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_solicitante . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }
                    ?>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <!-- EN CURSO SOLICITANTE -->
                    <?php
                        $query4 = "SELECT * FROM solicitud_prestamos WHERE id_solicitante = $id;";
                        $result4 = pg_query($conexion, $query4);

                        while($solicitud = pg_fetch_object($result4)){
                            $status = $solicitud -> status_solicitante;
                            if($status == "En curso"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_propietario = $solicitud -> id_propietario;
                                $queryPropietario = "SELECT * FROM usuarios WHERE id = '$id_propietario';";
                                $resultPropietario = pg_query($conexion, $queryPropietario);
                                $propietario = pg_fetch_object($resultPropietario);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $propietario -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $propietario -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<button class="w-28 h-12 rounded-full bg-blue-700 text-white mr-2 hover:bg-blue-900" onclick="entregarLibro('. $solicitud -> id . ')">Entregar</button>';
                                echo            '<button class="w-12 h-12 rounded-full bg-white mr-2 hover:bg-gray-400 flex items-center justify-center" onclick="abrirChat('. $solicitud->id . ');">
                                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                        <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                                                    </svg>
                                                </button>';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-yellow-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_solicitante . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }

                        // EN CURSO PROPIETARIO //
                        $query5 = "SELECT * FROM solicitud_prestamos WHERE id_propietario = $id_estudiante;";
                        $result5 = pg_query($conexion, $query5);

                        while($solicitud = pg_fetch_object($result5)){
                            $status = $solicitud -> status_propietario;
                            if($status == "En prestamo"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_solicitante = $solicitud -> id_solicitante;
                                $querySolicitante = "SELECT * FROM usuarios WHERE codigo_estudiante = '$id_solicitante';";
                                $resultSolicitante = pg_query($conexion, $querySolicitante);
                                $solicitante = pg_fetch_object($resultSolicitante);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $solicitante -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $solicitante -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<button class="w-12 h-12 rounded-full bg-white mr-2 hover:bg-gray-400 flex items-center justify-center" onclick="abrirChat('. $solicitud->id . ');">
                                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                        <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                                                    </svg>
                                                </button>';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-blue-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_propietario . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }
                    ?>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    <!-- ENTREGADO SOLICITANTE -->
                    <?php
                        $query6 = "SELECT * FROM solicitud_prestamos WHERE id_solicitante = $id;";
                        $result6 = pg_query($conexion, $query6);

                        while($solicitud = pg_fetch_object($result6)){
                            $status = $solicitud -> status_solicitante;
                            if($status == "Entregado"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_propietario = $solicitud -> id_propietario;
                                $queryPropietario = "SELECT * FROM usuarios WHERE id = '$id_propietario';";
                                $resultPropietario = pg_query($conexion, $queryPropietario);
                                $propietario = pg_fetch_object($resultPropietario);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $propietario -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $propietario -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<button class="w-12 h-12 rounded-full bg-white mr-2 hover:bg-gray-400 flex items-center justify-center" onclick="reportar('. $solicitud->id . ');">
                                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                    <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                                                    </svg>
                                                </button>';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-green-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_solicitante . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                            if($status == "Finalizado"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_propietario = $solicitud -> id_propietario;
                                $queryPropietario = "SELECT * FROM usuarios WHERE id = '$id_propietario';";
                                $resultPropietario = pg_query($conexion, $queryPropietario);
                                $propietario = pg_fetch_object($resultPropietario);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $propietario -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $propietario -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-red-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_propietario . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }

                        // ENTREGADO PROPIETARIO //
                        $query7 = "SELECT * FROM solicitud_prestamos WHERE id_propietario = $id_estudiante;";
                        $result7 = pg_query($conexion, $query7);

                        while($solicitud = pg_fetch_object($result7)){
                            $status = $solicitud -> status_propietario;
                            if($status == "Entregado"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_solicitante = $solicitud -> id_solicitante;
                                $querySolicitante = "SELECT * FROM usuarios WHERE codigo_estudiante = '$id_solicitante';";
                                $resultSolicitante = pg_query($conexion, $querySolicitante);
                                $solicitante = pg_fetch_object($resultSolicitante);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $solicitante -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $solicitante -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<button class="w-12 h-12 rounded-full bg-white mr-2 hover:bg-gray-400 flex items-center justify-center" onclick="reportar('. $solicitud->id . ');">
                                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                    <path d="M15 1.943v12.114a1 1 0 0 1-1.581.814L8 11V5l5.419-3.871A1 1 0 0 1 15 1.943ZM7 4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2v5a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V4ZM4 17v-5h1v5H4ZM16 5.183v5.634a2.984 2.984 0 0 0 0-5.634Z"/>
                                                    </svg>
                                                </button>';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-green-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_propietario . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                            if($status == "Cancelado"){
                                $id_libro = $solicitud -> id_libro;
                                $queryLibro = "SELECT * FROM libro WHERE id = $id_libro;";
                                $resultLibro = pg_query($conexion, $queryLibro);
                                $libro = pg_fetch_object($resultLibro);

                                $id_solicitante = $solicitud -> id_solicitante;
                                $querySolicitante = "SELECT * FROM usuarios WHERE codigo_estudiante = '$id_solicitante';";
                                $resultSolicitante = pg_query($conexion, $querySolicitante);
                                $solicitante = pg_fetch_object($resultSolicitante);

                                echo    '<div class="bg-gray-300 flex my-1 rounded-lg w-full">';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<img src=".' . $libro -> imagen_portada . '" alt="" width="150px" class="rounded-l-lg">';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $libro -> titulo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center w-1/3">';
                                echo            '<div class="w-28 h-28 rounded-full border-2 border-white" style="background-image: url(.'. $solicitante -> foto_perfil . '); background-size: cover; background-position: center;"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-5">' . $solicitante -> nombre_completo . '</span>';
                                echo        '</div>';
                                echo        '<div class="flex items-center justify-center w-1/3">';
                                echo            '<div class="w-12 h-12 rounded-full border-2 border-white bg-red-500"></div>';
                                echo            '<span class="text-lg text-black font-semibold mx-2">' . $solicitud -> status_propietario . '</span>';
                                echo        '</div>';
                                echo    '</div>';
                            }
                        }
                    ?>
                </div>
            </div>


        </div>
    </div>


</div>


<!-- Footer -->
<footer class="bg-white dark:bg-gray-900">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <!-- Texto sobre SwapBook -->
        <div class="md:flex md:justify-center md:flex-col items-center">
            <span class="text-6xl font-semibold whitespace-nowrap dark:text-white">Sobre SwapBook:</span>
            <p class="text-white text-center p-5 text-2xl">La página SwapBook es una página web creada por estudiantes de la Universidad de Guadalajara (UDG) con el propósito de promover el intercambio y préstamo de libros entre estudiantes de la misma institución, en el plantel CUCEI.</p>
        </div>
        <div class="md:flex md:justify-between items-center">
          <div class="mb-6 md:mb-0">
              <a href="" class="flex items-center">
                  <img src="../img/logo.png" class="h-12 me-3 rounded-full" alt="FlowBite Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SwapBook UDG</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Administradores</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="http://localhost/libros/login.php" class="hover:underline">Portal para administradores</a>
                        </li>
                        <li>
                            <a href="http://localhost/Libros/admin/formulario_admin.php" class="hover:underline">¿Cómo puedo ser<br>un administrador?</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Otros</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="https://github.com/imjahirrivera/SwapBook" class="hover:underline">Documentación</a>
                        </li>
                        <li>
                            <a href="http://localhost/Libros/privacidad.html" class="hover:underline">Políticas de privacidad</a>
                        </li>
                    </ul>
                </div>
          </div>
      </div>

      <!-- Linea que divide el footer -->
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <!-- Parte de abajo de la linea -->
      <div class="sm:flex sm:items-center sm:justify-between">
          <!-- Derechos -->
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 SwapBook UDG. All Rights Reserved.
          </span>
          <!-- Redes sociales -->
          <div class="flex mt-4 sm:justify-center sm:mt-0">
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                  <span class="sr-only">Facebook page</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                        <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                    </svg>
                  <span class="sr-only">Discord community</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                  </svg>
                  <span class="sr-only">GitHub account</span>
              </a>
          </div>
      </div>
    </div>
</footer>

<script>
// Obtener la cadena de consulta del URL
var queryString = window.location.search;

// Parsear la cadena de consulta en un objeto
var params = new URLSearchParams(queryString);

// Obtener el valor de 'variable1'
var valorVariable1 = params.get('url');

// Seleccionar el elemento <img> usando su ID
var imgElement = document.getElementById('img_de_perfil');
var imgPerfil = document.getElementById('foto_perfil');

// Establecer la propiedad src del elemento <img> con la nueva URL de la imagen
imgElement.src = "." + valorVariable1;
imgElement.style.objectFit = "cover";
imgElement.style.objectPosition = "center";

imgPerfil.src = "." + valorVariable1;
imgPerfil.style.objectFit = "cover";
imgPerfil.style.objectPosition = "center";

</script>

<script>
// Script para ejecutar la pagina de inicio de SwapBook y mandar el id y url del perfil
function paginaPrincipal()
{
    var queryString = window.location.search;

    var params = new URLSearchParams(queryString);

    // Obtener el valor de id y url
    var id = params.get('id');
    var url = params.get('url');

    // Seleccionar el elemento <img> usando su ID
    window.location.href = 'http://localhost/libros/user/index_user.php?id=' + id + '&url=' + url;
}


</script>

<script>
    function hoverBackground(element, url){
        element.style.backgroundImage = 'linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), ' + url + '';
    }

    function resetBackground(element, url) {
        var startIndex = url.indexOf('url("');
        if (startIndex !== -1) {
            // Extraer la subcadena que comienza después de "url("
            var subcadena = url.substring(startIndex + 'url("'.length);
            
            // Encontrar el índice del primer carácter de cierre de comillas (")
            var endIndex = subcadena.indexOf('")');
            if (endIndex !== -1) {
                // Extraer la parte de la subcadena que sigue después de "url(" y antes de ")"
                var resultado = subcadena.substring(0, endIndex);
                
                // Imprimir el resultado
                element.style.backgroundImage = 'url("' + resultado + '")';
            }
        }
    }
</script>

<script>
    function abrirProfile() {

        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/user/profile.php?id=' + id + '&url=' + url;
    }

    function moreBooks() {

        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/user/profile_more_books.php?id=' + id + '&url=' + url;
    }

    function editarPerfil() {

        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/user/edit_profile.php?id=' + id + '&url=' + url;
    }

    function addBook() {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/books/add_book.php?id=' + id + '&url=' + url;
    }

    function openBook(id_libro) {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/books/show_book.php?id=' + id + '&url=' + url + '&id_libro=' + id_libro;
    }
    function search() {
        let busqueda = document.getElementById('search_input').value.trim();

        if (busqueda == '') { // Verificar si el campo de búsqueda no está vacío
            alert('Campo incompleto!');
            return;
        }
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        window.location.href = 'http://localhost/libros/user/search.php?id=' + id + '&url=' + url + '&busqueda=' + encodeURIComponent(busqueda);
    }
</script>

<script>
    function cancelarSolicitud(id_solicitud) {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        window.location.href = 'http://localhost/libros/user/cox_cancelar_solicitud.php?id=' + id + '&url=' + url + '&id_solicitud=' + id_solicitud;
    }

    function aceptarSolicitud(id_solicitud) {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        window.location.href = 'http://localhost/libros/user/cox_aceptar_solicitud.php?id=' + id + '&url=' + url + '&id_solicitud=' + id_solicitud;
    }

    function entregarLibro(id_solicitud) {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        window.location.href = 'http://localhost/libros/user/cox_entregar_solicitud.php?id=' + id + '&url=' + url + '&id_solicitud=' + id_solicitud;
    }

    function abrirSolicitudes() {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/user/solicitudes.php?id=' + id + '&url=' + url;
    }
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
      
</body>
</html>

<?php

pg_close($conexion);

?>