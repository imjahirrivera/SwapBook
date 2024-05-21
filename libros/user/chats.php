<?php
include("../bd.php");

$row = null; 

if (isset($_POST['enviar'])) {
    // Recuperar el mensaje ingresado por el usuario
    $mensaje = $_POST['mensaje'];
    $id_intercambio = $_POST['id_intercambio'];
    $id_dos = $_GET['id'];
    $url_dos = $_GET['url'];
    $id_usuario1 = $_POST['id_usuario1'];

    // Validar que los campos no estén vacíos
    if (!empty($mensaje) && !empty($id_intercambio) && !empty($id_usuario1)) {
        // Insertar el mensaje en la base de datos
        $query_insertar = "INSERT INTO mensajes (id_intercambio, id_enviado, mensaje, fecha_envio) VALUES ($1, $2, $3, NOW())";
        $resultado_insertar = pg_query_params($conexion, $query_insertar, array($id_intercambio, $id_usuario1, $mensaje));

        if ($resultado_insertar) {
            error_log("Mensaje enviado correctamente.");
        } else {
            error_log("Error al enviar el mensaje: " . pg_last_error($conexion));
        }

        // Recargar la página para mostrar el mensaje recién enviado
        header("Location: " . $_SERVER['PHP_SELF'] . "?id_intercambio=" . $id_intercambio . "&id=" . $id_dos . "&url=" . $url_dos);
        exit;
    } else {
        error_log("Todos los campos son obligatorios.");
    }
}

if (isset($_GET['id_intercambio'])) {
    // Recuperar el ID del intercambio
    $id_intercambio = $_GET['id_intercambio'];

    $query = "SELECT * FROM solicitud_prestamos WHERE id = $1";
    $resultado = pg_query_params($conexion, $query, array($id_intercambio));

    if ($resultado && pg_num_rows($resultado) > 0) {
        // Obtener los detalles del intercambio
        $intercambio = pg_fetch_assoc($resultado);

        $cod = $intercambio['id_solicitante'];
        $codigo_estudiante = "SELECT id FROM usuarios WHERE codigo_estudiante = '$cod';";
        $codCon = pg_query($conexion, $codigo_estudiante);
        $id_sol = pg_fetch_assoc($codCon);
        
        $id_solAux = $id_sol['id'];
        
        $id_solicitante = $id_solAux;
        $id_propietario = $intercambio['id_propietario'];

        $id_session = $_GET['id'];
        $querySession = "SELECT id FROM usuarios WHERE codigo_estudiante = '$id_session';";
        $resSession = pg_query($conexion, $querySession);
        $rowSession = pg_fetch_assoc($resSession);

        // Determinar qué vista de usuario es
        if ($rowSession['id'] == $id_solicitante) {
            $id_usuario1 = $id_solicitante;
            $id_usuario2 = $id_propietario;
        } else {
            $id_usuario1 = $id_propietario;
            $id_usuario2 = $id_solicitante;
        }

        // Obtener los detalles del usuario con el que se está chateando
        $query = "SELECT * FROM usuarios WHERE id = $1";
        $result = pg_query_params($conexion, $query, array($id_usuario2));
        $row = pg_fetch_assoc($result);

        // Obtener los mensajes enviados en este intercambio
        $query_mensajes = "SELECT * FROM mensajes WHERE id_intercambio = $1 ORDER BY fecha_envio ASC";
        $result_mensajes = pg_query_params($conexion, $query_mensajes, array($id_intercambio));
    } else {
        error_log("Intercambio no encontrado.");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-no-repeat" style="background-image:url(../img/fondo.jpg);">
    <div class="wrapper flex flex-col items-center justify-center bg-gray-900 shadow-lg rounded-lg max-w-md w-full">
        <header class="flex items-center justify-between px-8 py-4 border-b border-gray-300 w-full">
            <a href="<?php echo 'http://localhost/libros/user/solicitudes.php?id=' . $_GET['id'] . '&url=' . $_GET['url']?>" class="text-white"><i class="fas fa-arrow-left text-lg"></i></a>

            <div class="flex items-center">
                <span class="text-lg font-medium text-white m-3"><?php echo htmlspecialchars($row['nombre_completo']); ?></span>
                <img src="../<?php echo htmlspecialchars($row['foto_perfil']); ?>" alt="Foto de perfil" class="w-12 h-12 rounded-full ml-auto">
            </div>
        </header>

        <div id="chatMessages" class="chat-box h-96 overflow-auto p-8 shadow-inner w-full" style="background-image:url(../img/geometry.png);">
            <?php
            if ($result_mensajes && pg_num_rows($result_mensajes) > 0) {
                while ($mensaje = pg_fetch_assoc($result_mensajes)) {
                    // Determinar si el mensaje fue enviado por el usuario 1 o el usuario 2
                    $clase_mensaje = ($mensaje['id_enviado'] == $id_usuario1) ? 'flex justify-end mb-4' : 'flex mb-4';
                    $clase_burbuja = ($mensaje['id_enviado'] == $id_usuario1) ? 'bg-blue-500 text-white p-3 rounded-br-lg rounded-l-lg ml-2 max-w-xs' : 'bg-gray-300 p-3 rounded-r-lg rounded-bl-lg max-w-xs';
            ?>
                    <div class="<?php echo $clase_mensaje; ?>">
                        <div class="<?php echo $clase_burbuja; ?>">
                            <p><?php echo htmlspecialchars($mensaje['mensaje']); ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] . '&url=' . $_GET['url']); ?>" method="POST" class="typing-area px-8 py-4 border-t border-gray-300 w-full flex items-center">
            <input type="hidden" name="id_intercambio" value="<?php echo htmlspecialchars($id_intercambio); ?>">
            <input type="hidden" name="id_usuario1" value="<?php echo htmlspecialchars($id_usuario1); ?>">
            <input type="text" name="mensaje" class="input-field flex-1 h-full px-4 py-2 rounded-l border border-gray-300 focus:outline-none focus:border-blue-500" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
            <button type="submit" name="enviar" class="py-2 px-4 bg-blue-500 text-white rounded-r cursor-pointer focus:bg-blue-600 h-full"><i class="fab fa-telegram-plane"></i></button>
        </form>
    </div>
    <script>

    function obtenerMensajes() {
        var chatMessages = document.getElementById('chatMessages');
        var id_usuario1 = "<?php echo $id_usuario2; ?>";
        var id_intercambio = "<?php echo htmlspecialchars($id_intercambio); ?>";

        fetch("http://localhost/Libros/user/obtener_mensajes.php?id_intercambio=" + id_intercambio)
            .then(response => response.json())
            .then(data => {
                chatMessages.innerHTML = '';
                data.forEach(mensaje => {
                    var divMensaje = document.createElement('div');
                    var p = document.createElement('p');
                    p.textContent = mensaje.mensaje;

                    var divBurbuja = document.createElement('div');
                    divBurbuja.appendChild(p);
                    divMensaje.appendChild(divBurbuja);

                    if (mensaje.id_enviado == id_usuario1) {
                        divMensaje.className = 'flex mb-4';
                        divBurbuja.className = 'bg-gray-300 p-3 rounded-r-lg rounded-bl-lg max-w-xs';
                    } else {
                        divMensaje.className = 'flex justify-end mb-4';
                        divBurbuja.className = 'bg-blue-500 text-white p-3 rounded-br-lg rounded-l-lg ml-2 max-w-xs';
                    }

                    chatMessages.appendChild(divMensaje);
                });
            })
            .catch(error => {
                console.error('Error al obtener los mensajes:', error);
            });
    }

    setInterval(obtenerMensajes, 200);


    </script>

</body>
</html>
