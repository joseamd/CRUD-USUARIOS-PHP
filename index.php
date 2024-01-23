<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud en PHP PostgreSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0b238d6077.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center p-3">CRUD EN PHP Y POSTGRESQL</h1>

    <?php
    include_once("controlador/eliminar_persona.php");
    ?>

    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center alert alert-secondary">Registro de Personas</h3>

            <?php
            include_once("modelo/conexion.php");
            include_once("controlador/registro_persona.php");
            ?>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellidos de la persona</label>
                <input type="text" class="form-control" name="apellido">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">DNI de la persona</label>
                <input type="text" class="form-control" name="dni">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo">
            </div>
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="table-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRES</th>
                        <th scope="col">APELLIDOS</th>
                        <th scope="col">DNI</th>
                        <th scope="col">FECHA DE NAC</th>
                        <th scope="col">CORREO</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //include_once("modelo/conexion.php");

                        // Crear una instancia de CConexion
                        $conexionObjeto = new CConexion();
                        $conexion = $conexionObjeto->ConexionBD();

                        // Realizar la consulta a la base de datos
                        $query = "SELECT * FROM persona";
                        $result = $conexion->query($query);

                        // Iterar sobre los resultados y mostrar cada fila
                        while ($datos = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $datos['id_persona'] . "</th>";
                            echo "<td>" . $datos['nombre'] . "</td>";
                            echo "<td>" . $datos['apellido'] . "</td>";
                            echo "<td>" . $datos['dni'] . "</td>";
                            echo "<td>" . $datos['fecha_nac'] . "</td>";
                            echo "<td>" . $datos['correo'] . "</td>";
                            echo "<td>
                                    <a href='modificar_persona.php?id=" . $datos['id_persona'] . "' class='btn btn-small btn-warning'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a onclick='return eliminar()' href='index.php?id=" . $datos['id_persona'] . "' class='btn btn-small btn-danger'><i class='fa-solid fa-trash'></i></a>
                                </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
    <script>
        function eliminar(){
            var respuesta = confirm("Estas seguro que deseas eliminar?");
            return respuesta
        }
    </script>

</body>

</html>