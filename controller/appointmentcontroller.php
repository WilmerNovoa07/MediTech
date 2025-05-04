<?php
require_once '../model/modelappointment.php';
class appointmentcontroller{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $appointment=new Modelo();

        $dato=$appointment->mostrar("appointment", "1");
        require_once '../view/appointment/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../view/appointment/AgregarModal.php';
    }
    
    //aca ando haciendo
    public function recibir() {
        // Iniciar sesión para SweetAlert
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Conexión a la base de datos
        include "../config/conex.php";
    
        try {
            $coddoc = $_POST['coddoc'];
            $dates = $_POST['dates'];
            $hour = $_POST['hour'];
            $codpaci = $_POST['codpaci'];
            $codespe = $_POST['codespe'];
            $estado = $_POST['estado'] ?? 'pendiente';
    
            // 1. Primero verificar disponibilidad
            $sql_verificar = "SELECT COUNT(*) as total FROM appointment 
                             WHERE coddoc = ? AND dates = ? AND hour = ?";
            $stmt = $conex->prepare($sql_verificar);
            $stmt->bind_param("sss", $coddoc, $dates, $hour);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
    
            if ($result['total'] > 0) {
                // Buscar horarios disponibles alternativos
                $sql_alternativos = "SELECT hour FROM appointment 
                                   WHERE coddoc = ? AND dates = ? AND hour != ?
                                   ORDER BY hour";
                $stmt = $conex->prepare($sql_alternativos);
                $stmt->bind_param("sss", $coddoc, $dates, $hour);
                $stmt->execute();
                $alternativos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                
                // Preparar mensaje con horarios alternativos
                $horarios = array_column($alternativos, 'hour');
                $mensaje = "Ya existe una cita para el Dr. en esta fecha y hora.";
                
                if (!empty($horarios)) {
                    $mensaje .= "\n\nHorarios disponibles ese día: " . implode(", ", $horarios);
                }
    
                $_SESSION['swal'] = [
                    'icon' => 'error',
                    'title' => 'Cita no disponible',
                    'text' => $mensaje,
                    'footer' => 'Intente con otro horario'
                ];
                
                header("Location: appointment.php");
                exit();
            }
    
            // 2. Si está disponible, insertar
            $sql_insertar = "INSERT INTO appointment (dates, hour, codpaci, coddoc, codespe, estado) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($sql_insertar);
            $stmt->bind_param("ssssss", $dates, $hour, $codpaci, $coddoc, $codespe, $estado);
            
            if ($stmt->execute()) {
                $_SESSION['swal'] = [
                    'icon' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Cita agendada correctamente',
                    'timer' => 2000,
                    'showConfirmButton' => false
                ];
            } else {
                throw new Exception("Error al insertar la cita");
            }
    
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Cita duplicada",
                        text: "El horario seleccionado ya está ocupado",
                        confirmButtonText: "Entendido"
                    });
                });
                </script>';
            }
            exit(); // Detener ejecución
        }
    
    
    

            //ELIMINAR
            function eliminar(){
                $codcit=$_REQUEST['codcit'];
                $condicion="codcit=$codcit";
                $appointment=new Modelo();
                $dato=$appointment->eliminar("appointment", $condicion);
                header("location:appointment.php");
            }

    }
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'codcit' => $_POST['codcit'],
                'dates' => $_POST['dates'],
                'hour' => $_POST['hour'],
                'codpaci' => $_POST['codpaci'],
                'coddoc' => $_POST['coddoc'],
                'codespe' => $_POST['codespe'],
                'estado' => $_POST['estado']
            ];
            
            $condicion = "codcit=".$_POST['codcit'];
            $valores = "dates='".$_POST['dates']."', hour='".$_POST['hour']."', estado=".$_POST['estado'];
            
            if ($this->model->actualizar("appointment", $valores, $condicion)) {
                header("Location: ".$_SERVER['HTTP_REFERER']."&success=1");
            } else {
                header("Location: ".$_SERVER['HTTP_REFERER']."&error=1");
            }
        }
    }
}