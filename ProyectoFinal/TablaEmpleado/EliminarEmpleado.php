<?php

$idEmpleado = $_POST["idEmpleado"];

require_once('../config.inc.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// sql to delete a record
$sql = "DELETE FROM empleado WHERE idEmpleado='" . $idEmpleado . "'";
if (mysqli_query($conn, $sql))
{
  $conn->close();
  header("location:TablaEmpleado.php");
} else {
  echo "Error al eliminar empleado: " . mysqli_error($conn);
}


mysqli_close($conn);

?>