<?php

$idConsulta = $_POST["idConsulta"];

require_once('../config.inc.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// sql to delete a record
$sql = "DELETE FROM consulta WHERE idConsulta='" . $idConsulta . "'";
if (mysqli_query($conn, $sql))
{
  $conn->close();
  header("location:TablaConsulta.php");
} else {
  echo "Error al eliminar Consulta: " . mysqli_error($conn);
}


mysqli_close($conn);

?>