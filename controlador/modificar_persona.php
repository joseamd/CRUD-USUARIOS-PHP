<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("modelo/conexion.php");

// Verificar si se ha enviado el formulario
if (!empty($_POST['btnmodificar'])) {

    // Validar que todos los campos del formulario están presentes
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['dni']) && !empty($_POST['fecha']) && !empty($_POST['correo'])) {

        // Obtener los datos del formulario
        $id_persona = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $fecha = $_POST['fecha'];
        $correo = $_POST['correo'];

        // Crear una instancia de CConexion y obtener la conexión        
        $conexionObjeto = new CConexion();
        $conexion = $conexionObjeto->ConexionBD();

        // Preparar una sentencia preparada para evitar la inyección de SQL
        $stmt = $conexion->prepare("UPDATE persona SET nombre=?, apellido=?, dni=?, fecha_nac=?, correo=? WHERE id_persona=?");

        // Ejecutar la sentencia preparada con los valores proporcionados
        $stmt->execute([$nombre, $apellido, $dni, $fecha, $correo, $id_persona]);

        // Verificar el resultado de la actualización
        if ($stmt->rowCount() == 1) {
            echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
            exit;
        } else {
            echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
            exit;
        }       
        
    } else {
        echo '<div class="alert alert-warning"> Algunos de los campos esta vacío!</div>';
    }
}
?>