<?php
require_once '../model/modelspecialty.php';

class specialtycontroller {
    public $model;

    public function __construct() {
        $this->model = new SpecialtyModel(); // ✅ Usa SpecialtyModel, no Modelo
    }

    function mostrar() {
        $dato = $this->model->getSpecialties(); // ✅ Usa el método correcto
        require_once '../view/specialty/mostrar.php';
    }

    //INSERTAR
    public function nuevo() {
        require_once '../view/specialty/nuevo.php';
    }

    public function recibir() {
        $nombrees = $_POST['txtnomes'];
        $this->model->insertar($nombrees); // ✅ Ajusta según tu modelo
        header("Location: specialty.php");
    }

    //ELIMINAR
    function eliminar() {
        $codespe = $_REQUEST['codespe'];
        $this->model->eliminar($codespe); // ✅ Usa el método del modelo
        header("location:specialty.php");
    }
}