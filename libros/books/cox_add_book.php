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

$codigo_estudiante = $_GET['id'];
$queryID = "SELECT id FROM usuarios WHERE codigo_estudiante = '$codigo_estudiante'";
$resultID = pg_query($conexion, $queryID);
$id = pg_fetch_object($resultID) -> id;

$titulo = $_REQUEST['titulo'];
$autor = $_REQUEST['autor'];
$isbn = $_REQUEST['isbn'];
$estatus = true;
$estado_fisico = $_REQUEST['estado_fisico'];
$sinopsis = $_REQUEST['sinopsis'];
$editorial = $_REQUEST['editorial'];
$num_paginas = $_REQUEST['num_paginas'];
$categorias = $_REQUEST['categoria'];
$idioma = $_REQUEST['idioma'];

$ruta_provicional = guardarImagen($_FILES['foto_libro']);

// Función para guardar la imagen en una carpeta del servidor y retornar la ruta
function guardarImagen($imagen) {
    $ruta_destino = "./covers/";
    $nombre_archivo = uniqid() . "_" . $imagen['name'];
    $ruta_completa = $ruta_destino . $nombre_archivo;
    move_uploaded_file($imagen['tmp_name'], $ruta_completa);
    return $ruta_completa;
}

$rutaRelativa = str_replace('./', '', $ruta_provicional);

$ruta_foto_libro = './books/' . $rutaRelativa;

$query = "INSERT INTO libro (titulo, autor, isbn, estatus, estado_fisico, imagen_portada, sinopsis, editorial, num_paginas, poseedor_id, categorias, idioma)
VALUES ('$titulo', '$autor', '$isbn', true, '$estado_fisico', '$ruta_foto_libro', '$sinopsis', '$editorial', $num_paginas, $id, '$categorias', '$idioma');";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

if($result){
    echo '<script> alert("Libro agregado con exito!");</script>';
}

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/user/profile.php";
$query_params = http_build_query(array(
    'id' => $codigo_estudiante,
    'url' => $_GET['url']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();
?>