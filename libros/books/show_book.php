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

$id = $_GET['id_libro'];
$query = "SELECT * FROM libro WHERE id = $id;";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

$id_user = $row -> poseedor_id;

$queryUser = "SELECT * FROM usuarios WHERE id = $id_user";

$resultUser = pg_query($conexion, $queryUser);
$user = pg_fetch_object($resultUser);

$codigo_estudiante = $_GET['id']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SwapBook: Editar libro</title>
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
    <!-- CUADRO COMPLETO NEGRO -->
    <div class="mx-auto w-full max-w-screen-xl p-20 py-6 lg:py-8 bg-black/90 rounded-3xl flex flex-col">

        <!-- INFORMACION BASICA DEL LIBRO -->
        <div class="flex justify-center items-center ">
            <img src="<?php echo '.' . $row -> imagen_portada; ?>" alt="" class="relative bg-white w-60 h-96 focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 hover:bg-black hover:bg-opacity-75">
            <div class="flex flex-col pl-12 w-2/4 ">
                <span class="text-4xl font-bold text-white"> <?php echo $row -> titulo; ?></span>
                <div class="pl-2 mt-2">
                    <span class="text-2xl font-semibold text-gray-300"> Autor:</span>
                    <span class="text-2xl font-semibold text-gray-400"><?php echo $row -> autor; ?></span>
                </div>
                <div class="pl-2">
                    <span class="text-2xl font-semibold text-gray-300"> Editorial:</span>
                    <span class="text-2xl font-semibold text-gray-400"><?php echo $row -> editorial; ?></span>
                </div>
                <div class="pl-2 mt-12">
                    <span class="text-2xl font-semibold <?php if((var_export($row->estatus, true)) == "'t'"){ echo 'text-green-500';}else{echo 'text-red-500';}?>"><?php if((var_export($row->estatus, true)) == "'t'"){ echo 'Disponible';}else{echo 'No Disponible';}?></span>
                </div>

                <div class="w-full mt-20 flex items-center">
                    <div class="flex flex-col items-center justify-center pr-4 border-r-2 border-gray-600">
                        <span class="text-base font-semibold text-gray-300 pb-3 whitespace-nowrap">Número de páginas</span>
                        <img src="./icons/book_pages.png" alt="" class="w-9">
                        <span class="text-base font-semibold text-gray-400 pt-3"><?php echo $row -> num_paginas; ?></span>
                    </div>
                    <div class="flex flex-col items-center justify-center pl-4 pr-4 border-r-2 border-gray-600">
                        <span class="text-base font-semibold text-gray-300 pb-3">ISBN</span>
                        <img src="./icons/isbn.png" alt="" class="w-9">
                        <span class="text-base font-semibold text-gray-400 pt-3"><?php echo $row -> isbn; ?></span>
                    </div>
                    <div class="flex flex-col items-center justify-center pl-6 pr-6 border-r-2 border-gray-600">
                        <span class="text-base font-semibold text-gray-300 pb-3">Idioma</span>
                        <img src="./icons/idioma.png" alt="" class="w-9">
                        <span class="text-base font-semibold text-gray-400 pt-3"><?php echo $row -> idioma; ?></span>
                    </div>
                    <div class="flex flex-col items-center justify-center pl-4">
                        <span class="text-base font-semibold text-gray-300 pb-3 whitespace-nowrap">Estado del libro</span>
                        <img src="./icons/estado.png" alt="" class="w-9">
                        <span class="text-base font-semibold text-gray-400 pt-3"><?php echo $row -> estado_fisico; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- LINEA -->
        <hr class="mx-auto border-gray-400 my-8 w-full"> </hr>

        <!-- SINOPSIS DEL LIBRO -->
        <div class="flex flex-col">
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-full border-4 border-gray-500" style="background-image: url('<?php echo '.' . $user -> foto_perfil?>');background-size: cover; background-position: center;"></div>
                <span class="text-2xl font-semibold text-white ml-3"><?php echo $user -> nombre_completo; ?></span>
            </div>
            <div class="mt-5">
                <p class="text-white text-xl"><?php echo $row -> sinopsis; ?></p>
            </div>
        </div>

        <!-- LINEA -->
        <hr class="mx-auto border-gray-400 my-8 w-full"> </hr>

        <!-- LISTA DE ESPERA -->
        <div class="flex my-3 flex-col justify-center">
            <span class="text-3xl font-semibold whitespace-nowrap text-white mb-6">Lista de espera</span>
            <?php 
                $id_libro = $_GET['id_libro'];
                $queryListaEspera = "SELECT * FROM lista_espera WHERE id_libro = $id_libro;";

                $resultLista = pg_query($conexion, $queryListaEspera);

                $validacion = "SELECT COUNT(*) FROM lista_espera WHERE id_libro = $id_libro;";
                $resultValidacion = pg_query($conexion, $validacion);
                $rowValidacion = pg_fetch_assoc($resultValidacion);

                $count = $rowValidacion['count'];

                if($count < 1){
                    echo    '<span class="text-2xl font-semibold text-gray-500 ml-3">No hay usuarios en lista de espera.</span>';
                }
                else{
                    while($lista = pg_fetch_object($resultLista)){
                        $userAux1 = $lista -> id_estudiante;
                        $queryUser = "SELECT * FROM usuarios WHERE codigo_estudiante = '$userAux1';";
    
                        $resultUser = pg_query($conexion, $queryUser);
                        $userAux = pg_fetch_object($resultUser);
    
                        echo    '<div class="w-full h-16 bg-gray-900 rounded-lg flex items-center justify-center my-2 border-2 border-gray-800">
                                    <div class="w-12 h-12 rounded-full border-2 border-white" style="background-image: url(.' . $userAux -> foto_perfil . ');background-size: cover; background-position: center;"></div>
                                    <span class="text-2xl font-semibold text-white ml-3">' . $userAux -> nombre_completo . '</span>
                                </div>';
                    }
                }
            ?>
        </div>

        <!-- SOLICITAR O NO SOLICITAR -->
        <div class="flex my-12 justify-center">
            <?php 
            //EL USUARIO ES DUENIO DEL LIBRO
            if(($user -> codigo_estudiante) == ($codigo_estudiante)){
                echo '<button type="button" onclick="editBook();" class="mr-4 relative flex w-44 h-12 rounded-full bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap dark:text-black">Editar Libro</span>';
                echo '</button>';
                echo '<button type="button" onclick="volver();" class="mr-4 relative flex w-44 h-12 rounded-full bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap dark:text-black">Volver</span>';
                echo '</button>';
            }// EL USUARIO NO ES DUENIO DEL LIBRO PERO EL LIBRO NO ESTA DISPONIBLE
            else if((var_export($row->estatus, true)) == "'f'"){
                echo '<button type="button" onclick="listaDeEspera('. $row ->id . ');" class="mr-4 relative flex w-fit h-12 rounded-full bg-white px-4 focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap dark:text-black">Entrar En Lista De Espera</span>';
                echo '</button>';
                echo '<button type="button" onclick="volver();" class="mr-4 relative flex w-44 h-12 rounded-full bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap dark:text-black">Volver</span>';
                echo '</button>';
            }// EL USUARIO NO ES DUENIO DEL LIBRO Y EL LIBRO SI ESTA DISPONIBLE
            else {
                echo '<button type="button" onclick="solicitarLibro('. $row ->id . ');" class="mr-4 relative flex w-44 h-12 rounded-full bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap dark:text-black">Solicitar Libro</span>';
                echo '</button>';
                echo '<button type="button" onclick="volver();" class="mr-4 relative flex w-44 h-12 rounded-full bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 items-center justify-center mt-auto" id="user-menu-button" aria-expanded="false" aria-haspopup="true">';
                echo    '<span class="text-xl font-semibold whitespace-nowrap text-black">Volver</span>';
                echo '</button>';
            }
            
            ?>
        </div>

        <!-- LINEA -->
        <hr class="mx-auto border-gray-400 mb-4 w-full"> </hr>
        <div class="flex my-3 flex-col justify-center">
            <span class="text-3xl font-semibold whitespace-nowrap dark:text-white mb-2">Reseñas sobre este usuario</span>
            <!-- RESENAS-->
                <?php 
                    $id_estudiante = $user -> id;
                    $queryDos = "SELECT * FROM resenas WHERE id_usuario = $id_estudiante;";
                    $resultDos = pg_query($conexion, $queryDos);

                    $validacion2 = "SELECT COUNT(*) FROM resenas WHERE id_usuario = $id_estudiante;";
                    $resultValidacion2 = pg_query($conexion, $validacion2);
                    $rowValidacion2 = pg_fetch_assoc($resultValidacion2);

                    $count = $rowValidacion2['count'];

                    if($count < 1){
                        echo    '<span class="text-2xl font-semibold text-gray-500 ml-3">No hay reseñas de este usuario.</span>';
                    }
                    else{
                        while($resena = pg_fetch_object($resultDos)){

                            //Usuario que hace la resena
                            $codigo_estudiante_critico = $resena -> id_critico;
                            $queryUser = "SELECT * FROM usuarios WHERE codigo_estudiante = '$codigo_estudiante_critico';";
                            $resultCritico = pg_query($conexion, $queryUser);
                            $rowUser = pg_fetch_object($resultCritico);
        
                            echo    '<div class="w-full h-24 bg-gray-800 rounded-lg flex items-center border-2 border-gray-800 mb-2">
                                        <div class="flex items-center ml-6 w-full">
                                            <div class="w-12 h-12 rounded-full border-2 border-gray-900" style="background-image: url(.' . $rowUser -> foto_perfil . ');background-size: cover; background-position: center;"></div>
                                            <div class="flex flex-col w-full">
                                                <div class="flex justify-between">
                                                    <span class="text-base font-semibold text-gray-400 ml-3">' . $rowUser -> nombre_completo . '</span>
                                                    <span class="text-base font-semibold text-gray-400 mr-3">' . $resena -> fecha . '</span>
                                                </div>
                                                <span class="text-base font-semibold text-white ml-3 ">' . $resena -> mensaje . '</span>
                                                <span class="text-base font-semibold text-gray-400 mr-3 self-end">Calificación: ' . $resena -> calificacion . '</span>
                                            </div>
                                        </div>
                                    </div>';
                        }
                    }
                ?>
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

    function editBook() {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        var id_libro = params.get('id_libro');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/books/edit_book.php?id=' + id + '&url=' + url + '&id_libro=' + id_libro;
    }

    function listaDeEspera(id_libro) {
        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        var id_libro = params.get('id_libro');
        // Tu código JavaScript aquí
        window.location.href = 'http://localhost/libros/books/solicitar_libro_lista_espera.php?id=' + id + '&url=' + url + '&id_libro=' + id_libro;
    }

    function volver() {
        window.history.back();
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

    function solicitarLibro(id_libro) {

        var queryString = window.location.search;

        var params = new URLSearchParams(queryString);

        // Obtener el valor de id y url
        var id = params.get('id');
        var url = params.get('url');
        window.location.href = 'http://localhost/libros/books/solicitar_libro.php?id=' + id + '&url=' + url + '&id_libro=' + id_libro;
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

      
</body>
</html>

<?php

pg_close($conexion);

?>