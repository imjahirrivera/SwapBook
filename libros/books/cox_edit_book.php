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

$id_libro = $_GET['id_libro'];

$titulo = $_REQUEST['titulo'];
$autor = $_REQUEST['autor'];
$isbn = $_REQUEST['isbn'];
$editorial = $_REQUEST['editorial'];
$num_paginas = $_REQUEST['num_paginas'];
$idioma = $_REQUEST['idioma'];
$categorias = $_REQUEST['categoria'];
$estado_fisico = $_REQUEST['estado_fisico'];
$sinopsis = $_REQUEST['sinopsis'];

$query = "UPDATE libro SET titulo = '$titulo', autor = '$autor', isbn = $isbn, editorial = '$editorial', num_paginas = $num_paginas, idioma = '$idioma', categorias = '$categorias', estado_fisico = '$estado_fisico', sinopsis = '$sinopsis' WHERE id = $id_libro;";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

//Validar si existe una imagen
$img = $_FILES['foto_libro'];
if($img['name'] != ""){
    $ruta_provicional = guardarImagen($_FILES['foto_libro']);

    $rutaRelativa = str_replace('./', '', $ruta_provicional);

    $ruta_foto_libro = './books/' . $rutaRelativa;

    $queryPortada = "UPDATE libro SET imagen_portada = '$ruta_foto_libro' WHERE id = $id_libro;";
    $resultPortada = pg_query($conexion, $queryPortada);
    $rowPortada = pg_fetch_object($resultPortada);
}

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/user/profile.php";
$query_params = http_build_query(array(
    'id' => $_GET['id'],
    'url' => $_GET['url']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();

// Función para guardar la imagen en una carpeta del servidor y retornar la ruta
function guardarImagen($imagen) {
    $ruta_destino = "./covers/";
    $nombre_archivo = uniqid() . "_" . $imagen['name'];
    $ruta_completa = $ruta_destino . $nombre_archivo;
    move_uploaded_file($imagen['tmp_name'], $ruta_completa);
    return $ruta_completa;
}
?>