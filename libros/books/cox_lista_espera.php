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
$codigo_estudiante = $_GET['id'];

//Verificar si no existes en la base de datos
$verify = "SELECT COUNT(*) FROM lista_espera WHERE id_estudiante = $codigo_estudiante AND id_libro = $id_libro;";
$result0 = pg_query($conexion,$verify);
$row0 = pg_fetch_assoc($result0);
$count = $row0['count'];

if($count != 0){
    echo '<script type="text/javascript">
        alert("YA ESTAS EN ESTA LISTA DE ESPERA!");
        window.history.back();
    </script>';
    return;
}else {
    $query = "INSERT INTO lista_espera (id_libro, id_estudiante) VALUES ($id_libro, $codigo_estudiante);";
    $result = pg_query($conexion, $query);
    $row = pg_fetch_object($result);

    if($result){
        echo '<script> alert("Libro agregado con exito!");</script>';
    }
}


// Construir la URL con parámetros de consulta
$base_url = "http://localhost/libros/books/show_book.php";
$query_params = http_build_query(array(
    'id' => $codigo_estudiante,
    'url' => $_GET['url'],
    'id_libro' => $_GET['id_libro']
));
$url = $base_url . '?' . $query_params;

// Redirigir a la nueva URL
header("Location: $url");
exit();
?>