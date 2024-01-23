<?php
include_once("modelo/conexion.php");

// Verificar si se ha enviado el formulario
if (!empty($_POST['btnregistrar'])) {

    // Validar que todos los campos del formulario están presentes
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['dni']) && !empty($_POST['fecha']) && !empty($_POST['correo'])) {
        //echo "TODO OK";

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $fecha = $_POST['fecha'];
        $correo = $_POST['correo'];

        // Crear una instancia de CConexion y obtener la conexión        
        $conexionObjeto = new CConexion();
        $conexion = $conexionObjeto->ConexionBD();

        // Preparar una sentencia preparada para evitar la inyección de SQL
        $stmt = $conexion->prepare("INSERT INTO persona (nombre, apellido, dni, fecha_nac, correo) VALUES (?, ?, ?, ?, ?)");

        // Ejecutar la sentencia preparada con los valores proporcionados
        $stmt->execute([$nombre, $apellido, $dni, $fecha, $correo]);

        // Verificar el resultado de la inserción
        if ($stmt->rowCount() == 1) {
            echo '<div class="alert alert-success"> Persona registrada correctamente!</div>';
        } else {
            echo '<div class="alert alert-danger"> Error al registrar persona!</div>';
        }
        
    } else {
        echo '<div class="alert alert-warning"> ALGUNOS DE LOS CAMPOS ESTA VACIO!</div>';
    }
}

?>