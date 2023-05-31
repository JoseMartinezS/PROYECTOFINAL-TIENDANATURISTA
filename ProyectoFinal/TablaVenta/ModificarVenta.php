<?php
    require_once('../config.inc.php');

    // Obtener los datos del formulario
    $idVenta = $_POST['idVenta'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $tipoPago = $_POST['tipoPago'];
    $descuento = $_POST['descuento'];

    // Crear la conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Actualizar los datos del paciente
    $sql = "UPDATE venta SET cantidad='$cantidad', fecha='$fecha', tipoPago='$tipoPago', descuento='$descuento' WHERE idVenta='$idVenta'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("location: TablaVenta.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>