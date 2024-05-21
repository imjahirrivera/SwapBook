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

    $queryVerificar = "SELECT COUNT(*) FROM lista_espera WHERE id_libro = $id_libro;";
    $resultVer = pg_query($conexion, $queryVerificar);
    $rowVer = pg_fetch_assoc($resultVer);
    $count = $rowVer['count'];

    if($count != 0) {
        //Verificar si existe alguien en lista de espera del libro

        $queryLista = "SELECT * FROM lista_espera WHERE id_libro = $id_libro ORDER BY id_lista ASC LIMIT 1;";
        $resultLista = pg_query($conexion, $queryLista);
        $rowLista = pg_fetch_object($resultLista);

        //Hago la nueva solicitud del usuario de hasta arriba de la lista de espera

        $id_solicitante = $rowLista -> id_estudiante; //El nuevo codigo

        $queryPropietario = "SELECT poseedor_id FROM libro WHERE id = $id_libro";

        $resultPropietario = pg_query($conexion, $queryPropietario);
        $userPropietario = pg_fetch_object($resultPropietario);

        $id_propietario = $userPropietario -> poseedor_id;


        $query = "INSERT INTO solicitud_prestamos (id_libro, id_solicitante, id_propietario, status_solicitante, status_propietario) VALUES ($id_libro, $id_solicitante, $id_propietario, 'Pendiente', 'Solicitud');";

        $result = pg_query($conexion, $query);
        $row = pg_fetch_object($result);


        //QUITAR EL USUARIO DE LA LISTA DE ESPERA

        $borrarIdLista = $rowLista -> id_lista;

        $queryBorrar = "DELETE FROM lista_espera WHERE id_lista = $borrarIdLista;";
        $resultBorrar = pg_query($conexion, $queryBorrar);
        $rowBorrar = pg_fetch_object($resultBorrar);
    }


    // BORRAR TODOS LOS MENSAJES DEL CHAT

    $queryChat = "SELECT COUNT(*) FROM mensajes WHERE id_intercambio = $id_solicitud;";
    $resultChat = pg_query($conexion, $queryChat);
    $rowChat = pg_fetch_object($resultChat);
    $count = $rowChat -> count;

    if($count > 0) {
        $queryBorrarChat = "DELETE FROM mensajes WHERE id_intercambio = $id_solicitud;";
        $resultBorrarChat = pg_query($conexion, $queryBorrarChat);
        $rowBorrarChat = pg_fetch_object($resultBorrarChat);
    }


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