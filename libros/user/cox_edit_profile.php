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

$id = $_REQUEST['codigo_estudiante'];

$telefono = $_REQUEST['telefono'];
$auxContra = $_REQUEST['contrasena'];

$img = $_FILES['foto_libro'];
if($img['name'] != ""){
    $ruta_provicional = guardarImagen($_FILES['foto_libro']);


    $rutaRelativa = str_replace('./', '', $ruta_provicional);

    $ruta_foto_libro = './user/' . $rutaRelativa;

    if($auxContra == "") {
        $query = "UPDATE usuarios SET telefono = '$telefono', foto_perfil = '$ruta_foto_libro' WHERE codigo_estudiante = '$id';";
    
        $result = pg_query($conexion, $query);
        $row = pg_fetch_object($result);
    
        if($result){
            echo '<script> alert("Guardado exitoso!");</script>';
        }
    }else{
        $hash = password_hash($auxContra, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET telefono = '$telefono', contraseña = '$hash', foto_perfil = '$ruta_foto_libro' WHERE codigo_estudiante = '$id';";
    
        $result = pg_query($conexion, $query);
        $row = pg_fetch_object($result);
    
        if($result){
            echo '<script> alert("Guardado exitoso!");</script>';
        }
    }
}else{
    if($auxContra == "") {
        $query = "UPDATE usuarios SET telefono = '$telefono' WHERE codigo_estudiante = '$id';";
    
        $result = pg_query($conexion, $query);
        $row = pg_fetch_object($result);
    
        if($result){
            echo '<script> alert("Guardado exitoso!");</script>';
        }
    }else{
        $hash = password_hash($auxContra, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET telefono = '$telefono', contraseña = '$hash' WHERE codigo_estudiante = '$id';";
    
        $result = pg_query($conexion, $query);
        $row = pg_fetch_object($result);
    
        if($result){
            echo '<script> alert("Guardado exitoso!");</script>';
        }
    }
}

$query2 = "SELECT codigo_estudiante, foto_perfil FROM usuarios where codigo_estudiante = '$id';";

$result2 = pg_query($conexion, $query2);
$row2 = pg_fetch_object($result2);

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/user/profile.php";
$query_params = http_build_query(array(
    'id' => $row2 -> codigo_estudiante,
    'url' => $row2 -> foto_perfil
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();

// Función para guardar la imagen en una carpeta del servidor y retornar la ruta
function guardarImagen($imagen) {
    $ruta_destino = "./img/";
    $nombre_archivo = uniqid() . "_" . $imagen['name'];
    $ruta_completa = $ruta_destino . $nombre_archivo;
    move_uploaded_file($imagen['tmp_name'], $ruta_completa);
    return $ruta_completa;
}
?>