<?php
require_once '../model/modelhorario.php'; // Asegúrate de que este archivo contiene la clase Modelo con el método mostrar()

class horariocontroller {
    public $model;

    public function __construct() {
        $this->model = new Modelo(); // Instancia de la clase Modelo
    }

    // Método para mostrar los horarios
    public function mostrar() {
        $modelo = new Modelo();
        $dato = $modelo->mostrarHorarios();
        require_once '../view/horario/mostrar.php';
    }
    

    // Método para insertar un nuevo horario
    public function insertar() {
        $coddoc = $_POST['coddoc'];
        $dia = $_POST['dia'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $estado = isset($_POST['estado']) ? $_POST['estado'] : '1'; // Asigna un valor predeterminado si no está definido
    
        // Verificar conflicto de horario
        if ($this->model->verificarHorario($coddoc, $dia, $hora_inicio, $hora_fin)) {
            echo "Error: Ya existe un horario conflictivo para el doctor en este día y horario.";
        } else {
            // Insertar el horario si no hay conflicto
            if ($this->model->insertarHorario($coddoc, $dia, $hora_inicio, $hora_fin, $estado)) {
                echo "Horario insertado correctamente.";
                header("Location: horario.php");
            } else {
                echo "Error al insertar el horario.";
            }
        }
    }
    
    

    // Aquí puedes agregar otros métodos para las operaciones como editar, actualizar, eliminar, etc.

}
