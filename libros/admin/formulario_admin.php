<?php
function registrarAdmin($datos) {
    include('../bd.php');
    // Obtener otros campos
    $nombre_completo = $datos['nombre_apellidos'];
    $correo_electronico = $datos['correo_electronico'];
    $numero_telefono = $datos['numero_telefono'];
    $codigo_academicos = $datos['codigo_academicos'];
    $razon = $datos['razon'];
    $contrasena = password_hash($datos['password'], PASSWORD_DEFAULT);


    // Verificar si el correo electrónico ya está en uso
    $query_correo = "SELECT COUNT(*) FROM registro_admin WHERE correo_electronico = $1";
    $result_correo = pg_query_params($conexion, $query_correo, array($correo_electronico));
    $row_correo = pg_fetch_assoc($result_correo);
    $correo_existente = intval($row_correo['count']) > 0;

    // Verificar si el código de estudiante ya está en uso
    $query_codigo = "SELECT COUNT(*) FROM registro_admin WHERE codigo_academicos = $1";
    $result_codigo = pg_query_params($conexion, $query_codigo, array($codigo_academicos));
    $row_codigo = pg_fetch_assoc($result_codigo);
    $codigo_existente = intval($row_codigo['count']) > 0;


    $errores = "";

    if ($correo_existente && $codigo_existente) {
        $errores .= "❌El correo electrónico ya ha sido registrado.<br>";
        $errores .= "❌El código de academicos ya ha sido registrado.<br>";
        return $errores;
    }else if ($correo_existente){
        $errores .= "❌El correo electrónico ya ha sido registrado.<br>";
        return $errores;
    }else if ($codigo_existente) {
        $errores .= "❌El código de academidos ya ha sido registrado.<br>";
        return $errores;
    }else{
        $query_insert = "INSERT INTO registro_admin (nombre_completo, correo_electronico, numero_telefono, codigo_academicos, contraseña, razon) VALUES ($1, $2, $3, $4, $5, $6)";
        $result_insert = pg_query_params($conexion, $query_insert, array($nombre_completo, $correo_electronico, $numero_telefono, $codigo_academicos, $contrasena, $razon));
        
        if ($result_insert) {
            header("Location: /Libros/login.php");
        }
    }
}

$errores = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro_admin'])) {
    $errores = registrarAdmin($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../css/output.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center h-screen body-login-register">
    <!--Formulario-->
    <div class="relative overflow-hidden bg-white shadow-md rounded m-24 w-1/3 max-w-full flex">
    <div class="bg-gray-800 w-1/12"></div>
    <div class="px-16 py-8 flex-grow w-11/12 max-w-full container"> 
            <h1 class="text-2xl font-semibold bg-gray-800  text-white p-2 text-center titulo no-underline rounded-3xl">Registrarse</h1>
            <form action="#" method="POST"  onsubmit="return validarFormularioAdmin()" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-4 mb-4 mt-5">
                    <!-- Otros datos-->
                    <div class="mb-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="nombre_apellidos">
                            Nombre(s) y Apellido(s)
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="nombre_apellidos" id="nombre_apellidos" type="text" placeholder="Nombre y apellido">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="correo_electronico">
                            Correo institucional
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="correo_electronico" id="correo_electronico" type="email" placeholder="ejemplo@alumnos.udg.mx">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="numero_telefono">
                            Telefono
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="numero_telefono" name="numero_telefono" type="text" placeholder="10 digitos">
                    </div>
                    <div class="mb-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="codigo_estudiante">
                            Codigo de academico
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="codigo_academicos" name="codigo_academicos" type="text" placeholder="9 digitos">
                    </div>
                    <div class="mb-2 ">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="password">
                            Contraseña
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="**********">
                    </div>
                    <div class="mb-2 ">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="password2">
                            Confirmar contraseña
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password2" type="password" name="password2" placeholder="**********">
                    </div>
                </div>
                <div class="grid gap-4 mb-2 mt-5">
                    <div class="mb-2">
                        <label class="block text-gray-700 text-md font-bold mb-2" for="razon">
                            Razón de ser administrador
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full h-28 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="razon" name="razon" placeholder="Escribe aquí la razón de ser administrador" style="max-height:200px; resize: none;"></textarea>
                    </div>
                </div>
                <div class="mb-2">
                    <p class=" text-sm font-bold mb-2 text-red-600" id="Error"></p>

                    <?php if(isset($errores)){ ?>
                        <p class=" text-sm font-bold mb-2 text-red-600"><?php echo $errores; ?></p>
                    <?php } ?>
                </div>
                <div class="w-full flex items-center justify-center align-center">
                    <span class="text-xs w-full font-bold">**Recuerda que llenar este formulario no te asegura una cuenta como Administrador.**</span>
                </div>
                <div class="mb-6">
                    <a href="../login.php" class="text-sm font-bold mb-2 no-underline text-blue-300">¿Ya tienes cuenta? Iniciar sesión</a>
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="registro_admin" type="submit">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
