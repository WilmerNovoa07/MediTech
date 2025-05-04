<?php
class SpecialtyModel {
    public $db;

    // Constructor: establece la conexión a la base de datos
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=trabajo_grado', "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones para errores de PDO
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método para obtener todas las especialidades
    public function getSpecialties() {
        try {
            $query = "SELECT codespe, nombrees FROM specialty";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna un array asociativo
        } catch (PDOException $e) {
            die("Error al obtener las especialidades: " . $e->getMessage());
        }
    }

    // Método para insertar una nueva especialidad
    public function insertar($nombrees) {
        try {
            $query = "INSERT INTO specialty (nombrees) VALUES (:nombrees)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombrees', $nombrees, PDO::PARAM_STR);
            return $stmt->execute(); // Retorna true si la inserción fue exitosa
        } catch (PDOException $e) {
            die("Error al insertar la especialidad: " . $e->getMessage());
        }
    }

    // Método para actualizar una especialidad
    public function actualizar($codespe, $nombrees) {
        try {
            $query = "UPDATE specialty SET nombrees = :nombrees WHERE codespe = :codespe";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nombrees', $nombrees, PDO::PARAM_STR);
            $stmt->bindParam(':codespe', $codespe, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true si la actualización fue exitosa
        } catch (PDOException $e) {
            die("Error al actualizar la especialidad: " . $e->getMessage());
        }
    }

    // Método para eliminar una especialidad
    public function eliminar($codespe) {
        try {
            $query = "DELETE FROM specialty WHERE codespe = :codespe";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':codespe', $codespe, PDO::PARAM_INT);
            return $stmt->execute(); // Retorna true si la eliminación fue exitosa
        } catch (PDOException $e) {
            die("Error al eliminar la especialidad: " . $e->getMessage());
        }
    }
}
?>