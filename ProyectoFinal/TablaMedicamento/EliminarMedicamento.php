<?php

$idMedicamento = $_POST["idMedicamento"];

require_once('../config.inc.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// sql to delete a record
$sql = "DELETE FROM medicamento WHERE idMedicamento='" . $idMedicamento . "'";
if (mysqli_query($conn, $sql))
{
  $conn->close();
  header("location:TablaMedicamento.php");
} else {
  echo "Error al eliminar empleado: " . mysqli_error($conn);
}


mysqli_close($conn);

?>