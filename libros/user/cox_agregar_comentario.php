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
$id_usuario = $_GET['id_usuario'];

$mensaje = $_REQUEST['resena'];
$date = new DateTime();
$dateAux = $date -> format('Y-m-d');
$calificacion = $_REQUEST['calificacion'];

$query = "INSERT INTO resenas (id_usuario, mensaje, fecha, calificacion, id_critico) VALUES ($id_usuario, '$mensaje', '$dateAux' , $calificacion, $codigo_estudiante);";
$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/books/show_book.php";
$query_params = http_build_query(array(
    'id' => $_GET['id'],
    'url' => $_GET['url'],
    'id_libro' => $_GET['id_libro']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();

?>