<!DOCTYPE html>
<html>
<title>Actualizar consulta</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }
    </style>
</head>
<body>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Actualizar consulta</h3>
                            <?php
                            require_once('../config.inc.php');

                            // Obtener el ID de la consulta
                            $idConsulta = $_POST['idConsulta'];

                            // Crear la conexión a la base de datos
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Consulta para obtener los datos de la consulta
                            $consulta = "SELECT * FROM consulta WHERE idConsulta = $idConsulta";
                            $resultado = $conn->query($consulta);

                            // Verificar si se encontraron resultados
                            if ($resultado->num_rows > 0) {
                                // Obtener los datos de la consulta
                                $registro = $resultado->fetch_assoc();

                                // Mostrar el formulario con los datos de la consulta
                                echo '<form action="ModificarConsulta.php" method="post">';
                                echo '<div class="form-outline mb-4">';
                                echo '<input type="text" name="precio" id="form3Example1q" class="form-control" value="' . $registro['precio'] . '"/>';
                                echo '<label class="form-label" for="form3Example1q">Precio</label>';
                                echo '</div>';
                                echo '<div class="form-outline mb-4">';
                                echo '<input type="text" name="fecha" id="form3Example1q" class="form-control" value="' . $registro['fecha'] . '"/>';
                                echo '<label class="form-label" for="form3Example1q">Fecha</label>';
                                echo '</div>';
                                echo '<div class="form-outline mb-4">';
                                echo '<input type="text" name="motivo" id="form3Example1q" class="form-control" value="' . $registro['motivo'] . '"/>';
                                echo '<label class="form-label" for="form3Example1q">Motivo</label>';
                                echo '</div>';
                                echo '<div class="form-outline mb-4">';
                                echo '<input type="text" name="diagnostico" id="form3Example1q" class="form-control" value="' . $registro['diagnostico'] . '"/>';
                                echo '<label class="form-label" for="form3Example1q">Diagnóstico</label>';
                                echo '</div>';
                                echo '<input type="hidden" name="idConsulta" value="' . $idConsulta . '"/>';
                                echo '<button type="submit" class="btn btn-success btn-lg mb-1">Actualizar</button>';
                                echo '</form>';
                            } else {
                                echo '<p>No se encontraron datos para la consulta seleccionada.</p>';
                            }

                            // Cerrar la conexión a la base de datos
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

