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

$query = "UPDATE solicitud_prestamos SET status_solicitante = 'Entregado', status_propietario = 'Entregado' WHERE id = '$id_solicitud';";

$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

$query2 = "SELECT * FROM solicitud_prestamos WHERE id = $id_solicitud;";
$result2 = pg_query($conexion, $query2);
$row2 = pg_fetch_object($result2);

$id_libro = $row2 -> id_libro;

$query3 = "UPDATE libro SET estatus = true WHERE id = '$id_libro';";
$result3 = pg_query($conexion, $query3);
$row3 = pg_fetch_object($result3);

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