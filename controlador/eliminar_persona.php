<?php
include_once("modelo/conexion.php");

if (!empty($_GET['id'])){
    $id = $_GET['id'];

    try {
        // Crear una instancia de CConexion y obtener la conexión        
        $conexionObjeto = new CConexion();
        $conexion = $conexionObjeto->ConexionBD();

        // Preparar una sentencia preparada para evitar la inyección de SQL
        $stmt = $conexion->prepare("DELETE FROM persona WHERE id_persona=?");

        // Ejecutar la sentencia preparada con los valores proporcionados
        $stmt->execute([$id]);

        // Verificar el resultado de la eliminación
        if ($stmt->rowCount() == 1) {
            echo '<div class="alert alert-success"> Persona eliminada correctamente!</div>';
        } else {
            echo '<div class="alert alert-warning"> No se encontró la persona con el ID especificado.</div>';
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo '<div class="alert alert-danger"> Error al eliminar persona: ' . $e->getMessage() . '</div>';        
    }
} else {
    //echo '<div class="alert alert-danger"> No se proporcionó un ID válido.</div>';
    
}
?>