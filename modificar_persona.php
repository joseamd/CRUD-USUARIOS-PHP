<?php
include_once("modelo/conexion.php");
// Almacenamos en una variable el id del usuario
$id = $_GET['id'];

// Crear una instancia de CConexion y obtener la conexión
$conexionObjeto = new CConexion();
$conexion = $conexionObjeto->ConexionBD();

// Preparar la consulta SQL para obtener los datos de la persona con el id proporcionado
$query = "SELECT * FROM persona WHERE id_persona = :id";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Obtener los datos de la persona
$datosPersona = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
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
    <h1 class="text-center p-3 alert alert-secondary">CRUD EN PHP Y POSTGRESQL</h1>

    <form class="col-4 p-3 mx-auto my-4" method="POST">
        <h3 class="text-center alert alert-secondary">Modificar Persona</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"]; ?>" />
        <?php
        include_once("controlador/modificar_persona.php");
        // Rellenar los campos del formulario con los datos obtenidos de la base de datos
        if ($datosPersona) {
        ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $datosPersona['nombre']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellidos de la persona</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo $datosPersona['apellido']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">DNI de la persona</label>
                <input type="text" class="form-control" name="dni" value="<?php echo $datosPersona['dni']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha" value="<?php echo $datosPersona['fecha_nac']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?php echo $datosPersona['correo']; ?>">
            </div>
        <?php
        } else {
            echo '<div class="alert alert-danger">Error: Persona no existe</div>';
        }
        ?>

        <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Modificar</button>
    </form>
</body>
</html>