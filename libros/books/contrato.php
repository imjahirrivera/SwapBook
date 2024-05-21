<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Préstamo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: url('../img/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background-color: rgba(255, 255, 255);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
            max-width: 800px;
            position: relative;
            z-index: 1;
            overflow-y: auto;
            max-height: 100vh;
        }

        .highlight-title {
            color: black;
            font-size: 20px;
            font-weight: bold;
            padding: 0.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .highlight-title h2 {
            margin: 0;
        }

        .div-volver {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .boton-volver {
            display: flex;
            width: 11rem;
            height: 3rem;
            background-color: #C1C1C1;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
        }
        
    </style>
</head>
<body class="flex justify-center items-center">
    <div class= "background-image"></div>
    <div class="container">
        <h1 class="text-3xl font-semibold bg-gray-800 text-white p-4 text-center rounded-3xl mb-6">Términos y Condiciones del Préstamo</h1>
        
        <div class="highlight-title">
            <h2>Condiciones del Libro:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>El solicitante se compromete a cuidar el libro prestado, manteniéndolo en el mismo estado en que fue recibido.</li>
            <li>El solicitante deberá revisar el estado del libro al recibirlo y notificar al prestamista de cualquier daño preexistente para evitar malentendidos posteriores.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Plazo de Devolución:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>El solicitante se compromete a devolver el libro en la fecha acordada.</li>
            <li>En caso de necesitar una extensión del plazo, el solicitante deberá comunicarse con el prestamista al menos tres días antes de la fecha de devolución para acordar una nueva fecha.</li>
            <li>La falta de devolución en la fecha acordada resultará en una penalización diaria de [Monto de Penalización], que deberá ser pagada al prestamista hasta que el libro sea devuelto.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Responsabilidad del Solicitante:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>El solicitante asume la responsabilidad completa por el libro durante el período de préstamo.</li>
            <li>En caso de daño, pérdida o robo del libro, el solicitante deberá informar inmediatamente al prestamista y asumir el costo de reposición del libro, el cual será determinado por el valor de mercado actual o el precio de compra original, lo que sea mayor.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Uso Adecuado:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>El solicitante se compromete a utilizar el libro exclusivamente para fines académicos y personales, sin fines de lucro.</li>
            <li>Se prohíbe la reproducción, distribución o uso comercial del libro en cualquier forma, respetando los derechos de autor y las leyes vigentes.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Devolución en Tiempo y Forma:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>El solicitante deberá devolver el libro en la fecha y condiciones acordadas, en el lugar acordado con el prestamista.</li>
            <li>El libro debe ser devuelto sin daños adicionales y en el mismo estado en que fue recibido.</li>
            <li>En caso de daños no reportados previamente, el solicitante será responsable del costo de reparación o reposición del libro.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Penalizaciones y Reposiciones:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>En caso de daños al libro, el solicitante será responsable de pagar el costo de reparación o reposición del libro.</li>
            <li>Si el libro no puede ser reparado, el solicitante deberá pagar el valor de reposición del libro, el cual será determinado por el valor de mercado actual o el precio de compra original, lo que sea mayor.</li>
            <li>La falta de pago de las penalizaciones o costos de reposición resultará en la suspensión de los privilegios de préstamo del solicitante en SwapBook CUCEI hasta que se realice el pago correspondiente.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Confidencialidad de la Información:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>Ambas partes acuerdan mantener la confidencialidad de la información personal proporcionada en este contrato y utilizarla únicamente para los fines del préstamo del libro.</li>
            <li>Cualquier uso indebido de la información personal será tratado de acuerdo con las políticas de privacidad de SwapBook CUCEI.</li>
        </ul>
        
        <div class="highlight-title">
            <h2>Aceptación de Términos:</h2>
        </div>
        <ul class="list-disc list-inside mb-4">
            <li>Al aceptar este contrato, el solicitante confirma que ha leído, entendido y acepta todos los términos y condiciones del préstamo del libro.</li>
            <li>Este contrato es vinculante y cualquier incumplimiento será tratado de acuerdo con las políticas de SwapBook CUCEI.</li>
        </ul>

    </div>

<script>
    function volver() {
        window.history.back();
    }
</script>


</body>
</html>
