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
$id_solicitante = $_GET['id'];

$queryPropietario = "SELECT poseedor_id FROM libro WHERE id = $id_libro";

$resultPropietario = pg_query($conexion, $queryPropietario);
$userPropietario = pg_fetch_object($resultPropietario);

$id_propietario = $userPropietario -> poseedor_id;


$query = "INSERT INTO solicitud_prestamos (id_libro, id_solicitante, id_propietario, status_solicitante, status_propietario) VALUES ($id_libro, $id_solicitante, $id_propietario, 'Pendiente', 'Solicitud');";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

if($result){
    echo '<script> alert("Libro agregado con exito!");</script>';
}

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/user/solicitudes.php";
$query_params = http_build_query(array(
    'id' => $id_solicitante,
    'url' => $_GET['url']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();
?>