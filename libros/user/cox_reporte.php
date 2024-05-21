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

//USUARIO REPORTANTE (YO)
$codigo_estudiante = $_GET['id'];

$queryReportante = "SELECT * FROM usuarios WHERE codigo_estudiante = '$codigo_estudiante'";
$resultReportante = pg_query($conexion, $queryReportante);
$reportante = pg_fetch_object($resultReportante);

$idReportante = $reportante -> id;
$nombreReportante = $reportante -> nombre_completo;

//USUARIO REPORTADO
$idReportado = $_GET['id_usuario'];

$queryReportado = "SELECT * FROM usuarios WHERE id = $idReportado";
$resultReportado = pg_query($conexion, $queryReportado);
$reportado = pg_fetch_object($resultReportado);

$nombreReportado = $reportado -> nombre_completo;

//Datos del reporte
$mensaje = $_REQUEST['mensaje'];

$date = new DateTime();
$dateAux = $date -> format('Y-m-d');

$estado = "En proceso";

//Guardar libro

$ruta_provicional = guardarImagen($_FILES['foto_libro']);

// Función para guardar la imagen en una carpeta del servidor y retornar la ruta
function guardarImagen($imagen) {
    $ruta_destino = "./reportes/";
    $nombre_archivo = uniqid() . "_" . $imagen['name'];
    $ruta_completa = $ruta_destino . $nombre_archivo;
    move_uploaded_file($imagen['tmp_name'], $ruta_completa);
    return $ruta_completa;
}

$rutaRelativa = str_replace('./', '', $ruta_provicional);

$ruta_foto_libro = './user/' . $rutaRelativa;

$query = "INSERT INTO reportes (usuario_reportante_id, usuario_reportante, usuario_reportado_id, usuario_reportado, descripcion, fecha, estado, foto_libro)
VALUES ($idReportante, '$nombreReportante', $idReportado, '$nombreReportado', '$mensaje', '$dateAux', '$estado', '$ruta_foto_libro');";
$result = pg_query($conexion, $query);
$row = pg_fetch_object($result);

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

?>