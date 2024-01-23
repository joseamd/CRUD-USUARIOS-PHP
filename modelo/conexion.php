<?php
class CConexion {
    private $conexion;

    public function ConexionBD() {
        $host = "localhost";
        $dbname = "dbphp";
        $username = "postgres";
        $password = "postgres";

        try {
            $this->conexion = new PDO("pgsql:host=$host; dbname=$dbname", $username, $password);
            //echo "Se conectó correctamente a la base de datos";
        } catch (PDOException $exp) {
            echo "No se pudo conectar a la base de datos, $exp";
        }

        return $this->conexion;
    }
}
?>