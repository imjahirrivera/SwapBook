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
$id_solicitud = $_GET['id_solicitud'];

$query = "UPDATE solicitud_prestamos SET status_solicitante = 'Finalizado', status_propietario = 'Cancelado' WHERE id = '$id_solicitud';";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/user/solicitudes.php";
$query_params = http_build_query(array(
    'id' => $_GET['id'],
    'url' => $_GET['url']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();
?>