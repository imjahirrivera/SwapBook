<?php
include("../bd.php");

// Verifica si se ha proporcionado el ID del intercambio
if (isset($_GET['id_intercambio'])) {
    $id_intercambio = $_GET['id_intercambio'];

    // Obtener los mensajes del intercambio
    $query_mensajes = "SELECT * FROM mensajes WHERE id_intercambio = $1 ORDER BY fecha_envio ASC";
    $result_mensajes = pg_query_params($conexion, $query_mensajes, array($id_intercambio));

    $mensajes = array();

    if ($result_mensajes && pg_num_rows($result_mensajes) > 0) {
        while ($mensaje = pg_fetch_assoc($result_mensajes)) {
            $mensajes[] = array(
                'id_enviado' => $mensaje['id_enviado'],
                'mensaje' => $mensaje['mensaje']
            );
        }
    }

    // Devolver los mensajes en formato JSON
    header('Content-Type: application/json');
    echo json_encode($mensajes);
} else {
    // Si no se proporciona el ID del intercambio, devolver un error
    http_response_code(400);
    echo json_encode(array('error' => 'ID de intercambio no proporcionado'));
}
?>
