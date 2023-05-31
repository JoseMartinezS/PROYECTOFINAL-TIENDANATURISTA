<?php
    require_once('../config.inc.php');

    // Obtener los datos del formulario
    $idProveedor = $_POST['idProveedor'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $telefono = $_POST['telefono'];

    // Crear la conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Actualizar los datos del paciente
    $sql = "UPDATE proveedor SET nombre='$nombre', apellidoPaterno='$apellidoPaterno', apellidoMaterno='$apellidoMaterno', telefono='$telefono' WHERE idProveedor='$idProveedor'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("location: TablaProveedor.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
